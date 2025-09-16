<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Training;
use App\Models\TrainingParticipant;
use App\Models\TrainingRecap;
use App\Models\Workshop;
use PDF;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Idev\EasyAdmin\app\Helpers\Constant;
use Idev\EasyAdmin\app\Http\Controllers\DefaultController;

class TrainingRecapController extends DefaultController
{
    protected $modelClass = TrainingRecap::class;
    protected $title;
    protected $generalUri;
    protected $tableHeaders;
    protected $tableHeadersWithCb;
    protected $actionButtons;
    // protected $arrPermissions;
    protected $importExcelConfig;

    public function __construct()
    {
        $this->title = 'Training Recap';
        $this->generalUri = 'training-recap';
        // $this->arrPermissions = [];
        $this->actionButtons = ['btn_delete'];

        $this->tableHeaders = [
                    ['name' => 'No', 'column' => '#', 'order' => true], 
                    ['name' => 'Workshop', 'column' => 'workshop', 'order' => true], 
                    ['name' => 'Employee', 'column' => 'employee', 'order' => true], 
                    ['name' => 'Department', 'column' => 'department', 'order' => true], 
                    ['name' => 'Date', 'column' => 'date', 'order' => true], 
                    ['name' => 'Created at', 'column' => 'created_at', 'order' => true],
                    ['name' => 'Updated at', 'column' => 'updated_at', 'order' => true],
        ];

        $this->tableHeadersWithCb = [
                ['name' => 'Workshop', 'column' => 'workshop', 'order' => true], 
                ['name' => 'Employee', 'column' => 'employee', 'order' => true], 
                ['name' => 'Department', 'column' => 'department', 'order' => true], 
                ['name' => 'Date', 'column' => 'date', 'order' => true], 
                ['name' => 'Created at', 'column' => 'created_at', 'order' => true],
                ['name' => 'Updated at', 'column' => 'updated_at', 'order' => true],
        ];
    }

    public function index()
    {
        $moreActions = [
        ];

        $permissions = (new Constant())->permissionByMenu($this->generalUri);
        $data['permissions'] = $permissions;
        $data['more_actions'] = $moreActions;
        // $data['headerLayout'] = $this->pageHeaderLayout;
        $data['table_headers'] = (request('training_id')) ? $this->tableHeaders : $this->tableHeadersWithCb;
        $data['title'] = $this->title;
        $data['uri_key'] = $this->generalUri;
        $data['uri_list_api'] = route($this->generalUri . '.listapi') . "?training_id=" . request('training_id');
        $data['uri_create'] = route($this->generalUri . '.create');
        $data['url_store'] = route($this->generalUri . '.store') . "?training_id=" . request('training_id');
        // $data['fields'] = $this->fields();
        $data['fields'] = $this->createFields(request('training_id'));
        $data['edit_fields'] = $this->fields('edit');
        $data['actionButtonViews'] = [
            'easyadmin::backend.idev.buttons.delete',
        ];
        $data['templateImportExcel'] = "#";
        $data['import_scripts'] = $this->importScripts;
        $data['import_styles'] = $this->importStyles;
        // $data['filters'] = $this->filters();
        $data['filters'] = request('training_id') ? $this->filters() : [];
        $data['drawerExtraClass'] = 'w-50';

        $layout = 'easyadmin::backend.idev.list_drawer';

        if (request('training_id')) {
            $layout = 'easyadmin::backend.idev.list_drawer_with_checkbox';
        }
        
        return view($layout, $data);
    }

    protected function filters()
    {
        $department = Department::get(['id as value', 'name as text']);
        $workshop = Workshop::get(['id as value', 'name as text']);

        $fields = [
            [
                'type' => 'select',
                'label' => 'Department',
                'name' => 'filter_department_id',
                'class' => 'col-md-3',
                'options' => $department,
            ],
            [
                'type' => 'select',
                'label' => 'Workshop',
                'name' => 'filter_workshop_id',
                'class' => 'col-md-3',
                'options' => $workshop,
            ],
        ];

        return $fields;
    }

    public function indexApi()
    {
        $permission = (new Constant)->permissionByMenu($this->generalUri);
        // $permission[] = 'answer';

        $eb = [];
        $data_columns = [];
        if (request('training_id') != null) {
            foreach ($this->tableHeaders as $key => $col) {
                if ($key > 0) {
                    $data_columns[] = $col['column'];
                }
            }
        } else {
            $data_columns[] = 'cb_event';
            foreach ($this->tableHeadersWithCb as $key => $col) {
                $data_columns[] = $col['column'];
            }
        }

        foreach ($this->actionButtons as $key => $ab) {
            if (in_array(str_replace("btn_", "", $ab), $permission)) {
                $eb[] = $ab;
            }
        }

        $dataQueries = $this->defaultDataQuery()->paginate(10);

        $datas['extra_buttons'] = $eb;
        $datas['data_columns'] = $data_columns;
        $datas['data_queries'] = $dataQueries;
        $datas['data_permissions'] = $permission;
        $datas['uri_key'] = $this->generalUri;

        return $datas;
    }

    protected function defaultDataQuery()
    {
        $filters = [];
        $orThose = null;
        $orderBy = 'id';
        $orderState = 'DESC';
        if (request('search')) {
            $orThose = request('search');
        }
        if (request('order')) {
            $orderBy = request('order');
            $orderState = request('order_state');
        }

        if (request('training_id')) {
        $filters[] = ['training_participants.training_id', '=', request('training_id')];
        }

        if (request('filter_department_id')) {
            $filters[] = ['departments.id', '=', request('filter_department_id')];
        }

        if (request('filter_workshop_id')) {
            $filters[] = ['workshops.id', '=', request('filter_workshop_id')];
        }

        $dataQueries = TrainingParticipant::join('employees', 'employees.id', '=', 'training_participants.employee_id')
        ->join('trainings', 'trainings.id', '=', 'training_participants.training_id')
        ->join('workshops', 'workshops.id', '=', 'training_participants.workshop_id')
        ->join('departments', 'departments.id', '=', 'employees.department_id')
        ->where($filters)
        ->where(function ($query) use ($orThose) {
            $query->where('workshops.name', 'LIKE', '%' . $orThose . '%');
            $query->orWhere('employees.first_name', 'LIKE', '%' . $orThose . '%');
            $query->orWhere('departments.name', 'LIKE', '%' . $orThose . '%');
            $query->orWhere('training_participants.date', 'LIKE', '%' . $orThose . '%');
        })
        ->orderBy($orderBy, $orderState)
        ->select('training_participants.*', 'workshops.name as workshop', 'employees.first_name as employee', 'departments.name as department');

        return $dataQueries;
    }

    protected function createFields($trainingId)
    {
        $workshop = Workshop::get(['id as value', 'name as text']);
        $fields[] = [
                'type' => 'select',
                'label' => 'Workshop',
                'name' => 'workshop_id',
                'class' => 'col-md-12 my-2',
                'required' => true,
                'value' => '',
                'options' => $workshop
            ];

        return $fields;
    }

    protected function fields($mode = "create", $id = '-')
    {
        $edit = null;
        if ($id != '-') {
            $edit = $this->modelClass::where('id', $id)->first();
        }

        $fields = [
        ];
        
        return $fields;
    }


    protected function rules($id = null)
    {
        $rules = [
        ];

        return $rules;
    }

    public function bulkUpdate(Request $request)
    {
        $trainingId = $request->event_id;
        $workshopId = $request->question_ids;

        $arrWorkshopId = json_decode($workshopId, true);

        $trainingParticipant = TrainingParticipant::whereIn('id', $arrWorkshopId)->get();

        try {
            DB::beginTransaction();
            
            $numb = 0;
            foreach ($trainingParticipant as $key => $q) {

                $q->workshop_id = $trainingId;
                $q->save();
                $updatedCount ++;
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'alert' => 'success',
                'message' => $updatedCount.' Question(s) Was Created Successfully',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}

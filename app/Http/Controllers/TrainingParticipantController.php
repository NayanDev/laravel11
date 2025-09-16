<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Training;
use App\Models\TrainingParticipant;
use App\Models\Workshop;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Idev\EasyAdmin\app\Helpers\Constant;
use Idev\EasyAdmin\app\Helpers\Validation;
use Idev\EasyAdmin\app\Http\Controllers\DefaultController;
use Illuminate\Support\Facades\DB;

class TrainingParticipantController extends DefaultController
{
    protected $modelClass = TrainingParticipant::class;
    protected $title;
    protected $generalUri;
    protected $tableHeaders;
    // protected $actionButtons;
    // protected $arrPermissions;
    protected $importExcelConfig;

    public function __construct()
    {
        $this->title = 'Training Participant';
        $this->generalUri = 'training-participant';
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


        $this->importExcelConfig = [ 
            'primaryKeys' => [''],
            'headers' => [ 
            ]
        ];
    }

    public function index()
    {
        $baseUrlExcel = route($this->generalUri.'.export-excel-default');
        $baseUrlPdf = route($this->generalUri.'.export-pdf-default');

        $params = "";
        if(request('training_id')){
            $params = "?training_id=".request('training_id');
        }

        $moreActions = [
            [
                'key' => 'export-pdf-default',
                'name' => 'Export Pdf',
                'html_button' => "<a id='export-pdf' data-base-url='".$baseUrlPdf."' class='btn btn-sm btn-danger radius-6' target='_blank' href='" . url($this->generalUri . '-export-pdf-default') . "' title='Export PDF'><i class='ti ti-file'></i> Print</a>"
            ],
        ];

        $permissions =  $this->arrPermissions;
        if ($this->dynamicPermission) {
            $permissions = (new Constant())->permissionByMenu($this->generalUri);
        }
        $layout = (request('from_ajax') && request('from_ajax') == true) ? 'easyadmin::backend.idev.list_drawer_ajax' : 'easyadmin::backend.idev.list_drawer';
        if(isset($this->drawerLayout)){
            $layout = $this->drawerLayout;
        }
        $data['permissions'] = $permissions;
        $data['more_actions'] = $moreActions;
        $data['headerLayout'] = $this->pageHeaderLayout;
        $data['table_headers'] = $this->tableHeaders;
        $data['title'] = $this->title;
        $data['uri_key'] = $this->generalUri;
        $data['uri_list_api'] = route($this->generalUri . '.listapi') . $params;
        $data['uri_create'] = route($this->generalUri . '.create');
        $data['url_store'] = route($this->generalUri . '.store');
        // $data['fields'] = $this->fields();
        $data['fields'] = $this->createFields(request('training_id'));
        $data['edit_fields'] = $this->fields('edit');
        $data['actionButtonViews'] = $this->actionButtonViews;
        $data['templateImportExcel'] = "#";
        $data['import_scripts'] = $this->importScripts;
        $data['import_styles'] = $this->importStyles;
        $data['filters'] = $this->filters();
        
        return view($layout, $data);
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

    private function createFields($trainingId)
    {
        if(isset($trainingId)){
            $training = Training::where('id', $trainingId)->first();
            $workshop = Workshop::select(['id as value', 'name as text'])->get();
            $planning = [
                ['value' => 'planned', 'text' => 'Planned'],
                ['value' => 'unplanned', 'text' => 'Unplanned'],
            ];
            $fields = [
                [
                    'type' => 'text',
                    'label' => 'Training Id',
                    'name' => 'training_id',
                    'class' => 'col-md-12 my-2',
                    'value' => $training ? $training->id : ''
                ],
                
                [
                    'type' => 'select2',
                    'label' => 'Workshop',
                    'name' => 'workshop_id',
                    'class' => 'col-md-12 my-2',
                    'options' => $workshop,
                    'value' => ''
                ],
                [
                    'type' => 'select2',
                    'label' => 'Planing',
                    'name' => 'plan',
                    'class' => 'col-md-12 my-2',
                    'options' => $planning,
                    'value' => ''
                ],
                [
                    'type' => 'datetime',
                    'label' => 'Date',
                    'name' =>  'date',
                    'class' => 'col-md-12 my-2',
                    'value' => (isset($edit)) ? $edit->name : ''
                ],
                [
                    'type' => 'bulktable_ajax',
                    'label' => 'Participant',
                    'name' => 'employee_id',
                    'class' => 'col-md-12 my-2',
                    'key' => 'employeeId',
                    'ajaxUrl' => url('participant-ajax'),
                    'table_headers' => ['Name', 'Department', 'Position']
                ],
            ];
        }else{
            $training = Training::get(['id as value', 'name as text']);

            $fields = [
                [
                    'type' => 'select2',
                    'label' => 'Event',
                    'name' => 'event_id',
                    'class' => 'col-md-12 my-2',
                    'options' => $training,
                    'value' => ''
                ],
                [
                    'type' => 'bulktable_ajax',
                    'label' => 'Peserta',
                    'name' => 'participants',
                    'class' => 'col-md-12 my-2',
                    'key' => 'id',
                    'ajaxUrl' => url('participant-ajax'),
                    'table_headers' => ['Nama']
                ],
            ];
        }

        return $fields;
    }

    protected function fields($mode = "create", $id = '-')
    {
        $edit = null;
        if ($id != '-') {
            $edit = $this->modelClass::where('id', $id)->first();
        }

        $workshop = Workshop::select(['id as value', 'name as text'])->get();
        $planning = [
            ['value' => 'planned', 'text' => 'Planned'],
            ['value' => 'unplanned', 'text' => 'Unplanned'],
        ];

        $fields = [
                [
                    'type' => 'select2',
                    'label' => 'Workshop',
                    'name' => 'workshop_id',
                    'class' => 'col-md-12 my-2',
                    'options' => $workshop,
                    'value' => ''
                ],
                [
                    'type' => 'select2',
                    'label' => 'Planing',
                    'name' => 'plan',
                    'class' => 'col-md-12 my-2',
                    'options' => $planning,
                    'value' => ''
                ],
                [
                    'type' => 'datetime',
                    'label' => 'Date',
                    'name' =>  'date',
                    'class' => 'col-md-12 my-2',
                    'required' => $this->flagRules('name', $id),
                    'value' => (isset($edit)) ? $edit->name : ''
                ],
                [
                    'type' => 'bulktable_ajax',
                    'label' => 'Participant',
                    'name' => 'employee_id',
                    'class' => 'col-md-12 my-2',
                    'key' => 'employeeId',
                    'ajaxUrl' => url('participant-ajax'),
                    'table_headers' => ['Name', 'Department', 'Position']
                ],
        ];
        
        return $fields;
    }

    public function participantAjax()
    {
        $filters = [];
        $orThose = null;
        if (request('search')) {
            $orThose = request('search');
        }

        $dataQueries = Employee::join('departments', 'departments.id', '=', 'employees.department_id')
            ->join('positions', 'positions.id', '=', 'employees.position_id')
            ->join('qualifications', 'qualifications.id', '=', 'employees.qualification_id')
            ->where($filters)
            ->where(function ($query) use ($orThose) {
                $query->where('employees.first_name', 'LIKE', '%' . $orThose . '%')
                    ->orWhere('employees.email', 'LIKE', '%' . $orThose . '%')
                    ->orWhere('departments.name', 'LIKE', '%' . $orThose . '%')
                    ->orWhere('positions.name', 'LIKE', '%' . $orThose . '%')
                    ->orWhere('qualifications.name', 'LIKE', '%' . $orThose . '%');
            })
                ->select(
                'employees.id as employeeId',
                'employees.first_name as employee',
                'departments.name as department',
                'positions.name as position',
                'qualifications.name as qualification'
            )
            ->paginate(10);

        $data['header'] = ['employee', 'department', 'position'];
        $data['body'] = $dataQueries;

        return $data;
    }

    protected function rules($id = null)
    {
        $rules = [
        ];

        return $rules;
    }

    protected function store(Request $request)
    {
        $rules = $this->rules();
        $strParticipants = $request->employee_id;

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $messageErrors = (new Validation)->modify($validator, $rules);

            return response()->json([
                'status' => false,
                'alert' => 'danger',
                'message' => 'Required Form',
                'validation_errors' => $messageErrors,
            ], 200);
        }

        DB::beginTransaction();

        try 
        {
            $arrParticipant = json_decode($strParticipants, true);
            $users = Employee::whereIn('id', $arrParticipant)->get();

            foreach($users as $key => $user){
                $insert = new TrainingParticipant();
                $insert->employee_id = $user->id;
                $insert->training_id = $request->training_id;
                $insert->workshop_id = $request->workshop_id;
                $insert->plan = $request->plan;
                $insert->status = 'open';
                $insert->user_id = Auth::user()->id;
                $insert->date = $request->date;
                $insert->save();
            }
            
            DB::commit();

            return response()->json([
                'status' => true,
                'alert' => 'success',
                'message' => 'Data Was Created Successfully',
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

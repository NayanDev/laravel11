<?php

namespace App\Http\Controllers;

use App\Models\TrainingParticipant;
use App\Models\TrainingRecap;
use Idev\EasyAdmin\app\Helpers\Constant;
use Idev\EasyAdmin\app\Http\Controllers\DefaultController;

class TrainingRecapController extends DefaultController
{
    protected $modelClass = TrainingRecap::class;
    protected $title;
    protected $generalUri;
    protected $tableHeaders;
    // protected $actionButtons;
    // protected $arrPermissions;
    protected $importExcelConfig;

    public function __construct()
    {
        $this->title = 'Training Recap';
        $this->generalUri = 'training-recap';
        // $this->arrPermissions = [];
        $this->actionButtons = [];

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
        $data['fields'] = $this->fields();
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

}

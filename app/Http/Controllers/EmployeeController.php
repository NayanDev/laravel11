<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Qualification;
use Idev\EasyAdmin\app\Helpers\Constant;
use Idev\EasyAdmin\app\Http\Controllers\DefaultController;

class EmployeeController extends DefaultController
{
    protected $modelClass = Employee::class;
    protected $title;
    protected $generalUri;
    protected $tableHeaders;
    // protected $actionButtons;
    // protected $arrPermissions;
    protected $importExcelConfig;

    public function __construct()
    {
        $this->title = 'Employee';
        $this->generalUri = 'employee';
        // $this->arrPermissions = [];
        $this->actionButtons = ['btn_edit', 'btn_delete'];

        $this->tableHeaders = [
                    ['name' => 'No', 'column' => '#', 'order' => true], 
                    ['name' => 'Name', 'column' => 'first_name', 'order' => true], 
                    ['name' => 'Email', 'column' => 'email', 'order' => true], 
                    ['name' => 'Department', 'column' => 'department', 'order' => true], 
                    ['name' => 'Position', 'column' => 'position', 'order' => true], 
                    ['name' => 'Qualification', 'column' => 'qualification', 'order' => true], 
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

        $moreActions = [
            [
                'key' => 'import-excel-default',
                'name' => 'Import Excel',
                'html_button' => "<button id='import-excel' type='button' class='btn btn-sm btn-info radius-6' href='#' data-bs-toggle='modal' data-bs-target='#modalImportDefault' title='Import Excel' ><i class='ti ti-upload'></i></button>"
            ],
            [
                'key' => 'export-excel-default',
                'name' => 'Export Excel',
                'html_button' => "<a id='export-excel' data-base-url='".$baseUrlExcel."' class='btn btn-sm btn-success radius-6' target='_blank' href='" . url($this->generalUri . '-export-excel-default') . "'  title='Export Excel'><i class='ti ti-cloud-download'></i></a>"
            ],
            [
                'key' => 'export-pdf-default',
                'name' => 'Export Pdf',
                'html_button' => "<a id='export-pdf' data-base-url='".$baseUrlPdf."' class='btn btn-sm btn-danger radius-6' target='_blank' href='" . url($this->generalUri . '-export-pdf-default') . "' title='Export PDF'><i class='ti ti-file'></i></a>"
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
        $data['uri_list_api'] = route($this->generalUri . '.listapi');
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
                ->orderBy($orderBy, $orderState)
                ->select(
                'employees.*',
                'departments.name as department',
                'positions.name as position',
                'qualifications.name as qualification'
            );

        return $dataQueries;
    }

    protected function fields($mode = "create", $id = '-')
    {
        $edit = null;
        if ($id != '-') {
            $edit = $this->modelClass::where('id', $id)->first();
        }

        $gender = [
            ['value' => 'L', 'text' => 'Male'],
            ['value' => 'P', 'text' => 'Female'],
        ];


        $department = Department::select(['id as value', 'name as text'])->get();
        $position = Position::select(['id as value', 'name as text'])->get();
        $qualification = Qualification::select(['id as value', 'name as text'])->get();

        $fields = [
                    [
                        'type' => 'text',
                        'label' => 'First Name',
                        'name' =>  'first_name',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->first_name : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'last_name',
                        'name' =>  'last_name',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->last_name : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'Email',
                        'name' =>  'email',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->email : ''
                    ],
                    [
                        'type' => 'number',
                        'label' => 'Phone Number',
                        'name' =>  'phone_number',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->phone_number : ''
                    ],
                    [
                        'type' => 'select2',
                        'label' => 'Gender',
                        'name' =>  'gender',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->gender : '',
                        'options' => $gender
                    ],
                    [
                        'type' => 'select2',
                        'label' => 'Department',
                        'name' =>  'department_id',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->department_id : '',
                        'options' => $department
                    ],
                    [
                        'type' => 'select2',
                        'label' => 'Position',
                        'name' =>  'position_id',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->position_id : '',
                        'options' => $position
                    ],
                    [
                        'type' => 'select2',
                        'label' => 'Qualification',
                        'name' =>  'qualification_id',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->qualification_id : '',
                        'options' => $qualification
                    ],
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

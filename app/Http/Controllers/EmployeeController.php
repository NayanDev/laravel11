<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Qualification;
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
                    ['name' => 'Department', 'column' => 'department_id', 'order' => true], 
                    ['name' => 'Position', 'column' => 'position_id', 'order' => true], 
                    ['name' => 'Qualification', 'column' => 'qualification_id', 'order' => true], 
                    ['name' => 'Created at', 'column' => 'created_at', 'order' => true],
                    ['name' => 'Updated at', 'column' => 'updated_at', 'order' => true],
        ];


        $this->importExcelConfig = [ 
            'primaryKeys' => [''],
            'headers' => [ 
            ]
        ];
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

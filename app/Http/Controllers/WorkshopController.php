<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Workshop;
use Idev\EasyAdmin\app\Http\Controllers\DefaultController;

class WorkshopController extends DefaultController
{
    protected $modelClass = Workshop::class;
    protected $title;
    protected $generalUri;
    protected $tableHeaders;
    // protected $actionButtons;
    // protected $arrPermissions;
    protected $importExcelConfig;

    public function __construct()
    {
        $this->title = 'Workshop';
        $this->generalUri = 'workshop';
        // $this->arrPermissions = [];
        $this->actionButtons = ['btn_edit', 'btn_delete'];

        $this->tableHeaders = [
                    ['name' => 'No', 'column' => '#', 'order' => true], 
                    ['name' => 'Name', 'column' => 'name', 'order' => true], 
                    ['name' => 'Department', 'column' => 'department_id', 'order' => true], 
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

        $department = Department::select(['id as value', 'name as text'])->get();

        $fields = [
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
                        'type' => 'text',
                        'label' => 'Workshop Name',
                        'name' =>  'name',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('name', $id),
                        'value' => (isset($edit)) ? $edit->name : ''
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

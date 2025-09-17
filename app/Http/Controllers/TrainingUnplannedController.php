<?php

namespace App\Http\Controllers;

use App\Models\TrainingParticipant;
use App\Models\TrainingUnplanned;
use Idev\EasyAdmin\app\Http\Controllers\DefaultController;

class TrainingUnplannedController extends DefaultController
{
    protected $modelClass = TrainingUnplanned::class;
    protected $title;
    protected $generalUri;
    protected $tableHeaders;
    // protected $actionButtons;
    // protected $arrPermissions;
    protected $importExcelConfig;

    public function __construct()
    {
        $this->title = 'Training Unplanned';
        $this->generalUri = 'training-unplanned';
        // $this->arrPermissions = [];
        $this->actionButtons = [];

        $this->tableHeaders = [
                    ['name' => 'No', 'column' => '#', 'order' => true],
                    ['name' => 'Employee', 'column' => 'employee', 'order' => true],
                    ['name' => 'Workshop', 'column' => 'workshop', 'order' => true],
                    ['name' => 'Department', 'column' => 'department', 'order' => true],
                    ['name' => 'Status', 'column' => 'status', 'order' => true],
                    ['name' => 'Created By', 'column' => 'user', 'order' => true],
                    ['name' => 'Date', 'column' => 'date', 'order' => true], 
                    ['name' => 'Created at', 'column' => 'created_at', 'order' => true],
                    ['name' => 'Updated at', 'column' => 'updated_at', 'order' => true],
        ];


        $this->importExcelConfig = [ 
            'primaryKeys' => ['employee_id'],
            'headers' => [
                    ['name' => 'Employee id', 'column' => 'employee_id'],
                    ['name' => 'Training id', 'column' => 'training_id'],
                    ['name' => 'Workshop id', 'column' => 'workshop_id'],
                    ['name' => 'Plan', 'column' => 'plan'],
                    ['name' => 'Status', 'column' => 'status'],
                    ['name' => 'User id', 'column' => 'user_id'],
                    ['name' => 'Date', 'column' => 'date'], 
            ]
        ];
    }


    protected function fields($mode = "create", $id = '-')
    {
        $edit = null;
        if ($id != '-') {
            $edit = $this->modelClass::where('id', $id)->first();
        }

        $fields = [
                    [
                        'type' => 'text',
                        'label' => 'Employee id',
                        'name' =>  'employee_id',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('employee_id', $id),
                        'value' => (isset($edit)) ? $edit->employee_id : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'Training id',
                        'name' =>  'training_id',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('training_id', $id),
                        'value' => (isset($edit)) ? $edit->training_id : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'Workshop id',
                        'name' =>  'workshop_id',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('workshop_id', $id),
                        'value' => (isset($edit)) ? $edit->workshop_id : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'Plan',
                        'name' =>  'plan',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('plan', $id),
                        'value' => (isset($edit)) ? $edit->plan : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'Status',
                        'name' =>  'status',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('status', $id),
                        'value' => (isset($edit)) ? $edit->status : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'User id',
                        'name' =>  'user_id',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('user_id', $id),
                        'value' => (isset($edit)) ? $edit->user_id : ''
                    ],
                    [
                        'type' => 'text',
                        'label' => 'Date',
                        'name' =>  'date',
                        'class' => 'col-md-12 my-2',
                        'required' => $this->flagRules('date', $id),
                        'value' => (isset($edit)) ? $edit->date : ''
                    ],
        ];
        
        return $fields;
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

        $filters[] = ['training_participants.plan', '=', 'unplanned'];

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
        ->join('users', 'users.id', '=', 'training_participants.user_id')
        ->where($filters)
        ->where(function ($query) use ($orThose) {
            $query->where('workshops.name', 'LIKE', '%' . $orThose . '%');
            $query->orWhere('employees.first_name', 'LIKE', '%' . $orThose . '%');
            $query->orWhere('departments.name', 'LIKE', '%' . $orThose . '%');
            $query->orWhere('training_participants.date', 'LIKE', '%' . $orThose . '%');
        })
        ->orderBy($orderBy, $orderState)
        ->select('training_participants.*', 'workshops.name as workshop', 'employees.first_name as employee', 'departments.name as department', 'users.name as user');

        return $dataQueries;
    }

    protected function rules($id = null)
    {
        $rules = [
                    'employee_id' => 'required|string',
                    'training_id' => 'required|string',
                    'workshop_id' => 'required|string',
                    'plan' => 'required|string',
                    'status' => 'required|string',
                    'user_id' => 'required|string',
                    'date' => 'required|string',
        ];

        return $rules;
    }

}

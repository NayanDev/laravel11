<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingParticipantController;
use App\Http\Controllers\TrainingRecapController;
use App\Http\Controllers\TrainingUnplannedController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;


    Route::group(['middleware' => ['web', 'auth']], function () {
        // Route Department
        Route::resource('department', DepartmentController::class);
        Route::get('department-api', [DepartmentController::class, 'indexApi'])->name('department.listapi');
        Route::get('department-export-pdf-default', [DepartmentController::class, 'exportPdf'])->name('department.export-pdf-default');
        Route::get('department-export-excel-default', [DepartmentController::class, 'exportExcel'])->name('department.export-excel-default');
        Route::post('department-import-excel-default', [DepartmentController::class, 'importExcel'])->name('department.import-excel-default');

        // Route Position
        Route::resource('position', PositionController::class);
        Route::get('position-api', [PositionController::class, 'indexApi'])->name('position.listapi');
        Route::get('position-export-pdf-default', [PositionController::class, 'exportPdf'])->name('position.export-pdf-default');
        Route::get('position-export-excel-default', [PositionController::class, 'exportExcel'])->name('position.export-excel-default');
        Route::post('position-import-excel-default', [PositionController::class, 'importExcel'])->name('position.import-excel-default');

        // Route Qualification
        Route::resource('qualification', QualificationController::class);
        Route::get('qualification-api', [QualificationController::class, 'indexApi'])->name('qualification.listapi');
        Route::get('qualification-export-pdf-default', [QualificationController::class, 'exportPdf'])->name('qualification.export-pdf-default');
        Route::get('qualification-export-excel-default', [QualificationController::class, 'exportExcel'])->name('qualification.export-excel-default');
        Route::post('qualification-import-excel-default', [QualificationController::class, 'importExcel'])->name('qualification.import-excel-default');

        // Route Employee
        Route::resource('employee', EmployeeController::class);
        Route::get('employee-api', [EmployeeController::class, 'indexApi'])->name('employee.listapi');
        Route::get('employee-export-pdf-default', [EmployeeController::class, 'exportPdf'])->name('employee.export-pdf-default');
        Route::get('employee-export-excel-default', [EmployeeController::class, 'exportExcel'])->name('employee.export-excel-default');
        Route::post('employee-import-excel-default', [EmployeeController::class, 'importExcel'])->name('employee.import-excel-default');

        // Route Workshop
        Route::resource('workshop', WorkshopController::class);
        Route::get('workshop-api', [WorkshopController::class, 'indexApi'])->name('workshop.listapi');
        Route::get('workshop-export-pdf-default', [WorkshopController::class, 'exportPdf'])->name('workshop.export-pdf-default');
        Route::get('workshop-export-excel-default', [WorkshopController::class, 'exportExcel'])->name('workshop.export-excel-default');
        Route::post('workshop-import-excel-default', [WorkshopController::class, 'importExcel'])->name('workshop.import-excel-default');

        // Route Training
        Route::resource('training', TrainingController::class);
        Route::get('training-api', [TrainingController::class, 'indexApi'])->name('training.listapi');
        Route::get('training-export-jadwal', [TrainingController::class, 'exporJadwalPdf'])->name('training.export-jadwal-pdf');
        Route::get('training-export-pdf-default', [TrainingController::class, 'exportPdf'])->name('training.export-pdf-default');
        Route::get('training-export-excel-default', [TrainingController::class, 'exportExcel'])->name('training.export-excel-default');
        Route::post('training-import-excel-default', [TrainingController::class, 'importExcel'])->name('training.import-excel-default');

        // Route Training Participant
        Route::resource('training-participant', TrainingParticipantController::class);
        Route::get('training-participant-api', [TrainingParticipantController::class, 'indexApi'])->name('training-participant.listapi');
        Route::get('training-participant-export-excel-default', [TrainingParticipantController::class, 'exportExcel'])->name('training-participant.export-excel-default');
        Route::post('training-participant-import-excel-default', [TrainingParticipantController::class, 'importExcel'])->name('training-participant.import-excel-default');
        Route::get('participant-ajax', [TrainingParticipantController::class, 'participantAjax']);
        Route::get('training-participant-export-pdf', [TrainingParticipantController::class, 'exportPdf'])->name('training-participant.export-pdf');

        // Route Training Recap Data
        Route::resource('training-recap', TrainingRecapController::class);
        Route::get('training-recap-api', [TrainingRecapController::class, 'indexApi'])->name('training-recap.listapi');
        Route::get('training-recap-export-pdf-default', [TrainingRecapController::class, 'exportPdf'])->name('training-recap.export-pdf-default');
        Route::get('training-recap-export-excel-default', [TrainingRecapController::class, 'exportExcel'])->name('training-recap.export-excel-default');
        Route::post('training-recap-import-excel-default', [TrainingRecapController::class, 'importExcel'])->name('training-recap.import-excel-default');
        Route::post('training-recap-bulk-update', [TrainingRecapController::class, 'bulkUpdate'])->name('training-recap.bulk-update');

        // Route Training Unplanned
        Route::resource('training-unplanned', TrainingUnplannedController::class);
        Route::get('training-unplanned-api', [TrainingUnplannedController::class, 'indexApi'])->name('training-unplanned.listapi');
        Route::get('training-unplanned-export-pdf-default', [TrainingUnplannedController::class, 'exportPdf'])->name('training-unplanned.export-pdf-default');
        Route::get('training-unplanned-export-excel-default', [TrainingUnplannedController::class, 'exportExcel'])->name('training-unplanned.export-excel-default');
        Route::post('training-unplanned-import-excel-default', [TrainingUnplannedController::class, 'importExcel'])->name('training-unplanned.import-excel-default');
    });
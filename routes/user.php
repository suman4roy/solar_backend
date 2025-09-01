<?php

use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\EmployeeController;

Route::group(['prefix'=>'customer'],function(){
                Route::post('basic-info/add/{id?}',[CustomerController::class,'addBasicInfo']); 
                Route::post('bank-info/add/{id?}',[CustomerController::class,'addBankInfo']); 
                Route::post('document-upload/add/{id?}',[CustomerController::class,'addDocumentUpload']); 
                Route::post('installation-address/add/{id?}',[CustomerController::class,'addInstallationAddress']); 
        });

        Route::group(['prefix'=>'employee'],function(){
                Route::post('add/{id?}',[EmployeeController::class,'addUpdateEmployee']);
                Route::delete('delete/{id}',[EmployeeController::class,'deleteEmployee']);
        });
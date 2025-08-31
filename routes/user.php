<?php

use App\Http\Controllers\Api\Customer\CustomerController;

Route::group(['prefix'=>'customer'],function(){
                Route::post('basic-info/add',[CustomerController::class,'addBasicInfo']); 
                Route::post('bank-info/add',[CustomerController::class,'addBankInfo']); 
                Route::post('document-upload/add',[CustomerController::class,'addDocumentUpload']); 
                Route::post('installation-address/add',[CustomerController::class,'addInstallationAddress']); 
        });
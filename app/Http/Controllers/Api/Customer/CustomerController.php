<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use App\Models\BankInfo;
use App\Models\DocumentUpload;
use App\Models\InstallationAddress;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{
    public function addBasicInfo(Request $request, $id = null)
    {
         $validation = Validator::make($request->all(),[ 
            'first_name' => 'required|string|max:255',
            'middle_name' => 'string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:basic_infos,email'.($id ? ','.$id : ''),
            'phone' => 'required|string|max:15|unique:basic_infos,phone'.($id ? ','.$id : ''),
            'alternate_phone' => 'required|string|max:15|unique:basic_infos,phone'.($id ? ','.$id : ''),
            'occupation' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 500,
                'message' => 'Validation failed',
                'err' => $validation->errors()
            ], 500);
        }

        try {
            $data = BasicInfo::updateOrCreate(
                ['id' => $id],
                [
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'alternate_phone' => $request->alternate_phone,
                    'occupation' => $request->occupation,
                    'gender' => $request->gender
                ]
            );
            return response()->json([
                'status' => 200,
                'message' => 'Basic info added successfully',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong in server',
                'err' => $e->getMessage()
            ], 500);
        }
    }


     public function addBankInfo(Request $request, $id = null)
    {
         $validation = Validator::make($request->all(),[ 
            'finance_type' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'account_no' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 500,
                'message' => 'Validation failed',
                'err' => $validation->errors()
            ], 500);
        }

        try {
            $data = BankInfo::updateOrCreate(
                ['id' => $id],
                [
                'finance_type' => $request->finance_type,
                'bank_name' => $request->bank_name,
                'account_no' => $request->account_no,
                'ifsc_code' => $request->ifsc_code,
                'account_holder' => $request->account_holder,
                'branch' => $request->branch,
                ]
            );
            return response()->json([
                'status' => 200,
                'message' => 'Bank info added successfully',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong in server',
                'err' => $e->getMessage()
            ], 500);
        }
    }

    public function addDocumentUpload(Request $request, $id = null)
    {
         $validation = Validator::make($request->all(),[ 
            'aadhar_card_front' => 'required|mimes:png,jpg,pdf,jpeg|max:2048',
            'aadhar_card_back' => 'required|mimes:png,jpg,pdf,jpeg|max:2048',
            'aadhar_card_no'=>'required|string|max:255',
            'pan_card_front' => 'required|mimes:png,jpg,pdf,jpeg|max:2048',
            'pan_card_back' => 'required|mimes:png,jpg,pdf,jpeg|max:2048',
            'pan_card_no'=>'required|string|max:255',
            'electricity_bill' => 'required|mimes:png,jpg,pdf,jpeg|max:2048',
            'bank_cancelled_cheque' => 'required|mimes:png,jpg,pdf,jpeg|max:2048',
            'consumer_no'=>'required|string|max:255',

        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 500,
                'message' => 'Validation failed',
                'err' => $validation->errors()
            ], 500);
        }

        try {

                if ($id) {
                    $document_upload = DocumentUpload::findOrFail($id);
                }else{
                    $document_upload =  new DocumentUpload();
                }
            
            $document_upload->aadhar_card_no = $request->aadhar_card_no;
            $document_upload->pan_card_no = $request->pan_card_no;
            $document_upload->consumer_no = $request->consumer_no;

            if ($request->hasFile('aadhar_card_front')) {
                ImageService::delete($document_upload->aadhar_card_front);
                $document_upload->aadhar_card_front = ImageService::save($request->file('aadhar_card_front'));
            }

            if ($request->hasFile('aadhar_card_back')) {
                ImageService::delete($document_upload->aadhar_card_back);
                $document_upload->aadhar_card_back = ImageService::save($request->file('aadhar_card_back'));
            }
            if ($request->hasFile('pan_card_front')) {
                ImageService::delete($document_upload->pan_card_front);
                $document_upload->pan_card_front = ImageService::save($request->file('pan_card_front'));
            }
            if ($request->hasFile('pan_card_back')) {
                ImageService::delete($document_upload->pan_card_back);
                $document_upload->pan_card_back = ImageService::save($request->file('pan_card_back'));
            }
            if ($request->hasFile('electricity_bill')) {
                ImageService::delete($document_upload->electricity_bill);
                $document_upload->electricity_bill = ImageService::save($request->file('electricity_bill'));
            }
            if ($request->hasFile('bank_cancelled_cheque')) {
                ImageService::delete($document_upload->bank_cancelled_cheque);
                $document_upload->bank_cancelled_cheque = ImageService::save($request->file('bank_cancelled_cheque'));
            }
            return response()->json([
                'status' => 200,
                'message' => 'Document added successfully',
                'data' => $document_upload
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong in server',
                'err' => $e->getMessage()
            ], 500);
        }
    }


    public function addInstallationAddress(Request $request, $id = null)
    {
         $validation = Validator::make($request->all(),[ 
            'village' => 'required|string|max:255',
            'landmark' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'pincode' => 'required|string|max:255',
            'proposed_capacity' => 'required|string|max:255',
            'plot_type' => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 500,
                'message' => 'Validation failed',
                'err' => $validation->errors()
            ], 500);
        }

        try {
            $data = InstallationAddress::updateOrCreate(
                ['id' => $id],
                [
                'village' => $request->village,
                'landmark' => $request->landmark,
                'district' => $request->district,
                'pincode' => $request->pincode,
                'proposed_capacity' => $request->proposed_capacity,
                'plot_type' => $request->plot_type,
                ]
            );
            return response()->json([
                'status' => 200,
                'message' => 'Installation address added successfully',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong in server',
                'err' => $e->getMessage()
            ], 500);
        }
    }
}

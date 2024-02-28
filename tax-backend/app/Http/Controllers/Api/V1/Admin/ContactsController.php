<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\V1\ContactHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    public function index(){
        $contacts = ContactResource::collection(Contact::with('entity')->get());
        return response()->json(compact('contacts'));
    }

    public function show($contact_id){
        $contact = new ContactResource(Contact::with('entity')->findOrFail($contact_id)) ;
        return response()->json(compact('contact'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'           => 'required|string',
            'bin'            => 'required|string',
            'contact_person' => 'required',
            'nid'            => 'required',
            'address'        => 'required'
        ]);

        if($validator->fails()){
            return  response()->json(['errors'=>$validator->errors()],422);
        }
        try{
            DB::beginTransaction();
            $user = ContactHelper::addNewContact($request);
            DB::commit();
            return $this->success($user,"New User Has been Created Successfully");
         }catch(\Exception $e){
             DB::rollBack();
             return $this->error($e->getMessage(),500);
         }
    }


    public function update(Request $request,$contact_id){

        //check contact exist
        $contact = Contact::findOrFail($contact_id);
        $validator = Validator::make($request->all(),[
            'name'           => 'required|string',
            'bin'            => 'required|string',
            'contact_person' => 'required',
            'nid'            => 'required',
            'address'        => 'required'
        ]);

        if($validator->fails()){
            return  response()->json(['errors'=>$validator->errors()],422);
        }

        try{
            DB::beginTransaction();
            $user = ContactHelper::updateContact($request,$contact);
            DB::commit();
            return $this->success($user,"New User Has been Created Successfully");
         }catch(\Exception $e){
             DB::rollBack();
             return $this->error($e->getMessage(),500);
         }
    }

    public function destroy($contact_id){
        $contact =  Contact::findOrFail($contact_id);
        $contact->delete();
        return response()->json(['success'=>'Contact Deleted Successfully']);
    }
}

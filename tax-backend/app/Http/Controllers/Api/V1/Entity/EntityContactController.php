<?php

namespace App\Http\Controllers\Api\V1\Entity;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class EntityContactController extends Controller
{
    public function index($entity_id){
        $contacts = Contact::where('entity_id',$entity_id)->get();
        return response()->json(compact('contacts'));
    }
    //this function is used for showing folder component
    public function getContactsWithTransactionsForEntity($entity_id){
        $contacts = Contact::with('transactions')->select('id','name')->where('entity_id',$entity_id)->get();
        return response()->json(compact('contacts'));
    }

    public function getContactViaId($entity_id,$contact_id){
        $contact = Contact::where([
            ['entity_id','=',$entity_id],
            ['id','=',$contact_id],
        ])->first();
        return response()->json(compact('contact'));
    }
}

<?php
namespace App\Helpers\V1;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactHelper{


    public static function addNewContact(Request $request){

        $data = array(
            'entity_id'       => $request->input('entity_id')?$request->input('entity_id'):null,
            'name'           => $request->input('name'),
            'bin'            => bcrypt($request->input('bin')),
            'contact_person' => $request->input('contact_person'),
            'nid'            => $request->input('nid'),
            'address'        => $request->input('address')
        );

        $contact = Contact::create( $data);
        return $contact;
    }

    public static function updateContact(Request $request,$contact){

        $data = array(
            'entity_id'       => $request->input('entity_id')?$request->input('entity_id'):null,
            'name'           => $request->input('name'),
            'bin'            => bcrypt($request->input('bin')),
            'contact_person' => $request->input('contact_person'),
            'nid'            => $request->input('nid'),
            'address'        => $request->input('address')
        );

        $contact = $contact->update($data);
        return $contact;
    }

}

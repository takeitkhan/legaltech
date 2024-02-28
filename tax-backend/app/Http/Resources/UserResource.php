<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use BaseResourceTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public $company_id;
    public function __construct($resource, $company_id = false) {
        // Ensure we call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;
        $this->company_id = $company_id; // $apple param passed
    }
    public function toArray($request)
    {
        $role = $this->role?->first();
        if($this->company_id){
          $role = $this->roleViaEntity($this->company_id);
        //   info('entity_id0'.$this->company_id.$role);
        //   $role= $this->role?->map()
        }
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'type'      => $this->type,//type will be superadmin, user
            'status'    => $this->status,
            'avatar'    => $this->getFilePath().'images/avatar/'.$this->avatar,
            // 'avatar'     => asset('public/images/avatar/'.$this->avatar),
            'role'       => $role,
            'main_role'  => $this->role,
            'entities'   => $this->entities
        ];
    }
}

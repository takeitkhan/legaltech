<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    use BaseResourceTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'bin'         => $this->bin,
            'address'     => $this->address,
            'tin'         => $this->tin,
            'entity_type' => $this->entity_type,
            'ownership_type' => $this->ownership_type,
            'users'       => UserResource::collection($this->entity_role_users) ,
        //    'company_logo' => asset('public/images/entity/'.$this->company_logo),
            'company_logo' => $this->getFilePath().'images/entity/'.$this->company_logo
            // 'company_logo' => asset('images/entity/'.$this->company_logo)
        ];
    }
}

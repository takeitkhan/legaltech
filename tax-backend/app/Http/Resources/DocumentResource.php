<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'id'               => $this->id,
            'name'             => $this->name,
            // 'file_as_image'    => asset('public/files/documents/'.$this->name),
            // 'file_as_image'    => asset('files/documents/'.$this->name),
            'file_as_image'    => $this->getFilePath().'files/documents/'.$this->name,
            'file_extension'   => $this->file_extension,
            'user'             => $this->uploadUser,
            'transaction'      => $this->transaction,
            'entity'           => $this->entity,
            'document_type_id' => isset($this->document_type_id)?$this->document_type:null,
            'status'          => $this->status,
            'created_at'      => $this->created_at
        ];
    }
}

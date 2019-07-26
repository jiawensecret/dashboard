<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'tel' => $this->tel,
            'is_super' => boolval($this->is_super),
            'created_at' => date('Y:m:d H:i:s',strtotime($this->created_at)),
            'updated_at' => date('Y:m:d H:i:s',strtotime($this->updated_at)),
        ];
    }
}

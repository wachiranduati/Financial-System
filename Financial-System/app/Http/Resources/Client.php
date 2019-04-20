<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Client extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'firstname'=> $this->firstname,
            'othernames'=> $this->othernames,
            'address' => $this->address,
            'customerid'=> $this->customerid,
            'nationalid'=> $this->nationalid,
            'mobilenumber'=>$this->mobilenumber,
            'customerphoto'=> $this->customerphoto
        ];
    }
}

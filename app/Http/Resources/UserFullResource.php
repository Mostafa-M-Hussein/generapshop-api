<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'mobile_confirmed' => $this->mobile_verified,
            'email' => $this->email,
            'email_confirmed' => $this->email_verified,
            'shipping_address' => new AddressResource($this->shipping_Address),
            'biling_address' => new  AddressResource($this->biling_Address),
            'member_since' =>  $this->created_at->format('l jS \\of F Y')  ,
        ];

    }
}

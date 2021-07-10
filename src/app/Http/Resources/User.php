<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
  /**
    * Transform the resource into an array.
    *
    * @param \Illuminate\Http\Request $request
    * @return array
    */

    public function toArray($request){
      return [
        'id' => $this->id,
        'first_name' => $this->first_name,
        'middle_name' => $this->middle_name,
        'last_name' => $this->last_name,
        'avatar' => $this->avatar,
        'gender' => $this->gender,
        'corps_member_id' => $this->corps_member_id,
        'email' => $this->email,
        'phone_number' => $this->phone_number,
        'place_of_deployment' => $this->place_of_deployment,
        'batch' => $this->batch,
        'next_of_kin' => $this->next_of_kin,
        'next_of_kin_phone' => $this->next_of_kin_phone,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'location' => [
          'lng' => floatval($this->location->lng),
          'lat' => floatval($this->location->lat)
        ],
      ];
    }

}

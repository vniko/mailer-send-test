<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MailMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arr =  parent::toArray($request);
        $arr['recipient'] = new RecipientResource($this->recipient);
        $arr['sender'] = new RecipientResource($this->sender);

        return $arr;
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'company' => [
                'id' => $this->id,
                'title' => $this->title,
                'number' => $this->number,
                'description' => $this->description,
                'user' => $this->getUser()->first()
            ]
        ];
    }
}

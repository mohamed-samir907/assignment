<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"            => $this->id,
            "name"          => $this->name,
            "price"         => number_format($this->price, 2, '.', ' '),
            "url"           => $this->url,
            "description"   => trim($this->description),
        ];
    }
}

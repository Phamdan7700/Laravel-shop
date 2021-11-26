<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => $this->category->title,
            "id" => $this->id,
            "name" => $this->name,
            "manufacturer" => $this->manufacturer,
            "price" => $this->price,
            "price_sale" => $this->price_sale,
            "content" => $this->content,
            "detail" => $this->detail,
            "thumbnail" => asset("$this->thumbnail"),
            "img_list" => explode(',', $this->img_list),
            "count_in_sock" => $this->count_in_sock,
            "category" => $this->category->title,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "rating" => [
                "rate" => $this->rate,
                "count" => $this->count
            ]


        ];
    }
}

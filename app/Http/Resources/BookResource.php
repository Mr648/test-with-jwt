<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'pages' => $this->pages,
            'publisher' => $this->publisher,
            'created_at' => $this->created_at->format('M,d,Y h:i:s'),
            'updated_at' => $this->updated_at->format('M,d,Y h:i:s'),
            $this->mergeWhen($this->resource->relationLoaded('author'), [
                'author' => AuthorResource::make($this->whenLoaded('author'))
            ])
        ];
    }
}

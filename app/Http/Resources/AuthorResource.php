<?php

namespace App\Http\Resources;

use App\Models\Enums\Roles;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AuthorResource extends JsonResource
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
            'family' => $this->family,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'avatar' => !is_null($this->avatar) ? url(Storage::url($this->avatar)) : null,
            'role' => Roles::toPersian($this->role),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            $this->mergeWhen($this->resource->relationLoaded('books'), [
                'books_count'=>$this->books_count,
                'books' => BookResource::collection($this->whenLoaded('books'))
            ])
        ];
    }
}

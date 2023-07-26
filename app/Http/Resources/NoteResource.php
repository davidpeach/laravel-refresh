<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'is_live' => $this->is_live,
            'tags' => $this->when(
                $this->relationLoaded('activity') &&
                    $this->activity->relationLoaded('tags'),
                function () {
                    return $this->activity->tags->pluck('slug');
                }
            ),
        ];
    }
}

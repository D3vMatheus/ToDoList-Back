<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed is_completed
 */
class ToDoItemResource extends JsonResource{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array{
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'is_completed' => (bool) $this->is_completed,
        ];
    }
}

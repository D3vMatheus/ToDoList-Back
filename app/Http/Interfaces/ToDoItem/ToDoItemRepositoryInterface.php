<?php

namespace App\Http\Interfaces\ToDoItem;

use Illuminate\Database\Eloquent\Collection;
use App\Models\ToDoItem;

interface ToDoItemRepositoryInterface{

    /**
     *  @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $idToDoItem
     * @return ToDoItem|null
     */
    public function findOrFail(int $idToDoItem): ?ToDoItem;

    /**
     * @param array $dataToDoItem
     * @return ToDoItem
     */
    public function create(array $dataToDoItem): ToDoItem;

    /**
     * @param int $idToDoItem
     * @param array $dataToDoItem
     * @return bool
     */
    public function update(int $idToDoItem, array $dataToDoItem): bool;

    /**
     * @param int $idToDoItem
     * @return bool
     */
    public function delete(int $idToDoItem): bool;  
}
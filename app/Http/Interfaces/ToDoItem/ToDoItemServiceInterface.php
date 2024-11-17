<?php

namespace App\Http\Interfaces\ToDoItem;

use Illuminate\Database\Eloquent\Collection;
use App\Models\ToDoItem;

interface ToDoItemServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllToDoItem(): Collection;

    /**
     * @param int $idToDoItem
     * @return ToDoItem|null
     */
    public function getToDoItemById(int $idToDoItem): ?ToDoItem;
    
    /**
     * @param array  $toDoItemValidatedSuccess
     * @return ToDoItem
     */
    public function storeToDoItem(array $toDoItemValidatedSuccess): ToDoItem;

    /**
     * @param int $idToDoItem
     * @param array  $toDoItemValidatedSuccess
     * @return ToDoItem
     */
    public function updateToDoItem(int $idToDoItem, array $toDoItemValidatedSuccess): ToDoItem;
    
    /**
     * @param int $idToDoItem
     * @return ToDoItem
     */
    public function deleteToDoItem(int $idToDoItem): ToDoItem;
}
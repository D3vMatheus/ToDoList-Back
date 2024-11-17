<?php

namespace App\Repositories;

use App\Http\Interfaces\ToDoItem\ToDoItemRepositoryInterface;
use App\Models\ToDoItem;
use Illuminate\Database\Eloquent\Collection;

class ToDoItemRepository implements ToDoItemRepositoryInterface{

    protected ToDoItem $toDoItem;

    /**
     * @param ToDoItem $toDoItem
     */
    public function __construct (ToDoItem $toDoItem){
        $this->toDoItem = $toDoItem;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->toDoItem->all();
    }

    /**
     * @param int $idToDoItem
     * @return ToDoItem|null
     */
    public function findOrFail(int $idToDoItem): ?ToDoItem
    {
        return $this->toDoItem->findOrFail($idToDoItem);
    }

    /**
     * @param array $dataToDoItem
     * @return ToDoItem
     */
    public function create(array $dataToDoItem): ToDoItem
    {
        return $this->toDoItem->create($dataToDoItem);
    }

    /**
     * @param int $idToDoItem
     * @param array $dataToDoItem
     * @return bool
     */
    public function update(int $idToDoItem, array $dataToDoItem): bool
    {
        return $this->toDoItem->update($dataToDoItem);
    }

    /**
     * @param int $idToDoItem
     * @return bool
     */
    public function delete(int $idToDoItem): bool
    {
        return $this->toDoItem->delete();
    }
}

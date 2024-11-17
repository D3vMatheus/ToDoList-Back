<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ToDoItemRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Interfaces\ToDoItem\ToDoItemServiceInterface;
use App\Models\ToDoItem;

class ToDoItemService implements ToDoItemServiceInterface{

    protected ToDoItemRepository $toDoItemRepository;

    public function __construct(ToDoItemRepository $toDoItemRepository){
        $this->toDoItemRepository = $toDoItemRepository;
    }

    /**
     * @return Collection
     * @throws Exception
     */
    public function getAllToDoItem(): Collection{
        try{
            return $this->toDoItemRepository->all();
        }catch(QueryException $e){
            throw new Exception('Database error getAllStock: ' .  $e->getMessage());
        }
    }

    /**
     * @param int $idToDoItem
     * @return ToDoItem|null
     * @throws Exception
     */
    public function getToDoItemById(int $idToDoItem): ?ToDoItem
    {
        try{
            return $this->toDoItemRepository->findOrFail($idToDoItem);
        }catch(QueryException $e){
            throw new Exception('Database error getToDoItemById: ' .  $e->getMessage());
        } catch (ModelNotFoundException $e) {
            throw new Exception('Model not found getToDoItemById: ' . $e->getMessage());
        }
    }

    /**
     * @param array  $toDoItemValidatedSuccess
     * @return ToDoItem
     * @throws Exception
     */
    public function storeToDoItem(array $toDoItemValidatedSuccess): ToDoItem
    {
        try{
            DB::beginTransaction();
            $dataStoreToDoItem = $this->toDoItemRepository->create($toDoItemValidatedSuccess);
            DB::commit();

            return $dataStoreToDoItem;
        }catch(QueryException $e){
            DB::rollBack();
            throw new Exception('Database error storeToDoItem' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new Exception('Model not found storeToDoItem: ' . $e->getMessage());
        }
    }

    /**
     * @param int $idToDoItem
     * @param array  $toDoItemValidatedSuccess
     * @return ToDoItem
     * @throws Exception
     */
    public function updateToDoItem(int $idToDoItem, array $toDoItemValidatedSuccess): ToDoItem
    {
        try{
            $toDoItemUpdate = $this->toDoItemRepository->findOrFail($idToDoItem);

            DB::beginTransaction();
            $toDoItemUpdate->update($toDoItemValidatedSuccess);
            DB::commit();

            return $toDoItemUpdate;
        }catch(QueryException $e){
            DB::rollBack();
            throw new Exception('Database error updateToDoItem' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new Exception('Model not found updateToDoItem: ' . $e->getMessage());
        }
    }

    /**
     * @param int $idToDoItem
     * @return ToDoItem
     * @throws Exception
     */
    public function deleteToDoItem(int $idToDoItem): ToDoItem
    {
        try
        {
            $deleteToDoItem = $this->toDoItemRepository->findOrFail($idToDoItem);

            DB::beginTransaction();
            $deleteToDoItem->delete();

            DB::commit();
            return $deleteToDoItem;

        }catch (QueryException $e) {
            DB::rollBack();
            throw new Exception('Database error deleteToDoItem: ' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new Exception('Model not found deleteToDoItem: ' . $e->getMessage());
        }
    }
}

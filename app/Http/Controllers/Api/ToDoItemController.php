<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ToDoItem\StoreToDoItemRequest;
use App\Http\Requests\ToDoItem\UpdateToDoItemRequest;
use App\Http\Resources\ToDoItemResource;
use App\Http\Controllers\Controller;
use App\Services\ToDoItemService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class ToDoItemController extends Controller
{
    protected ToDoItemService $toDoItemService;

    /**
     * @param ToDoItemService $toDoItemService
     */
    public function __construct(ToDoItemService $toDoItemService)
    {
        $this->toDoItemService = $toDoItemService;
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $allToDoItem = $this->toDoItemService->getAllToDoItem();

            return ToDoItemResource::collection($allToDoItem)->response()->setStatusCode(Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error('Failed to retrieve AllToDoItem: ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getTraceAsString()
            ]);
            return response()->json(
                ['error' => 'Unable to retrieve to do items. Please try again later.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param int $idToDoItem
     * @return JsonResponse
     */
    public function show(int $idToDoItem): JsonResponse
    {
        try {
            $toDoItemById = $this->toDoItemService->getToDoItemById($idToDoItem);

            return ToDoItemResource::make($toDoItemById)->response()->setStatusCode(Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error('Failed to retrieve ToDoItemById: ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getTraceAsString()
            ]);
            return response()->json(
                ['error' => 'Unable to retrieve the to do item. Please try again later.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param StoreToDoItemRequest $request
     * @return JsonResponse
     */
    public function store(StoreToDoItemRequest $request): JsonResponse
    {
        try {
            $toDoItemValidatedSuccess = $request->validated();

            $toDoItemCreateSuccess = $this->toDoItemService->storeToDoItem($toDoItemValidatedSuccess);

            return ToDoItemResource::make($toDoItemCreateSuccess)->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $e) {
            Log::error('Failed while create to do item: ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getTraceAsString()
            ]);
            return response()->json(
                ['error' => 'Couldn\'t create to do item. Please try again later.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param int $idToDoItem
     * @param UpdateToDoItemRequest $request
     * @return JsonResponse
     */
    public function update(int $idToDoItem, UpdateToDoItemRequest $request): JsonResponse
    {
        try {
            $toDoItemValidatedSuccess = $request->validated();

            $toDoItemUpdateSuccess = $this->toDoItemService->updateToDoItem(
                $idToDoItem,
                $toDoItemValidatedSuccess
            );

            return ToDoItemResource::make($toDoItemUpdateSuccess)->response()->setStatusCode(Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error('Failed while update to do item: ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getTraceAsString()
            ]);
            return response()->json(
                ['error' => 'Couldn\'t update to do item. Please try again later.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param int $idToDoItem
     * @return JsonResponse
     */
    public function destroy(int $idToDoItem): JsonResponse
    {
        try {
            $toDoItemDeleteSuccess = $this->toDoItemService->deleteToDoItem(
                $idToDoItem
            );

            return ToDoItemResource::make($toDoItemDeleteSuccess)
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error('Failed to delete to do item: ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'code' => $e->getTraceAsString()
            ]);
            return response()->json(
                ['error' => 'Couldn\'t delete to do item. Please try again later.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}

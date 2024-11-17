<?php

use App\Http\Controllers\Api\ToDoItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function (){
    Route::apiResource('/toDoItem', ToDoItemController::class);
});
<?php

use App\Http\Controllers\Api\ToDoItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

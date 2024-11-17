<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoItem extends model
{
    protected $table = 'to_do_item';

    protected $fillable = [
        'id',
        'name',
        'is_completed'
    ];
}

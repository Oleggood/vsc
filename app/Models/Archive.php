<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
//    use HasFactory;
//    protected $fillable = array('task_id', 'task_date', 'number', 'task_name', 'item', 'task', 'note', 'deadline', 'task_status_id', 'done', 'comment', 'users_string');
    protected $guarded = [];
    protected $table = 'archives';
}

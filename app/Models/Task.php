<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
//    use HasFactory;
    //use SoftDeletes;
    protected $fillable = array('task_date', 'number', 'task_name', 'item', 'task', 'note', 'deadline', 'task_status_id', 'done', 'comment');
    protected $table = 'tasks';


    public function users()
		{
			return $this->belongsToMany(User::class, 'task_users', 'task_id', 'user_id')->withPivot('status_id')->withTimestamps();
		}

}

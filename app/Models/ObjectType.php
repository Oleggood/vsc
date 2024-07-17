<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectType extends Model
{
    use HasFactory;
    protected $table = 'object_types';
    protected $guarded = false;

    public function assignments ()
    {
        return $this->hasMany(Assignment::class, 'object_type_id', 'id');
    }

}

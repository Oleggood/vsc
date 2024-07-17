<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basis extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'basics';

    public function assignments ()
    {
        return $this->hasMany(Assignment::class, 'base_id', 'id');
    }
}

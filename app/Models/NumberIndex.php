<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberIndex extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'number_indexes';


    public function assignments ()
    {
        return $this->hasMany(Assignment::class, 'number_index_id', 'id');
    }

}

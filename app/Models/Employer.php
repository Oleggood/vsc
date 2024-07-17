<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'employers';


    public function assignments ()
    {
        return $this->hasMany(Assignment::class, 'employer_id', 'id');
    }

}

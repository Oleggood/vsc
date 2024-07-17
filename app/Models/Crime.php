<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'crimes';

//    public function assignments ()
//    {
//        return $this->hasMany(Assignment::class, 'crime_id', 'id');
//    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_crime', 'crime_id', 'assignment_id')->withPivot('main')->withTimestamps();
    }

    public function factPreventResult ()
    {
        return $this->hasMany(Result::class, 'fact_prevent_crime_id', 'id');
    }
    public function factSolvedResult ()
    {
        return $this->hasMany(Result::class, 'fact_solved_crime_id', 'id');
    }
    public function factSearchResult ()
    {
        return $this->hasMany(Result::class, 'fact_search_crime_id', 'id');
    }



}

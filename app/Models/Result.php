<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'results';

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function factPreventCrime()
    {
        return $this->belongsTo(Crime::class, 'fact_prevent_crime_id');
    }
    public function factSolvedCrime()
    {
        return $this->belongsTo(Crime::class, 'fact_solved_crime_id');
    }
    public function factSearchCrime()
    {
        return $this->belongsTo(Crime::class, 'fact_search_crime_id');
    }


}

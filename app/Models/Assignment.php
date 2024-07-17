<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $table = 'assignments';
    protected $guarded = false;

    public function basis()
    {
        return $this->belongsTo(Basis::class, 'base_id');
    }

//    public function crime()
//    {
//        return $this->belongsTo(Crime::class, 'crime_id');
//    }

    public function crimes()
    {
        return $this->belongsToMany(Crime::class, 'assignment_crime', 'assignment_id', 'crime_id')->withPivot('main')->withTimestamps();
    }

    public function objectType()
    {
        return $this->belongsTo(ObjectType::class, 'object_type_id');
    }

    public function numberIndex()
    {
        return $this->belongsTo(NumberIndex::class, 'number_index_id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'execut_id');
    }

    public function results ()
    {
        return $this->hasMany(Result::class, 'assignment_id', 'id');
    }

}

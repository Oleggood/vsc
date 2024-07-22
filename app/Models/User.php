<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'birthday',
        'nickname',
        'email',
        'password',
        'login',
        'note',
        'department_id',
        'position_id',
        'role_id',
    ];

//    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id')->withDefault([
            'role' => 'не определена',
        ]);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id')->withDefault([
            'department' => 'не определено',
        ]);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id')->withDefault([
            'position' => 'не определена',
        ]);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_users', 'user_id', 'task_id')->withPivot('status_id')->withTimestamps();
    }

    public function assignments ()
    {
        return $this->hasMany(Assignment::class, 'execut_id', 'id');
    }

    public function isManager(): bool
    {
        $isDirector = $this->position()->where('is_director', 1)->get();
        $isDeputyDirector = $this->position()->where('is_deputy_director', 1)->get();
        (count($isDirector) or count($isDeputyDirector)) > 0 ? $isManagerBool = true : $isManagerBool = false;
        return $isManagerBool;
    }

    public function getAllUsersForSmallSelectFormat()
    {
        $usersFormattedCollection = $this->pluck('nickname', 'id')->map(function ($value, $key) {
            return [
                'id' => $key,
                'name' => $value
            ];
        });
        return $usersFormattedCollection->sortBy('name')->values()->all();
    }

}

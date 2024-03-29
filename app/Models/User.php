<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles ,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'student_id',
        'teacher_id',
        'employe_id',
    ];

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

    public function getTypeAttribute() {
        if($this->student) {
            return 'student';
        }
        elseif($this->teacher) {
            return 'teacher';
        }
        elseif($this->employe) {
            return 'employe';
        }

        return 'Unknown';
        /* if($this->student()->withTrashed()->exists()) {
            return 'student';
        }
        elseif($this->teacher()->withTrashed()->exists()) {
            return 'teacher';
        }
        elseif($this->employe()->withTrashed()->exists()) {
            return 'employe';
        } */

        //return $this->roles->first()->name;
    }

    public function student() {
        return $this->hasOne(Student::class)->withTrashed();
    }

    public function teacher() {
        return $this->hasOne(Teacher::class)->withTrashed();
    }

    public function employe() {
        return $this->hasOne(Employe::class)->withTrashed();
    }
}

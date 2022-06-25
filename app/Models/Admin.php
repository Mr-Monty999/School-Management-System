<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    use HasFactory;

    protected $fillable = ["admin_name", "password", "school_id"];
    protected $table = "admins";

    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
}

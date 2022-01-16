<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','phone'];

    public function role(){
        return $this->belongsToMany(Role::class);
    }
}

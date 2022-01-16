<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['id','role','color'];

    public function contacts(){
        return $this->belongsToMany(Contact::class);
    }
}

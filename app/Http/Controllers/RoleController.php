<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(Role $role){
        $roles = $role->all();
        return response()->json($roles);
    }
}

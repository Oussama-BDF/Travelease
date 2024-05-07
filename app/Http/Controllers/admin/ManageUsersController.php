<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the role by its name 'user'
        $role = Role::where('name', 'user')->first();

        // Get only the users who have the 'user' role
        $users = $role->users;

        return view('admin.users.index', compact('users'));
    }
}

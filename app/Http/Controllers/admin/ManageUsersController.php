<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ManageUsersController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        // Get the role by its name 'user'
        $role = Role::where('name', 'user')->first();

        // Get only the users who have the 'user' role
        $users = $role->users;

        return view('pages.admin.users.index', compact('users'));
    }

    public function show($user_uuid) {
        $user = User::where('uuid', $user_uuid)
            ->firstOrFail();
        return view('pages.admin.users.show', compact('user'));
    }
}

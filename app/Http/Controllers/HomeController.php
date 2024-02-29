<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidRoleException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // User role
        $role = Auth::user()->role_id;

        // Check user role
        switch ($role->id)
        {
            case User::ROLE_ADMIN:
                return redirect(route('admins.dashboard'));
                break;
            case User::ROLE_USER:
                return redirect(route('users.dashboard'));
                break;
            default:
                throw new InvalidRoleException();
                break;
        }
    }
}

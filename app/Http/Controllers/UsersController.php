<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::paginate(100);

		return view('users.index', compact('users'));
	}
}
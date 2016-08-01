<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::orderBy('id', 'desc')->paginate(100);

		return view('users.index', compact('users'));
	}

	public function store(Request $request)
	{
		User::create($request->all());

		return redirect()->route('users.index');
	}
}
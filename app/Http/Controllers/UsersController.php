<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::orderBy('id', 'desc')->paginate(100);

		$pdo = DB::connection()->getPdo();

		return view('users.index', compact('users', 'pdo'));
	}

	public function store(Request $request)
	{
		User::create($request->all());

		return redirect()->route('users.index');
	}
}
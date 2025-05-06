<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return response()->json($this->users->all());
    }
}


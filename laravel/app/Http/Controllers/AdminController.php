<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Esto buscará el archivo en resources/views/admin/dashboard.blade.php
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Prism\Prism\Facades\PrismServer;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Index', [
        ]);
    }
}

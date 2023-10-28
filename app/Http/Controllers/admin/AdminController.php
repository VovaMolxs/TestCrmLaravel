<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Employes;

class AdminController extends Controller
{
     public function index() {


         return view('home');
     }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NiveauScolaireController extends Controller
{
    public function index(){
        return inertia("NiveauScolaire/Index");
    }
}

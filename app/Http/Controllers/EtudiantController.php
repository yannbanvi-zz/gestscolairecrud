<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(){
        return inertia("Etudiant/Index");
    }

    public function create(){
        return inertia("Etudiant/Create");
    }

    public function edit($id){
        return inertia("Etudiant/Edit");
    }
}

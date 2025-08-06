<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function layout(){
        return view('panel.layout.app');
    }
}

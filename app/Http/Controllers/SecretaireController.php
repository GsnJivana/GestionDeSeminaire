<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SecretaireController extends Controller
{
    //
    public function index(){
        //return view(view: "SecretaireDashboard");
        $user=Auth::user()->getAttribute("role");
        $bol= intval(Auth::user()->getAttribute("role") ) ;
        $bol1=intval(strcasecmp(Auth::user()->getAttribute("role"),"etudiant")) ;
        return $bol1;
        }
}

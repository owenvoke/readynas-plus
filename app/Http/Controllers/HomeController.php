<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\XmlReaderCaster;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sys = new System();
        $device = $sys->getDeviceInfo();
        $health = $sys->getHealthInfo();

        return view('home', [
            'device' => $device,
            'health' => $health
        ]);
    }
}

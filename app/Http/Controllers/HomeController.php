<?php

namespace App\Http\Controllers;

use App\System;

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

        $data = [
            'firmware' => $sys->getFirmwareInfo(),
            'device' => $sys->getDeviceInfo(),
            'health' => $sys->getHealthInfo(),
            'apps' => $sys->getAppInfo(),
        ];

        return view('home', $data);
    }
}

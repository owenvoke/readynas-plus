<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;

class DisksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sys = new System();

        $data = [
            'disks' => $sys->getDiskInfo(),
            'volumes' => $sys->getVolumeInfo(),
        ];

        return view('disks.index', $data);
    }
}

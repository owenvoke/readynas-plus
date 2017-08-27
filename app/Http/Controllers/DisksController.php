<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;

class DisksController extends Controller
{
    public function index()
    {
        $sys = new System();

        $data = [
            'disks' => $sys->getDiskInfo(),
        ];

        return view('disks.index', $data);
    }
}

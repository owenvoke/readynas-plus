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

    public function show($drive)
    {
        $sys = new System();

        $data = [
            'disk' => $sys->getDiskInfo()
        ];

        foreach ($data['disk']->DiskEnclosure_Collection->DiskEnclosure as $value) {
            foreach ($value->Disk_Collection->Disk as $disk) {
                if ($disk->attributes()->{'resource-id'} == $drive) {
                    $data['disk'] = $disk;
                    break;
                }
            }
        }

        return view('disks.show', $data);
    }
}

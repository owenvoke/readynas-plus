@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Disks</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($disks->DiskEnclosure_Collection->DiskEnclosure as $value)
                            @foreach ($value->Disk_Collection->Disk as $disk)
                                <div class="app-block text-center">
                                    <a href="/disks/{{ $disk->attributes()->{'resource-id'} }}" target="_blank">
                                        <p class="@if ($disk->attributes()->DiskState == 'ONLINE') text-success @else text-danger @endif">
                                            <span class="fa fa-fw fa-hdd-o fa-4x"></span>
                                        </p>

                                        <strong>{{ $disk->attributes()->Model }}</strong>
                                        <span>{{ Rych\ByteSize\ByteSize::formatBinary($disk->attributes()->Capacity) }}</span>
                                        <span>{{ $disk->attributes()->HardwareInterface }}</span>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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

                        @foreach ($volumes->Volume_Collection->Volume as $volume)
                            <div>
                                <i title="{{ $volume->Property_List->GUID }}">{{ $volume->Property_List->Volume_Name }}</i>
                                <table class="table">
                                    <colgroup>
                                        <col/>
                                        <col width="80%"/>
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <td>Data:</td>
                                        <td>
                                            <span>{{ \Rych\ByteSize\ByteSize::formatMetric($volume->Property_List->Capacity * 1000) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Snapshots:</td>
                                        <td>
                                            <span>{{ \Rych\ByteSize\ByteSize::formatMetric($volume->Property_List->UsedBySnapShotKB * 1000) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Free Space:</td>
                                        <td>
                                            <span>{{ \Rych\ByteSize\ByteSize::formatMetric($volume->Property_List->Free * 1000) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type:</td>
                                        <td>
                                            <span>RAID {{ $volume->Property_List->RAID_Level or 'None' }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach

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

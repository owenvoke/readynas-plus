@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ $disk->attributes()->{'resource-id'} }}:</strong> {{ $disk->attributes()->Model }}
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <colgroup>
                                <col/>
                                <col width="80%"/>
                            </colgroup>

                            <tr>
                                <th>Status:</th>
                                <td>{{ $disk->attributes()->DiskState }}</td>
                            </tr>
                            <tr>
                                <th>Temperature:</th>
                                <td>{{ $disk->attributes()->Temperature }}</td>
                            </tr>
                        </table>

                        <table class="table">
                            <colgroup>
                                <col/>
                                <col width="80%"/>
                            </colgroup>
                            <tr>
                                <th>Model:</th>
                                <td>{{ $disk->attributes()->Model }}</td>
                            </tr>
                            <tr>
                                <th>Serial:</th>
                                <td>{{ $disk->attributes()->Serial }}</td>
                            </tr>
                            <tr>
                                <th>RPM:</th>
                                <td>{{ $disk->attributes()->RPM }}</td>
                            </tr>
                            <tr>
                                <th>Firmware:</th>
                                <td>{{ $disk->attributes()->FirmwareVersion }}</td>
                            </tr>
                        </table>

                        <table class="table">
                            <colgroup>
                                <col/>
                                <col width="80%"/>
                            </colgroup>
                            <tr>
                                <th>Pool Type:</th>
                                <td>{{ $disk->attributes()->PoolType }}</td>
                            </tr>
                            <tr>
                                <th>Pool Name:</th>
                                <td>{{ $disk->attributes()->PoolName }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

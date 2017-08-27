@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Device</div>

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
                            <tbody>
                            <tr>
                                <th class="text-right">Model:</th>
                                <td>{{ $device['MODEL'] or 'UNKNOWN' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Status:</th>
                                <td>{{ $device['STATUS'] or 'UNKNOWN' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Serial:</th>
                                <td>{{ $device['SERIAL'] or 'UNKNOWN' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Firmware:</th>
                                <td>
                                    <span>{{ $device['FIRMWARE_VERSION'] or 'UNKNOWN' }}</span>
                                    (<a href="/updates/check">Check for updates</a>)
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right">Device Time:</th>
                                <td>{{ date('M d, Y H:i:s', $device['FIRMWARE_TIME']) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="panel-heading">Apps</div>

                    <div class="panel-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                                <td>{{ $device->SystemInfo->Model or 'UNKNOWN' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Status:</th>
                                <td>{{ $device->SystemInfo->Status or 'UNKNOWN' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Antivirus:</th>
                                <td>
                                    <a href="/antivirus">
                                        {{ ($device->SystemInfo->{'Anti-Virus-Def-Version'} == 'not enabled') ?
                                        'Disabled' : $device->SystemInfo->{'Anti-Virus-Def-Version'} }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right">Serial:</th>
                                <td>{{ $device->SystemInfo->Serial or 'UNKNOWN' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Firmware:</th>
                                <td>
                                    <span>{{ $device->SystemInfo->Firmware_Version or 'UNKNOWN' }}</span>
                                    (<a href="/updates/check">Check for updates</a>)
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="panel-heading">Apps</div>

                    <div class="panel-body">
                        @foreach ($apps->LocalApp_Collection->Application as $value)
                            <div class="app-block text-center" title="{{ $value->Description }}">
                                <a href="{{ $value->LaunchURL }}" target="_blank">
                                    <img src="https://{{ env('NAS_IP') }}/apps/logo/{{ $value->attributes()->{'resource-id'} }}.png">
                                    <strong>{{ $value->Name }}</strong>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

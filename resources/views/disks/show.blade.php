@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if ($disk->DiskSMARTInfo->Device)
                        <div class="panel-heading">
                            <strong>{{ $disk->DiskSMARTInfo->Device }}:</strong>
                            <span>{{ $disk->DiskSMARTInfo->Model }}</span>
                            <span>({{ $disk->DiskSMARTInfo->Class }})</span>
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
                                    <th>ATA Errors:</th>
                                    <td>{{ $disk->DiskSMARTInfo->HealthData->ATAErrorCount }}</td>
                                </tr>
                                <tr>
                                    <th>Temperature:</th>
                                    <td>{{ $disk->DiskSMARTInfo->HealthData->Temperature }}</td>
                                </tr>
                                <tr>
                                    <th>Power On Hours:</th>
                                    <td>{{ $disk->DiskSMARTInfo->HealthData->PowerOnHours }}</td>
                                </tr>
                            </table>

                            <table class="table">
                                <colgroup>
                                    <col/>
                                    <col width="80%"/>
                                </colgroup>
                                <tr>
                                    <th>Model:</th>
                                    <td>{{ $disk->DiskSMARTInfo->Model }}</td>
                                </tr>
                                <tr>
                                    <th>Serial:</th>
                                    <td>{{ $disk->DiskSMARTInfo->Serial }}</td>
                                </tr>
                                <tr>
                                    <th>RPM:</th>
                                    <td>{{ $disk->DiskSMARTInfo->RPM }}</td>
                                </tr>
                                <tr>
                                    <th>Firmware:</th>
                                    <td>{{ $disk->DiskSMARTInfo->Firmware }}</td>
                                </tr>
                            </table>

                            <table class="table">
                                <colgroup>
                                    <col/>
                                    <col width="80%"/>
                                </colgroup>
                                <tr>
                                    <th>Pool Type:</th>
                                    <td>{{ $disk->DiskSMARTInfo->PoolType }}</td>
                                </tr>
                                <tr>
                                    <th>Pool Name:</th>
                                    <td>{{ $disk->DiskSMARTInfo->Pool }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

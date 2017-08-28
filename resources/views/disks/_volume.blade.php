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
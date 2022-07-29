<table border="1">
    <thead>
        <tr>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">No</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Karyawan</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Cabang</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Jumlah Rencana</th>
            <th style="background-color: lightblue; font-weight: bold; text-align: center;">Rencana</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($activity_plan as $key => $item)
            <tr>
                <td rowspan="{{ count($item->activityPlanRencana) }}" style="text-align: center; vertical-align: center;">{{ $key + 1 }}</td>
                <td rowspan="{{ count($item->activityPlanRencana) }}" style="text-align: center; vertical-align: center;">
                    @if ($item->karyawan)
                        {{ $item->karyawan->nama_lengkap }}
                    @else
                        @if ($item->karyawan_id == 0)
                            Admin
                        @endif
                    @endif
                </td>
                <td rowspan="{{ count($item->activityPlanRencana) }}" style="text-align: center; vertical-align: center;">{{ $item->cabang->nama_cabang }}</td>
                @foreach ($item->activityPlanJumlah as $key_detail => $item_detail)
                    @if ($key_detail == 0)
                        <td rowspan="{{ count($item_detail->activityPlanRencana) }}" style="text-align: center; vertical-align: center;">{{ $item_detail->nama }} ({{ $item_detail->jumlah }})</td>
                    @else
                    <tr>
                        <td rowspan="{{ count($item_detail->activityPlanRencana) }}" style="text-align: center; vertical-align: center;">{{ $item_detail->nama }} ({{ $item_detail->jumlah }})</td>
                    @endif
                    @foreach ($item_detail->activityPlanRencana as $key_rencana => $item_rencana)
                        @if ($key_rencana == 0)
                            <td>{{ $item_rencana->nama }}</td>
                        @else
                            <tr>
                                <td>{{ $item_rencana->nama }}</td>
                        @endif
                    @endforeach
                @endforeach
                {{-- @foreach ($item_detail->activityPlanRencana as $item_rencana)
                    <td>{{ $item_rencana->nama }}</td>
                @endforeach --}}
                {{-- <td>
                    <table>
                        @foreach ($jenis_rencana as $key_jenis => $item_jenis)
                            <tr>
                                <td rowspan="{{ $item_jenis->tes }}">{{ $item_jenis->tes }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td> --}}
                    {{-- @foreach ($item->detail as $key_detail => $item_detail)
                        @if ($key_detail == 0)
                            <td>{{ $item_detail->jenis_rencana }}</td>
                            <td>{{ $item_detail->detail_rencana }}</td>
                        @else
                            <tr>
                                <td>{{ $item_detail->jenis_rencana }}</td>
                                <td>{{ $item_detail->detail_rencana }}</td>
                        @endif
                    @endforeach --}}
            </tr>

        @endforeach
    </tbody>
</table>

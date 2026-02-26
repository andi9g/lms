<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Laporan Absen</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }
        h1,h2,h3,h4,h5,p {
            margin:0;
            padding:0;
        }
        table {
            border-collapse: collapse;
        }
        .tableku {
            font-size: 10pt;
        }
        th {
            padding: 3px;
        }

        .tableku td {
            padding: 2px;
        }
        .page-break {
            page-break-after: always;
        }
        .tdku td {
            padding: 4px;
        }
        .tdku th {
            padding: 5px;
        }
    </style>
    
</head>
<body>
    <table width="100%">
        <tr>
            <td width="90px">
                <img src="{{ public_path('storage/'.$instansi->logo) }}" width="90px" alt="">
            </td>
            <td >
                <h2>LAPORAN ABSENSI</h2>
                <h3>{{ $instansi->namainstansi }}</h3>
                <h5>{{ $instansi->alamatinstansi }}</h5>
            </td>
        </tr>
    </table>

    <br>

    <p>{{ $tglindo }}</p>

    <table width="100%" border="1" class="tableku">
        <tr>
            <th rowspan="2" width="5px">No</th>
            <th rowspan="2" width="140px">NIP</th>
            <th rowspan="2">Nama Lengkap</th>
            <th colspan="{{ count($jp) }}">Jam Pertemuan</th>
            <th rowspan="2">Total.JP</th>
        </tr>
        <tr>
            @foreach ($jp as $item)
                <th width="50px">{{ $item->namajp }}</th>
            @endforeach
        </tr>

        @foreach ($detailuser as $item)
        <tr>
            <td rowspan="2" align="center">{{ $loop->iteration }}</td>
            <td rowspan="2">{{ $item->nip }}</td>
            <td rowspan="2" nowrap>{{ $item->namalengkap }}</td>

            @php
                $userAbsen = $absen[$item->iduser] ?? collect();
                $rangeMap = [];
                $totalHadirJP = 0;

                foreach ($userAbsen as $row) {
                    $rangeLength = ($row->keluar - $row->masuk) + 1;
                    $totalHadirJP += $rangeLength;
                    for ($i = $row->masuk; $i <= $row->keluar; $i++) {
                        $rangeMap[$i] = [
                            'start' => $row->masuk,
                            'end' => $row->keluar,
                            'jamabsen' => $row->jamabsen??"",
                            'rombel' => $row->gurumapel->kelas->namakelas." ".$row->gurumapel->jurusan->namajurusan
                        ];
                    }
                }


                $jpNumber = 1;
                $totalJP = count($jp);
            @endphp

            @while ($jpNumber <= $totalJP)

                @if (isset($rangeMap[$jpNumber]) && $rangeMap[$jpNumber]['start'] == $jpNumber)

                    @php
                        $colspan = $rangeMap[$jpNumber]['end'] - $rangeMap[$jpNumber]['start'] + 1;
                        $jam = \Carbon\Carbon::parse($rangeMap[$jpNumber]['jamabsen'])->format("H:i");
                    @endphp

                    <td colspan="{{ $colspan }}"
                        style="background: rgba(156, 231, 156, 0.74); font-size:8pt;border-bottom:none"
                        align="center">
                        {{ $rangeMap[$jpNumber]['rombel'] }}
                    </td>

                    @php
                        $jpNumber += $colspan;
                    @endphp

                @elseif (isset($rangeMap[$jpNumber]))

                    @php
                        $jpNumber++;
                    @endphp

                @else

                    <td style="background: rgba(201, 93, 93, 0.603);border-bottom:none"></td>

                    @php
                        $jpNumber++;
                    @endphp

                @endif

            @endwhile

            <td rowspan="2" width="15px" align="center">{{ $totalHadirJP }} JP</td>
           

        </tr>
         @php
               $jpNumber = 1;
            @endphp
            <tr>
                @while ($jpNumber <= $totalJP)
    
                    @if (isset($rangeMap[$jpNumber]) && $rangeMap[$jpNumber]['start'] == $jpNumber)
    
                        @php
                            $colspan = $rangeMap[$jpNumber]['end'] - $rangeMap[$jpNumber]['start'] + 1;
                            $jam = \Carbon\Carbon::parse($rangeMap[$jpNumber]['jamabsen'])->format("H:i");
                        @endphp
    
                        <td colspan="{{ $colspan }}"
                            style="background: rgba(156, 231, 156, 0.74); font-size:8pt;border-top:none"
                            align="center">
                            {{ $jam }}
                        </td>
    
                        @php
                            $jpNumber += $colspan;
                        @endphp
    
                    @elseif (isset($rangeMap[$jpNumber]))
    
                        @php
                            $jpNumber++;
                        @endphp
    
                    @else
    
                        <td style="background: rgba(201, 93, 93, 0.603);border-top:none" width="40px"></td>
    
                        @php
                            $jpNumber++;
                        @endphp
    
                    @endif
    
                @endwhile
            </tr>
        @endforeach
    </table>
    


    <div class="page-break"></div>
    <h1>Materi</h1>

    <p>{{ $tglindo }}</p>
    <table width="100%" border="1" class="tableku tdku">
        <tr>
            <th style="background: rgba(184, 184, 184, 0.767)" rowspan="2">No</th>
            <th style="background: rgba(184, 184, 184, 0.767)" rowspan="2" >NIP</th>
            <th style="background: rgba(184, 184, 184, 0.767)" rowspan="2">Nama Pegawai</th>
            <th style="background: rgba(184, 184, 184, 0.767)" colspan="4">Pembelajaran</th>
        </tr>
        <tr>
            <th style="background: rgba(184, 184, 184, 0.767)">Jam ke</th>
            <th style="background: rgba(184, 184, 184, 0.767)">Materi Pembelajaran</th>
            <th style="background: rgba(184, 184, 184, 0.767)">Kelas</th>
            <th style="background: rgba(184, 184, 184, 0.767)">Jam Absen</th>
        </tr>

         @foreach ($detailuser as $i => $item)
            @php
                $userAbsen = $absen[$item->iduser] ?? collect();
                $rowspan = count($userAbsen);
                
                $warna = "background: rgba(220, 220, 220, 0.692)";
            @endphp
            <tr valign="top">
                <td rowspan="{{ $rowspan }}" align="center" @if($i%2==0) style=" {{ $warna }}"@endif>{{ $loop->iteration }}</td>
                <td rowspan="{{ $rowspan }}" @if($i%2==0) style="{{ $warna }}"@endif>{{ $item->nip }}</td>
                <td rowspan="{{ $rowspan }}" nowrap @if($i%2==0) style="{{ $warna }}"@endif>{{ $item->namalengkap }}</td>
                @foreach ($userAbsen as $key => $ua)
                @if ($key == 0)   
                    <td align="center" @if($i%2==0) style="{{ $warna }}"@endif>{{ $ua->masuk." - ". $ua->keluar }} </td>
                    <td @if($i%2==0) style="{{ $warna }}"@endif>{{ $ua->materi }}</td>
                    <td @if($i%2==0) style="{{ $warna }}"@endif>{{ $ua->gurumapel->kelas->namakelas . " ".$ua->gurumapel->jurusan->namajurusan  }}</td>
                    <td align="center" @if($i%2==0) style="{{ $warna }}"@endif>{{ \Carbon\Carbon::parse($ua->jamabsen)->format("H:i") }}</td>
                @endif
                @endforeach
                @if (count($userAbsen) == 0)
                    <td @if($i%2==0) style="{{ $warna }}"@endif></td>
                    <td @if($i%2==0) style="{{ $warna }}"@endif></td>
                    <td @if($i%2==0) style="{{ $warna }}"@endif></td>
                    <td @if($i%2==0) style="{{ $warna }}"@endif></td>
                @endif
            </tr>
                @foreach ($userAbsen as $key => $ua)
                @if ($key > 0)
                    <tr>
                        <td align="center" @if($i%2==0) style="{{ $warna }}"@endif>{{ $ua->masuk." - ". $ua->keluar }} </td>
                        <td @if($i%2==0) style="{{ $warna }}"@endif>{{ $ua->materi }}</td>
                        <td @if($i%2==0) style="{{ $warna }}"@endif>{{ $ua->gurumapel->kelas->namakelas . " ".$ua->gurumapel->jurusan->namajurusan  }}</td>
                        <td align="center" @if($i%2==0) style="{{ $warna }}"@endif>{{ \Carbon\Carbon::parse($ua->jamabsen)->format("H:i") }}</td>
                    </tr>
                    @endif
                @endforeach

            
        @endforeach
        
    </table>
</body>
</html>
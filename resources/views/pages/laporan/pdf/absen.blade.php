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

        .tableku td {
            padding: 2px;
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
        </tr>
        <tr>
            @foreach ($jp as $item)
                <th>{{ $item->namajp }}</th>
            @endforeach
        </tr>

        @foreach ($detailuser as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nip }}</td>
                <td nowrap>{{ $item->namalengkap }}</td>
                @foreach ($jp as $datajp)
                    @php
                        $absen = DB::table("absenpelajaran")
                        ->where([
                            "iduser" => $item->iduser,
                            "idjp" => $datajp->idjp,
                            "tanggalabsen" => $tanggalabsen
                        ])
                        ->value('jamabsen');
                    @endphp
                    @if ($absen == null) 
                        <td style="background: rgba(201, 93, 93, 0.603)" width="40px"></td>
                    @else
                        <td style="background: rgba(156, 231, 156, 0.74);font-size:8pt" align="center" width="40px">{{ \Carbon\Carbon::parse($absen)->format("H:i") }}</td>
                    @endif
                @endforeach
            </tr>
            
        @endforeach
    </table>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-size: 6px;
            margin: 0;
            padding: 0;
            font-family: 'DejaVu Sans', sans-serif;
        }

        .text-start {
            text-align: left;
        }

        .letterhead {
            position: relative;
            margin-bottom: 10px;
            overflow: visible;
            padding-bottom: 10px;
            /* border: 2px solid black; */
        }

        .letterhead img {
            position: absolute;
            width: 40px;
            padding-top: 5px;
            padding-bottom: 5px;
            /* border: 1px solid green; */
        }

        .letterhead h3 {
            /* margin-top: 20px; */
            margin-bottom: 0;
            text-align: right;
            /* padding: 10px; */
            /* border: 1px solid red; */
            padding: 0px;
        }
        
        .letterhead p {
            text-align: right;
            margin-top: 0;
            margin-bottom: 20px;
            padding: 0px;
            /* border:1px solid blue; */
        }

        .info-section {
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }
        .no-border {
            border: none !important;
        }

    .th {
        border: 1px solid black;
        font-size: 6px;
        margin: 0;
        padding: 0;
        text-align: center;
        vertical-align: middle;
        height: 80px;
        width: 25px;
        position: relative; /* Tambahkan ini */
    }

    .rotate-text {
        position: absolute;    /* Posisi absolute agar bisa full */
        top: 50%;             /* Posisi vertical center */
        left: 50%;           /* Posisi horizontal center */
        transform: translate(-50%, -50%) rotate(-90deg); /* Gabung translate dan rotate */
        width: 80px;        /* Sesuaikan dengan height th */
        display: flex;       /* Gunakan flex untuk centering content */
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="letterhead">
        <img src="{{ asset('easyadmin/idev/img/kop-dokumen.png') }}" alt="PT Sampharindo">
        <h3>ANALISA KEBUTUHAN LATIHAN</h3>
        <p><em>Training Needs Analysis</em></p>
    </div>
    <div class="info-section">
        <span style="float:left;font-size:6px;">Divisi / Bagian / Unit Kerja :  Produksi</span>
        <span style="float:right;font-size:6px;">Periode 2025</span>
    </div>
    <br>

    <table>
        <thead>
            <tr>
                <th rowspan="3" style="width: 15px">No</th>
                <th rowspan="3">Jabatan</th>
                <th rowspan="3" style="width: 30px;">Jumlah Personil</th>
                <th colspan="15">Jenis Pelatihan</th>
            </tr>
            <tr>
                <th colspan="6">Qualifications</th>
                <th colspan="3">Pelatihan Umum</th>
                <th colspan="6">Pelatihan Khusus & Tambahan</th>
            </tr>
            <tr>
                <th class="th"><span class="rotate-text">SMA</span></th>
                <th class="th"><span class="rotate-text">Bachelor</span></th>
                <th class="th"><span class="rotate-text">Sertifikasi APT</span></th>
                <th class="th"><span class="rotate-text">Magister</span></th>
                <th class="th"><span class="rotate-text">Doktoral</span></th>
                <th class="th"><span class="rotate-text">Profesi</span></th>
                <th class="th"><span class="rotate-text">Organisasi <br> perusahaan</span></th>
                <th class="th"><span class="rotate-text">CPD/IDU Dasar</span></th>
                <th class="th"><span class="rotate-text">Bahasa Inggris</span></th>
                <th class="th"><span class="rotate-text">Pelatihan Sistem</span></th>
                <th class="th"><span class="rotate-text">Penguatan Motivasi</span></th>
                <th class="th"><span class="rotate-text">Kepemimpinan</span></th>
                <th class="th"><span class="rotate-text">Skill Khusus</span></th>
                <th class="th"><span class="rotate-text">Job Description</span></th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="text-start">Manager SCM</td>
                <td>1</td>
                <td>&#10003;</td><td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td>
                <td>&#10003;</td><td>&#10003;</td><td>&#10003;</td><td>&#10003;</td><td></td><td>&#10003;</td>
            </tr>
            <tr>
                <td>2</td>
                <td class="text-start">Asman PPIC</td>
                <td>1</td>
                <td>&#10003;</td><td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td>
                <td>&#10003;</td><td>&#10003;</td><td></td><td>&#10003;</td><td></td><td>&#10003;</td>
            </tr>
            <tr>
                <td>3</td>
                <td class="text-start">Asman Logistik/KAU/Gudang</td>
                <td>1</td>
                <td>&#10003;</td><td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td>
                <td>&#10003;</td><td></td><td>&#10003;</td><td>&#10003;</td><td>&#10003;</td><td></td>
            </tr>
            <tr>
                <td>4</td>
                <td class="text-start">Supervisor Gudang</td>
                <td>2</td>
                <td>&#10003;</td><td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td>
                <td>&#10003;</td><td></td><td></td><td>&#10003;</td><td></td><td>&#10003;</td>
            </tr>
            <!-- Tambahkan baris lain sesuai tabel gambar -->
        </tbody>
    </table>

    <br>
    <p><i>Catatan: berilah tanda &#10003; pada kolom yang sesuai</i></p>
    <br><br>

    <table class="no-border" style="width:100%;">
        <tr>
            <td class="no-border text-center"style="width:20%;">
                Disiapkan Oleh,<br><br><br><br>
                <strong>Anto Wardana</strong>
            </td>
            <td class="no-border" style="width:20%;"></td>
            <td class="no-border" style="width:20%;"></td>
            <td class="no-border" style="width:20%;"></td>
            <td class="no-border text-center"style="width:20%;">
                Disetujui Oleh,<br><br><br><br>
                <strong>Ramadhan Reza Akbar</strong>
            </td>
        </tr>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisa Kebutuhan Latihan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;;
            margin: 10px;
        }
/* 
        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        } */

        .letterhead {
            position: relative;
            margin-bottom: 20px;
            overflow: visible;
            padding: 20px;
            /* border: 2px solid black; */
        }

        .letterhead img {
            position: absolute;
            width: 80px;
            padding: 10px;
            /* border: 1px solid green; */
        }

        .letterhead h3 {
            margin-top: 20px;
            margin-bottom: 0;
            text-align: right;
            /* padding: 10px; */
            /* border: 1px solid red; */
            padding: 0px;
        }
        
        .letterhead p {
            text-align: right;
            /* padding: 10px; */
            /* border: 1px solid red; */
            margin-top: 0;
            margin-bottom: 20px;
            padding: 0px;
        }

        .header-title {
            text-align: center;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 18px;
        }

        .header-subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .info-section {
            margin-bottom: 15px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 2px solid #333;
            padding: 8px;
            text-align: left;
        }

        thead th {
            background-color: #e0e0e0;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        tbody td {
            text-align: center;
        }

        tbody td:first-child {
            text-align: center;
        }

        .signatures {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            text-align: center;
            font-size: 14px;
        }

        .signature-block {
            width: 250px;
            border: 1px solid green;
        }

        .signature-space {
            border: 1px solid black;
            height: 70px;
            margin-bottom: 5px;
        }

        /* Halaman Pertama (Portrait) */
        @page {
            size: A4 portrait;
        }
        /* Kelas untuk halaman kedua (landscape) */
        .landscape-page {
            page-break-before: always;
            page-break-after: always;
        }
        .landscape-page-content {
            size: A4 landscape;
        }

        .header-vertikal {
    /* 1. Gunakan transform, tetapi tambahkan penyesuaian posisi */
    transform: rotate(-90deg); /* Ubah ke -90deg atau 270deg */
    
    /* 2. Tambahkan margin dan padding untuk menempatkan teks di tengah */
    padding: 0;
    margin: 0 auto; 
    
    /* 3. Atur tinggi dan lebar agar teks tidak tumpang tindih */
    height: 100px; /* Sesuaikan nilai ini sesuai kebutuhan */
    width: 20px; /* Sesuaikan nilai ini sesuai kebutuhan */
    
    /* 4. Pastikan teks tidak terpotong */
    white-space: nowrap;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="letterhead">
            <img src="{{ asset('easyadmin/idev/img/kop-dokumen.png') }}" alt="PT Sampharindo">
            <h3>ANALISA KEBUTUHAN LATIHAN</h3>
            <p>Training Needs Analysis</p>
        </div>
        <div class="info-section">
            <strong>Divisi / Bagian / Unit Kerja : </strong> Produksi
            <strong style="float:right;">Periode 2025</strong>
        </div>

        <table>
            <thead>
                <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3"><span style="transform: rotate(90deg);border:1px solid black;">Jabatan Test</span></th>
                    <th rowspan="3">Jumlah<br>Personil</th>
                    <th colspan="17">Jenis Pelatihan</th>
                </tr>
                <tr>
                    <th colspan="6">Qualifications</th>
                    <th colspan="4">Pelatihan Umum</th>
                    <th colspan="7">Pelatihan Khusus & Tambahan</th>
                </tr>
                <tr>
                    <th class="header-vertikal">SMA</th>
                    <th class="header-vertikal">Bachelor</th>
                    <th class="header-vertikal">Sertifikasi</th>
                    <th class="header-vertikal">Magister</th>
                    <th class="header-vertikal">Doctoral</th>
                    <th class="header-vertikal">Professor</th>
                    <th class="header-vertikal">Organisasi<br>Perusahaan</th>
                    <th class="header-vertikal">Peraturan<br>Perusahaan</th>
                    <th class="header-vertikal">CPOB Dasar</th>
                    <th class="header-vertikal">Regulasi<br>Pemerintah</th>
                    <th class="header-vertikal">Perubahan Sistem</th>
                    <th class="header-vertikal">Pelatihan Teknis</th>
                    <th class="header-vertikal">Peningkatan Keahlian</th>
                    <th class="header-vertikal">Kepemimpinan</th>
                    <th class="header-vertikal">Studi Kasus</th>
                    <th class="header-vertikal">Job Description</th>
                    <th class="header-vertikal"> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Manager SCM</td>
                    <td>1</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Asman PPIC</td>
                    <td>1</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Asman Logistik/APJ/Gudang</td>
                    <td>1</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Supervisor Gudang</td>
                    <td>1</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Supervisor PPIC</td>
                    <td>1</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Kepala Kelompok Gudang</td>
                    <td>2</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Administrasi Logistik</td>
                    <td>4</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Administrasi PPIC</td>
                    <td>1</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Operator Bahan Baku</td>
                    <td>7</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Operator Bahan Kemas</td>
                    <td>9</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Operator Obat Jadi</td>
                    <td>4</td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&#10004;</td>
                </tr>
            </tbody>
        </table>
        <div>
            <br>
            <span>Catatan: berilah tanda &#10004; pada kolom yang sesuai</span>
        </div>
        <div class="signatures">
            <div class="signature-block">
                Disiapkan Oleh,
                <div class="signature-space">
                    <img width="200" src="{{ asset('easyadmin/idev/img/ttd.png') }}" alt="ttd">
                </div>
                <strong><u>Anta Wardana</u></strong><br>
                Kabag SCM
            </div>
            <div class="signature-block" style="float: right">
                Disetujui Oleh,
                <div class="signature-space">
                    <img width="200" src="{{ asset('easyadmin/idev/img/ttd.png') }}" alt="ttd">
                </div>
                <strong><u>Ramadhan Reza Akbar</u></strong><br>
                Manager SCM
                    
                <br><br><br>
                <span style="float: right;">F.DUP.34.R.00.T.01.07.10</span>
            </div>
        </div>
    </div>
    <div class="container landscape-page-content">
        <div class="letterhead">
            <img src="logo.png" alt="PT Sampharindo">
            <h3>RENCANA USULAN PELATIHAN</h3>
        </div>
        <div class="info-section">
            <strong>Divisi / Bagian / Unit Kerja : Produksi</strong> 
            <strong style="float: right;">Tahun : 2025</strong> 
        </div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Jenis Pelatihan</th>
                    <th rowspan="2">Waktu /<br> Durasi</th>
                    <th rowspan="2">Instruktur</th>
                    <th rowspan="2">Personil</th>
                    <th rowspan="2">Jabatan</th>
                    <th colspan="4">Jan</th>
                    <th colspan="4">Feb</th>
                    <th colspan="4">Mar</th>
                    <th colspan="4">Apr</th>
                    <th colspan="4">May</th>
                    <th colspan="4">Jun</th>
                    <th colspan="4">Jul</th>
                    <th colspan="4">Aug</th>
                    <th colspan="4">Sept</th>
                    <th colspan="4">Oct</th>
                    <th colspan="4">Nov</th>
                    <th colspan="4">Dec</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Warehouse in Pharmaceutical Industry</td>
                    <td>2 Jam</td>
                    <td>Internal</td>
                    <td>27 Personil</td>
                    <td>SCM</td>
                    <td class="highlight"></td>
                    <td class="highlight"></td>
                    <td class="highlight"></td>
                    <td class="highlight"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Leadership</td>
                    <td>2 Jam</td>
                    <td>Eksternal</td>
                    <td>7 Personil</td>
                    <td>SCM</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="highlight"></td>
                    <td class="highlight"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tanggap Darurat</td>
                    <td>2 Jam</td>
                    <td>Internal</td>
                    <td>6 Personil</td>
                    <td>SCM</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="highlight"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Manual Handling K3</td>
                    <td>2 Jam</td>
                    <td>Internal</td>
                    <td>23 Personil</td>
                    <td>SCM</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="highlight"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="signatures">
            <div class="signature-block">
                Disiapkan Oleh,
                <div class="signature-space">
                    <img width="200" src="ttd.png" alt="ttd">
                </div>
                <strong><u>Anta Wardana</u></strong><br>
                Kabag SCM
            </div>
            <div class="signature-block">
                Disetujui Oleh,
                <div class="signature-space">
                    <img width="200" src="ttd.png" alt="ttd">
                </div>
                <strong><u>Ramadhan Reza Akbar</u></strong><br>
                Manager SCM
                    
                <br><br><br>
                <span style="float: right;">F.DUP.34.R.00.T.01.07.10</span>
            </div>
        </div>
    </div>
</body>
</html>
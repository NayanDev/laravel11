@extends("backend.parent")
@section("content")
@push('mtitle')
{{$title}}
@endpush
<div class="pc-container">
  <div class="pc-content">

    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            Hi, <b>{{ Auth::user()->name }} </b> Anda login sebagai <i>{{ Auth::user()->role->name }}</i> 
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-body p-3">
            <h3> Selamat datang di Learning Management System <br><b>Sampharindo Group</b></h3>
            <!-- <p>LMS Sampharindo merupakan sistem yang dikembangkan tim iDev untuk melakukan management peserta workshop atau pelatihan. <br>Sistem ini memiliki fitur diantaranya : presensi peserta, cetak sertifikat, undangan email/WA, share materi, laporan, tes online dan sebagainya. </p> -->
            
            <img src="{{ asset('idev/img/dashboard.png') }}" style="max-width:500px;" class="img-thumbnail w-100 img-responsive img-fluid my-2" alt="">
            <!-- <p>Pada Minggu, 21 Januari 2024 pukul 10.00 kami mengadakan workshop <h2>Responsive Website in Your Hand</h2> Anda bisa mengakses repository berisi materi maupun tools terkait workshop pada link yang kami sediakan -->
            <hr>
            <a href="https://drive.google.com/drive/folders/1XwMurzcANrbA0iaWPg_imnMywZr_-02S?usp=sharing" target="_blank" class="btn btn-danger"> <i class="ti ti-folder"></i> Repository Workshop</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
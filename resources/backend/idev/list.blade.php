@extends("backend.parent")
@section("content")
@push('mtitle')
{{$title}}
@endpush
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-secondary text-white">
        Filter
      </div>
      <div class="card-body">
        <form id="form-filter-list" action="{{$uri_list_api}}" method="get">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Search</label>
                <input class="form-control search-list" name="search">
                <input type="hidden" name="route_name" class="route-name" value="{{$uri_key}}">
                <input type="hidden" name="page" class="current-paginate">
                <input type="hidden" name="order" class="current-order">
                <input type="hidden" name="order_state" class="current-order-state" value="ASC">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row mb-2">
@if(Session::get('message'))
  <div class="col-md-12">
    <div class="alert alert-autoclose alert-{{Session::get('status')}} alert-dismissible fade show" role="alert">
      <span data-notify="icon" class="nc-icon nc-bell-55"></span> {{Session::get('message')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
  @endif
  <div class="count-total-list col-md-6"></div>
  @php
  $permissions = (Auth::check()) ? Auth::user()->role->permissions : [];
  $arr_permission = (new App\Helpers\Constant())->permissionDb($uri_key, $permissions);
  @endphp
  <div class="col-md-6">
    @if($allow_create && in_array('create', $arr_permission))
    <button class="au-btn au-btn-icon au-btn--blue shadow float-right" onclick="window.location='{{$uri_create}}'">
     <i class="zmdi zmdi-plus"></i> Create
    </button>
    @endif
    @if($allow_export_excel && in_array('exportexcel', $arr_permission))
    <button class="btn btn-success shadow float-right" onclick="window.location='{{$uri_export_excel}}'">Excel</button>
    @endif
    @if($allow_export_pdf && in_array('exportpdf', $arr_permission))
    <button class="btn btn-danger shadow float-right" onclick="window.location='{{$uri_create}}'">PDF</button>
    @endif
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive table--no-card">
      <table id="table-list" class="table table-borderless table-striped table-earning idev-table">
        <thead>
          <tr>
            @foreach($table_headers as $header)
            @php
            $header_name = $header['name'];
            $header_column = $header['column'];
            @endphp
            <th style="white-space: nowrap;">{{$header_name}} <button class="btn btn-sm btn-link" @if($header['order']) onclick="orderBy('list','{{$header_column}}')" @endif><i class="fa fa-sort"></i></button></th>
            @endforeach
            <th class="col-action"></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>
<div class="row mt-4">
  <div class="col-md-12">
    <div id="paginate-list"></div>
  </div>
</div>
@push('scripts')
<script>
  $(document).ready(function() {
    idevTable("list")
  })
  $(".search-list").keyup(delay(function(e) {
    var dInput = this.value;
    if (dInput.length > 3 || dInput.length == 0) {
      $('.current-paginate').val(1)
      $('.search-list').val(dInput)
      idevTable("list")
    }
  }, 500))
</script>
@endpush
@endsection
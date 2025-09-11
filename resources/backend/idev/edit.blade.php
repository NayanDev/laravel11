@extends("backend.parent")
@section("content")
@push('mtitle')
New {{$title}}
@endpush
@php
  $id_update = str_replace(" ","-",strtolower($title))
@endphp
  <div class="row">
    @if(Session::get('message'))
        <div class="col-md-12">
            <div class="alert alert-autoclose alert-{{Session::get('status')}} alert-with-icon alert-dismissible fade show" data-notify="container">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                <span data-notify="message">{{Session::get('message')}}</span>
            </div>
        </div>
    @endif
    <div class="{{isset($class_card)?$class_card:'col-md-6'}}">
      <div class="card">
        <div class="card-body">
          <form id="form-update-{{$id_update}}" action="{{$url_update}}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
                @foreach($fields as $key => $field)
                  @include('backend.idev.fields.'.$field['type'])
                @endforeach
              <div class="col-md-12">
                <div class="form-group">
                  <button  id="btn-for-form-update-{{$id_update}}" type="button" class="btn btn-outline-info" onclick="submitAfterValid('form-update-{{$id_update}}')">Submit</button>
                  <button type="button" class="btn btn-outline-danger" onclick="window.history.back()">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
 
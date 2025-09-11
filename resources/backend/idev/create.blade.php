@extends('backend.parent')
@section('content')
    @push('mtitle')
        New {{ $title }}
    @endpush
    @php
    $id_store = str_replace(' ', '-', strtolower($title));
    @endphp
    <div class="row">
        @if (Session::get('message'))
            <div class="col-md-12">
                <div class="alert alert-autoclose alert-{{ Session::get('status') }} alert-with-icon alert-dismissible fade show"
                    data-notify="container">
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="nc-icon nc-simple-remove"></i>
                    </button>
                    <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                    <span data-notify="message">{{ Session::get('message') }}</span>
                </div>
            </div>
        @endif
        <div class="{{ isset($class_card) ? $class_card : 'col-md-6' }}">
            <div class="card">
                <div class="card-body">
                    <form id="form-create-{{ $id_store }}" action="{{ $url_store }}" method="post">
                        @csrf
                        <div class="row">
                            @php $method = "create"; @endphp
                            @foreach ($fields as $key => $field)
                                @include('backend.standard.fields.' . $field['type'])
                            @endforeach
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="btn-for-form-create-{{ $id_store }}" type="button"
                                        class="btn btn-outline-info"
                                        onclick="submitAfterValid('form-create-{{ $id_store }}')">Submit</button>
                                    <button type="button" class="btn btn-outline-danger"
                                        onclick="window.history.back()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

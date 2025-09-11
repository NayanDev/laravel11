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
          <div class="col-md-10">
            Feedback <b>{{ $participant->event_name }}</b>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-body p-3">
            <form id="form-feedback" action="{{url('feedback-form-submit')}}" method="post">
              @csrf
              <div class="row">
                @foreach ($masterFeedbacks as $key => $mf)
                  
                  <div class="col-md-12">
                    <h5>
                      {{$key+1}}.  {{$mf->name}}
                    </h5>
                    <div class="row mb-3">
                      @foreach (range('A', 'D') as $alp)
                      @php
                        $getFeedback = "";
                        if($participant->feedback){
                          $arrFeedback = json_decode($participant->feedback, true) ?? [];
                          if(array_key_exists($mf->id, $arrFeedback)){
                            if($arrFeedback[$mf->id] == $alp){
                              $getFeedback = "checked";
                            }
                          }
                        }
                      @endphp
                        <div class="col-md-1">
                          {{ $alp }}. <input type="radio" name="feedback[{{ $mf->id }}]" value="{{ $alp }}" {{ $getFeedback }} >
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div>
              <hr>
              <input type="hidden" name="participant_id" value="{{$participant->id}}">
              <button type="button" id="btn-for-form-feedback" class="btn btn-outline-secondary" onclick="softSubmit('form-feedback','list', actionOnSubmit())">
                    Update
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
  <script>
    function actionOnSubmit(){

        // setTimeout(function() {
        //     window.location.replace("{{url('report-participant')}}")  
        // }, 3000)
    }
  </script>
@endpush
@endsection
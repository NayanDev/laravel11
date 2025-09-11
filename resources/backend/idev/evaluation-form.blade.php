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
            Form Evaluasi <b>{{ $participant->name }}</b>
          </div>
          <div class="col-md-2">
             SKOR
             <h2>{{$totalScore}}</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-body p-3">
            <form id="form-evaluation" action="{{url('evaluation-form-submit')}}" method="post">
              @csrf
              @php
                $arrCategory = [];
              @endphp
              <div class="row">
                @foreach ($masterEvaluations as $key => $me)
                  @if (!in_array($me->category, $arrCategory))
                    <div class="col-md-12 bg-warning">
                      <h5 class="pt-2">
                        {{$me->category}}
                      </h5>
                    </div>
                    @php
                      $arrCategory[] = $me->category;
                    @endphp
                  @endif
                  <div class="col-md-10">
                    <div class="pt-3">
                      • {{$me->aspect}}
                    </div>
                  </div>
                  <div class="col-md-2">
                    <input type="number" name="aspect[{{ $me->id }}]" min="0" max="100" class="form-control m-2 idev-form" value="{{ array_key_exists($me->id, $arrAnswerLog) ? $arrAnswerLog[$me->id] : ''}}">
                  </div>
                @endforeach
              </div>
              <hr>
              <input type="hidden" name="participant_id" value="{{$participant->id}}">
              <input type="hidden" name="event_id" value="{{$participant->event_id}}">

              <button type="button" id="btn-for-form-evaluation" class="btn btn-outline-secondary" onclick="softSubmit('form-evaluation','list', actionOnSubmit())">
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
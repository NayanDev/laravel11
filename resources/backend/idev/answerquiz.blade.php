@extends("backend.parent")
@section("content")
@push('mtitle')
{{$title}}
@endpush
@push("styles")
<style>
    .section-header {
        background: white;
        padding: 8px;
        font-family: system-ui;
    }

    .big-font {
        font-size: 30px;
        font-weight: 700;
    }

    .quiz-section {
        display: none;
    }
    .progress-bar{
        height: 6px;
        width: 0%;
        background-color: blue;
        margin-bottom: 10px;
        margin-top: -16px;
    }
    .progress-bar-inactive{
        height: 6px;
        width: 100%;
        background-color: silver;
        margin-bottom: 10px;
    }
</style>
@endpush

<div class="pc-container">
    <div class="pc-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{$participant->event_name}}</h5>
                        </div>
                        {{$startTime}}
                    </div>
                    <div class="col-md-3">
                        <label id="digital-clock" class="big-font">00:00:00</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header bg-warning">
                        Soal
                    </div>
                    <div class="card-body p-3">
                        <div class="progress-bar-inactive"></div>
                        <div class="progress-bar"></div>

                        <form id="form-quiz" action="{{url('quiz-submit')}}" method="post">
                            @csrf
                            <input type="hidden" name="participant_id" value="{{request('participant_id')}}">
                            <input type="hidden" name="start_time" value="{{$startTime}}">
                            @foreach($arrQuiz['id'] as $key1 => $aq)
                            <div class="quiz-section step-{{$key1}}">
                                <div class="content-qustion">
                                    {{$key1 + 1}}. {{$arrQuiz['question'][$aq]}}
                                </div>
                                <div class="content-answers mt-2">
                                    @foreach ($arrQuiz['answers'][$aq] as $key2 => $ans)
                                    <input type="radio" name="questions[{{$key1}}]" class="answer-radio ar-key-{{$ans['id']}}" data-quest="{{$aq}}" data-key="{{$key1}}" value="{{$ans['id']}}">
                                    {{$ans['content']}}<br>
                                    @endforeach
                                </div>
                                <div class="button-section mt-4">
                                    @if ($key1 > 0)
                                    <button type="button" class="btn btn-sm btn-primary" onclick="btnPrev({{$key1}})">
                                        Prev
                                    </button>
                                    @endif

                                    @if ($key1 == sizeof($arrQuiz['id']) - 1)
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                                        Submit
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-primary" onclick="btnNext({{$key1}})">
                                        Next
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-warning">
                        Navigasi Soal
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($arrQuiz['id'] as $key1 => $aq)
                            <div class="col-3 mb-1">
                                <button class="ar-numbering-{{$aq}} btn btn-outline-warning btn-block" style="width:54px;" onclick="navigateTo({{$key1}})">{{$key1+1}}</button>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("scripts")
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure want to finish this Quiz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">No</button>
        <button type="button" id="btn-for-form-quiz" class="btn btn-sm btn-success" onclick="softSubmit('form-quiz','list', actionOnSubmit())">Yes</button>
      </div>
    </div>
  </div>
</div>
<script>
    var eventId = "{{request('event_id')}}"
    var mode = "{{request('mode')}}"
    var initIndex = 0
    var logAnswer = sessionStorage.getItem("logAnswer") ? JSON.parse(sessionStorage.getItem("logAnswer")) : [];
    var logNumbAnswer = sessionStorage.getItem("logNumAnswer") ? JSON.parse(sessionStorage.getItem("logNumAnswer")) : [];

    $(document).ready(function() {
        $(".step-" + initIndex).show()
        setProgress()

        $('.answer-radio').click(function(){
            logAnswer[$(this).attr('data-key')] = $(this).val()
            logNumbAnswer[$(this).attr('data-key')] = $(this).attr('data-quest')
            sessionStorage.setItem("logNumAnswer", JSON.stringify(logNumbAnswer))
            sessionStorage.setItem("logAnswer", JSON.stringify(logAnswer))
            setProgress()
            updateNumbering()
        })

        $.each(logAnswer, function( index, value ) {
            $( ".ar-key-"+value).prop('checked', true)
        });

        updateNumbering()
    });

    function updateNumbering() {
        $.each(logNumbAnswer, function( index, value ) {
            $( ".ar-numbering-"+value).addClass('btn-primary').removeClass('btn-outline-warning');
        });
    }


    function setProgress(){
        var progress = 100*logAnswer.length / $(".quiz-section").length

        $(".progress-bar").animate({ width:progress+'%' }); 
    }

    function actionOnSubmit(){
        sessionStorage.removeItem("logAnswer");

        setTimeout(function() {
            window.location.replace("{{url('assesment')}}")  
        }, 3000)
    }

    function btnPrev(currentIndex) {
        initIndex--
        $(".quiz-section").hide()
        $(".step-" + initIndex).show()
    }

    function btnNext(currentIndex) {
        initIndex++
        $(".quiz-section").hide()
        $(".step-" + initIndex).show()
    }

    function navigateTo(currentIndex) {
        initIndex = currentIndex
        $(".quiz-section").hide()
        $(".step-" + initIndex).show()
    }

    var countDownDate = new Date("{{$endTime}}").getTime();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (seconds.toString().length == 1) {
            seconds = "0"+seconds
        }
        if (hours.toString().length == 1) {
            hours = "0"+hours
        }
        if (minutes.toString().length == 1) {
            minutes = "0"+minutes
        }

        document.getElementById("digital-clock").innerHTML = hours + ":" +
            minutes + ":" + seconds;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("digital-clock").innerHTML = "Time is over";
            softSubmit('form-quiz','list', actionOnSubmit())
        }
    }, 1000);
</script>
@endpush

@endsection
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
</style>
@endpush

<div class="pc-container">
  <div class="pc-content">

    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-9">
            <div class="page-header-title">
              <h5 class="m-b-10">{{request('mode')}}</h5>
            </div>
            {{request('subtitle')}}
          </div>
          <div class="col-md-3">
            <label id="digital-clock" class="big-font">00:00:00</label>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-4">
        <div class="card mb-4">
          <div class="card-header bg-warning">
            SCAN QR CODE
          </div>
          <div class="card-body p-3">

            <label for="">Unique Code</label>
            <input type="text" id="id-number" class="form-control" name="">
            <div class="section-information"></div>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card mb-4">
          <div class="card-header bg-warning">
            Daftar Peserta
          </div>
          <div class="card-body p-3">
            <table class="table table-striped presence-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Waktu</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push("scripts")
<script>
  var eventId = "{{request('event_id')}}"
  var mode = "{{request('mode')}}"

  $(document).ready(function() {
    $("#id-number").focus();
    latestPresence()
  });

  function latestPresence() {
    $('.presence-table').css("opacity", "0.6")

    $.get("{{ url('presence-api') }}?event_id=" + eventId + "&mode=" + mode, function(response) {
      var html = ""
      $.each(response, function(index, res) {
        var numb = index + 1
        html += "<tr>"
        html += "<td>" + numb + "</td>"
        html += "<td>" + res.name + "</td>"
        html += "<td>" + res.waktu + "</td>"
        html += "</tr>"
      })
      $('.presence-table tbody').html(html)
      $('.presence-table').css("opacity", "1")
    });
  }


  $(function() {
    var ajaxLoading = false

    $('#id-number').keyup(delay(function(e) {
      var code = this.value;
      if (code.length > 5 && !ajaxLoading) {
        submitMe();
      }
    }, 800));
    $("#id-number").keyup(function(e) {
      var code = e.key; // recommended to use e.key, it's normalized across devices and languages
      var codeId = $(this).val()

      if (code === "Enter") e.preventDefault();
      if (code === " " || code === "Enter") {
        alert("Prohibited!")
      }
    });

    function delay(callback, ms) {
      var timer = 0;
      return function() {
        var context = this,
          args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function() {
          callback.apply(context, args);
        }, ms || 0);
      };
    }


    function submitMe() {
      var idNumber = $('#id-number').val()
      ajaxLoading = true
      $.ajax({
        url: '{{ url("presence-submit") }}',
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          code: idNumber,
          event_id: eventId,
          mode: mode,
        },
        success: function(result) {
          var html = ""
          if (result.status) {
            latestPresence()
            var mData = result.data
            html += "<table class='table'>"
            html += "<tr>"
            html += "<td>Nama</td>"
            html += "<td> : <b>" + mData.name + "</b></td>"
            html += "</tr>"
            html += "<tr>"
            html += "<td>Check In</td>"
            html += "<td> : <b>" + mData.check_in_at + "</b></td>"
            html += "</tr>"
            html += "<tr>"
            html += "<td>Check Out</td>"
            html += "<td> : <b>" + mData.check_out_at + "</b></td>"
            html += "</tr>"
            html += "</table>"
          }
          var alertHtml = '<div class="alert alert-' + result.alert + ' my-2" role="alert" bis_skin_checked="1">' + result.message + '</div>'
          $(".section-information").html(alertHtml + html)
          $('#id-number').val("")

          ajaxLoading = false
          $(".section-information").delay(5000).slideUp(200, function() {
            $(".section-information").hide();
          });
        },
        complete: function() {
          $(this).data('requestRunning', false);
        },
        error: function(result) {
          console.log(result);
        }
      });

    }
  });

  function getDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    if (month.toString().length == 1) {
      month = '0' + month;
    }
    if (day.toString().length == 1) {
      day = '0' + day;
    }
    if (hour.toString().length == 1) {
      hour = '0' + hour;
    }
    if (minute.toString().length == 1) {
      minute = '0' + minute;
    }
    if (second.toString().length == 1) {
      second = '0' + second;
    }
    var dateTime = hour + ':' + minute + ':' + second;
    return dateTime;
  }

  setInterval(function() {
    currentTime = getDateTime();
    document.getElementById("digital-clock").innerHTML = currentTime;
  }, 1000);
</script>
@endpush

@endsection
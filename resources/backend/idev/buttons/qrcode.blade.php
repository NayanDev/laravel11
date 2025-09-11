<div class="modal fade" tabindex="-1" role="dialog" id="modalQrcode">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Your Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="section-qrcode text-center w-100">
                </div>
                
                <form id="form-feedback" action="{{url('participant-feedback')}}" method="post">
                    @csrf
                    <label>Tuliskan Saran dan Masukan</label>
                    <textarea class="form-control" name="feedback" row="5" col="5"></textarea>
                    <hr>
                    <input type="hidden" name="id" class="part-id" value="">
                    <button id="btn-for-form-feedback" type="button" 
                        class="btn btn-sm btn-outline-primary"           
                        onclick="softSubmit('form-feedback', 'list-{{$uri_key}}')">Submit</button>
                </form>

                <div style="display:none;">
                    <hr>
                WA Message <br>
                <small>
                    Selamat malam <b class="info-name"></b>,<br>
                    Mengingatkan kembali untuk Pelatihan <b class="info-event"></b> <br>
                    Akan diselenggarakan pada <b class="info-schedule"></b><br>
                    Diharapkan untuk hadir sesuai waktu yang tercantum, info lebih lanjut mengenai Pelatihan bisa Anda lihat di:<br> 
                    https://lms.sampharindp.id <br>

                    Gunakan <br>
                    Email : <b class="info-email"></b> <br>
                    Password : workshop21 <br>
                    Untuk login ke akun anda dan segera ubah password anda di Account Setting (Pojok Kanan Atas).<br>
                    <br>
                    Terimakasih
                </small>
                </div>
                
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('theme/assets/js/plugins/qrcode.min.js')}}"></script>

    <script>

        function setQrcode(response) {
            var mCode = response.code
            $(".info-name").text(response.name)
            $(".info-email").text(response.email)
            $(".info-event").text('"'+response.event_name+'"')
            $(".info-schedule").text(response.schedule)
            $(".part-id").val(response.id)

            $(".section-qrcode").html("<div id='qrcode' style='width:200px; margin:auto;'></div><b>"+mCode+"</b>")
            var qrcode = new QRCode("qrcode", {
                text: mCode,
                width: 200,
                height: 200,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            })

        }
    </script>
@endpush
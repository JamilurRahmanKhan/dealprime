@extends('website.layouts.master')
@section('title','Customer Authentication')
@section('body')
    <main class="main">
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="heading mb-1">
                                <h2 class="title">Check OTP</h2>
                            </div>

                            <form action="{{route('check.otp')}}" method="post">
                                @csrf
                                <label for="login-password">
                                    Enter OTP
                                    <span class="required">*</span>
                                </label>
                                <input  type="password"  name="new_otp"  class="form-input form-wide mb-1"  id="new_otp" 
                                    onkeyup="sendOtp()" 
                                    maxlength="6"
                                    placeholder="Enter OTP"
                                    required
                                />
                            
                                
                                <input type="hidden" value="{{$otp}}"  id="new_otp_check"  />
                                <div class="text-danger">
                                    <small> @error('new_otp') {{$message}}@enderror</small>
                                </div>
                                    
{{--                                <div id="otp-timer" class="mb-2">--}}
{{--                                    <small>OTP expires in: <span id="timer">01:00</span></small>--}}
{{--                                </div>--}}

                               <button type="submit" id="send-otp" class="btn btn-dark btn-md w-100" style="display:none;">
                                    Enter OTP
                                </button>

                                <!-- Resend OTP Button (Initially Hidden) -->
{{--                                <button type="button" id="resend-otp" class="btn btn-primary btn-md w-100 mt-2" style="display:none;" onclick="resendOTP()">Resend OTP</button>--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->
    
      <script>
        function sendOtp() {
            const otpInput = document.getElementById('new_otp');
            const sendOtpButton = document.getElementById('send-otp'); 
            const newOtpCheck = document.getElementById('new_otp_check');
            
            // Check if the OTP length is 6
            if (otpInput.value.length === 6) {
                if(otpInput.value == newOtpCheck.value){
                    sendOtpButton.style.display = 'block'; // Show the button
                }
            } else {
                sendOtpButton.style.display = 'none'; // Hide the button
            }
        }
    </script>

{{--    <script>--}}
{{--        let timerDuration = 30; // Timer duration in seconds--}}
{{--        let timerInterval;--}}

{{--        function startTimer() {--}}
{{--            const timerElement = document.getElementById('timer');--}}
{{--            timerInterval = setInterval(function () {--}}
{{--                let minutes = Math.floor(timerDuration / 30);--}}
{{--                let seconds = timerDuration % 30;--}}
{{--                if (seconds < 5) {--}}
{{--                    seconds = '0' + seconds;--}}
{{--                }--}}
{{--                timerElement.textContent = `${minutes}:${seconds}`;--}}

{{--                // When timer reaches 0, stop the timer and show resend button--}}
{{--                if (timerDuration === 0) {--}}
{{--                    clearInterval(timerInterval);--}}
{{--                    document.getElementById('resend-otp').style.display = 'block';--}}
{{--                    document.getElementById('send-otp').style.display = 'none';--}}
{{--                } else {--}}
{{--                    timerDuration--;--}}
{{--                }--}}
{{--            }, 1000);--}}
{{--        }--}}

{{--        // Start the timer when the page loads--}}
{{--        window.onload = function () {--}}
{{--            startTimer();--}}
{{--        }--}}

{{--        function resendOTP() {--}}
{{--            // Logic to resend OTP, you might want to make an AJAX call or some backend logic here--}}
{{--            alert('OTP has been resent!');--}}

{{--            // Reset the timer and hide the resend button again--}}
{{--            timerDuration = 30;--}}
{{--            document.getElementById('resend-otp').style.display = 'none';--}}
{{--            document.getElementById('send-otp').style.display = 'block';--}}
{{--            startTimer();--}}
{{--        }--}}
{{--    </script>--}}
@endsection

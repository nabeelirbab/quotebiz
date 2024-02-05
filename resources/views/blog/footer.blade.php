   <?php 
    $sitename = \Acelle\Model\Setting::get("site_name");
    $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small'));
    $sitelightlogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
    $job_design = Acelle\Jobs\HelperJob::form_design(); 
  $sitedarklogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));


    ?>
  <!--   <footer class="footer-wrap-layout2">
            <div class="container">
                <div class="footer-box-layout2">
                    <div class="footer-logo">
                        <a href="/"><img src="{{$sitelightlogo}}" alt="{{$sitename}}" alt="logo" style="max-width: 15%;"></a>
                    </div>
                    <div class="copyright">© <?php echo date('Y'); ?> {{$sitename}}. All Rights Reserved.</div>
                </div>
            </div>
        </footer> -->
        <!-- Footer Area End Here -->

    @include('modal.footer-modal',['job_design' => $job_design])
   <footer class="footer bg-indigo is-dark bg-lighter" id="footer">
    <div class="container">

        <div class="row g-3 align-items-center justify-content-md-between py-3">
          <div class="col-md-3 d-flex justify-content-center justify-content-sm-start">
              <a href="{{ url('/') }}" class="logo-link">
                @if($job_design->footer_logo == 'dark')
                  <img class="logo-light logo-img" src="{{$sitedarklogo}}" alt="{{$sitename}}" srcset="./images/logo2x.png 2x" alt="logo">
                  <img class="logo-dark logo-img" src="{{$sitedarklogo}}" alt="{{$sitename}}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                  @else
                  <img class="logo-light logo-img" src="{{$sitesmalllogo}}" alt="{{$sitename}}" srcset="./images/logo2x.png 2x" alt="logo">
                  <img class="logo-dark logo-img" src="{{$sitesmalllogo}}" alt="{{$sitename}}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                  @endif
                    </a>
          </div>
            <div class="col-md-6">
                <div class="footer-logo">
                  
                    <div class="mt-2 text-center">
                         <ul class="link-inline gx-4" style="text-transform: uppercase;line-height: 0.9;">
                            <!-- <li><a href="#">How it works</a></li> -->
                            <li><a href="#">Home</a></li>
                            @if($job_design && $job_design->profile_status != '2')<li><a href="{{ url('/service-providers') }}">{{ ($job_design && $job_design->sp_text) ? $job_design->sp_text : 'Service Providers' }}</a></li>
                            @endif
                            <li><a href="#" data-toggle="modal" data-target="#contactus">Contact</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#terms">Terms</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#privacy">Privacy</a></li>
                            <li><a href="{{ url('sitemap') }}" target="_blank">Sitemap</a></li>
                        </ul><!-- .footer-nav -->

                    </div>
                 
                </div><!-- .footer-logo -->
            </div><!-- .col -->
            <div class="col-md-3 d-md-flex justify-content-lg-end">
            @if($job_design)
               @if($job_design && $job_design->facebook || $job_design->instagram || $job_design->linkedIn || $job_design->twitter || $job_design->whatsApp )
              <div class="centered-text mt-md-3 mt-2">
                <div class="social">
                @if($job_design->facebook)
                <a href="{{$job_design->facebook}}" target="_blank"><em class="icon ni ni-facebook-fill"></em></a>
                @endif
                @if($job_design->instagram)
                <a href="{{$job_design->instagram}}" target="_blank"><em class="icon ni ni-instagram-round"></em></a>
                @endif
                @if($job_design->linkedIn)
                <a href="{{$job_design->linkedIn}}" target="_blank"><em class="icon ni ni-linkedin-round"></em></a>
                @endif
                @if($job_design->twitter)
                <a href="{{$job_design->twitter}}" target="_blank"><em class="icon ni ni-twitter-round"></em></a>
                @endif
                @if($job_design->whatsApp)
                <a href="{{$job_design->whatsApp}}" target="_blank"><em class="icon ni ni-whatsapp-round"></em></a>
                 @endif
                </div>
              </div>
              @endif
              @endif
            </div><!-- .col -->
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <div class="text-base text-center" style="font-size: 13px">
              <a href="">Copyright &copy; {{date("Y")}} {{$sitename}}.</a>
            </div>
          </div>
        </div>
      </div>
        
</footer><!-- .footer -->
    <!-- jquery-->
</div>
    <script src="{{ asset('frontend-assets/js/blog/jquery-3.3.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('frontend-assets/js/blog/bootstrap.min.js') }}"></script>
    <!-- Meanmenu js -->
    <script src="{{ asset('frontend-assets/js/blog/jquery.meanmenu.min.js') }}"></script>
    <!-- Main js -->
    <script src="{{ asset('frontend-assets/js/blog/mains.js') }}"></script>
<script>
$(document).ready(function () {
    $('.track-click').on('click', function() {
        var type = $(this).data('type');
        var userId = $(this).data('user-id');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('/track-click') }}",
            method: 'POST',
            data: { track_type: type, user_id: userId, _token: _token },
            success: function(response) {
                // Handle success (if needed)
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });
    $('#contactform').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
            submitButton.prop('disabled', true);  // Disable the button

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                // Display success message in the modal
                $('.error-body').html('<div class="alert alert-success" role="alert">Message sent successfully!</div>');
            },
            error: function (data) {
                // Display error message in the modal
                $('.error-body').html('<div class="alert alert-danger" role="alert">Error sending message. Please try again.</div>');
            },
             complete: function () {
                    submitButton.prop('disabled', false);  // Re-enable the button after completion
            }
        });
    });
});
</script>
</body>

</html>
    <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/revolution.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/slick.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/script.js') }}"></script>
    {{-- //datatable --}}
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="http://<?php echo request('account') ?>.shopgrabthis.com:3000/socket.io/socket.io.js"></script>

    <script type="text/javascript">

        var getAPIURL = '{{ url('') }}';
        var userid = '{{Auth::user()->id }}';

        const socket = io.connect('http://<?php echo request('account') ?>.shopgrabthis.com:3000');
        socket.on('connect', function() {
          console.log("Connected to WS server");
          console.log(socket.connected); 
          socket.emit('register',userid);
        });

        $(document).ready(function() {

           getcount();
        });


        function getcount(){
            $.ajax({
                  url: getAPIURL + "/allunreadmsg/"+userid,
                  type: "GET"
                }).then(function(res) {
                  $('.msgnotifications').html(res);
                })
        }

        socket.on('receiveMsg', function(data) {
            getcount();
        });

        socket.on('receiveReadMsg', function(data) {
            getcount();
        });
    </script>



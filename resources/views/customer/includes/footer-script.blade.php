    <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
   
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



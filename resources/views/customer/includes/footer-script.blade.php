    <script src="{{ asset('frontend-assets/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('frontend-assets/assets/js/scripts.js?ver=2.9.1') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
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

         var firebaseConfig = {
            apiKey: "AIzaSyD6wC6Brb4NQwVjHbVL7_OtFC5MUb9xVfQ",
            authDomain: "quotebiz-f2e07.firebaseapp.com",
            projectId: "quotebiz-f2e07",
            storageBucket: "quotebiz-f2e07.appspot.com",
            messagingSenderId: "391920071095",
            appId: "1:391920071095:web:4beb5f11c6184728437832"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {
            
            axios.post("{{ url('service-provider/fcm-token') }}",{
                _method:"PATCH",
                token
            }).then(({data})=>{
                console.log(data)
            }).catch(({response:{data}})=>{
                console.error(data)
            })

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();
  
    messaging.onMessage(function({data:{body,title}}){
        new Notification(title, {body});
    });
    </script>



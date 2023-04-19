   <?php 
    $sitename = \Acelle\Model\Setting::get("site_name");
    $sitesmalllogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));
    $sitelightlogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_big'));
    ?>
    <footer class="footer-wrap-layout2">
            <div class="container">
                <div class="footer-box-layout2">
                    <div class="footer-logo">
                        <a href="/"><img src="{{$sitelightlogo}}" alt="{{$sitename}}" alt="logo"></a>
                    </div>
                    <div class="copyright">© <?php echo date('Y'); ?> {{$sitename}}. All Rights Reserved.</div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    
    </div>
    <!-- jquery-->
    <script src="{{ asset('frontend-assets/js/blog/jquery-3.3.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('frontend-assets/js/blog/bootstrap.min.js') }}"></script>
    <!-- Meanmenu js -->
    <script src="{{ asset('frontend-assets/js/blog/jquery.meanmenu.min.js') }}"></script>
    <!-- Main js -->
    <script src="{{ asset('frontend-assets/js/blog/main.js') }}"></script>

</body>

</html>
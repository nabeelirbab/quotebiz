<nav class="navbar navbar-expand-xl navbar-dark fixed-top navbar-main py-0">
    <div class="container-fluid ms-0">
        <a class="navbar-brand d-flex align-items-center me-2" href="{{ url('/') }}">
            @if (\Acelle\Model\Setting::get('site_logo_small'))
                <img class="logo" src="{{ action('SettingController@file', \Acelle\Model\Setting::get('site_logo_small')) }}" alt="">
            @else
                <span class="default-app-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 389.3 60.1"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><path d="M38.5,56.4,36.7,43.8H16.9l-7,12.6H0L29.6,6h9.8l8,50.4ZM33.1,16V13.6h-.2a18,18,0,0,1-1.6,3.8L20.6,36.7H35.7l-2.4-19A9.9,9.9,0,0,1,33.1,16Z" style="fill:#fff"/><path d="M82.7,28.9A13.5,13.5,0,0,0,79.4,27a13.2,13.2,0,0,0-4.4-.8,10.4,10.4,0,0,0-6.1,2,14.7,14.7,0,0,0-4.5,5.7,17.5,17.5,0,0,0-1.8,7.8c0,2.9.7,5.1,2,6.6a7,7,0,0,0,5.6,2.3,12.2,12.2,0,0,0,4.6-.9,22.6,22.6,0,0,0,4.4-2.2l-1.5,7.2a22.4,22.4,0,0,1-9.9,2.6c-4.3,0-7.6-1.3-10.1-3.9s-3.6-6.3-3.6-10.9a26,26,0,0,1,2.7-11.6,19.9,19.9,0,0,1,7.6-8.4,20.2,20.2,0,0,1,10.9-3,22.2,22.2,0,0,1,5.1.6,19.7,19.7,0,0,1,4,1.6Z" style="fill:#fff"/><path d="M118.6,29.3a10,10,0,0,1-6,9.5c-4.1,2.1-10.2,3.2-18.4,3.3v1.1a7.4,7.4,0,0,0,2.2,5.6,8.6,8.6,0,0,0,6.1,2.1,22,22,0,0,0,5.7-1,39.9,39.9,0,0,0,5.6-2.5l-1.4,7a25,25,0,0,1-11.7,2.9c-4.7,0-8.3-1.3-10.9-3.9s-4-6.3-4-11a25.6,25.6,0,0,1,2.7-11.5A20.7,20.7,0,0,1,96,22.6a18.4,18.4,0,0,1,10.4-3.1q5.7,0,9,2.7A8.8,8.8,0,0,1,118.6,29.3Zm-8.2.2a3.7,3.7,0,0,0-1.3-2.8,4.9,4.9,0,0,0-3.5-1.1,9.8,9.8,0,0,0-6.8,3.1,15.7,15.7,0,0,0-4,7.5c10.4,0,15.6-2.2,15.6-6.7Z" style="fill:#fff"/><path d="M130.6,57c-2.6,0-4.6-.6-6-1.9a7.5,7.5,0,0,1-2-5.5,60.1,60.1,0,0,1,1.3-8.5c.9-4.1,3.6-16.8,8.1-38h8.6l-8.5,40a35.4,35.4,0,0,0-.8,4.5c0,1.8,1,2.7,3.1,2.7a8.7,8.7,0,0,0,3.2-.6l-1.3,6.5A22.4,22.4,0,0,1,130.6,57Z" style="fill:#fff"/><path d="M151.3,57c-2.6,0-4.6-.6-5.9-1.9a7.1,7.1,0,0,1-2-5.5,48.5,48.5,0,0,1,1.3-8.5c.9-4.1,3.6-16.8,8.1-38h8.5l-8.5,40a23.4,23.4,0,0,0-.7,4.5q0,2.7,3,2.7a8.7,8.7,0,0,0,3.2-.6L157,56.2A22.4,22.4,0,0,1,151.3,57Z" style="fill:#fff"/><path d="M196.3,29.3a10,10,0,0,1-6,9.5c-4,2.1-10.2,3.2-18.4,3.3v1.1a7.3,7.3,0,0,0,2.1,5.6,8.6,8.6,0,0,0,6.1,2.1,22,22,0,0,0,5.7-1,28.1,28.1,0,0,0,5.6-2.5l-1.4,7a25,25,0,0,1-11.7,2.9c-4.7,0-8.3-1.3-10.9-3.9s-3.9-6.3-3.9-11a26.9,26.9,0,0,1,2.6-11.5,20.7,20.7,0,0,1,7.5-8.3,18.7,18.7,0,0,1,10.5-3.1c3.7,0,6.7.9,8.9,2.7A8.5,8.5,0,0,1,196.3,29.3Zm-8.2.2a3.2,3.2,0,0,0-1.3-2.8,4.9,4.9,0,0,0-3.5-1.1,9.8,9.8,0,0,0-6.8,3.1,14.7,14.7,0,0,0-3.9,7.5C182.9,36.2,188.1,34,188.1,29.5Z" style="fill:#fff"/><path d="M339.6,59.2h-8.7a17.3,17.3,0,0,1,.3-3.2,22,22,0,0,1,.4-3.6h-.2a28.9,28.9,0,0,1-3.8,4.7,12.4,12.4,0,0,1-3.4,2.2,12.6,12.6,0,0,1-4.3.8,9.1,9.1,0,0,1-7.9-3.7c-1.9-2.4-2.9-5.7-2.9-10A25.6,25.6,0,0,1,312.2,34a19.9,19.9,0,0,1,8.2-8.8,23.9,23.9,0,0,1,12-2.9A68.3,68.3,0,0,1,345.9,24l-5,23.5c-.3,1.6-.6,3.7-.9,6.1A52.7,52.7,0,0,0,339.6,59.2Zm-3.3-30a15.7,15.7,0,0,0-4.8-.5,12.8,12.8,0,0,0-7.1,2.1,14.4,14.4,0,0,0-4.9,6.3,22.5,22.5,0,0,0-1.8,8.9,9.2,9.2,0,0,0,1.3,5.4,4.5,4.5,0,0,0,4,1.9c2.5,0,4.8-1.3,6.8-3.9a26.4,26.4,0,0,0,4.4-10.5Z" style="fill:#fff"/><path d="M358.6,59.8a8.3,8.3,0,0,1-5.9-2,7.1,7.1,0,0,1-2-5.5,14.7,14.7,0,0,1,.4-3.6l5.2-25.5h8.5l-4.7,22.7a35.4,35.4,0,0,0-.8,4.5c0,1.8,1,2.7,3.1,2.7a8.7,8.7,0,0,0,3.2-.6L364.2,59A21,21,0,0,1,358.6,59.8ZM368.1,11a4.7,4.7,0,0,1-1.5,3.5,5.5,5.5,0,0,1-3.7,1.4,4.5,4.5,0,0,1-3.5-1.3,3.9,3.9,0,0,1-1.5-3.3,3.9,3.9,0,0,1,1.6-3.5,5,5,0,0,1,3.7-1.3,5.5,5.5,0,0,1,3.5,1.2A4.7,4.7,0,0,1,368.1,11Z" style="fill:#fff"/><path d="M379.3,59.8a8.3,8.3,0,0,1-5.9-2,6.9,6.9,0,0,1-2.1-5.4,48.6,48.6,0,0,1,1.4-8.5c.9-4.1,3.6-16.8,8.1-38h8.5l-8.5,40a23.4,23.4,0,0,0-.7,4.5q0,2.7,3,2.7a8.7,8.7,0,0,0,3.2-.6L385,59A22.4,22.4,0,0,1,379.3,59.8Z" style="fill:#fff"/><path d="M307.4.1,310,3.3c-.1.4-.1.7-.2,1.1l-.2.6L297.9,59.1H284.5l10.4-44L266.1,44.8l-4.2-.6L246.7,16.9c-3.6,14-7.1,28-10.7,42.1l-11.6.2,14-54.8c.3-1.5.7-2.9,1.5-3.4h10.2c-.3-.8-.2-.6-.1-.4s1.3,2.5,1.9,3.8l.4.6c4.5,8.9,9.1,17.7,13.7,26.5L291.7,5l.6-.6L296.5.1Z" style="fill:#fff"/><path d="M310,3.5a2.9,2.9,0,0,0-.2.9H238.4l.4-1.8A3.4,3.4,0,0,1,242.1,0h65.1a2.9,2.9,0,0,1,2.9,2.9C310.1,3.1,310,3.3,310,3.5Z" style="fill:#fff"/><path d="M228.9,14.7H203.3a2.5,2.5,0,0,1,0-5h25.6a2.5,2.5,0,0,1,0,5Z" style="fill:#fff"/><path d="M225.3,28.7H213.5a2.5,2.5,0,0,1,0-5h11.8a2.5,2.5,0,0,1,0,5Z" style="fill:#fff"/><path d="M221.9,42.7h-3.1a2.5,2.5,0,0,1,0-5h3.1a2.5,2.5,0,0,1,0,5Z" style="fill:#fff"/></g></g></g></g></svg>
                </span>
            @endif
        </a>
        <button class="navbar-toggler" role="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <span class="leftbar-hide-menu middle-bar-element">
            <svg class="SideBurgerIcon-image" viewBox="0 0 50 32"><path d="M49,4H19c-0.6,0-1-0.4-1-1s0.4-1,1-1h30c0.6,0,1,0.4,1,1S49.6,4,49,4z"></path><path d="M49,16H19c-0.6,0-1-0.4-1-1s0.4-1,1-1h30c0.6,0,1,0.4,1,1S49.6,16,49,16z"></path><path d="M49,28H19c-0.6,0-1-0.4-1-1s0.4-1,1-1h30c0.6,0,1,0.4,1,1S49.6,28,49,28z"></path><path d="M8.1,22.8c-0.3,0-0.5-0.1-0.7-0.3L0.7,15l6.7-7.8c0.4-0.4,1-0.5,1.4-0.1c0.4,0.4,0.5,1,0.1,1.4L3.3,15l5.5,6.2   c0.4,0.4,0.3,1-0.1,1.4C8.6,22.7,8.4,22.8,8.1,22.8z"></path></svg>
        </span>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-md-0 main-menu">
                <li class="nav-item" rel0="HomeController">
                    <a href="{{ url('/') }}" title="{{ trans('messages.dashboard') }}" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                        <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.1 86.1"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><path d="M51.8,86.1H41.9a8.5,8.5,0,0,1-8.5-8.5V60.2a8.5,8.5,0,0,1,8.5-8.5h9.9a8.5,8.5,0,0,1,8.5,8.5V77.6A8.5,8.5,0,0,1,51.8,86.1ZM41.9,58.7a1.5,1.5,0,0,0-1.5,1.5V77.6a1.5,1.5,0,0,0,1.5,1.5h9.9a1.5,1.5,0,0,0,1.5-1.5V60.2a1.5,1.5,0,0,0-1.5-1.5Z" style="fill:aqua"/><path d="M60.4,86.1H31.7A20.6,20.6,0,0,1,11.2,65.7V24.6h7V65.7A13.5,13.5,0,0,0,31.7,79.1H60.4A13.5,13.5,0,0,0,73.9,65.7V25.3h7V65.7A20.6,20.6,0,0,1,60.4,86.1Z" style="fill:#f2f2f2"/><path d="M88.6,36.5a3.6,3.6,0,0,1-2-.6L45.7,7.7,5.5,35.1a3.5,3.5,0,1,1-4-5.8L43.7.6a3.6,3.6,0,0,1,4,0L90.6,30.1a3.5,3.5,0,0,1-2,6.4Z" style="fill:#f2f2f2"/></g></g></g></g></svg>
                        </i>
                        <span>{{ trans('messages.dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item" rel0="HomeController">
                    <a href="{{ url('quotes') }}" title="{{ trans('messages.lists') }}" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                        <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                        </i>
                        <span>Quotes</span>
                    </a>
                </li>
                <li class="nav-item" rel2="HomeController">
                    <a href="{{ url('customers') }}" title="Customers" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                        <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                        </i>
                        <span>Customers</span>
                    </a>
                </li>

                      <li class="nav-item dropdown language-switch"  rel0="CustomerController">
                                    <a  class="nav-link lvl-1 dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                                   <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                        </i>
                            <span>Service Providers</span>
                             <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                             <li class="nav-item" rel0="CustomerController9">
                                    <a href="{{ url('serviceproviders') }}" class="dropdown-item d-flex align-items-center">
                                        <i class="navbar-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 104.4 103" style="enable-background:new 0 0 104.4 103;" xml:space="preserve"><style type="text/css">.st0{fill:#333333;}.st1{opacity:0.65;}</style><g id="Layer_2_1_"><g id="Layer_1-2"><path class="st0" d="M46,51.6c-14.2,0-25.8-11.6-25.8-25.8C20.2,11.6,31.8,0,46,0c14.2,0,25.8,11.6,25.8,25.8 C71.8,40,60.2,51.6,46,51.6z M46,7c-10.4,0-18.8,8.4-18.8,18.8c0,10.4,8.4,18.8,18.8,18.8s18.8-8.4,18.8-18.8 C64.8,15.4,56.4,7,46,7z"/><path class="st0" d="M88.5,103c-1.9,0-3.5-1.6-3.5-3.5c0-21.5-17.5-39-39-39S7,78,7,99.5c0,1.9-1.6,3.5-3.5,3.5S0,101.4,0,99.5 c0-25.4,20.6-46,46-46s46,20.6,46,46C92,101.4,90.4,103,88.5,103z"/><path class="st0" d="M19.5,103h-16c-1.9,0-3.5-1.6-3.5-3.5S1.6,96,3.5,96h16c1.9,0,3.5,1.6,3.5,3.5S21.4,103,19.5,103z"/><path class="st0" d="M88.5,103H36.9c-1.9,0-3.5-1.6-3.5-3.5S35,96,36.9,96h51.6c1.9,0,3.5,1.6,3.5,3.5S90.4,103,88.5,103z"/><path class="st0" d="M46,39c-3.3,0-6.4-1.6-7.7-4c-0.9-1.7-0.3-3.8,1.4-4.7c1.7-0.9,3.8-0.3,4.7,1.3c0.2,0.1,0.7,0.4,1.6,0.4 c0.7,0,1.3-0.3,1.6-0.5c0.8-1.7,2.8-2.4,4.5-1.7c1.8,0.8,2.6,2.8,1.8,4.6C52.6,37.6,48.9,39,46,39z M44.5,31.6 C44.5,31.6,44.5,31.6,44.5,31.6C44.5,31.6,44.5,31.6,44.5,31.6z M44.4,31.5L44.4,31.5L44.4,31.5z"/><g class="st1"><path class="st0" d="M73.6,46.7c-1,0-2.1-0.5-2.8-1.3c-1.2-1.5-0.9-3.7,0.6-4.9C77,36.1,79.8,29,78.6,22 c-0.9-6.9-5.7-12.7-12.2-14.8c-1.8-0.6-2.8-2.6-2.2-4.4c0.6-1.8,2.6-2.8,4.4-2.2c9,3,15.7,11,17,20.5c1.5,9.4-2.2,19-9.8,25 C75.1,46.5,74.4,46.7,73.6,46.7z"/><path class="st0" d="M100.9,99c-1.9,0-3.5-1.6-3.5-3.5c0-17.9-11.7-33.7-27.7-37.7c-1.9-0.5-3-2.4-2.6-4.2c0.5-1.9,2.4-3,4.2-2.6 c19.5,4.8,33.1,23.1,33.1,44.5C104.4,97.4,102.8,99,100.9,99z"/></g></g></g></svg>
                                        </i>
                                        Service Providers List
                                    </a>
                                </li>
                            <li class="nav-item" rel0="CustomerController9">
                                    <a href="{{ url('service-categories') }}" class="dropdown-item d-flex align-items-center">
                                        <i class="navbar-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 104.4 103" style="enable-background:new 0 0 104.4 103;" xml:space="preserve"><style type="text/css">.st0{fill:#333333;}.st1{opacity:0.65;}</style><g id="Layer_2_1_"><g id="Layer_1-2"><path class="st0" d="M46,51.6c-14.2,0-25.8-11.6-25.8-25.8C20.2,11.6,31.8,0,46,0c14.2,0,25.8,11.6,25.8,25.8 C71.8,40,60.2,51.6,46,51.6z M46,7c-10.4,0-18.8,8.4-18.8,18.8c0,10.4,8.4,18.8,18.8,18.8s18.8-8.4,18.8-18.8 C64.8,15.4,56.4,7,46,7z"/><path class="st0" d="M88.5,103c-1.9,0-3.5-1.6-3.5-3.5c0-21.5-17.5-39-39-39S7,78,7,99.5c0,1.9-1.6,3.5-3.5,3.5S0,101.4,0,99.5 c0-25.4,20.6-46,46-46s46,20.6,46,46C92,101.4,90.4,103,88.5,103z"/><path class="st0" d="M19.5,103h-16c-1.9,0-3.5-1.6-3.5-3.5S1.6,96,3.5,96h16c1.9,0,3.5,1.6,3.5,3.5S21.4,103,19.5,103z"/><path class="st0" d="M88.5,103H36.9c-1.9,0-3.5-1.6-3.5-3.5S35,96,36.9,96h51.6c1.9,0,3.5,1.6,3.5,3.5S90.4,103,88.5,103z"/><path class="st0" d="M46,39c-3.3,0-6.4-1.6-7.7-4c-0.9-1.7-0.3-3.8,1.4-4.7c1.7-0.9,3.8-0.3,4.7,1.3c0.2,0.1,0.7,0.4,1.6,0.4 c0.7,0,1.3-0.3,1.6-0.5c0.8-1.7,2.8-2.4,4.5-1.7c1.8,0.8,2.6,2.8,1.8,4.6C52.6,37.6,48.9,39,46,39z M44.5,31.6 C44.5,31.6,44.5,31.6,44.5,31.6C44.5,31.6,44.5,31.6,44.5,31.6z M44.4,31.5L44.4,31.5L44.4,31.5z"/><g class="st1"><path class="st0" d="M73.6,46.7c-1,0-2.1-0.5-2.8-1.3c-1.2-1.5-0.9-3.7,0.6-4.9C77,36.1,79.8,29,78.6,22 c-0.9-6.9-5.7-12.7-12.2-14.8c-1.8-0.6-2.8-2.6-2.2-4.4c0.6-1.8,2.6-2.8,4.4-2.2c9,3,15.7,11,17,20.5c1.5,9.4-2.2,19-9.8,25 C75.1,46.5,74.4,46.7,73.6,46.7z"/><path class="st0" d="M100.9,99c-1.9,0-3.5-1.6-3.5-3.5c0-17.9-11.7-33.7-27.7-37.7c-1.9-0.5-3-2.4-2.6-4.2c0.5-1.9,2.4-3,4.2-2.6 c19.5,4.8,33.1,23.1,33.1,44.5C104.4,97.4,102.8,99,100.9,99z"/></g></g></g></svg>
                                        </i>
                                        Categories List
                                    </a>
                                </li>
                           
                            </ul>
                    </li>
                   

                            <li class="nav-item dropdown language-switch"
                        rel1="CustomerController"
                    >
                        <a role="button" class="nav-link lvl-1 dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                             <i class="navbar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 106.1 92.1"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><path d="M40.8,92.1h-.1a5.2,5.2,0,0,1-5.1-4.8c-1.4-4.5-2.7-9-4-13.4S29,65.3,27.8,61L3.2,50.4a.1.1,0,0,0-.1-.1A5.7,5.7,0,0,1,.5,47.8a5.6,5.6,0,0,1,2.6-7.4.1.1,0,0,0,.1-.1c16-6.8,31.7-13.2,46.9-19.3S82.2,8,98.9.8a4.5,4.5,0,0,1,5.7.4,4.6,4.6,0,0,1,1.5,4.1l-5.4,38.1C99,56.1,97.2,68.8,95.4,81.6a5.5,5.5,0,0,1-2,3.7,5.6,5.6,0,0,1-4.1,1.4l-1.4-.3h-.2L52.1,71.2c-2.2,6-4.2,11.3-6,16.4A5.4,5.4,0,0,1,40.8,92.1ZM9.3,45.4,31.6,55a4.8,4.8,0,0,1,2.6,3c1.3,4.6,2.7,9.2,4.1,13.9L41,81q2.7-7.2,5.7-15.6l.2-.3.2-.4c.1-.2.2-.5.4-.6L89.2,12.6C76.8,17.8,64.6,22.7,52.7,27.5,38.6,33.2,24.1,39.1,9.3,45.4ZM55.6,65.2,88.7,79.1l5.1-36.6L98,12.8ZM27.5,59.9h0Z" style="fill:#f2f2f2"/><path d="M40.1,54.6a3.6,3.6,0,0,1-2.2-6.3l2-1.6a3.6,3.6,0,0,1,5,.6,3.5,3.5,0,0,1-.6,4.9l-2,1.6A3.5,3.5,0,0,1,40.1,54.6Z" style="fill:#ff0"/><path d="M52.4,45.2a3.5,3.5,0,0,1-2.7-1.4,3.4,3.4,0,0,1,.6-4.9L63.4,28.6a3.5,3.5,0,0,1,4.3,5.5L54.6,44.4A3.7,3.7,0,0,1,52.4,45.2Z" style="fill:aqua"/></g></g></g></g></svg>
                                </i>
                            <span>Form Builder</span>
                            <span class="caret"></span>
                        </a>
                     <ul class="dropdown-menu">
                            
                            <li class="nav-item" rel0="CustomerController9">
                                    <a href="{{ url('questions') }}" class="dropdown-item d-flex align-items-center">
                                        <i class="navbar-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 104.4 103" style="enable-background:new 0 0 104.4 103;" xml:space="preserve"><style type="text/css">.st0{fill:#333333;}.st1{opacity:0.65;}</style><g id="Layer_2_1_"><g id="Layer_1-2"><path class="st0" d="M46,51.6c-14.2,0-25.8-11.6-25.8-25.8C20.2,11.6,31.8,0,46,0c14.2,0,25.8,11.6,25.8,25.8 C71.8,40,60.2,51.6,46,51.6z M46,7c-10.4,0-18.8,8.4-18.8,18.8c0,10.4,8.4,18.8,18.8,18.8s18.8-8.4,18.8-18.8 C64.8,15.4,56.4,7,46,7z"/><path class="st0" d="M88.5,103c-1.9,0-3.5-1.6-3.5-3.5c0-21.5-17.5-39-39-39S7,78,7,99.5c0,1.9-1.6,3.5-3.5,3.5S0,101.4,0,99.5 c0-25.4,20.6-46,46-46s46,20.6,46,46C92,101.4,90.4,103,88.5,103z"/><path class="st0" d="M19.5,103h-16c-1.9,0-3.5-1.6-3.5-3.5S1.6,96,3.5,96h16c1.9,0,3.5,1.6,3.5,3.5S21.4,103,19.5,103z"/><path class="st0" d="M88.5,103H36.9c-1.9,0-3.5-1.6-3.5-3.5S35,96,36.9,96h51.6c1.9,0,3.5,1.6,3.5,3.5S90.4,103,88.5,103z"/><path class="st0" d="M46,39c-3.3,0-6.4-1.6-7.7-4c-0.9-1.7-0.3-3.8,1.4-4.7c1.7-0.9,3.8-0.3,4.7,1.3c0.2,0.1,0.7,0.4,1.6,0.4 c0.7,0,1.3-0.3,1.6-0.5c0.8-1.7,2.8-2.4,4.5-1.7c1.8,0.8,2.6,2.8,1.8,4.6C52.6,37.6,48.9,39,46,39z M44.5,31.6 C44.5,31.6,44.5,31.6,44.5,31.6C44.5,31.6,44.5,31.6,44.5,31.6z M44.4,31.5L44.4,31.5L44.4,31.5z"/><g class="st1"><path class="st0" d="M73.6,46.7c-1,0-2.1-0.5-2.8-1.3c-1.2-1.5-0.9-3.7,0.6-4.9C77,36.1,79.8,29,78.6,22 c-0.9-6.9-5.7-12.7-12.2-14.8c-1.8-0.6-2.8-2.6-2.2-4.4c0.6-1.8,2.6-2.8,4.4-2.2c9,3,15.7,11,17,20.5c1.5,9.4-2.2,19-9.8,25 C75.1,46.5,74.4,46.7,73.6,46.7z"/><path class="st0" d="M100.9,99c-1.9,0-3.5-1.6-3.5-3.5c0-17.9-11.7-33.7-27.7-37.7c-1.9-0.5-3-2.4-2.6-4.2c0.5-1.9,2.4-3,4.2-2.6 c19.5,4.8,33.1,23.1,33.1,44.5C104.4,97.4,102.8,99,100.9,99z"/></g></g></g></svg>
                                        </i>
                                        Questions List
                                    </a>
                                </li>
                                    <li class="nav-item" rel0="CustomerController9">
                                    <a href="{{ url('form-design') }}" class="dropdown-item d-flex align-items-center">
                                        <i class="navbar-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 104.4 103" style="enable-background:new 0 0 104.4 103;" xml:space="preserve"><style type="text/css">.st0{fill:#333333;}.st1{opacity:0.65;}</style><g id="Layer_2_1_"><g id="Layer_1-2"><path class="st0" d="M46,51.6c-14.2,0-25.8-11.6-25.8-25.8C20.2,11.6,31.8,0,46,0c14.2,0,25.8,11.6,25.8,25.8 C71.8,40,60.2,51.6,46,51.6z M46,7c-10.4,0-18.8,8.4-18.8,18.8c0,10.4,8.4,18.8,18.8,18.8s18.8-8.4,18.8-18.8 C64.8,15.4,56.4,7,46,7z"/><path class="st0" d="M88.5,103c-1.9,0-3.5-1.6-3.5-3.5c0-21.5-17.5-39-39-39S7,78,7,99.5c0,1.9-1.6,3.5-3.5,3.5S0,101.4,0,99.5 c0-25.4,20.6-46,46-46s46,20.6,46,46C92,101.4,90.4,103,88.5,103z"/><path class="st0" d="M19.5,103h-16c-1.9,0-3.5-1.6-3.5-3.5S1.6,96,3.5,96h16c1.9,0,3.5,1.6,3.5,3.5S21.4,103,19.5,103z"/><path class="st0" d="M88.5,103H36.9c-1.9,0-3.5-1.6-3.5-3.5S35,96,36.9,96h51.6c1.9,0,3.5,1.6,3.5,3.5S90.4,103,88.5,103z"/><path class="st0" d="M46,39c-3.3,0-6.4-1.6-7.7-4c-0.9-1.7-0.3-3.8,1.4-4.7c1.7-0.9,3.8-0.3,4.7,1.3c0.2,0.1,0.7,0.4,1.6,0.4 c0.7,0,1.3-0.3,1.6-0.5c0.8-1.7,2.8-2.4,4.5-1.7c1.8,0.8,2.6,2.8,1.8,4.6C52.6,37.6,48.9,39,46,39z M44.5,31.6 C44.5,31.6,44.5,31.6,44.5,31.6C44.5,31.6,44.5,31.6,44.5,31.6z M44.4,31.5L44.4,31.5L44.4,31.5z"/><g class="st1"><path class="st0" d="M73.6,46.7c-1,0-2.1-0.5-2.8-1.3c-1.2-1.5-0.9-3.7,0.6-4.9C77,36.1,79.8,29,78.6,22 c-0.9-6.9-5.7-12.7-12.2-14.8c-1.8-0.6-2.8-2.6-2.2-4.4c0.6-1.8,2.6-2.8,4.4-2.2c9,3,15.7,11,17,20.5c1.5,9.4-2.2,19-9.8,25 C75.1,46.5,74.4,46.7,73.6,46.7z"/><path class="st0" d="M100.9,99c-1.9,0-3.5-1.6-3.5-3.5c0-17.9-11.7-33.7-27.7-37.7c-1.9-0.5-3-2.4-2.6-4.2c0.5-1.9,2.4-3,4.2-2.6 c19.5,4.8,33.1,23.1,33.1,44.5C104.4,97.4,102.8,99,100.9,99z"/></g></g></g></svg>
                                        </i>
                                        Design Settings
                                    </a>
                                </li>
                     </ul>
                    </li>
            
                 <li class="nav-item" rel2="HomeController">
                    <a href="{{ url('payments-receive') }}" title="Receive Payments" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                        <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                        </i>
                        <span>Received Payments</span>
                    </a>
                </li>
                  <li class="nav-item" rel2="HomeController">
                    <a href="{{ url('credit-amount') }}" title="Receive Payments" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                        <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                        </i>
                        <span>Credits Management</span>
                    </a>
                </li>
             
       
               <li class="nav-item" rel2="HomeController">
                    <a href="{{ url('account/profile') }}" title="Support" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                        <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                        </i>
                        <span>Account</span>
                    </a>
                </li>
            
                <li class="nav-item" rel2="HomeController">
                    <a href="{{ url('support') }}" title="Support" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                        <i class="navbar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                        </i>
                        <span>Support</span>
                    </a>
                </li>
            </ul>
            <div class="navbar-right">
                <ul class="navbar-nav me-auto mb-md-0">
                    @include('layouts.core._top_activity_log')
                    
                    @include('layouts.core._menu_frontend_user')
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    var MenuFrontend = {
        saveLeftbarState: function(state) {
            var url = '{{ url('account/leftbar/state') }}';

            $.ajax({
                method: "GET",
                url: url,
                data: {
                    _token: CSRF_TOKEN,
                    state: state,
                }
            });
        }
    };

    $(function() {
        //
        $('.leftbar .leftbar-hide-menu').on('click', function(e) {
            if (!$('.leftbar').hasClass('leftbar-closed')) {
                $('.leftbar').addClass('leftbar-closed');

                MenuFrontend.saveLeftbarState('closed');
            } else {
                $('.leftbar').removeClass('leftbar-closed');

                MenuFrontend.saveLeftbarState('open');
            }
        });
    });        
</script>

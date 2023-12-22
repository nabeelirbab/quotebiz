  <link rel="stylesheet" href="{{ asset('frontend-assets/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/theme.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/account.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('frontend-assets/assets/css/style.css') }}">
    <style type="text/css">
    	.nav-tabs .nav-link:after {
		    background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		    opacity: 0;
		}
		.link-list-menu li.active > a, .link-list-menu a.active, .link-list-menu a:hover, .link-list-menu li.active > a .icon, .link-list-menu a.active .icon, .link-list-menu a:hover .icon, .link-list-menu li.active > a:after, .link-list-menu a.active:after, .link-list-menu a:hover:after {
		     color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		}
    	.chat.is-me .chat-msg {
		    background-color:  {{ ($job_design) ? $job_design->button_color.'!important':'#0fac81 !important'}};
		    color: #fff;
		}
		.bg-primary {
			 background-color: {{ ($job_design) ? $job_design->button_color.'!important':'#0fac81 !important'}};
		}
		.chat-upload-option a {
		    color: {{ ($job_design) ? $job_design->button_color.'!important':'#0fac81 !important'}};
		}
		.text-primary {
		    color: {{ ($job_design) ? $job_design->button_color.'!important':'#0fac81 !important'}};
		}
		.nav-tabs .nav-item.active .nav-link {
			color: {{ ($job_design) ? $job_design->button_color.'!important':'#0fac81 !important'}};
		}
		.nav-tabs .nav-link.active {
		    color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		    border: none;
		    background-color: transparent;
		}
    	a:hover {
		    color:  {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		}
		.btn-primary {
		  border: none !important;
		  background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		}
		.btn-success {
		  border: none !important;
		  background: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		}
		.link-list-menu a.active{
           color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		}
		.link-list-menu li.active > a, .link-list-menu a.active, .link-list-menu a:hover, .link-list-menu li.active > a .icon, .link-list-menu a.active .icon, .link-list-menu a:hover .icon, .link-list-menu li.active > a:after, .link-list-menu a.active:after, .link-list-menu a:hover:after {
		     color: {{ ($job_design) ? $job_design->button_color.'!important':'#6200EA !important'}};
		}

    </style>
   
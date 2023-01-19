<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


function get_domain($url) {
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{0,63}\.[a-z\.]{1,5})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}

if(get_domain(request()->getHost()) == config('app.url')){
    $account_prefix = '{account}.'.config('app.url');
}else{
    Route::pattern('account', '('.request()->getHost().')');
    $account_prefix = '{account}';

}

Route::domain($account_prefix)->group(function ($account) {

    Route::group(['middleware' => ['not_installed', 'not_logged_in','validdomain']], function ($account) {
    // Helper method to generate other routes for authentication
    Route::get('/', 'QuoteController@home');
    Auth::routes();

    Route::get('/login/token/{token}', 'Controller@tokenLogin');
    Route::match(['get', 'post'],'quote-form', 'QuestionChoiceController@index');
    Route::post('category-search', 'QuoteController@category_search');
    Route::post('storeform', 'QuestionChoiceController@storeform');
    Route::post('checkEmail', 'QuestionChoiceController@checkEmail');
    Route::get('/validate-token/{api_token}', 'Controller@validateToken');
    Route::get('user/activate/{token}', 'UserController@activate');
    Route::get('/disabled', 'Controller@userDisabled');
    Route::get('/offline', 'Controller@offline');
    Route::get('/not-authorized', 'Controller@notAuthorized');
    Route::get('/demo', 'Controller@demo');
    Route::get('/demo/go/{view}', 'Controller@demoGo');
    Route::get('/autologin/{api_token}', 'Controller@autoLogin');
    Route::get('/migrate/run', 'Admin\Upgrade@migrate');

    //Subscriber avatar
    Route::get('assets/images/avatar/subscriber-{uid?}.jpg', 'SubscriberController@avatar');

    // User resend activation email
    Route::get('users/resend-activation-email/{uid}', 'UserController@resendActivationEmail');

    // Plan
    Route::get('plans/select2', 'PlanController@select2');

    // Customer registration
    
    Route::get('users/login', 'UserController@login');
    Route::post('users/login', 'UserController@login');
    Route::get('users/login', 'UserController@login');
    Route::post('users/register', 'UserController@register');
    Route::get('users/register', 'UserController@register');
    Route::get('users/subcategory/{id}', 'UserController@subcategory');
    Route::get('users/subcategory_select/{id}', 'UserController@subcategory_select');
});

// Without authentication
Route::group(['middleware' => ['not_installed']], function () {
    Route::match(['get', 'post'], 'blank', function () {
        return;
    });

    Route::get('p/{message_id}/open', 'CampaignController@open')->name('openTrackingUrl');
    Route::get('p/{url}/click/{message_id?}', 'CampaignController@click')->name('clickTrackingUrl');
    Route::get('c/{subscriber}/unsubscribe/{message_id?}', 'CampaignController@unsubscribe')->name('unsubscribeUrl');
    Route::get('campaigns/{message_id}/web-view', 'CampaignController@webView')->name('webViewerUrl');
    Route::get('campaigns/{campaign_uid}/webview/{subscriber_uid}/preview', 'CampaignController@webViewPreview')->name('webViewerPreviewUrl');
    Route::post('lists/{uid}/embedded-form-subscribe', 'MailListController@embeddedFormSubscribe');
    Route::post('lists/{uid}/embedded-form-subscribe-captcha', 'MailListController@embeddedFormSubscribe');
    Route::get('lists/{uid}/check-email', 'MailListController@checkEmail');
    Route::get('lists/{list_uid}/sign-up', 'PageController@signUpForm');
    Route::post('lists/{list_uid}/sign-up', 'PageController@signUpForm');
    Route::get('lists/{list_uid}/sign-up/{subscriber_uid}/thank-you', 'PageController@signUpThankyouPage');
    Route::get('lists/{list_uid}/subscribe-confirm/{uid}/{code}', 'PageController@signUpConfirmationThankyou');
    Route::get('lists/{list_uid}/unsubscribe/{uid}/{code}', 'PageController@unsubscribeForm')->name('unsubscribeForm');
    Route::post('lists/{list_uid}/unsubscribe/{uid}/{code}', 'PageController@unsubscribeForm');
    Route::get('lists/{list_uid}/unsubscribe-success/{uid}', 'PageController@unsubscribeSuccessPage');
    Route::get('lists/{list_uid}/update-profile/{uid}/{code}', 'PageController@profileUpdateForm')->name('updateProfileUrl');
    Route::post('lists/{list_uid}/update-profile/{uid}/{code}', 'PageController@profileUpdateForm');
    Route::get('lists/{list_uid}/update-profile-success/{uid}', 'PageController@profileUpdateSuccessPage');
    Route::get('lists/{list_uid}/profile-update-email-sent/{uid}', 'PageController@profileUpdateEmailSent');

    // Notification handler
    Route::post('delivery/notify/{stype?}', 'DeliveryController@notify');
    Route::get('delivery/notify/{stype?}', 'DeliveryController@notify');
    Route::post('delivery/report', 'DeliveryController@report');

    // Also allow GET logout (the logout route generated by Route::auth() is POST)
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');   // use GET for logout, keep compatible with 5.2

    // Verify a sender
    Route::get('senders/verify/{token}', 'SenderController@verify');
    Route::get('senders/verify/{uid}/result', 'SenderController@verifyResult');
    // Get Application Key
    Route::get('appkey', 'Controller@appkey')->name('appkey');
    // Campaign test links
    Route::get('campaigns/test/{message}', 'CampaignController@notification')->name('campaign_message');

    // products
    Route::get('/products/widget/products/list', 'ProductController@widgetProductList');
    Route::post('/products/widget/product', 'ProductController@widgetProduct');
});
Route::patch('/fcm-token', 'HomeController@updateToken')->name('fcmToken');
Route::group(['middleware' => ['not_installed', 'auth']], function () {
    // get files from download
    Route::get('/download/{name?}', [ function ($name) {
        $path = storage_path('app/download/' . $name);
        if (\File::exists($path)) {
            return response()->download($path);
        } else {
            abort(404);
        }
    }])->where('name', '.+')->name('download');

    Route::post('/chatstart', 'ChatController@chatStart');
    Route::post('/chatFilesShare', 'ChatController@chatFilesShare');
    Route::get('/deleteMsg/{id}', 'ChatController@deleteMsg');
    Route::post('/updateMsg', 'ChatController@updateMsg');
    Route::post('/readmsg', 'ChatController@readMsg');
    Route::post('/notificationstatus', 'ChatController@notificationStatus');
    Route::post('/emptyrefid', 'ChatController@emptyRefId');
    Route::get('/allunreadmsg/{id}', 'ChatController@allunreadMsg');


});
Route::group(['middleware' => ['not_installed', 'auth', 'customer','validdomain']], function () {
Route::name('customer.')->prefix('customer')->group(function () {

    Route::get('/', function () {
        return view('customer.index');
    })->name('home');

    Route::get('/login', function () {
        return view('customer.login');
    });

    Route::get('/inbox', 'Customer\QuoteController@index');
    Route::get('/my-jobs', 'Customer\QuoteController@myquotes');
    Route::get('/getprovider', 'ChatController@getProviderfriend');
    Route::post('/change-status', 'Customer\QuoteController@changeStatus');
    Route::post('/profile-update', 'Customer\QuoteController@profileUpdate');
    Route::post('/userImg', 'UserController@userImage');
    Route::match(['get', 'post'],'sp-register', 'UserController@sp_register');
    Route::get('/profile', function () {
        return view('customer.profile');
    });
    Route::get('/support', function () {
        return view('customer.support');
    });
    Route::get('/supportchat', function () {
        return view('customer.supportchat');
    });
    Route::get('/createticket', function () {
        return view('customer.createticket');
    });
});

});

    Route::get('/getstates/{id}','ServiceProvider\QuoteController@getstates')->name("getstates");
    Route::get('/getcities/{id}','ServiceProvider\QuoteController@getcities')->name("getcities");

Route::group(['middleware' => ['not_installed', 'auth', 'service_provider','validdomain']], function () {

    Route::name('service-provider.')->prefix('service-provider')->group(function () {

    Route::get('/', function () {
        return view('service_provider.index');
    });
    Route::patch('/fcm-token', [HomeController::class, 'updateToken'])->name('fcmToken');

    Route::match(['get', 'post'],'payment', 'ServiceProvider\StripeController@stripePayment');
    Route::post('stripe', 'ServiceProvider\StripeController@stripePost')->name('stripe.post');

    Route::get('/login', function () {
        return view('service_provider.login');
    });
    Route::get('/buy-credits', function () {
        return view('service_provider.buyCreadits');
    });

    Route::get('/register', function () {
        return view('service_provider.register');
    });

    Route::get('/quotes-responses','ServiceProvider\QuoteController@index');
    Route::get('/quotes-leads','ServiceProvider\QuoteController@leads');
    Route::get('/leadsquotes','ServiceProvider\QuoteController@leadsquotes');
    Route::get('/newjob/{id}','ServiceProvider\QuoteController@newJob');
    Route::post('/profile-update', 'ServiceProvider\QuoteController@profileUpdate');
    Route::post('/business-update', 'ServiceProvider\QuoteController@businessUpdate');
    Route::post('/location-update', 'ServiceProvider\QuoteController@locationUpdate');
    Route::post('/address-update', 'ServiceProvider\QuoteController@addressupdate');
    Route::post('/userImg', 'UserController@userImage');
    Route::get('/getcustomer','ChatController@getCustomerfriend');
    Route::post('/storequotation','ChatController@storequotation');
    Route::get('/userCountries','ServiceProvider\QuoteController@userCountries');
    Route::get('/getstates/{id}','ServiceProvider\QuoteController@getstates')->name("getstates");
        Route::get('/getstatesforprovider/{id}','ServiceProvider\QuoteController@getstatesforprovider')->name("getstatesforprovider");
    Route::get('/getcities/{id}','ServiceProvider\QuoteController@getcities')->name("getcities");
    Route::get('/getprovidercities/{id}','ServiceProvider\QuoteController@getprovidercities')->name("getprovidercities");

    Route::get('/settings', function () {
        return view('service_provider.settings');
    });
    Route::get('/location-setting', function () {
        return view('service_provider.locationSettings');
    })->name('locationSetting');
    Route::get('/business-setting', function () {
        return view('service_provider.businessSettings');
    })->name('businessSetting');

    Route::get('/support', function () {
        return view('service_provider.support');
    });

    Route::get('/supportchat', function () {
        return view('service_provider.supportchat');
    });

    Route::get('/createticket', function () {
        return view('service_provider.createticket');
    });

    Route::get('/payment-history','ServiceProvider\StripeController@paymenthistory');

});

});


Route::get('users/logout', 'UserController@logout');

 Route::name('admin.')->prefix('admin')->group(function () {
	
  Route::group(['middleware' => ['not_installed', 'auth', 'admin','validdomain']], function () {

    Route::match(['get', 'post'],'/stripekey', 'StripeController@stripeKey');
    Route::match(['get', 'post'],'/dateformat', 'UserController@dateformet');
    Route::match(['get', 'post'],'/form-design', 'UserController@formdesign');
    Route::match(['get', 'post'],'/custom-domain', 'SettingController@customdomain');
    Route::get('/domain-status', 'SettingController@domainStatus');

    Route::post('sendInvitation', 'UserController@sendInvitation');
    Route::post('resendInvitation', 'UserController@resendInvitation');
    Route::get('/preview-design', 'UserController@formdesign');

        // Question
  Route::name('questions.')->prefix('questions/')->group(function () {
    Route::get('/', 'QuestionController@index')->name('nabeel');
    Route::get('add-question', 'QuestionController@create');
    Route::post('store', 'QuestionController@store');
    Route::post('searchcategory', 'QuestionController@searchcategory');
    Route::get('delete/{id}', 'QuestionController@destroy');
    Route::get('editquestion/{id}', 'QuestionController@editquestion');
    Route::get('subeditquestion/{id}', 'QuestionController@subeditquestion');
    Route::get('deletequestion/{id}', 'QuestionController@deletequestion');
    Route::get('deleteoption/{id}', 'QuestionController@deleteoption');
    Route::get('deleteChoice/{id}', 'QuestionController@deletechoice');
    Route::get('/categories', 'QuestionController@vuedata');
    Route::get('/categories/{id}', 'QuestionController@categoriesbyid');
    Route::get('/subcategories/{id}', 'QuestionController@subcategoriesbyid');
    Route::post('updateOrder', 'QuestionController@updateOrder');

 });


    // New subscription
    Route::get('account/subscription/select-plan', 'SubscriptionController@selectPlan');
    Route::get('account/subscription/order-box', 'SubscriptionController@orderBox');
    Route::match(['get', 'post'], 'account/subscription/change-plan', 'SubscriptionController@changePlan');
    Route::post('account/subscription/resume', 'SubscriptionController@resume');
    Route::post('account/subscription/cancel', 'SubscriptionController@cancel');
    Route::post('account/subscription/invoice/{invoice_uid}/confirm-free', 'SubscriptionController@confirmFree');
    Route::match(['get', 'post'], 'account/subscription/billing-information', 'SubscriptionController@billingInformation');
    Route::post('account/subscription/checkout', 'SubscriptionController@checkout');
    Route::post('account/subscription/cancel-now', 'SubscriptionController@cancelNow');
    Route::post('account/subscription/invoice/{invoice_uid}/cancel', 'SubscriptionController@cancelInvoice');
    Route::post('account/subscription/invoice/{invoice_uid}/confirm', 'SubscriptionController@confirmFree');
    Route::get('account/subscription/payment/{invoice_uid}', 'SubscriptionController@payment');
    Route::post('account/subscription/init', 'SubscriptionController@init');
    Route::get('account/subscription', 'SubscriptionController@index');

    // Customer login back

    Route::get('customers/login-back', 'CustomerController@loginBack');
    Route::get('customers/admin-area', 'CustomerController@adminArea');

    // Customer profile/information
    Route::get('account/save-auto-theme-mode', 'AccountController@saveAutoThemeMode');
    Route::get('account/activity', 'AccountController@activity');
    Route::match(['get', 'post'], 'account/wizard/menu-layout', 'AccountController@wizardMenuLayout');
    Route::match(['get', 'post'], 'account/wizard/color-scheme', 'AccountController@wizardColorScheme');
    Route::get('account/leftbar/state', 'AccountController@leftbarState');
    Route::post('account/payment/remove', 'AccountController@removePaymentMethod');
    Route::match(['get', 'post'], 'account/payment/edit', 'AccountController@editPaymentMethod');
    Route::get('account/profile', 'AccountController@profile');
    Route::post('account/profile', 'AccountController@profile');
    Route::get('account/contact', 'AccountController@contact');
    Route::post('account/contact', 'AccountController@contact');
    Route::get('account/logs', 'AccountController@logs');
    Route::get('account/logs/listing', 'AccountController@logsListing');
    Route::get('account/quota_log_2', 'AccountController@quotaLog2');
    Route::get('account/quota_log', 'AccountController@quotaLog');
    Route::get('account/billing', 'AccountController@billing');
    Route::match(['get', 'post'], 'account/billing/edit', 'AccountController@editBillingAddress');
});

Route::group(['middleware' => ['not_installed', 'auth', 'admin', 'subscription']], function () {
    Route::get('/', 'HomeController@index');

    // Search
    Route::get('/search/subscribers', 'SearchController@subscribers');
    Route::get('/search/templates', 'SearchController@templates');
    Route::get('/search/automations', 'SearchController@automations');
    Route::get('/search/lists', 'SearchController@lists');
    Route::get('/search/campaigns', 'SearchController@campaigns');
    Route::get('/search/general', 'SearchController@general');

    Route::get('/quotes', 'QuoteController@index');
    Route::get('/support', 'HomeController@support');
    Route::get('/supportchat', 'HomeController@supportchat');
    Route::get('/customers', 'HomeController@customers');
    Route::post('/import-customers', 'UserController@uploadUsers');
    Route::post('/import-sp', 'UserController@uploadSP');

    Route::get('/removesetting', 'HomeController@removesetting');
    Route::get('/payments-receive', 'UserController@paymentsReceive');
    Route::match(['get', 'post'],'/credit-amount', 'UserController@credits');
    Route::post('/quoteprice', 'UserController@quoteprice');
    Route::get('/deletecredit/{id}', 'UserController@deletecredit');
    // Category
    Route::name('service-categories.')->prefix('service-categories/')->group(function () {

    Route::get('/', 'CategoryController@index');
    Route::post('store', 'CategoryController@store');
    Route::post('storesub', 'CategoryController@storesub');
    Route::get('edit/{id}', 'CategoryController@edit');
    Route::post('update', 'CategoryController@update');
    Route::get('delete/{id}', 'CategoryController@destroy');
});
    Route::get('/servicecategories', 'CategoryController@index');
    Route::get('/serviceproviders', 'HomeController@serviceproviders');
    Route::post('/add-credits', 'UserController@spcredits');
    Route::get('/invitedserviceproviders', 'HomeController@invitedserviceproviders');
    Route::get('/location_setting/{id}', 'HomeController@location_setting');
    Route::post('/Save_location_setting', 'HomeController@Save_location_setting');
    Route::get('/profile_detail/{id}', 'HomeController@provider_detail');
    Route::get('/customer_detail/{id}', 'HomeController@customer_detail');
    Route::get('/account_status/{id}', 'HomeController@accountstatus');
    Route::get('frontend/docs/api/v1', 'Controller@docsApiV1');

    Route::get('account/api/renew', 'AccountController@renewToken');
    Route::match(['get','post'],'account/api', 'AccountController@api');
    Route::match(['get','post'],'account/currency', 'AccountController@currency');
    Route::match(['get','post'],'account/location-setting', 'AccountController@locationsetting');
    Route::match(['get', 'post'],'account/site-setting', 'HomeController@sitesetting');

    // Mail list
    Route::get('lists/{uid}/email-verification/chart', 'MailListController@emailVerificationChart');
    Route::get('lists/{uid}/clone-to-customers/choose', 'MailListController@cloneForCustomersChoose');
    Route::post('lists/{uid}/clone-to-customers', 'MailListController@cloneForCustomers');

    Route::get('lists/{uid}/verification/{job_uid}/progress', 'MailListController@verificationProgress');
    Route::get('lists/{uid}/verification', 'MailListController@verification');
    Route::post('lists/{uid}/verification/start', 'MailListController@startVerification');
    Route::post('lists/{uid}/verification/{job_uid}/stop', 'MailListController@stopVerification');
    Route::post('lists/{uid}/verification/reset', 'MailListController@resetVerification');
    Route::match(['get', 'post'], 'lists/copy', 'MailListController@copy');
    Route::get('lists/quick-view', 'MailListController@quickView');
    Route::get('lists/{uid}/list-growth', 'MailListController@listGrowthChart');
    Route::get('lists/{uid}/list-statistics-chart', 'MailListController@statisticsChart');
    Route::get('lists/sort', 'MailListController@sort');
    Route::get('lists/listing/{page?}', 'MailListController@listing');
    Route::post('lists/delete', 'MailListController@delete');
    Route::get('lists/delete/confirm', 'MailListController@deleteConfirm');
    Route::get('lists/{uid}/overview', 'MailListController@overview')->name('mail_list');
    Route::resource('lists', 'MailListController');
    Route::get('lists/{uid}/edit', 'MailListController@edit');
    Route::patch('lists/{uid}/update', 'MailListController@update');
    Route::match(['get', 'post'], 'lists/{uid}/embedded-form', 'MailListController@embeddedForm');
    Route::get('lists/{uid}/embedded-form-frame', 'MailListController@embeddedFormFrame');

 Route::get('builder/form', 'CustomerController@builder');
    // Field
    Route::get('lists/{list_uid}/fields', 'FieldController@index');
    Route::get('lists/{list_uid}/fields/sort', 'FieldController@sort');
    Route::post('lists/{list_uid}/fields/store', 'FieldController@store');
    Route::get('lists/{list_uid}/fields/sample/{type}', 'FieldController@sample');
    Route::get('lists/{list_uid}/fields/{uid}/delete', 'FieldController@delete');

    // Subscriber
    Route::match(['get', 'post'], 'lists/{list_uid}/subscribers/assign-values', 'SubscriberController@assignValues');
    Route::match(['get', 'post'], 'lists/{list_uid}/subscribers/bulk-delete', 'SubscriberController@bulkDelete');

    Route::post('lists/{list_uid}/subscriber/{uid}/remove-tag', 'SubscriberController@removeTag');
    Route::match(['get', 'post'], 'lists/{list_uid}/subscriber/{uid}/update-tags', 'SubscriberController@updateTags');

    Route::post('lists/{list_uid}/subscribers/resend/confirmation-email/{uids?}', 'SubscriberController@resendConfirmationEmail');
    Route::post('subscriber/{uid}/verification/start', 'SubscriberController@startVerification');
    Route::post('subscriber/{uid}/verification/reset', 'SubscriberController@resetVerification');
    Route::get('lists/{from_uid}/copy-move-from/{action}', 'SubscriberController@copyMoveForm');
    Route::post('subscribers/move', 'SubscriberController@move');
    Route::post('subscribers/copy', 'SubscriberController@copy');
    Route::get('lists/{list_uid}/subscribers', 'SubscriberController@index');
    Route::get('lists/{list_uid}/subscribers/create', 'SubscriberController@create');
    Route::get('lists/{list_uid}/subscribers/listing', 'SubscriberController@listing');
    Route::post('lists/{list_uid}/subscribers/store', 'SubscriberController@store');
    Route::get('lists/{list_uid}/subscribers/{uid}/edit', 'SubscriberController@edit');
    Route::patch('lists/{list_uid}/subscribers/{uid}/update', 'SubscriberController@update');
    Route::post('lists/{list_uid}/subscribers/delete', 'SubscriberController@delete');
    Route::get('lists/{list_uid}/subscribers/delete', 'SubscriberController@delete');
    Route::post('lists/{list_uid}/subscribers/subscribe', 'SubscriberController@subscribe');
    Route::post('lists/{list_uid}/subscribers/unsubscribe', 'SubscriberController@unsubscribe');

    Route::get('lists/{list_uid}/subscribers/import', 'SubscriberController@import');
    Route::post('lists/{list_uid}/subscribers/import/dispatch', 'SubscriberController@dispatchImportJob');
    Route::get('lists/{list_uid}/import/{job_uid}/progress', 'SubscriberController@importProgress');
    Route::get('lists/import/{job_uid}/log/download', 'SubscriberController@downloadImportLog');
    Route::post('lists/import/{job_uid}/cancel', 'SubscriberController@cancelImport');

    Route::get('lists/{list_uid}/subscribers/export', 'SubscriberController@export');
    Route::post('lists/{list_uid}/subscribers/export/dispatch', 'SubscriberController@dispatchExportJob');
    Route::get('lists/export/{job_uid}/progress', 'SubscriberController@exportProgress');
    Route::get('lists/export/{job_uid}/log/download', 'SubscriberController@downloadExportedFile');
    Route::post('lists/export/{job_uid}/cancel', 'SubscriberController@cancelExport');

    // Segment
    Route::get('segments/condition-value-control', 'SegmentController@conditionValueControl');
    Route::get('segments/select_box', 'SegmentController@selectBox');
    Route::get('lists/{list_uid}/segments', 'SegmentController@index');
    Route::get('lists/{list_uid}/segments/{uid}/subscribers', 'SegmentController@subscribers');
    Route::get('lists/{list_uid}/segments/{uid}/listing_subscribers', 'SegmentController@listing_subscribers');
    Route::get('lists/{list_uid}/segments/create', 'SegmentController@create');
    Route::get('lists/{list_uid}/segments/listing', 'SegmentController@listing');
    Route::post('lists/{list_uid}/segments/store', 'SegmentController@store');
    Route::get('lists/{list_uid}/segments/{uid}/edit', 'SegmentController@edit');
    Route::patch('lists/{list_uid}/segments/{uid}/update', 'SegmentController@update');
    Route::get('lists/{list_uid}/segments/delete', 'SegmentController@delete');
    Route::get('lists/{list_uid}/segments/sample_condition', 'SegmentController@sample_condition');

    // Page
    Route::post('lists/{list_uid}/pages/{alias}/restore-default', 'PageController@restoreDefault');
    Route::get('lists/{list_uid}/pages/{alias}/update', 'PageController@update');
    Route::post('lists/{list_uid}/pages/{alias}/update', 'PageController@update');
    Route::post('lists/{list_uid}/pages/{alias}/preview', 'PageController@preview');

    // Template
    Route::post('templates/{uid}/export', 'TemplateController@export');
    Route::match(['get','post'], 'templates/{uid}/change-name', 'TemplateController@changeName');
    Route::match(['get','post'], 'templates/{uid}/categories', 'TemplateController@categories');

    Route::match(['get','post'], 'templates/{uid}/update-thumb-url', 'TemplateController@updateThumbUrl');
    Route::match(['get','post'], 'templates/{uid}/update-thumb', 'TemplateController@updateThumb');

    Route::get('templates/{uid}/builder/change-template/{change_uid}', 'TemplateController@builderChangeTemplate');
    Route::get('templates/builder/templates/{category_uid?}', 'TemplateController@builderTemplates');
    Route::post('templates/builder/create', 'TemplateController@builderCreate');
    Route::get('templates/builder/create', 'TemplateController@builderCreate');
    Route::post('templates/{uid}/builder/edit/asset', 'TemplateController@uploadTemplateAssets');
    Route::get('templates/{uid}/builder/edit/content', 'TemplateController@builderEditContent');
    Route::post('templates/{uid}/builder/edit', 'TemplateController@builderEdit');
    Route::get('templates/{uid}/builder/edit', 'TemplateController@builderEdit');

    Route::post('templates/{uid}/copy', 'TemplateController@copy');
    Route::get('templates/{uid}/copy', 'TemplateController@copy');
    Route::get('templates/listing/{page?}', 'TemplateController@listing');
    Route::get('templates/choosing/{campaign_uid}/{page?}', 'TemplateController@choosing');
    Route::get('templates/upload', 'TemplateController@uploadTemplate');
    Route::post('templates/upload', 'TemplateController@uploadTemplate');
    Route::get('templates/{uid}/preview', 'TemplateController@preview');
    Route::get('templates/delete', 'TemplateController@delete');
    Route::resource('templates', 'TemplateController');
    Route::get('templates/{uid}/edit', 'TemplateController@edit');
    Route::patch('templates/{uid}/update', 'TemplateController@update');

    // Campaign
    Route::get('campaigns/{uid}/preview-as/list', 'CampaignController@previewAsList');
    Route::get('campaigns/{uid}/preview-as', 'CampaignController@previewAs');

    Route::post('campaigns/{uid}/custom-plain/off', 'CampaignController@customPlainOff');
    Route::post('campaigns/{uid}/custom-plain/on', 'CampaignController@customPlainOn');
    Route::post('campaigns/{uid}/remove-attachment', 'CampaignController@removeAttachment');
    Route::get('campaigns/{uid}/download-attachment', 'CampaignController@downloadAttachment');
    Route::post('campaigns/{uid}/upload-attachment', 'CampaignController@uploadAttachment');
    Route::get('campaigns/{uid}/template/builder-select', 'CampaignController@templateBuilderSelect');

    Route::match(['get', 'post'], 'campaigns/{uid}/template/builder-plain', 'CampaignController@builderPlainEdit');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/builder-classic', 'CampaignController@builderClassic');
    Route::match(['get', 'post'], 'campaigns/{uid}/plain', 'CampaignController@plain');
    Route::get('campaigns/{uid}/template/change/{template_uid}', 'CampaignController@templateChangeTemplate');

    Route::get('campaigns/{uid}/template/content', 'CampaignController@templateContent');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/edit', 'CampaignController@templateEdit');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/upload', 'CampaignController@templateUpload');
    Route::get('campaigns/{uid}/template/layout/list', 'CampaignController@templateLayoutList');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/layout', 'CampaignController@templateLayout');
    Route::get('campaigns/{uid}/template/create', 'CampaignController@templateCreate');

    Route::get('campaigns/{uid}/spam-score', 'CampaignController@spamScore');
    Route::get('campaigns/{from_uid}/copy-move-from/{action}', 'CampaignController@copyMoveForm');
    Route::match(['get', 'post'], 'campaigns/{uid}/resend', 'CampaignController@resend');
    Route::get('campaigns/{uid}/tracking-log/download', 'CampaignController@trackingLogDownload');
    Route::get('campaigns/job/{uid}/progress', 'CampaignController@trackingLogExportProgress');
    Route::get('campaigns/job/{uid}/download', 'CampaignController@download');

    Route::get('campaigns/{uid}/template/review-iframe', 'CampaignController@templateReviewIframe');
    Route::get('campaigns/{uid}/template/review', 'CampaignController@templateReview');
    Route::get('campaigns/select-type', 'CampaignController@selectType');
    Route::get('campaigns/{uid}/list-segment-form', 'CampaignController@listSegmentForm');
    Route::get('campaigns/{uid}/preview/content/{subscriber_uid?}', 'CampaignController@previewContent');
    Route::get('campaigns/{uid}/preview', 'CampaignController@preview');
    Route::match(['get', 'post'], 'campaigns/send-test-email', 'CampaignController@sendTestEmail');
    Route::get('campaigns/delete/confirm', 'CampaignController@deleteConfirm');
    Route::match(['get', 'post'], 'campaigns/copy', 'CampaignController@copy');
    Route::get('campaigns/{uid}/subscribers', 'CampaignController@subscribers');
    Route::get('campaigns/{uid}/subscribers/listing', 'CampaignController@subscribersListing');
    Route::get('campaigns/{uid}/open-map', 'CampaignController@openMap');
    Route::get('campaigns/{uid}/tracking-log', 'CampaignController@trackingLog');
    Route::get('campaigns/{uid}/tracking-log/listing', 'CampaignController@trackingLogListing');
    Route::get('campaigns/{uid}/bounce-log', 'CampaignController@bounceLog');
    Route::get('campaigns/{uid}/bounce-log/listing', 'CampaignController@bounceLogListing');
    Route::get('campaigns/{uid}/feedback-log', 'CampaignController@feedbackLog');
    Route::get('campaigns/{uid}/feedback-log/listing', 'CampaignController@feedbackLogListing');
    Route::get('campaigns/{uid}/open-log', 'CampaignController@openLog');
    Route::get('campaigns/{uid}/open-log/listing', 'CampaignController@openLogListing');
    Route::get('campaigns/{uid}/click-log', 'CampaignController@clickLog');
    Route::get('campaigns/{uid}/click-log/listing', 'CampaignController@clickLogListing');
    Route::get('campaigns/{uid}/unsubscribe-log', 'CampaignController@unsubscribeLog');
    Route::get('campaigns/{uid}/unsubscribe-log/listing', 'CampaignController@unsubscribeLogListing');

    Route::get('campaigns/quick-view', 'CampaignController@quickView');
    Route::get('campaigns/{uid}/chart24h', 'CampaignController@chart24h');
    Route::get('campaigns/{uid}/chart', 'CampaignController@chart');
    Route::get('campaigns/{uid}/chart/countries/open', 'CampaignController@chartCountry');
    Route::get('campaigns/{uid}/chart/countries/click', 'CampaignController@chartClickCountry');
    Route::get('campaigns/{uid}/overview', 'CampaignController@overview');
    Route::get('campaigns/{uid}/links', 'CampaignController@links');
    Route::get('campaigns/listing/{page?}', 'CampaignController@listing');
    Route::get('campaigns/{uid}/recipients', 'CampaignController@recipients');
    Route::post('campaigns/{uid}/recipients', 'CampaignController@recipients');
    Route::get('campaigns/{uid}/setup', 'CampaignController@setup');
    Route::post('campaigns/{uid}/setup', 'CampaignController@setup');
    Route::get('campaigns/{uid}/template', 'CampaignController@template');
    Route::post('campaigns/{uid}/template', 'CampaignController@template');
    Route::get('campaigns/{uid}/template/select', 'CampaignController@templateSelect');
    Route::get('campaigns/{uid}/template/choose/{template_uid}', 'CampaignController@templateChoose');
    Route::get('campaigns/{uid}/template/preview', 'CampaignController@templatePreview');
    Route::get('campaigns/{uid}/template/iframe', 'CampaignController@templateIframe');
    Route::get('campaigns/{uid}/template/build/{style}', 'CampaignController@templateBuild');
    Route::get('campaigns/{uid}/template/rebuild', 'CampaignController@templateRebuild');
    Route::get('campaigns/{uid}/schedule', 'CampaignController@schedule');
    Route::post('campaigns/{uid}/schedule', 'CampaignController@schedule');
    Route::get('campaigns/{uid}/confirm', 'CampaignController@confirm');
    Route::post('campaigns/{uid}/confirm', 'CampaignController@confirm');
    Route::post('campaigns/delete', 'CampaignController@delete');
    Route::get('campaigns/select2', 'CampaignController@select2');
    Route::post('campaigns/pause', 'CampaignController@pause');
    Route::post('campaigns/restart', 'CampaignController@restart');
    Route::resource('campaigns', 'CampaignController');
    Route::get('campaigns/{uid}/edit', 'CampaignController@edit');
    Route::patch('campaigns/{uid}/update', 'CampaignController@update');
    Route::get('campaigns/{uid}/run', 'CampaignController@run');
    Route::get('campaigns/{uid}/update-stats', 'CampaignController@updateStats');

    Route::get('users/login-back', 'UserController@loginBack');

    // Sending servers
    Route::get('sending_servers/{uid}/senders/dropbox', 'SendingServerController@fromDropbox');
    Route::post('sending_servers/{uid}/remove-domain/{domain}', 'SendingServerController@removeDomain');
    Route::post('sending_servers/{uid}/add-domain', 'SendingServerController@addDomain');
    Route::get('sending_servers/{uid}/add-domain', 'SendingServerController@addDomain');
    Route::get('sending_servers/aws-region-host', 'SendingServerController@awsRegionHost');

    Route::post('sending_servers/{uid}/test-connection', 'SendingServerController@testConnection');

    Route::post('sending_servers/{uid}/config', 'SendingServerController@config');
    Route::post('sending_servers/sending-limit', 'SendingServerController@sendingLimit');
    Route::get('sending_servers/sending-limit', 'SendingServerController@sendingLimit');

    Route::post('sending_servers/{uid}/test', 'SendingServerController@test');
    Route::get('sending_servers/{uid}/test', 'SendingServerController@test');
    Route::get('sending_servers/select', 'SendingServerController@select');
    Route::get('sending_servers/listing/{page?}', 'SendingServerController@listing');
    Route::get('sending_servers/sort', 'SendingServerController@sort');
    Route::get('sending_servers/delete', 'SendingServerController@delete');
    Route::get('sending_servers/disable', 'SendingServerController@disable');
    Route::get('sending_servers/enable', 'SendingServerController@enable');
    Route::resource('sending_servers', 'SendingServerController');
    Route::get('sending_servers/create/{type}', 'SendingServerController@create');
    Route::post('sending_servers/create/{type}', 'SendingServerController@store');
    Route::get('sending_servers/{id}/edit/{type}', 'SendingServerController@edit');
    Route::patch('sending_servers/{id}/update/{type}', 'SendingServerController@update');

    // Sending domain
    Route::post('sending_domains/{id}/updateDkimSelector', 'SendingDomainController@updateDkimSelector');
    Route::get('sending_domains/{id}/records', 'SendingDomainController@records');
    Route::post('sending_domains/{id}/verify', 'SendingDomainController@verify');
    Route::get('sending_domains/listing/{page?}', 'SendingDomainController@listing');
    Route::get('sending_domains/sort', 'SendingDomainController@sort');
    Route::get('sending_domains/delete', 'SendingDomainController@delete');
    Route::resource('sending_domains', 'SendingDomainController');

    // Tracking domain
    Route::get('tracking_domains/listing/{page?}', 'TrackingDomainController@listing');
    Route::get('tracking_domains/delete', 'TrackingDomainController@delete');
    Route::get('tracking_domains/{uid}/verify', 'TrackingDomainController@verify');
    Route::resource('tracking_domains', 'TrackingDomainController');

    // Email verification servers
    Route::get('email_verification_servers/options', 'EmailVerificationServerController@options');
    Route::get('email_verification_servers/listing/{page?}', 'EmailVerificationServerController@listing');
    Route::get('email_verification_servers/sort', 'EmailVerificationServerController@sort');
    Route::get('email_verification_servers/delete', 'EmailVerificationServerController@delete');
    Route::get('email_verification_servers/disable', 'EmailVerificationServerController@disable');
    Route::get('email_verification_servers/enable', 'EmailVerificationServerController@enable');
    Route::resource('email_verification_servers', 'EmailVerificationServerController');

    // Blacklists
    Route::get('blacklists/import', 'BlacklistController@import');
    Route::post('blacklists/import/start', 'BlacklistController@startImport');
    Route::get('blacklists/import/{job_uid}/progress', 'BlacklistController@importProgress');
    Route::post('blacklists/import/{job_uid}/cancel', 'BlacklistController@cancelImport');

    Route::get('blacklists/listing/{page?}', 'BlacklistController@listing');
    Route::get('blacklists/delete', 'BlacklistController@delete');
    Route::resource('blacklists', 'BlacklistController');

    // Sender
    Route::get('senders/dropbox', 'SenderController@dropbox');
    Route::get('senders/listing/{page?}', 'SenderController@listing');
    Route::get('senders/sort', 'SenderController@sort');
    Route::get('senders/delete', 'SenderController@delete');
    Route::resource('senders', 'SenderController');

    // Notifications
    Route::resource('notifications', 'NotificationController');
    Route::post('notifications/{id}/hide', 'NotificationController@hide');

    // Automation2
    Route::match(['get', 'post'], 'automation2/condition/wait/custom', 'Automation2Controller@conditionWaitCustom');
    Route::match(['get', 'post'], 'automation2/{email_uid}/send-test-email', 'Automation2Controller@sendTestEmail');
    Route::get('automation2/{uid}/cart/items', 'Automation2Controller@cartItems');
    Route::get('automation2/{uid}/cart/list', 'Automation2Controller@cartList');
    Route::get('automation2/{uid}/cart/stats', 'Automation2Controller@cartStats');
    Route::match(['get', 'post'], 'automation2/{uid}/car/change-store', 'Automation2Controller@cartChangeStore');
    Route::match(['get', 'post'], 'automation2/{uid}/car/wait', 'Automation2Controller@cartWait');
    Route::match(['get', 'post'], 'automation2/{uid}/car/change-list', 'Automation2Controller@cartChangeList');
    Route::get('automation2/{uid}/condition/setting', 'Automation2Controller@conditionSetting');
    Route::get('automation2/{uid}/operation/show', 'Automation2Controller@operationShow');
    Route::match(['get', 'post'], 'automation2/{uid}/operation/edit', 'Automation2Controller@operationEdit');
    Route::match(['get', 'post'], 'automation2/{uid}/operation/create', 'Automation2Controller@operationCreate');
    Route::get('automation2/{uid}/operation/select', 'Automation2Controller@operationSelect');
    Route::post('automation2/{uid}/wait-time', 'Automation2Controller@waitTime');
    Route::get('automation2/{uid}/wait-time', 'Automation2Controller@waitTime');
    Route::get('automation2/{uid}/last-saved', 'Automation2Controller@lastSaved');
    Route::post('automation2/{uid}/subscribers/{subscriber_uid}/restart', 'Automation2Controller@subscribersRestart');
    Route::post('automation2/{uid}/subscribers/{subscriber_uid}/remove', 'Automation2Controller@subscribersRemove');
    Route::get('automation2/{uid}/subscribers/{subscriber_uid}/show', 'Automation2Controller@subscribersShow');
    Route::get('automation2/{uid}/subscribers/list', 'Automation2Controller@subscribersList');
    Route::get('automation2/{uid}/subscribers/list', 'Automation2Controller@subscribersList');
    Route::get('automation2/{uid}/subscribers', 'Automation2Controller@subscribers');
    Route::get('automation2/{uid}/template/{email_uid}/preview/content', 'Automation2Controller@templatePreviewContent');
    Route::get('automation2/{uid}/template/{email_uid}/preview', 'Automation2Controller@templatePreview');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/plain-edit', 'Automation2Controller@templateEditPlain');
    Route::get('automation2/{uid}/template/{email_uid}/builder-select', 'Automation2Controller@templateBuilderSelect');
    Route::get('automation2/segment-select', 'Automation2Controller@segmentSelect');

    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/edit-classic', 'Automation2Controller@templateEditClassic');
    Route::match(['get', 'post'], 'automation2/{uid}/contacts/copy-to-new-list', 'Automation2Controller@copyToNewList');
    Route::post('automation2/{uid}/contacts/export', 'Automation2Controller@exportContacts');

    Route::get('automation2/{uid}/contacts/{contact_uid}/retry', 'Automation2Controller@contactRetry');
    Route::post('automation2/{uid}/contacts/{contact_uid}/tag/remove', 'Automation2Controller@removeTag');
    Route::match(['get', 'post'], 'automation2/{uid}/contacts/tag', 'Automation2Controller@tagContacts');
    Route::match(['get', 'post'], 'automation2/{uid}/contact/{contact_uid}/tag', 'Automation2Controller@tagContact');
    Route::post('automation2/{uid}/contact/{contact_uid}/remove', 'Automation2Controller@removeContact');
    Route::get('automation2/{uid}/contact/{contact_uid}/profile', 'Automation2Controller@profile');
    Route::get('automation2/{uid}/timeline/list', 'Automation2Controller@timelineList');
    Route::get('automation2/{uid}/timeline', 'Automation2Controller@timeline');
    Route::post('automation2/{uid}/contacts/list', 'Automation2Controller@contactsList');
    Route::get('automation2/{uid}/contacts/list', 'Automation2Controller@contactsList');
    Route::get('automation2/{uid}/contacts', 'Automation2Controller@contacts');

    Route::get('automation2/{uid}/insight', 'Automation2Controller@insight');
    Route::post('automation2/{uid}/data/save', 'Automation2Controller@saveData');
    Route::post('automation2/{uid}/update', 'Automation2Controller@update');
    Route::get('automation2/{uid}/settings', 'Automation2Controller@settings');

    Route::post('automation2/{uid}/template/{email_uid}/attachment/{attachment_uid}/remove', 'Automation2Controller@emailAttachmentRemove');
    Route::get('automation2/{uid}/template/{email_uid}/attachment/{attachment_uid}', 'Automation2Controller@emailAttachmentDownload');

    Route::post('automation2/{uid}/template/{email_uid}/attachment', 'Automation2Controller@emailAttachmentUpload');
    Route::post('automation2/{uid}/template/{email_uid}/remove-template', 'Automation2Controller@templateRemove');
    Route::get('automation2/{uid}/template/{email_uid}/content', 'Automation2Controller@templateContent');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/edit', 'Automation2Controller@templateEdit');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/upload', 'Automation2Controller@templateUpload');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/layout', 'Automation2Controller@templateLayout');
    Route::get('automation2/{uid}/template/{email_uid}/layout/list', 'Automation2Controller@templateLayoutList');
    Route::get('automation2/{uid}/template/{email_uid}/create', 'Automation2Controller@templateCreate');

    Route::post('automation2/{uid}/email/{email_uid}/delete', 'Automation2Controller@emailDelete');
    Route::match(['get', 'post'], 'automation2/{uid}/email/setup', 'Automation2Controller@emailSetup');
    Route::match(['get', 'post'], 'automation2/{uid}/email/{email_uid}/confirm', 'Automation2Controller@emailConfirm');
    Route::match(['get', 'post'], 'automation2/{uid}/email/{email_uid?}', 'Automation2Controller@email');
    Route::match(['get', 'post'], 'automation2/{uid}/email/{email_uid}/template', 'Automation2Controller@emailTemplate');
    Route::match(['get', 'post'], 'automation2/{uid}/action/edit', 'Automation2Controller@actionEdit');
    Route::match(['get', 'post'], 'automation2/{uid}/trigger/edit', 'Automation2Controller@triggerEdit');
    Route::post('automation2/{uid}/action/select', 'Automation2Controller@actionSelect');
    Route::get('automation2/{uid}/action/select/confirm', 'Automation2Controller@actionSelectConfirm');
    Route::get('automation2/{uid}/action/select', 'Automation2Controller@actionSelectPupop');
    Route::post('automation2/{uid}/trigger/select', 'Automation2Controller@triggerSelect');
    Route::get('automation2/{uid}/trigger/select', 'Automation2Controller@triggerSelectPupop');
    Route::get('automation2/{uid}/trigger/select/confirm', 'Automation2Controller@triggerSelectConfirm');
    Route::match(['get'], 'automation2/{uid}/edit', 'Automation2Controller@edit');
    Route::match(['get', 'post'], 'automation2/wizard', 'Automation2Controller@wizard');
    Route::get('automation2/wizard/trigger', 'Automation2Controller@wizardTrigger');
    Route::match(['get', 'post'], 'automation2/wizard/trigger/option', 'Automation2Controller@wizardTriggerOption');
    Route::get('automation2/wizard/trigger/option/field-select', 'Automation2Controller@wizardListFieldSelect');
    Route::patch('automation2/disable', 'Automation2Controller@disable');
    Route::patch('automation2/enable', 'Automation2Controller@enable');
    Route::delete('automation2/delete', 'Automation2Controller@delete');
    Route::get('automation2/listing', 'Automation2Controller@listing');
    Route::get('automation2', 'Automation2Controller@index');
    Route::get('automation2/{uid}/debug', 'Automation2Controller@debug');
    Route::get('automation2/{automation}/{subscriber}/trigger', 'Automation2Controller@triggerNow');
    Route::get('trigger/{id}', 'AutoTrigger@show');
    Route::get('trigger/{id}/check', 'AutoTrigger@check');
    Route::get('automation2/{automation}/run', 'Automation2Controller@run');

    // Sample UI/UX
    Route::get('sample', 'SamplesController@index');

    // Products
    Route::get('/products/widget/products/options', 'ProductController@widgetProductOptions');
    Route::get('products/listing', 'ProductController@listing');
    Route::resource('products', 'ProductController');

    // Source
    Route::get('sources/{uid}/detail', 'SourceController@show');
    Route::match(['get', 'post'], 'sources/woo-connect', 'SourceController@wooConnect');
    Route::post('sources/{uid}/sync', 'SourceController@sync');
    Route::post('sources/delete', 'SourceController@delete');
    Route::get('sources/connect', 'SourceController@connect');
    Route::get('sources/listing', 'SourceController@listing');
    Route::resource('sources', 'SourceController');

    // Site - Menu
    Route::get('site/menus', 'Site\MenuController@index');

    // Site - Product
    Route::post('site/profucts/{id}/delete', 'Site\ProductController@delete');
    Route::match(['get', 'post'], 'site/products/{id}/edit', 'Site\ProductController@edit');
    Route::match(['get', 'post'], 'site/products/add', 'Site\ProductController@add');
    Route::post('site/profucts/{id}/activate', 'Site\TemplateController@activate');
    Route::get('site/products/listing', 'Site\ProductController@listing');
    Route::get('site/products', 'Site\ProductController@index');

    // Site - Template
    Route::post('site/templates/{id}/activate', 'Site\TemplateController@activate');
    Route::get('site/templates/listing', 'Site\TemplateController@listing');
    Route::get('site/templates', 'Site\TemplateController@index');
    // Invoice
    Route::get('invoices/{uid}/download', 'InvoiceController@download');
   });

     Route::get('/getstates/{id}','ServiceProvider\QuoteController@getstates')->name("getstates");
     Route::get('/getcities/{id}','ServiceProvider\QuoteController@getcities')->name("getcities");

  });

});

Route::get('/', 'HomeController@home');
// ADMIN AREA

Route::group(['namespace' => 'Admin', 'middleware' => ['not_installed', 'auth', 'super_admin']], function () {
    Route::name('super-admin.')->prefix('super-admin')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('docs/api/v1', 'ApiController@doc');
    // Route::get('servicecategories', 'HomeController@servicecategories');
    // Search
    Route::get('search/sending-servers', 'SearchController@sending_servers');
    Route::get('search/plans', 'SearchController@plans');
    Route::get('search/templates', 'SearchController@templates');
    Route::get('search/customers', 'SearchController@customers');
    Route::get('search/general', 'SearchController@general');

    // Notification
    Route::get('notifications/popup', 'NotificationController@popup');
    Route::post('notifications/delete', 'NotificationController@delete');
    Route::get('notifications/listing', 'NotificationController@listing');
    Route::get('notifications', 'NotificationController@index');

    // User
    Route::get('users/switch/{uid}', 'UserController@switch_user');
    Route::get('users/listing/{page?}', 'UserController@listing');
    Route::get('users/sort', 'UserController@sort');
    Route::get('users/delete', 'UserController@delete');
    // Route::resource('users', 'UserController');

    // Template
    Route::post('templates/{uid}/export', 'TemplateController@export');
    Route::match(['get','post'], 'templates/{uid}/change-name', 'TemplateController@changeName');
    Route::match(['get','post'], 'templates/{uid}/categories', 'TemplateController@categories');

    Route::match(['get','post'], 'templates/{uid}/update-thumb-url', 'TemplateController@updateThumbUrl');
    Route::match(['get','post'], 'templates/{uid}/update-thumb', 'TemplateController@updateThumb');

    Route::get('templates/{uid}/builder/change-template/{change_uid}', 'TemplateController@builderChangeTemplate');
    Route::get('templates/builder/templates/{category_uid}', 'TemplateController@builderTemplates');
    Route::post('templates/builder/create', 'TemplateController@builderCreate');
    Route::get('templates/builder/create', 'TemplateController@builderCreate');
    Route::post('templates/{uid}/builder/edit/asset', 'TemplateController@uploadTemplateAssets');
    Route::get('templates/{uid}/builder/edit/content', 'TemplateController@builderEditContent');
    Route::post('templates/{uid}/builder/edit', 'TemplateController@builderEdit');
    Route::get('templates/{uid}/builder/edit', 'TemplateController@builderEdit');

    Route::post('templates/{uid}/copy', 'TemplateController@copy');
    Route::get('templates/{uid}/copy', 'TemplateController@copy');
    Route::get('templates/{uid}/preview', 'TemplateController@preview');
    Route::get('templates/listing/{page?}', 'TemplateController@listing');
    Route::get('templates/upload', 'TemplateController@uploadTemplate');
    Route::post('templates/upload', 'TemplateController@uploadTemplate');
    Route::get('templates/delete', 'TemplateController@delete');
    Route::resource('templates', 'TemplateController');
    Route::get('templates/{uid}/edit', 'TemplateController@edit');
    Route::patch('templates/{uid}/update', 'TemplateController@update');

    // Layout
    Route::get('layouts/listing/{page?}', 'LayoutController@listing');
    Route::get('layouts/sort', 'LayoutController@sort');
    Route::resource('layouts', 'LayoutController');

    // Sending servers
    Route::get('sending_servers/{uid}/senders/dropbox', 'SendingServerController@fromDropbox');
    Route::post('sending_servers/{uid}/remove-domain/{domain}', 'SendingServerController@removeDomain');
    Route::post('sending_servers/{uid}/add-domain', 'SendingServerController@addDomain');
    Route::get('sending_servers/{uid}/add-domain', 'SendingServerController@addDomain');
    Route::get('sending_servers/aws-region-host', 'SendingServerController@awsRegionHost');

    Route::post('sending_servers/{uid}/test-connection', 'SendingServerController@testConnection');

    Route::post('sending_servers/{uid}/config', 'SendingServerController@config');
    Route::post('sending_servers/sending-limit', 'SendingServerController@sendingLimit');
    Route::get('sending_servers/sending-limit', 'SendingServerController@sendingLimit');

    Route::get('sending_servers/select2', 'SendingServerController@select2');
    Route::post('sending_servers/{uid}/test', 'SendingServerController@test');
    Route::get('sending_servers/{uid}/test', 'SendingServerController@test');
    Route::get('sending_servers/select', 'SendingServerController@select');
    Route::get('sending_servers/listing/{page?}', 'SendingServerController@listing');
    Route::get('sending_servers/sort', 'SendingServerController@sort');
    Route::get('sending_servers/delete', 'SendingServerController@delete');
    Route::get('sending_servers/disable', 'SendingServerController@disable');
    Route::get('sending_servers/enable', 'SendingServerController@enable');
    Route::resource('sending_servers', 'SendingServerController');
    Route::get('sending_servers/create/{type}', 'SendingServerController@create');
    Route::post('sending_servers/create/{type}', 'SendingServerController@store');
    Route::get('sending_servers/{id}/edit/{type}', 'SendingServerController@edit');
    Route::patch('sending_servers/{id}/update/{type}', 'SendingServerController@update');

    // Bounce handlers
    Route::post('bounce_handlers/{uid}/test', 'BounceHandlerController@test');
    Route::get('bounce_handlers/listing/{page?}', 'BounceHandlerController@listing');
    Route::get('bounce_handlers/sort', 'BounceHandlerController@sort');
    Route::get('bounce_handlers/delete', 'BounceHandlerController@delete');
    Route::get('bounce_handlers/{uid}/run', 'BounceHandlerController@run');
    Route::resource('bounce_handlers', 'BounceHandlerController');

    // Feedback Loop handlers
    Route::post('feedback_loop_handlers/{uid}/test', 'FeedbackLoopHandlerController@test');
    Route::get('feedback_loop_handlers/listing/{page?}', 'FeedbackLoopHandlerController@listing');
    Route::get('feedback_loop_handlers/sort', 'FeedbackLoopHandlerController@sort');
    Route::get('feedback_loop_handlers/delete', 'FeedbackLoopHandlerController@delete');
    Route::resource('feedback_loop_handlers', 'FeedbackLoopHandlerController');

    // Language
    Route::get('languages/delete/confirm', 'LanguageController@deleteConfirm');
    Route::get('languages/listing/{page?}', 'LanguageController@listing');
    Route::get('languages/delete', 'LanguageController@delete');
    Route::get('languages/{id}/translate', 'LanguageController@translate');
    Route::post('languages/{id}/translate', 'LanguageController@translate');
    Route::get('languages/{id}/translate/intro', 'LanguageController@translateIntro');
    Route::get('languages/disable', 'LanguageController@disable');
    Route::get('languages/enable', 'LanguageController@enable');
    Route::get('languages/{id}/download', 'LanguageController@download');
    Route::get('languages/{id}/upload', 'LanguageController@upload');
    Route::post('languages/{id}/upload', 'LanguageController@upload');
    Route::resource('languages', 'LanguageController');

    // Settings
    Route::post('settings/payment', 'SettingController@payment');
    Route::post('settings/advanced/{name}/update', 'SettingController@advancedUpdate');
    Route::get('settings/advanced', 'SettingController@advanced');
    Route::post('settings/upgrade/cancel', 'SettingController@cancelUpgrade');
    Route::post('settings/upgrade', 'SettingController@doUpgrade');
    Route::post('settings/upgrade/upload', 'SettingController@uploadApplicationPatch');
    Route::get('settings/upgrade', 'SettingController@upgrade');
    Route::get('u', 'SettingController@upgrade'); // shortcut to upgrade page
    Route::post('settings/license', 'SettingController@license');
    Route::get('settings/license', 'SettingController@license');
    Route::match(['get','post'], 'settings/mailer/test', 'SettingController@mailerTest');
    Route::get('settings/mailer', 'SettingController@mailer');
    Route::post('settings/mailer', 'SettingController@mailer');
    Route::get('settings/cronjob', 'SettingController@cronjob');
    Route::post('settings/cronjob', 'SettingController@cronjob');
    Route::get('settings/urls', 'SettingController@urls');
    Route::get('settings/sending', 'SettingController@sending');
    Route::post('settings/sending', 'SettingController@sending');
    Route::get('settings/general', 'SettingController@general');
    Route::post('settings/general', 'SettingController@general');
    Route::get('settings/logs', 'SettingController@logs');
    Route::get('log', 'SettingController@download_log');
    Route::get('settings/{tab?}', 'SettingController@index');
    Route::post('settings', 'SettingController@index');
    Route::get('update-urls', 'SettingController@updateUrls');


    // Tracking log
    Route::get('tracking_log', 'TrackingLogController@index');
    Route::get('tracking_log/listing', 'TrackingLogController@listing');

    // Feedback log
    Route::get('bounce_log', 'BounceLogController@index');
    Route::get('bounce_log/listing', 'BounceLogController@listing');

    // Open log
    Route::get('open_log', 'OpenLogController@index');
    Route::get('open_log/listing', 'OpenLogController@listing');

    // Click log
    Route::get('click_log', 'ClickLogController@index');
    Route::get('click_log/listing', 'ClickLogController@listing');

    // Feedback log
    Route::get('feedback_log', 'FeedbackLogController@index');
    Route::get('feedback_log/listing', 'FeedbackLogController@listing');

    // Unsubscribe log
    Route::get('unsubscribe_log', 'UnsubscribeLogController@index');
    Route::get('unsubscribe_log/listing', 'UnsubscribeLogController@listing');

    // Blacklist
    Route::get('blacklists/import', 'BlacklistController@import');
    Route::get('blacklists/import/{job_uid}/progress', 'BlacklistController@importProgress');
    Route::post('blacklists/import/{job_uid}/cancel', 'BlacklistController@cancelImport');
    Route::post('blacklists/import/start', 'BlacklistController@startImport');

    Route::get('blacklist', 'BlacklistController@index');
    Route::get('blacklist/listing', 'BlacklistController@listing');
    Route::get('blacklist/delete', 'BlacklistController@delete');
    Route::get('blacklists/{id}/reason', 'BlacklistController@reason');

    // Customer
    Route::match(['get', 'post'], 'customers/{uid}/assign-plan', 'CustomerController@assignPlan');
    Route::get('customers/{uid}/su-account', 'CustomerController@subAccount');
    Route::post('customers/{uid}/contact', 'CustomerController@contact');
    Route::get('customers/{id}/contact', 'CustomerController@contact');
    Route::get('customers/growthChart', 'CustomerController@growthChart');
    Route::get('customers/{id}/subscriptions', 'CustomerController@subscriptions');
    Route::get('customers/select2', 'CustomerController@select2');
    Route::get('customers/login-as/{uid}', 'CustomerController@loginAs');
    Route::get('customers/listing/{page?}', 'CustomerController@listing');
    Route::get('customers/splisting/{page?}', 'CustomerController@splisting');
    Route::get('customers/userlisting/{page?}', 'CustomerController@userlisting');
    Route::get('customers/sort', 'CustomerController@sort');
    Route::get('customers/delete', 'CustomerController@delete');
    Route::get('customers/disable', 'CustomerController@disable');
    Route::get('customers/enable', 'CustomerController@enable');
    Route::resource('customers', 'CustomerController');
    Route::resource('customer', 'CustomerController@customers');

    Route::get('service-provider', 'CustomerController@serviceproviders');
    Route::get('customer', 'CustomerController@customers');

    // Admin Group
    Route::get('admin_groups/listing/{page?}', 'AdminGroupController@listing');
    Route::get('admin_groups/sort', 'AdminGroupController@sort');
    Route::get('admin_groups/delete', 'AdminGroupController@delete');
    Route::resource('admin_groups', 'AdminGroupController');

    // Admin
    Route::get('admins/login-as/{uid}', 'AdminController@loginAs');
    Route::get('admins/listing/{page?}', 'AdminController@listing');
    Route::get('admins/sort', 'AdminController@sort');
    Route::get('admins/delete', 'AdminController@delete');
    Route::get('admins/disable', 'AdminController@disable');
    Route::get('admins/enable', 'AdminController@enable');
    Route::get('admins/login-back', 'AdminController@loginBack');
    Route::resource('admins', 'AdminController');

    // Admin Group 2
    Route::get('admin_groups2/listing/{page?}', 'AdminGroup2Controller@listing');
    Route::get('admin_groups2/sort', 'AdminGroup2Controller@sort');
    Route::get('admin_groups2/delete', 'AdminGroup2Controller@delete');
    Route::resource('admin_groups2', 'AdminGroup2Controller');

    // Admin2
    Route::get('admins2/login-as/{uid}', 'Admin2Controller@loginAs');
    Route::get('admins2/listing/{page?}', 'Admin2Controller@listing');
    Route::get('admins2/sort', 'Admin2Controller@sort');
    Route::get('admins2/delete', 'Admin2Controller@delete');
    Route::get('admins2/disable', 'Admin2Controller@disable');
    Route::get('admins2/enable', 'Admin2Controller@enable');
    Route::get('admins2/login-back', 'Admin2Controller@loginBack');
    Route::resource('admin2/admins', 'Admin2Controller');


    // Account
    Route::get('account/save-auto-theme-mode', 'AccountController@saveAutoThemeMode');
    Route::get('account/leftbar/state', 'AccountController@leftbarState');
    Route::get('account/api/renew', 'AccountController@renewToken');
    Route::get('account/api', 'AccountController@api');
    Route::get('account/profile', 'AccountController@profile');
    Route::post('account/profile', 'AccountController@profile');
    Route::get('account/contact', 'AccountController@contact');
    Route::post('account/contact', 'AccountController@contact');

    // Plan
    Route::match(['get', 'post'], 'plans/{uid}/tos', 'PlanController@tos');
    Route::post('plans/{uid}/visible/on', 'PlanController@visibleOn');
    Route::post('plans/{uid}/visible/off', 'PlanController@visibleOff');

    Route::match(['get', 'post'], 'plans/{uid}/sending-server/subaccount', 'PlanController@sendingServerSubaccount');
    Route::match(['get', 'post'], 'plans/{uid}/sending-server/own', 'PlanController@sendingServerOwn');
    Route::match(['get', 'post'], 'plans/{uid}/sending-server/option', 'PlanController@sendingServerOption');
    Route::match(['get', 'post'], 'plans/{uid}/wizard/sending-server', 'PlanController@wizardSendingServer');
    Route::match(['get', 'post'], 'plans/wizard', 'PlanController@wizard');
    Route::get('plans/{uid}/sending-server', 'PlanController@sendingServer');
    Route::match(['get', 'post'], 'plans/{uid}/billing-cycle', 'PlanController@billingCycle');
    Route::match(['get', 'post'], 'plans/{uid}/sending-limit', 'PlanController@sendingLimit');
    Route::get('plans/{uid}/email-verification', 'PlanController@emailVerification');
    Route::get('plans/{uid}/general', 'PlanController@general');
    Route::get('plans/{uid}/quota', 'PlanController@quota');
    Route::get('plans/{uid}/security', 'PlanController@security');
    Route::get('plans/{uid}/email-footer', 'PlanController@emailFooter');
    Route::get('plans/{uid}/payment', 'PlanController@payment');
    Route::get('plans/{uid}/billing-history', 'PlanController@billingHistory');
    Route::get('plans/{uid}/general', 'PlanController@general');
    Route::post('plans/{uid}/save', 'PlanController@save');

    Route::post('plans/{id}/sending_servers/{sending_server_uid}/set-primary', 'PlanController@setPrimarySendingServer');
    Route::match(['get', 'post'], 'plans/{id}/sending_servers/fitness', 'PlanController@fitness');
    Route::post('plans/{id}/sending_servers/{sending_server_uid}/remove', 'PlanController@removeSendingServer');
    Route::post('plans/{id}/sending_servers/add', 'PlanController@addSendingServer');
    Route::get('plans/{id}/sending_servers/add', 'PlanController@addSendingServer');
    Route::get('plans/{id}/sending_servers', 'PlanController@sendingServers');
    Route::get('plans/pieChart', 'PlanController@pieChart');
    Route::get('plans/delete/confirm', 'PlanController@deleteConfirm');
    Route::get('plans/select2', 'PlanController@select2');
    Route::get('plans/listing/{page?}', 'PlanController@listing');
    Route::get('plans/sort', 'PlanController@sort');
    Route::get('plans/delete', 'PlanController@delete');
    Route::get('plans/disable', 'PlanController@disable');
    Route::post('plans/enable', 'PlanController@enable');
    Route::match(['get', 'post'], 'plans/copy', 'PlanController@copy');
    Route::resource('plans', 'PlanController');

    // Currency
    Route::get('currencies/select2', 'CurrencyController@select2');
    Route::get('currencies/listing/{page?}', 'CurrencyController@listing');
    Route::get('currencies/sort', 'CurrencyController@sort');
    Route::get('currencies/delete', 'CurrencyController@delete');
    Route::get('currencies/disable', 'CurrencyController@disable');
    Route::get('currencies/enable', 'CurrencyController@enable');
    Route::resource('currencies', 'CurrencyController');

    // Subscription
    Route::post('subscriptions/{id}/approve', 'SubscriptionController@approve');
    // Route::match(['get','post'], 'subscriptions/create', 'SubscriptionController@create');
    // Route::post('subscriptions/{id}/approve-pending', 'SubscriptionController@approvePending');
    // Route::post('subscriptions/{id}/renew', 'SubscriptionController@renew');
    Route::match(['get','post'], 'subscriptions/{id}/reject-pending', 'SubscriptionController@rejectPending');
    Route::get('subscriptions/{id}/invoices', 'SubscriptionController@invoices');
    // Route::post('subscriptions/{id}/change-plan', 'SubscriptionController@changePlan');
    // Route::get('subscriptions/{id}/change-plan', 'SubscriptionController@changePlan');
    Route::post('subscriptions/{id}/cancel-now', 'SubscriptionController@cancelNow');
    Route::post('subscriptions/{id}/resume', 'SubscriptionController@resume');
    Route::post('subscriptions/{id}/cancel', 'SubscriptionController@cancel');
    Route::get('subscriptions/listing/{page?}', 'SubscriptionController@listing');
    Route::get('subscriptions/sort', 'SubscriptionController@sort');
    Route::delete('subscriptions/delete', 'SubscriptionController@delete');
    Route::resource('subscriptions', 'SubscriptionController');

    // Email verification servers
    Route::get('email_verification_servers/options', 'EmailVerificationServerController@options');
    Route::get('email_verification_servers/listing/{page?}', 'EmailVerificationServerController@listing');
    Route::get('email_verification_servers/sort', 'EmailVerificationServerController@sort');
    Route::get('email_verification_servers/delete', 'EmailVerificationServerController@delete');
    Route::get('email_verification_servers/disable', 'EmailVerificationServerController@disable');
    Route::get('email_verification_servers/enable', 'EmailVerificationServerController@enable');
    Route::resource('email_verification_servers', 'EmailVerificationServerController');

    // Sub account
    Route::get('sub_accounts/{uid}/delete/confirm', 'SubAccountController@deleteConfirm');
    Route::delete('sub_accounts/{uid}/delete', 'SubAccountController@delete');
    Route::get('sub_accounts/listing/{page?}', 'SubAccountController@listing');
    Route::resource('sub_accounts', 'SubAccountController');

    // Payment gateways
    Route::post('payment/gateways/{name}/disable', 'PaymentController@disable');
    Route::post('payment/gateways/{name}/enable', 'PaymentController@enable');
    Route::post('payment/gateways/{name}/set-primary', 'PaymentController@setPrimary');
    Route::post('payment/gateways/update/{name}', 'PaymentController@update');
    Route::get('payment/gateways/edit/{name}', 'PaymentController@edit');
    Route::get('payment/gateways/index', 'PaymentController@index');

    // Plugin managements
    Route::match(['get', 'post'], 'plugins/install', 'PluginController@install');
    Route::get('plugins/listing/{page?}', 'PluginController@listing');
    Route::get('plugins/sort', 'PluginController@sort');
    Route::get('plugins/delete', 'PluginController@delete');
    Route::get('plugins/disable', 'PluginController@disable');
    Route::get('plugins/enable', 'PluginController@enable');
    Route::resource('plugins', 'PluginController');

    // GeoIP Management
    Route::get('geoip', 'GeoIpController@index');
    Route::match(['get', 'post'], 'geoip/setting', 'GeoIpController@setting');
    Route::post('geoip/reset', 'GeoIpController@reset');

    // Update
    Route::get('upgrade/finalize', 'Upgrade@finalize');

    // Modify jobs indexes
    Route::get('jobs/drop-index', 'Upgrade@dropIndex');
    Route::get('jobs/create-index', 'Upgrade@createIndex');

    //
    Route::post('tax/remove/{code}', 'TaxController@removeCountry');
    Route::match(['get','post'], 'tax/add', 'TaxController@addTax');
    Route::get('tax/countries', 'TaxController@countries');
    Route::match(['get','post'], 'tax/settings', 'TaxController@settings');

    // Invoice
    Route::get('invoices/{uid}/download', 'InvoiceController@download');

     // Campaign
    Route::get('campaigns/{uid}/preview-as/list', 'CampaignController@previewAsList');
    Route::get('campaigns/{uid}/preview-as', 'CampaignController@previewAs');

    Route::post('campaigns/{uid}/custom-plain/off', 'CampaignController@customPlainOff');
    Route::post('campaigns/{uid}/custom-plain/on', 'CampaignController@customPlainOn');
    Route::post('campaigns/{uid}/remove-attachment', 'CampaignController@removeAttachment');
    Route::get('campaigns/{uid}/download-attachment', 'CampaignController@downloadAttachment');
    Route::post('campaigns/{uid}/upload-attachment', 'CampaignController@uploadAttachment');
    Route::get('campaigns/{uid}/template/builder-select', 'CampaignController@templateBuilderSelect');

    Route::match(['get', 'post'], 'campaigns/{uid}/template/builder-plain', 'CampaignController@builderPlainEdit');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/builder-classic', 'CampaignController@builderClassic');
    Route::match(['get', 'post'], 'campaigns/{uid}/plain', 'CampaignController@plain');
    Route::get('campaigns/{uid}/template/change/{template_uid}', 'CampaignController@templateChangeTemplate');

    Route::get('campaigns/{uid}/template/content', 'CampaignController@templateContent');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/edit', 'CampaignController@templateEdit');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/upload', 'CampaignController@templateUpload');
    Route::get('campaigns/{uid}/template/layout/list', 'CampaignController@templateLayoutList');
    Route::match(['get', 'post'], 'campaigns/{uid}/template/layout', 'CampaignController@templateLayout');
    Route::get('campaigns/{uid}/template/create', 'CampaignController@templateCreate');

    Route::get('campaigns/{uid}/spam-score', 'CampaignController@spamScore');
    Route::get('campaigns/{from_uid}/copy-move-from/{action}', 'CampaignController@copyMoveForm');
    Route::match(['get', 'post'], 'campaigns/{uid}/resend', 'CampaignController@resend');
    Route::get('campaigns/{uid}/tracking-log/download', 'CampaignController@trackingLogDownload');
    Route::get('campaigns/job/{uid}/progress', 'CampaignController@trackingLogExportProgress');
    Route::get('campaigns/job/{uid}/download', 'CampaignController@download');

    Route::get('campaigns/{uid}/template/review-iframe', 'CampaignController@templateReviewIframe');
    Route::get('campaigns/{uid}/template/review', 'CampaignController@templateReview');
    Route::get('campaigns/select-type', 'CampaignController@selectType');
    Route::get('campaigns/{uid}/list-segment-form', 'CampaignController@listSegmentForm');
    Route::get('campaigns/{uid}/preview/content/{subscriber_uid?}', 'CampaignController@previewContent');
    Route::get('campaigns/{uid}/preview', 'CampaignController@preview');
    Route::match(['get', 'post'], 'campaigns/send-test-email', 'CampaignController@sendTestEmail');
    Route::get('campaigns/delete/confirm', 'CampaignController@deleteConfirm');
    Route::match(['get', 'post'], 'campaigns/copy', 'CampaignController@copy');
    Route::get('campaigns/{uid}/subscribers', 'CampaignController@subscribers');
    Route::get('campaigns/{uid}/subscribers/listing', 'CampaignController@subscribersListing');
    Route::get('campaigns/{uid}/open-map', 'CampaignController@openMap');
    Route::get('campaigns/{uid}/tracking-log', 'CampaignController@trackingLog');
    Route::get('campaigns/{uid}/tracking-log/listing', 'CampaignController@trackingLogListing');
    Route::get('campaigns/{uid}/bounce-log', 'CampaignController@bounceLog');
    Route::get('campaigns/{uid}/bounce-log/listing', 'CampaignController@bounceLogListing');
    Route::get('campaigns/{uid}/feedback-log', 'CampaignController@feedbackLog');
    Route::get('campaigns/{uid}/feedback-log/listing', 'CampaignController@feedbackLogListing');
    Route::get('campaigns/{uid}/open-log', 'CampaignController@openLog');
    Route::get('campaigns/{uid}/open-log/listing', 'CampaignController@openLogListing');
    Route::get('campaigns/{uid}/click-log', 'CampaignController@clickLog');
    Route::get('campaigns/{uid}/click-log/listing', 'CampaignController@clickLogListing');
    Route::get('campaigns/{uid}/unsubscribe-log', 'CampaignController@unsubscribeLog');
    Route::get('campaigns/{uid}/unsubscribe-log/listing', 'CampaignController@unsubscribeLogListing');

    Route::get('campaigns/quick-view', 'CampaignController@quickView');
    Route::get('campaigns/{uid}/chart24h', 'CampaignController@chart24h');
    Route::get('campaigns/{uid}/chart', 'CampaignController@chart');
    Route::get('campaigns/{uid}/chart/countries/open', 'CampaignController@chartCountry');
    Route::get('campaigns/{uid}/chart/countries/click', 'CampaignController@chartClickCountry');
    Route::get('campaigns/{uid}/overview', 'CampaignController@overview');
    Route::get('campaigns/{uid}/links', 'CampaignController@links');
    Route::get('campaigns/listing/{page?}', 'CampaignController@listing');
    Route::get('campaigns/{uid}/recipients', 'CampaignController@recipients');
    Route::post('campaigns/{uid}/recipients', 'CampaignController@recipients');
    Route::get('campaigns/{uid}/setup', 'CampaignController@setup');
    Route::post('campaigns/{uid}/setup', 'CampaignController@setup');
    Route::get('campaigns/{uid}/template', 'CampaignController@template');
    Route::post('campaigns/{uid}/template', 'CampaignController@template');
    Route::get('campaigns/{uid}/template/select', 'CampaignController@templateSelect');
    Route::get('campaigns/{uid}/template/choose/{template_uid}', 'CampaignController@templateChoose');
    Route::get('campaigns/{uid}/template/preview', 'CampaignController@templatePreview');
    Route::get('campaigns/{uid}/template/iframe', 'CampaignController@templateIframe');
    Route::get('campaigns/{uid}/template/build/{style}', 'CampaignController@templateBuild');
    Route::get('campaigns/{uid}/template/rebuild', 'CampaignController@templateRebuild');
    Route::get('campaigns/{uid}/schedule', 'CampaignController@schedule');
    Route::post('campaigns/{uid}/schedule', 'CampaignController@schedule');
    Route::get('campaigns/{uid}/confirm', 'CampaignController@confirm');
    Route::post('campaigns/{uid}/confirm', 'CampaignController@confirm');
    Route::post('campaigns/delete', 'CampaignController@delete');
    Route::get('campaigns/select2', 'CampaignController@select2');
    Route::post('campaigns/pause', 'CampaignController@pause');
    Route::post('campaigns/restart', 'CampaignController@restart');
    Route::resource('campaigns', 'CampaignController');
    Route::get('campaigns/{uid}/edit', 'CampaignController@edit');
    Route::patch('campaigns/{uid}/update', 'CampaignController@update');
    Route::get('campaigns/{uid}/run', 'CampaignController@run');
    Route::get('campaigns/{uid}/update-stats', 'CampaignController@updateStats');

    // Automation2
    Route::match(['get', 'post'], 'automation2/condition/wait/custom', 'Automation2Controller@conditionWaitCustom');
    Route::match(['get', 'post'], 'automation2/{email_uid}/send-test-email', 'Automation2Controller@sendTestEmail');
    Route::get('automation2/{uid}/cart/items', 'Automation2Controller@cartItems');
    Route::get('automation2/{uid}/cart/list', 'Automation2Controller@cartList');
    Route::get('automation2/{uid}/cart/stats', 'Automation2Controller@cartStats');
    Route::match(['get', 'post'], 'automation2/{uid}/car/change-store', 'Automation2Controller@cartChangeStore');
    Route::match(['get', 'post'], 'automation2/{uid}/car/wait', 'Automation2Controller@cartWait');
    Route::match(['get', 'post'], 'automation2/{uid}/car/change-list', 'Automation2Controller@cartChangeList');
    Route::get('automation2/{uid}/condition/setting', 'Automation2Controller@conditionSetting');
    Route::get('automation2/{uid}/operation/show', 'Automation2Controller@operationShow');
    Route::match(['get', 'post'], 'automation2/{uid}/operation/edit', 'Automation2Controller@operationEdit');
    Route::match(['get', 'post'], 'automation2/{uid}/operation/create', 'Automation2Controller@operationCreate');
    Route::get('automation2/{uid}/operation/select', 'Automation2Controller@operationSelect');
    Route::post('automation2/{uid}/wait-time', 'Automation2Controller@waitTime');
    Route::get('automation2/{uid}/wait-time', 'Automation2Controller@waitTime');
    Route::get('automation2/{uid}/last-saved', 'Automation2Controller@lastSaved');
    Route::post('automation2/{uid}/subscribers/{subscriber_uid}/restart', 'Automation2Controller@subscribersRestart');
    Route::post('automation2/{uid}/subscribers/{subscriber_uid}/remove', 'Automation2Controller@subscribersRemove');
    Route::get('automation2/{uid}/subscribers/{subscriber_uid}/show', 'Automation2Controller@subscribersShow');
    Route::get('automation2/{uid}/subscribers/list', 'Automation2Controller@subscribersList');
    Route::get('automation2/{uid}/subscribers/list', 'Automation2Controller@subscribersList');
    Route::get('automation2/{uid}/subscribers', 'Automation2Controller@subscribers');
    Route::get('automation2/{uid}/template/{email_uid}/preview/content', 'Automation2Controller@templatePreviewContent');
    Route::get('automation2/{uid}/template/{email_uid}/preview', 'Automation2Controller@templatePreview');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/plain-edit', 'Automation2Controller@templateEditPlain');
    Route::get('automation2/{uid}/template/{email_uid}/builder-select', 'Automation2Controller@templateBuilderSelect');
    Route::get('automation2/segment-select', 'Automation2Controller@segmentSelect');

    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/edit-classic', 'Automation2Controller@templateEditClassic');
    Route::match(['get', 'post'], 'automation2/{uid}/contacts/copy-to-new-list', 'Automation2Controller@copyToNewList');
    Route::post('automation2/{uid}/contacts/export', 'Automation2Controller@exportContacts');

    Route::get('automation2/{uid}/contacts/{contact_uid}/retry', 'Automation2Controller@contactRetry');
    Route::post('automation2/{uid}/contacts/{contact_uid}/tag/remove', 'Automation2Controller@removeTag');
    Route::match(['get', 'post'], 'automation2/{uid}/contacts/tag', 'Automation2Controller@tagContacts');
    Route::match(['get', 'post'], 'automation2/{uid}/contact/{contact_uid}/tag', 'Automation2Controller@tagContact');
    Route::post('automation2/{uid}/contact/{contact_uid}/remove', 'Automation2Controller@removeContact');
    Route::get('automation2/{uid}/contact/{contact_uid}/profile', 'Automation2Controller@profile');
    Route::get('automation2/{uid}/timeline/list', 'Automation2Controller@timelineList');
    Route::get('automation2/{uid}/timeline', 'Automation2Controller@timeline');
    Route::post('automation2/{uid}/contacts/list', 'Automation2Controller@contactsList');
    Route::get('automation2/{uid}/contacts/list', 'Automation2Controller@contactsList');
    Route::get('automation2/{uid}/contacts', 'Automation2Controller@contacts');

    Route::get('automation2/{uid}/insight', 'Automation2Controller@insight');
    Route::post('automation2/{uid}/data/save', 'Automation2Controller@saveData');
    Route::post('automation2/{uid}/update', 'Automation2Controller@update');
    Route::get('automation2/{uid}/settings', 'Automation2Controller@settings');

    Route::post('automation2/{uid}/template/{email_uid}/attachment/{attachment_uid}/remove', 'Automation2Controller@emailAttachmentRemove');
    Route::get('automation2/{uid}/template/{email_uid}/attachment/{attachment_uid}', 'Automation2Controller@emailAttachmentDownload');

    Route::post('automation2/{uid}/template/{email_uid}/attachment', 'Automation2Controller@emailAttachmentUpload');
    Route::post('automation2/{uid}/template/{email_uid}/remove-template', 'Automation2Controller@templateRemove');
    Route::get('automation2/{uid}/template/{email_uid}/content', 'Automation2Controller@templateContent');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/edit', 'Automation2Controller@templateEdit');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/upload', 'Automation2Controller@templateUpload');
    Route::match(['get', 'post'], 'automation2/{uid}/template/{email_uid}/layout', 'Automation2Controller@templateLayout');
    Route::get('automation2/{uid}/template/{email_uid}/layout/list', 'Automation2Controller@templateLayoutList');
    Route::get('automation2/{uid}/template/{email_uid}/create', 'Automation2Controller@templateCreate');

    Route::post('automation2/{uid}/email/{email_uid}/delete', 'Automation2Controller@emailDelete');
    Route::match(['get', 'post'], 'automation2/{uid}/email/setup', 'Automation2Controller@emailSetup');
    Route::match(['get', 'post'], 'automation2/{uid}/email/{email_uid}/confirm', 'Automation2Controller@emailConfirm');
    Route::match(['get', 'post'], 'automation2/{uid}/email/{email_uid?}', 'Automation2Controller@email');
    Route::match(['get', 'post'], 'automation2/{uid}/email/{email_uid}/template', 'Automation2Controller@emailTemplate');
    Route::match(['get', 'post'], 'automation2/{uid}/action/edit', 'Automation2Controller@actionEdit');
    Route::match(['get', 'post'], 'automation2/{uid}/trigger/edit', 'Automation2Controller@triggerEdit');
    Route::post('automation2/{uid}/action/select', 'Automation2Controller@actionSelect');
    Route::get('automation2/{uid}/action/select/confirm', 'Automation2Controller@actionSelectConfirm');
    Route::get('automation2/{uid}/action/select', 'Automation2Controller@actionSelectPupop');
    Route::post('automation2/{uid}/trigger/select', 'Automation2Controller@triggerSelect');
    Route::get('automation2/{uid}/trigger/select', 'Automation2Controller@triggerSelectPupop');
    Route::get('automation2/{uid}/trigger/select/confirm', 'Automation2Controller@triggerSelectConfirm');
    Route::match(['get'], 'automation2/{uid}/edit', 'Automation2Controller@edit');
    Route::match(['get', 'post'], 'automation2/wizard', 'Automation2Controller@wizard');
    Route::get('automation2/wizard/trigger', 'Automation2Controller@wizardTrigger');
    Route::match(['get', 'post'], 'automation2/wizard/trigger/option', 'Automation2Controller@wizardTriggerOption');
    Route::get('automation2/wizard/trigger/option/field-select', 'Automation2Controller@wizardListFieldSelect');
    Route::patch('automation2/disable', 'Automation2Controller@disable');
    Route::patch('automation2/enable', 'Automation2Controller@enable');
    Route::delete('automation2/delete', 'Automation2Controller@delete');
    Route::get('automation2/listing', 'Automation2Controller@listing');
    Route::get('automation2', 'Automation2Controller@index');
    Route::get('automation2/{uid}/debug', 'Automation2Controller@debug');
    Route::get('automation2/{automation}/{subscriber}/trigger', 'Automation2Controller@triggerNow');
    Route::get('trigger/{id}', 'AutoTrigger@show');
    Route::get('trigger/{id}/check', 'AutoTrigger@check');
    Route::get('automation2/{automation}/run', 'Automation2Controller@run');

    // Mail list
    Route::get('lists/{uid}/email-verification/chart', 'MailListController@emailVerificationChart');
    Route::get('lists/{uid}/clone-to-customers/choose', 'MailListController@cloneForCustomersChoose');
    Route::post('lists/{uid}/clone-to-customers', 'MailListController@cloneForCustomers');

    Route::get('lists/{uid}/verification/{job_uid}/progress', 'MailListController@verificationProgress');
    Route::get('lists/{uid}/verification', 'MailListController@verification');
    Route::post('lists/{uid}/verification/start', 'MailListController@startVerification');
    Route::post('lists/{uid}/verification/{job_uid}/stop', 'MailListController@stopVerification');
    Route::post('lists/{uid}/verification/reset', 'MailListController@resetVerification');
    Route::match(['get', 'post'], 'lists/copy', 'MailListController@copy');
    Route::get('lists/quick-view', 'MailListController@quickView');
    Route::get('lists/{uid}/list-growth', 'MailListController@listGrowthChart');
    Route::get('lists/{uid}/list-statistics-chart', 'MailListController@statisticsChart');
    Route::get('lists/sort', 'MailListController@sort');
    Route::get('lists/listing/{page?}', 'MailListController@listing');
    Route::post('lists/delete', 'MailListController@delete');
    Route::get('lists/delete/confirm', 'MailListController@deleteConfirm');
    Route::get('lists/{uid}/overview', 'MailListController@overview')->name('mail_list');
    Route::resource('lists', 'MailListController');
    Route::get('lists/{uid}/edit', 'MailListController@edit');
    Route::patch('lists/{uid}/update', 'MailListController@update');
    Route::match(['get', 'post'], 'lists/{uid}/embedded-form', 'MailListController@embeddedForm');
    Route::get('lists/{uid}/embedded-form-frame', 'MailListController@embeddedFormFrame');

    // Field
    Route::get('lists/{list_uid}/fields', 'FieldController@index');
    Route::get('lists/{list_uid}/fields/sort', 'FieldController@sort');
    Route::post('lists/{list_uid}/fields/store', 'FieldController@store');
    Route::get('lists/{list_uid}/fields/sample/{type}', 'FieldController@sample');
    Route::get('lists/{list_uid}/fields/{uid}/delete', 'FieldController@delete');

    // Subscriber
    Route::match(['get', 'post'], 'lists/{list_uid}/subscribers/assign-values', 'SubscriberController@assignValues');
    Route::match(['get', 'post'], 'lists/{list_uid}/subscribers/bulk-delete', 'SubscriberController@bulkDelete');

    Route::post('lists/{list_uid}/subscriber/{uid}/remove-tag', 'SubscriberController@removeTag');
    Route::match(['get', 'post'], 'lists/{list_uid}/subscriber/{uid}/update-tags', 'SubscriberController@updateTags');

    Route::post('lists/{list_uid}/subscribers/resend/confirmation-email/{uids?}', 'SubscriberController@resendConfirmationEmail');
    Route::post('subscriber/{uid}/verification/start', 'SubscriberController@startVerification');
    Route::post('subscriber/{uid}/verification/reset', 'SubscriberController@resetVerification');
    Route::get('lists/{from_uid}/copy-move-from/{action}', 'SubscriberController@copyMoveForm');
    Route::post('subscribers/move', 'SubscriberController@move');
    Route::post('subscribers/copy', 'SubscriberController@copy');
    Route::get('lists/{list_uid}/subscribers', 'SubscriberController@index');
    Route::get('lists/{list_uid}/subscribers/create', 'SubscriberController@create');
    Route::get('lists/{list_uid}/subscribers/listing', 'SubscriberController@listing');
    Route::post('lists/{list_uid}/subscribers/store', 'SubscriberController@store');
    Route::get('lists/{list_uid}/subscribers/{uid}/edit', 'SubscriberController@edit');
    Route::patch('lists/{list_uid}/subscribers/{uid}/update', 'SubscriberController@update');
    Route::post('lists/{list_uid}/subscribers/delete', 'SubscriberController@delete');
    Route::get('lists/{list_uid}/subscribers/delete', 'SubscriberController@delete');
    Route::post('lists/{list_uid}/subscribers/subscribe', 'SubscriberController@subscribe');
    Route::post('lists/{list_uid}/subscribers/unsubscribe', 'SubscriberController@unsubscribe');

    Route::get('lists/{list_uid}/subscribers/import', 'SubscriberController@import');
    Route::post('lists/{list_uid}/subscribers/import/dispatch', 'SubscriberController@dispatchImportJob');
    Route::get('lists/{list_uid}/import/{job_uid}/progress', 'SubscriberController@importProgress');
    Route::get('lists/import/{job_uid}/log/download', 'SubscriberController@downloadImportLog');
    Route::post('lists/import/{job_uid}/cancel', 'SubscriberController@cancelImport');

    Route::get('lists/{list_uid}/subscribers/export', 'SubscriberController@export');
    Route::post('lists/{list_uid}/subscribers/export/dispatch', 'SubscriberController@dispatchExportJob');
    Route::get('lists/export/{job_uid}/progress', 'SubscriberController@exportProgress');
    Route::get('lists/export/{job_uid}/log/download', 'SubscriberController@downloadExportedFile');
    Route::post('lists/export/{job_uid}/cancel', 'SubscriberController@cancelExport');

    // Segment
    Route::get('segments/condition-value-control', 'SegmentController@conditionValueControl');
    Route::get('segments/select_box', 'SegmentController@selectBox');
    Route::get('lists/{list_uid}/segments', 'SegmentController@index');
    Route::get('lists/{list_uid}/segments/{uid}/subscribers', 'SegmentController@subscribers');
    Route::get('lists/{list_uid}/segments/{uid}/listing_subscribers', 'SegmentController@listing_subscribers');
    Route::get('lists/{list_uid}/segments/create', 'SegmentController@create');
    Route::get('lists/{list_uid}/segments/listing', 'SegmentController@listing');
    Route::post('lists/{list_uid}/segments/store', 'SegmentController@store');
    Route::get('lists/{list_uid}/segments/{uid}/edit', 'SegmentController@edit');
    Route::patch('lists/{list_uid}/segments/{uid}/update', 'SegmentController@update');
    Route::get('lists/{list_uid}/segments/delete', 'SegmentController@delete');
    Route::get('lists/{list_uid}/segments/sample_condition', 'SegmentController@sample_condition');

    // Page
    Route::post('lists/{list_uid}/pages/{alias}/restore-default', 'PageController@restoreDefault');
    Route::get('lists/{list_uid}/pages/{alias}/update', 'PageController@update');
    Route::post('lists/{list_uid}/pages/{alias}/update', 'PageController@update');
    Route::post('lists/{list_uid}/pages/{alias}/preview', 'PageController@preview');


    Route::get('lists/{list_uid}/sign-up', 'PageController@signUpForm');
    Route::post('lists/{list_uid}/sign-up', 'PageController@signUpForm');
    Route::get('lists/{list_uid}/sign-up/{subscriber_uid}/thank-you', 'PageController@signUpThankyouPage');
    Route::get('lists/{list_uid}/subscribe-confirm/{uid}/{code}', 'PageController@signUpConfirmationThankyou');
    Route::get('lists/{list_uid}/unsubscribe/{uid}/{code}', 'PageController@unsubscribeForm')->name('unsubscribeForm');
    Route::post('lists/{list_uid}/unsubscribe/{uid}/{code}', 'PageController@unsubscribeForm');
    Route::get('lists/{list_uid}/unsubscribe-success/{uid}', 'PageController@unsubscribeSuccessPage');
    Route::get('lists/{list_uid}/update-profile/{uid}/{code}', 'PageController@profileUpdateForm')->name('updateProfileUrl');
    Route::post('lists/{list_uid}/update-profile/{uid}/{code}', 'PageController@profileUpdateForm');
    Route::get('lists/{list_uid}/update-profile-success/{uid}', 'PageController@profileUpdateSuccessPage');
    Route::get('lists/{list_uid}/profile-update-email-sent/{uid}', 'PageController@profileUpdateEmailSent');

  //Subscriber avatar
    Route::get('assets/images/avatar/subscriber-{uid?}.jpg', 'SubscriberController@avatar');
// Sender
    Route::get('senders/dropbox', 'SenderController@dropbox');
    Route::get('senders/listing/{page?}', 'SenderController@listing');
    Route::get('senders/sort', 'SenderController@sort');
    Route::get('senders/delete', 'SenderController@delete');
    Route::resource('senders', 'SenderController');

// Category
    Route::name('service-categories.')->prefix('service-categories/')->group(function () {

    Route::get('/', 'CategoryController@index');
    Route::get('add-categories', 'CategoryController@create');
    Route::post('store', 'CategoryController@store');
    Route::post('storesub', 'CategoryController@storesub');
    Route::get('edit/{id}', 'CategoryController@edit');
    Route::post('update', 'CategoryController@update');
    Route::get('delete/{id}', 'CategoryController@destroy');
});

    // Question
    Route::name('questions.')->prefix('questions/')->group(function () {
        // Route::get('/', 'QuestionController@index');
        Route::get('/', 'QuestionController@index');
        Route::get('add-question', 'QuestionController@create');
        Route::post('store', 'QuestionController@store');
        Route::post('searchcategory', 'QuestionController@searchcategory');
        Route::get('delete/{id}', 'QuestionController@destroy');
        Route::get('editquestion/{id}', 'QuestionController@editquestion');
        Route::get('deletequestion/{id}', 'QuestionController@deletequestion');
        Route::get('deleteoption/{id}', 'QuestionController@deleteoption');
        Route::get('deleteChoice/{id}', 'QuestionController@deletechoice');
        Route::get('/categories', 'QuestionController@vuedata');
        Route::get('/categories/{id}', 'QuestionController@categoriesbyid');
        Route::post('updateOrder', 'QuestionController@updateOrder');

    });

    // Domains
    Route::get('customs-domains', 'UserController@domainlist');
    Route::get('domain_status/{id}', 'UserController@domain_status');


});

});
Route::get('super-admin/logout', 'Auth\LoginController@logout')->name('super-admin.logout');
Route::get('/files/{uid}/{name?}', [ function ($uid, $name) {
    // Do not use $user->getAssetsPath($name), avoid one SQL query!
    $path = storage_path('app/users/' . $uid . '/home/files/' . $name);
    $mime_type = \Acelle\Library\File::getFileType($path);
    if (\File::exists($path)) {
        return response()->file($path, array('Content-Type' => $mime_type));
    } else {
        abort(404);
    }
}])->where('name', '.+')->name('user_files');

// assets path for customer thumbs
Route::get('/thumbs/{uid}/{name?}', [ function ($uid, $name) {
    // Do not use $user->getThumbsPath($name), avoid one SQL query!
    $path = storage_path('app/users/' . $uid . '/home/thumbs/' . $name);
    if (\File::exists($path)) {
        $mime_type = \Acelle\Library\File::getFileType($path);
        return response()->file($path, array('Content-Type' => $mime_type));
    } else {
        abort(404);
    }
}])->where('name', '.+')->name('user_thumbs');

// assets path for email
// Deprecated, used for templates generated by older version of Acelle
Route::get('/p/assets/{path}', [ function ($token) {
    // Notice $path should be relative only for acellemail/storage/ folder
    // For example, with a real path of /home/deploy/acellemail/storage/app/sub/example.png => $path = "app/sub/example.png"
    $decodedPath = \Acelle\Library\StringHelper::base64UrlDecode($token);
    $absPath = storage_path($decodedPath);

    if (\File::exists($absPath)) {
        $mime_type = \Acelle\Library\File::getFileType($absPath);
        return response()->file($absPath, array('Content-Type' => $mime_type));
    } else {
        abort(404);
    }
}])->name('public_assets_deprecated');

// assets path for email
Route::get('assets/{dirname}/{basename}', [ function ($dirname, $basename) {
    $dirname = \Acelle\Library\StringHelper::base64UrlDecode($dirname);
    $absPath = storage_path(join_paths($dirname, $basename));

    if (\File::exists($absPath)) {
        $mimetype = \Acelle\Library\File::getFileType($absPath);
        return response()->file($absPath, array('Content-Type' => $mimetype));
    } else {
        abort(404);
    }
}])->name('public_assets');

// Setting upload path
Route::get('setting/{filename}', 'SettingController@file');

// Translation data
Route::get('/datatable_locale', 'Controller@datatable_locale');
Route::get('/jquery_validate_locale', 'Controller@jquery_validate_locale');

// Term of service
Route::get('/terms-of-service', 'Controller@termsOfService');

    Route::get('user/activate/{token}', 'UserController@activate');
// For visitor with Web UI, loading the right app language
Route::group(['middleware' => ['not_installed', 'not_logged_in']], function () {
    // Helper method to generate other routes for authentication
    Auth::routes();

    Route::get('/login/token/{token}', 'Controller@tokenLogin');
    // Route::get('questionnaire', 'QuestionChoiceController@index');
    Route::post('storeform', 'QuestionChoiceController@storeform');
    Route::get('/validate-token/{api_token}', 'Controller@validateToken');
    Route::get('/disabled', 'Controller@userDisabled');
    Route::get('/offline', 'Controller@offline');
    Route::get('/not-authorized', 'Controller@notAuthorized');
    Route::get('/demo', 'Controller@demo');
    Route::get('/demo/go/{view}', 'Controller@demoGo');
    Route::get('/autologin/{api_token}', 'Controller@autoLogin');
    Route::get('/migrate/run', 'Admin\Upgrade@migrate');

    //Subscriber avatar
    Route::get('assets/images/avatar/subscriber-{uid?}.jpg', 'SubscriberController@avatar');

    // User resend activation email
    Route::get('users/resend-activation-email', 'UserController@resendActivationEmail');

    // Plan
    Route::get('plans/select2', 'PlanController@select2');
    Route::get('super/getstates/{id}','ServiceProvider\QuoteController@supergetstates');
    Route::get('super/getcities/{id}','ServiceProvider\QuoteController@supergetcities');
    // Admin registration
    Route::match(['get', 'post'],'signup', 'UserController@adminregister');
    Route::get('admin/activate/{token}', 'UserController@adminActivate');

});

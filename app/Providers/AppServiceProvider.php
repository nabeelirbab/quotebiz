<?php

namespace Acelle\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use URL;
use Acelle\Model\Setting;
use Acelle\Library\HookManager;
use Acelle\Model\Plugin;
use Acelle\Model\Notification;
use Acelle\Library\BillingManager;
use Acelle\Library\Facades\Hook;
use Illuminate\Http\Request;
use Config;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Teak default settings (PHP, Laravel, etc.)
        $this->changeDefaultSettings();

        // Add custom validation rules
        // @deprecated
        $this->addCustomValidationRules();

        // Just finish if the application is not set up
        if (!isInitiated()) {
            return;
        }

        // Load application's plugins
        // Disabled plugin may also register hooks
        $this->loadPlugins();
          // $mailer = Setting::get('mailer.mailer') ?: Setting::get('mailer.driver');
        // $domain = $this->get_domain(request()->getHost());
        $domain = request()->getHost();
          $config = [
        'default' => Setting::getmail('mailer.mailer', $domain),
        'local_domain' =>  Setting::getmail('mailer.host', $domain),
        'mailers' => [
            'smtp' => [
                'transport' => 'smtp',
                'host' => Setting::getmail('mailer.host', $domain),
                'port' => Setting::getmail('mailer.port', $domain),
                'username' => Setting::getmail('mailer.username', $domain),
                'password' => Setting::getmail('mailer.password', $domain),
                'encryption' => Setting::getmail('mailer.encryption', $domain),
                'timeout' => null,
                'auth_mode' => null,
            ],
            // Add other mailers if needed
        ],
        'from' => [
            'address' => 'info@floridadjs.com', // This can be dynamic as well if needed
            'name' => 'Your Name or Default Name',
        ],
    ];
        Config::set('mail', $config);
    }

    /**
     * Register any application services.
     *
     * @return void
     */

   public function get_domain($url) {
    
        // Define the regular expression pattern to extract the subdomain
        $pattern = '/^(?P<subdomain>[a-zA-Z0-9-]+)\./';

        // Perform the match
        if (preg_match($pattern, $url, $matches)) {
            // Extracted subdomain
            $subdomain = $matches['subdomain'];
            
            // Output the result
            return $subdomain;
        } else {
            // No subdomain found
            return false;
        }
    }

    public function register()
    {

      
        
        $this->app->singleton(HookManager::class, function ($app) {
            return new HookManager();
        });

        $this->app->singleton(BillingManager::class, function ($app) {
            return new BillingManager();
        });

        Hook::register('add_translation_file', function () {
            return [
                "id" => "acelle_messages",
                "plugin_name" => "Acelle/Core",
                "file_title" => "Messages",
                "translation_folder" => base_path('resources/lang'),
                "file_name" => "messages.php",
                "default" => "default",
                "type" => 'default',
            ];
        });

        Hook::register('add_translation_file', function () {
            return [
                "id" => "acelle_auth",
                "plugin_name" => "Acelle/Core",
                "file_title" => "Auth",
                "translation_folder" => base_path('resources/lang'),
                "file_name" => "auth.php",
                "default" => "default",
                "type" => 'default',
            ];
        });

        Hook::register('add_translation_file', function () {
            return [
                "id" => "acelle_pagination",
                "plugin_name" => "Acelle/Core",
                "file_title" => "Pagination",
                "translation_folder" => base_path('resources/lang'),
                "file_name" => "pagination.php",
                "default" => "default",
                "type" => 'default',
            ];
        });

        Hook::register('add_translation_file', function () {
            return [
                "id" => "acelle_passwords",
                "plugin_name" => "Acelle/Core",
                "file_title" => "Passwords",
                "translation_folder" => base_path('resources/lang'),
                "file_name" => "passwords.php",
                "default" => "default",
                "type" => 'default',
            ];
        });

        Hook::register('add_translation_file', function () {
            return [
                "id" => "acelle_builder",
                "plugin_name" => "Acelle/Core",
                "file_title" => "Builder",
                "translation_folder" => base_path('resources/lang'),
                "file_name" => "builder.php",
                "default" => "default",
                "type" => 'default',
            ];
        });

        Hook::register('add_translation_file', function () {
            return [
                "id" => "acelle_validation",
                "plugin_name" => "Acelle/Core",
                "file_title" => "Validation",
                "translation_folder" => base_path('resources/lang'),
                "file_name" => "validation.php",
                "default" => "default",
                "type" => 'default',
            ];
        });

    }

    private function loadPlugins()
    {
        try {
            Plugin::autoload();
            Notification::cleanupDuplicateNotifications('Plugin Error');
        } catch (\Exception $ex) {
            // Just in case
            Notification::warning([
                'message' => 'Cannot load Acelle plugins. Error: '.htmlspecialchars($ex->getMessage()),
                'title' => 'Plugin Error',
            ]);
        }
    }

    // @deprecated
    private function addCustomValidationRules()
    {
        // extend substring validator
        Validator::extend('substring', function ($attribute, $value, $parameters, $validator) {
            $tag = $parameters[0];
            if (strpos($value, $tag) === false) {
                return false;
            }

            return true;
        });
        Validator::replacer('substring', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':tag', $parameters[0], $message);
        });

        // License validator
        Validator::extend('license', function ($attribute, $value, $parameters, $validator) {
            return $value == '' || true;
        });

        // License error validator
        Validator::extend('license_error', function ($attribute, $value, $parameters, $validator) {
            return false;
        });
        Validator::replacer('license_error', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':error', $parameters[0], $message);
        });
    }

    private function changeDefaultSettings()
    {
        ini_set('memory_limit', '-1');
        ini_set('pcre.backtrack_limit', 1000000000);

        // Laravel 5.5 to 5.6 compatibility
        Blade::withoutDoubleEncoding();

        // Check if HTTPS (including proxy case)
        $isSecure = false;
        if (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') == 0) {
            $isSecure = true;
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') == 0 || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_SSL'], 'on') == 0) {
            $isSecure = true;
        }

        if ($isSecure) {
            URL::forceScheme('https');
        }

        // HTTP or HTTPS
        // parse_url will return either 'http' or 'https'
        //$scheme = parse_url(config('app.url'), PHP_URL_SCHEME);
        //if (!empty($scheme)) {
        //    URL::forceScheme($scheme);
        //}

        // Fix Laravel 5.4 error
        // [Illuminate\Database\QueryException]
        // SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
        Schema::defaultStringLength(191);

        if (!\App::runningInConsole()) {
            // This is just a trick for getting Controller name in view
            // See https://stackoverflow.com/questions/29549660/get-laravel-5-controller-name-in-view
            // @todo: fix this anti-pattern
            app('view')->composer('*', function ($view) {
                $route = app('request')->route();
                if (is_null($route)) {
                    return;
                }

                $action = app('request')->route()->getAction();

                if (!array_key_exists('controller', $action)) {
                    return;
                }

                $controller = class_basename($action['controller']);
                list($controller, $action) = explode('@', $controller);
                $view->with(compact('controller', 'action'));
            });
        }
    }
}

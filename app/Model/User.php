<?php

/**
 * User class.
 *
 * Model class for user
 *
 * LICENSE: This product includes software developed at
 * the Acelle Co., Ltd. (http://acellemail.com/).
 *
 * @category   MVC Model
 *
 * @author     N. Pham <n.pham@acellemail.com>
 * @author     L. Pham <l.pham@acellemail.com>
 * @copyright  Acelle Co., Ltd
 * @license    Acelle Co., Ltd
 *
 * @version    1.0
 *
 * @link       http://acellemail.com
 */

namespace Acelle\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Acelle\Notifications\ResetPassword;
use Acelle\Library\Log as MailLog;
use Acelle\Library\ExtendedSwiftMessage;
use Acelle\Model\Setting;
use Illuminate\Http\UploadedFile;
use App;
use URL;
use File;
use Acelle\Library\Tool;
use Acelle\Library\Traits\HasUid;

class User extends Authenticatable
{
    use Notifiable;
    use HasUid;

    public const BASE_DIR = 'app/users';
    public const ASSETS_DIR = 'home/files';
    public const ASSETS_THUMB_DIR = 'home/thumbs';
    public const PROFILE_IMAGE_PATH = 'home/avatar';
    public const PROFILE_THUMB_PATH = 'home/avatar-thumb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'title', 'email', 'first_name', 'last_name','subdomain','mobileno','biography','user_type','date_format','fcm_token','admin_address','country','state','city','zipcode','address','activated','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = array('allQuoteSp');

public static $itemsPerPage = 25;
    /**
     * Associations.
     *
     * @var object | collect
     */
    public function category()
    {
        return $this->belongsTo('Acelle\Model\Category');
    }

     public function customans()
    {
        return $this->hasMany('Acelle\Model\CustomFieldAnswer');
    }
    
    public function customer()
    {
        return $this->belongsTo('Acelle\Model\Customer');
    }

    public function subdomain()
    {
        return $this->hasOne('Acelle\Model\Subdomain');
    }

    public function customdomain()
    {
        return $this->hasOne('Acelle\Model\Subdomain');
    }

    public function chatcustomer()
    {
        return $this->hasOne('Acelle\Model\Quotation','customer_id','id');
    }

    public function chatsp()
    {
        return $this->hasOne('Acelle\Model\Quotation','user_id','id');
    }

    public function business()
    {
        return $this->hasOne('Acelle\Model\SpBusiness','user_id','id');
    }

    public function gallery()
    {
        return $this->hasMany('Acelle\Model\GalleryImage');
    }

    public function allQuoteSp()
    {
        return $this->hasMany('Acelle\Model\Quotation','user_id','id');
    }

    public function stripekey()
    {
        return $this->hasOne('Acelle\Model\StripeKey');
    }

    public function creadits()
    {
        return $this->hasMany('Acelle\Model\BuyCreadit')->orderBy('id','desc');
    }
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function profile()
    {
        return $this->visits()->where('track_type', 'profile_view');
    }
    public function website()
    {
        return $this->visits()->where('track_type', 'website');
    }
    public function emailview()
    {
        return $this->visits()->where('track_type', 'email');
    }
    public function mobile()
    {
        return $this->visits()->where('track_type', 'phone');
    }
    public function language()
    {
        return $this->belongsTo('Acelle\Model\Language');
    }
    public function admin()
    {
        return $this->hasOne('Acelle\Model\Admin');
    }

    public function createUserDirectories()
    {
        $paths = [
            $this->getBasePath(),
            $this->getAssetsPath(),
            $this->getThumbsPath(),
        ];

        foreach ($paths as $path) {
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
        }
    }

    /**
     * Get authenticate from file.
     *
     * @return string
     */
    public static function getAuthenticateFromFile()
    {
        $path = base_path('.authenticate');

        if (file_exists($path)) {
            $content = \File::get($path);
            $lines = explode("\n", $content);
            if (count($lines) > 1) {
                $demo = session()->get('demo');
                if (!isset($demo) || $demo == 'backend') {
                    return ['email' => $lines[0], 'password' => $lines[1]];
                } else {
                    return ['email' => $lines[2], 'password' => $lines[3]];
                }
            }
        }

        return ['email' => '', 'password' => ''];
    }

    /**
     * Send regitration activation email.
     *
     * @return string
     */
    public function sendActivationMail($name = null)
    {
        $layout = \Acelle\Model\Layout::where('alias', 'registration_confirmation_email')->first();
        $token = $this->getToken();
        $sitename = \Acelle\Model\Setting::get("site_name");
        $sitedarklogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));
        $layout->content = str_replace('{ACTIVATION_URL}', join_url(url('user/activate/'.$token)), $layout->content);
        $layout->content = str_replace('{CUSTOMER_NAME}', $name, $layout->content);
        $layout->content = str_replace('{SITE_NAME}', $sitename, $layout->content);
        $layout->content = str_replace('{SITE_URL}', url('/'), $layout->content);
        $layout->content = str_replace('{SITE_LOGO}', $sitedarklogo, $layout->content);
        $layout->content = str_replace('{YEAR}', date('Y'), $layout->content);

        $name = is_null($name) ? trans('messages.to_email_name') : $name;

        // build the message
        $message = new ExtendedSwiftMessage();
        $message->setEncoder(new \Swift_Mime_ContentEncoder_PlainContentEncoder('8bit'));
        $message->setContentType('text/html; charset=utf-8');

        $message->setSubject($layout->subject);
        $message->setFrom(\Acelle\Model\Setting::get('mailer.from.address'), \Acelle\Model\Setting::get("site_name") . ' Team');
        $message->setTo([$this->email => $name]);
        $message->setReplyTo(Setting::get('mail.reply_to'));
        $message->addPart($layout->content, 'text/html');

        $mailer = App::make('xmailer');
        $result = $mailer->sendWithDefaultFromAddress($message);

        if (array_key_exists('error', $result)) {
            throw new \Exception($result['error']);
        }

        MailLog::info('Sent activation email to '.$this->email);
    } 

    public function sendAdminActivationMail($name = null)
    {
        $layout = \Acelle\Model\Layout::where('alias', 'registration_confirmation_email')->first();
        $token = $this->getToken();

        $sitename = 'Quotebiz.io';
        $sitedarklogo = 'https://www.quotebiz.io/wp-content/uploads/2022/03/QB_logo.png';
        $layout->content = str_replace('{ACTIVATION_URL}', join_url(url('admin/activate/'.$token)), $layout->content);
        $layout->content = str_replace('{CUSTOMER_NAME}', $name, $layout->content);
        $layout->content = str_replace('{SITE_NAME}', $sitename, $layout->content);
        $layout->content = str_replace('{SITE_URL}', url('/'), $layout->content);
        $layout->content = str_replace('{SITE_LOGO}', $sitedarklogo, $layout->content);
        $layout->content = str_replace('{YEAR}', date('Y'), $layout->content);

        $name = is_null($name) ? trans('messages.to_email_name') : $name;

        // build the message
        $message = new ExtendedSwiftMessage();
        $message->setEncoder(new \Swift_Mime_ContentEncoder_PlainContentEncoder('8bit'));
        $message->setContentType('text/html; charset=utf-8');

        $message->setSubject($layout->subject);
        $message->setTo([$this->email => $name]);
        $message->setReplyTo(Setting::get('mail.reply_to'));
        $message->addPart($layout->content, 'text/html');

        $mailer = App::make('xmailer');
        $result = $mailer->sendWithDefaultFromAddress($message);

        if (array_key_exists('error', $result)) {
            throw new \Exception($result['error']);
        }

        MailLog::info('Sent activation email to '.$this->email);
    }

    /**
     * The rules for validation.
     *
     * @var array
     */
    
    public function rulesupdate()
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'timezone' => 'required',
            'language_id' => 'required',
        );

        if (isset($this->id)) {
            $rules['password'] = 'nullable|confirmed|min:5';
        } else {
            $rules['password'] = 'required|confirmed|min:5';
        }

        return $rules;
    }
    public function rules()
    {
        $rules = array(
            'email' => 'required|email|unique:users,email,'.$this->id.',id',
            'first_name' => 'required|string|max:10|min:2', // First name: 2-10 characters
            'last_name' => 'required|string|max:10|min:2',  // Last name: 2-10 characters
            'timezone' => 'required',
            'language_id' => 'required',
            'date_format' => 'required',
        );

        if (isset($this->id)) {
            $rules['password'] = 'nullable|confirmed|min:5';
        } else {
            $rules['password'] = 'required|confirmed|min:5';
        }

        return $rules;
    }

    /**
     * The rules for validation.
     *
     * @var array
     */
    public function registerRules($subdomain)
    {
        $rules = array(
            'subdomain' => 'required|unique:subdomains,subdomain,'.$this->id.',id',
            'email' => 'required|email|unique:users,email,'.$this->id.',id,subdomain,'.$subdomain,
            'first_name' => 'required|string|max:10|min:2', // First name: 2-10 characters
            'last_name' => 'required|string|max:10|min:2',  // Last name: 2-10 characters
        );

        if (isset($this->id)) {
            $rules['password'] = 'min:5';
        } else {
            $rules['password'] = 'required|min:5';
        }

        return $rules;
    }

    public function registerRules2($subdomain)
    {
        $rules = array(
            
            'email' => 'required|email|unique:users,email,'.$this->id.',id,subdomain,'.$subdomain,
            'first_name' => 'required|string|max:10|min:2', // First name: 2-10 characters
            'last_name' => 'required|string|max:10|min:2',  // Last name: 2-10 characters
            'category_id' => 'required',
        );

        if (isset($this->id)) {
            $rules['password'] = 'min:5';
        } else {
            $rules['password'] = 'required|min:5';
        }

        return $rules;
    }

    /**
     * The rules for validation via api.
     *
     * @var array
     */
    public function apiRules()
    {
        return array(
            'email' => 'required|email|unique:users,email,'.$this->id.',id',
            'first_name' => 'required',
            'last_name' => 'required',
            'timezone' => 'required',
            'language_id' => 'required',
            'password' => 'required|min:5',
        );
    }

    /**
     * The rules for validation via api.
     *
     * @var array
     */
    public function apiUpdateRules($request)
    {
        $arr = [];

        if (isset($request->email)) {
            $arr['email'] = 'required|email|unique:users,email,'.$this->id.',id';
        }
        if (isset($request->first_name)) {
            $arr['first_name'] = 'required';
        }
        if (isset($request->last_name)) {
            $arr['last_name'] = 'required';
        }
        if (isset($request->timezone)) {
            $arr['timezone'] = 'required';
        }
        if (isset($request->language_id)) {
            $arr['language_id'] = 'required';
        }
        if (isset($request->password)) {
            $arr['password'] = 'min:5';
        }

        return $arr;
    }

    /**
     * Display customer name: first_name last_name.
     *
     * @var string
     */
    public function displayName()
    {
        return htmlspecialchars(trim($this->first_name.' '.$this->last_name));
    }

    /**
     * User activation.
     *
     * @return string
     */
    public function userActivation()
    {
        return $this->hasOne('Acelle\Model\userActivation');
    }

    /**
     * Create activation token for user.
     *
     * @return string
     */
    public function getToken()
    {
        $token = \Acelle\Model\UserActivation::getToken();

        $userActivation = $this->userActivation;

        if (!is_object($userActivation)) {
            $userActivation = new \Acelle\Model\UserActivation();
            $userActivation->user_id = $this->id;
        }

        $userActivation->token = $token;
        $userActivation->save();

        return $token;
    }

    /**
     * Set user is activated.
     *
     * @return bool
     */
    public function setActivated()
    {
        $this->activated = true;
        $this->save();
    }

    /**
     * Bootstrap any application services.
     */
    public static function boot()
    {
        parent::boot();

        // Create uid when creating list.
        static::creating(function ($item) {
            // Create new uid
            $uid = uniqid();
            $item->uid = $uid;

            // Add api token
            $item->api_token = str_random(60);
        });
    }

    /**
     * Check if user has admin account.
     */
    public function isAdmin()
    {
        return is_object($this->admin);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new ResetPassword($token, url('password/reset', $token)));

        $layout = \Acelle\Model\Layout::where('alias', 'reset_password')->first();
        $sitename = \Acelle\Model\Setting::get("site_name");
        $sitedarklogo = action('SettingController@file', \Acelle\Model\Setting::get('site_logo_dark'));
        $layout->content = str_replace('{RESET_URL}', join_url(url('password/reset', $token)), $layout->content);
        
        $layout->content = str_replace('{SITE_NAME}', $sitename, $layout->content);
        $layout->content = str_replace('{SITE_URL}', url('/'), $layout->content);
        $layout->content = str_replace('{SITE_LOGO}', $sitedarklogo, $layout->content);
        
        // $htmlContent = '<p>Please click the link below to reset your password:<br><a href="'.$resetPasswordUrl.'">'.$resetPasswordUrl.'</a>';

        // build the message
        $message = new ExtendedSwiftMessage();
        $message->setEncoder(new \Swift_Mime_ContentEncoder_PlainContentEncoder('8bit'));
        $message->setContentType('text/html; charset=utf-8');

        $message->setSubject('Password Reset');
        $message->setTo($this->email);
        $message->setReplyTo(Setting::get('mail.reply_to'));
        $message->addPart($layout->content, 'text/html');

        $mailer = App::make('xmailer');
        $result = $mailer->sendWithDefaultFromAddress($message);

        if (array_key_exists('error', $result)) {
            throw new \Exception($result['error']);
        }
    }

    public function getLockPath($path)
    {
        $base = $this->getBasePath('locks');

        if (!\File::exists($base)) {
            \File::makeDirectory($base, 0777, true, true);
        }

        return join_paths($base, $path);
    }

    public function getAssetsPath($path = null)
    {
        $base = $this->getBasePath(self::ASSETS_DIR);

        if (!\File::exists($base)) {
            \File::makeDirectory($base, 0777, true, true);
        }

        return join_paths($base, $path);
    }

    public function getThumbsPath($path = null)
    {
        $base = $this->getBasePath(self::ASSETS_THUMB_DIR);

        if (!\File::exists($base)) {
            \File::makeDirectory($base, 0777, true, true);
        }

        return join_paths($base, $path);
    }

    public function getBasePath($path = null)
    {
        $base = storage_path(join_paths(self::BASE_DIR, $this->uid));

        if (!\File::exists($base)) {
            \File::makeDirectory($base, 0777, true, true);
        }

        return join_paths($base, $path);
    }

    /**
     * Generate one time token.
     */
    public function generateOneTimeToken()
    {
        $this->one_time_api_token = generateRandomString(32);
        $this->save();
    }

    /**
     * Clear one time token.
     */
    public function clearOneTimeToken()
    {
        $this->one_time_api_token = null;
        $this->save();
    }

    public function getAssetsSubUrl()
    {
        $appSubDirectory = \Acelle\Helpers\getAppSubdirectory();
        $appSubDirectory = (is_null($appSubDirectory)) ? '' : $appSubDirectory;

        // Returns a relative subpath like "/files/000000"
        $subpath = route('user_files', ['uid' => $this->uid], false);
        return join_paths($appSubDirectory, $subpath);
    }

    public function getThumbsSubUrl()
    {
        $appSubDirectory = \Acelle\Helpers\getAppSubdirectory();
        $appSubDirectory = (is_null($appSubDirectory)) ? '' : $appSubDirectory;

        // Returns a relative subpath like "/thumbs/000000"
        $subpath = route('user_thumbs', ['uid' => $this->uid], false) ;
        return join_paths($appSubDirectory, $subpath);
    }

    public function getFilemanagerConfig()
    {
        // Create user directories if not exists
        $this->createUserDirectories();

        // Base URL with port, but without subpath
        $baseUrl = parse_url(url('/'));

        // port may be null
        if (!array_key_exists('port', $baseUrl)) {
            $baseUrl['port'] = '';
        }

        $baseUrl = "{$baseUrl['scheme']}://{$baseUrl['host']}{$baseUrl['port']}";

        // Limitation
        // Since this method is called from within the dialog.php file, there is no way to know if whether or not it is an admin or customer session
        // So, there is no chance to apply quota here
        if ($this->customer) {
            // Limited by plan
            $maxSizeTotal = $this->customer->getOption("max_size_upload_total") > 0 ? $this->customer->getOption("max_size_upload_total") : 2048;
            $maxSizeUpload = $this->customer->getOption("max_file_size_upload") > 0 ? $this->customer->getOption("max_file_size_upload") : 2048;
        } else {
            // Virtually unlimited
            $maxSizeTotal = 2048;
            $maxSizeUpload = 2048;
        }

        $config = [
            'base_url' => $baseUrl,

            // The `upload_dir` is needed to make the final file URL which is compatible with `user_files` route
            // For example: "/files/000000/example.jpg"
            'upload_dir' => join_paths('/', $this->getAssetsSubUrl(), '/'),
            'thumb_dir' => join_paths('/', $this->getThumbsSubUrl(), '/'),
            'thumbs_upload_dir' => join_paths('/', $this->getThumbsSubUrl(), '/'),
            // relative path from filemanager folder to upload folder, WITH FINAL /
            'current_path' => join_paths('../../storage/', self::BASE_DIR, $this->uid, self::ASSETS_DIR, '/'),
            // relative path from filemanager folder to upload folder, WITH FINAL /
            'thumbs_base_path' => join_paths('../../storage/', self::BASE_DIR, $this->uid, self::ASSETS_THUMB_DIR, '/'),
            'MaxSizeTotal' => $maxSizeTotal,
            'MaxSizeUpload' => $maxSizeUpload,
        ];

        return $config;
    }

    public function getProfileImageUrl()
    {
        $path = $this->getProfileImagePath();
        if (file_exists($path)) {
            return \Acelle\Helpers\generatePublicPath($path);
        } else {
            return URL::asset('images/user-placeholder.svg');
        }
    }

    public function getProfileThumbUrl()
    {
        $path = $this->getProfileThumbPath();
        if (file_exists($path)) {
            return \Acelle\Helpers\generatePublicPath($path);
        } else {
            return URL::asset('images/user-placeholder.svg');
        }
    }

    public function getProfileImagePath()
    {
        return $this->getBasePath(self::PROFILE_IMAGE_PATH);
    }

    public function getProfileThumbPath()
    {
        return $this->getBasePath(self::PROFILE_THUMB_PATH);
    }

    /**
     * Upload and resize avatar.
     *
     * @var void
     */
    public function uploadProfileImage(UploadedFile $file)
    {
        // Full path: /storage/app/users/000000/home/avatar
        $path = $this->getProfileImagePath();

        // File name: avatar
        $filename = basename($path);

        // The base dir: /storage/app/users/000000/home/
        $dirname = dirname($path);

        // save to server at /storage/app/users/000000/home/avatar
        $file->move($dirname, $filename);

        // create thumbnails and replace the original image with the the small-sized thumbnail
        $img = \Image::make($path);
        $img->fit(120, 120)->save($path);

        return $path;
    }

    public function removeProfileImage()
    {
        $path = $this->getProfileImagePath();
        if (file_exists($path)) {
            File::delete($path);
        }

        $thumb = $this->getProfileThumbPath();
        if (file_exists($thumb)) {
            File::delete($thumb);
        }
    }

    public function deleteAndCleanup()
    {
        // User's storage location
        // For example: storage/app/users/000000/
        $path = $this->getBasePath();
        if (file_exists($path)) {
            Tool::xdelete($path);
        }

        $this->delete();
    }
}

<?php

namespace Acelle\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as LaravelLog;
use Acelle\Model\Setting;
use Acelle\Model\Subdomain;
use Acelle\Library\UpgradeManager;
use Acelle\Library\ExtendedSwiftMessage;
use Acelle\Model\Language;
use Acelle\Model\Template;
use Acelle\Model\MailSetting;
use Illuminate\Support\Facades\Session;
use Acelle\Helpers\LicenseHelper;
use Illuminate\Support\Facades\DB;
use Auth;
use App;

class SettingController extends Controller
{
    /**
     * Render uploaded file.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function file(Request $request, $filename)
    {
        //return \Image::make(Setting::getUploadFilePath($filename))->response();
        $path = Setting::getUploadFilePath($filename);
        $type = mime_content_type($path);
        if ($type == 'image/svg') {
            $type = 'image/svg+xml';
        }
        return response()->file($path, ['Content-Type' => $type]);
    }

    public function customdomain(Request $request){

         if ($request->isMethod('post')) {
             Subdomain::where('user_id',Auth::user()->id)->update(['parent'=> $request->parent]);
             return redirect()->back()->with('success', 'Domain add successfully');   
         }
         return view('customDomain');
    }
    public function googledomain(Request $request){

         if ($request->isMethod('post')) {
             Subdomain::where('user_id',Auth::user()->id)->update(['parent'=> $request->parent]);
             return redirect()->back()->with('success', 'Domain add successfully');   
         }
         return view('googleDomain');
    }

    public function domainStatus(Request $request){
        Subdomain::where('user_id',Auth::user()->id)->update(['status'=> $request->get('status')]);
         return redirect()->back()->with('success', 'Domain status changed successfully');   
    }


    public function savemail(Request $request){
        
         if ($request->old('env')) {
            $mailSettings = $request->old('env');
        } else {
            // SMTP
            $mailSettings = [
                'MAIL_MAILER' => Setting::getByDomain('mailer.mailer') ?: Setting::getByDomain('mailer.driver'), // Laravel 5.8 compatibility
                'MAIL_HOST' => Setting::getByDomain('mailer.host'),
                'MAIL_PORT' => Setting::getByDomain('mailer.port'),
                'MAIL_USERNAME' => Setting::getByDomain('mailer.username'),
                'MAIL_PASSWORD' => Setting::getByDomain('mailer.password'),
                'MAIL_ENCRYPTION' => Setting::getByDomain('mailer.encryption'),
                'MAIL_FROM_ADDRESS' => Setting::getByDomain('mailer.from.address'),
                'MAIL_FROM_NAME' => Setting::getByDomain('mailer.from.name'),
                'sendmail_path' => Setting::getByDomain('mailer.sendmail_path') ?: "/usr/sbin/sendmail",
            ];
        }

         $rules = [
            'smtp' => [
                'env.MAIL_MAILER' => 'required',
                'env.MAIL_HOST' => 'required',
                'env.MAIL_PORT' => 'required',
                'env.MAIL_USERNAME' => 'required',
                'env.MAIL_PASSWORD' => 'required',
                'env.MAIL_FROM_ADDRESS' => 'required|email',
                'env.MAIL_FROM_NAME' => 'required',
            ],
            'sendmail' => [
                'env.MAIL_FROM_ADDRESS' => 'required|email',
                'env.MAIL_FROM_NAME' => 'required',
                'env.sendmail_path' => 'required',
            ],
        ];

        if ($request->isMethod('post')) {
            $mailSettings = $request->input('env');
            $mailSetting = MailSetting::where('Subdomain', Setting::subdomain())->first();

               if ($mailSetting) {
                     DB::statement("
                        UPDATE `mail_settings`
                        SET `mailer.mailer` = ?,
                            `mailer.host` = ?,
                            `mailer.port` = ?,
                            `mailer.encryption` = ?,
                            `mailer.username` = ?,
                            `mailer.password` = ?,
                            `mailer.from.name` = ?,
                            `mailer.from.address` = ?,
                            `mailer.sendmail_path` = ?
                        WHERE `Subdomain` = ?
                    ", [
                        $mailSettings['MAIL_MAILER'],
                        $mailSettings['MAIL_HOST'],
                        $mailSettings['MAIL_PORT'],
                        $mailSettings['MAIL_ENCRYPTION'],
                        $mailSettings['MAIL_USERNAME'],
                        $mailSettings['MAIL_PASSWORD'],
                        $mailSettings['MAIL_FROM_NAME'],
                        $mailSettings['MAIL_FROM_ADDRESS'],
                        $mailSettings['sendmail_path'],
                        Setting::subdomain(),
                    ]);
                }else{
                 DB::statement("
                INSERT INTO `mail_settings` (`Subdomain`, `mailer.mailer`, `mailer.host`, `mailer.port`, `mailer.encryption`, `mailer.username`, `mailer.password`, `mailer.from.name`, `mailer.from.address`, `mailer.sendmail_path`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                `Subdomain` = VALUES(`Subdomain`),
                `mailer.mailer` = VALUES(`mailer.mailer`),
                `mailer.host` = VALUES(`mailer.host`),
                `mailer.port` = VALUES(`mailer.port`),
                `mailer.encryption` = VALUES(`mailer.encryption`),
                `mailer.username` = VALUES(`mailer.username`),
                `mailer.password` = VALUES(`mailer.password`),
                `mailer.from.name` = VALUES(`mailer.from.name`),
                `mailer.from.address` = VALUES(`mailer.from.address`),
                `mailer.sendmail_path` = VALUES(`mailer.sendmail_path`)
            ", [
                Setting::subdomain(),
                $mailSettings['MAIL_MAILER'],
                $mailSettings['MAIL_HOST'],
                $mailSettings['MAIL_PORT'],
                $mailSettings['MAIL_ENCRYPTION'],
                $mailSettings['MAIL_USERNAME'],
                $mailSettings['MAIL_PASSWORD'],
                $mailSettings['MAIL_FROM_NAME'],
                $mailSettings['MAIL_FROM_ADDRESS'],
                $mailSettings['sendmail_path'],
            ]);
            }

           
        }
         return view('settings.mailer', [
            'rules' => $rules,
            'env' => $mailSettings,
        ]);
    }

    public function mailerTest(Request $request)
    {

        // validate and save posted data
        if ($request->isMethod('post')) {
// dd($request->all());
            // Prenvent save from demo mod
            if ($this->isDemoMode()) {
                return view('somethingWentWrong', ['message' => trans('messages.operation_not_allowed_in_demo')]);
            }

            try {
                // build the message
                $message = new ExtendedSwiftMessage();
                $message->setEncoder(new \Swift_Mime_ContentEncoder_PlainContentEncoder('8bit'));
                $message->setContentType('text/html; charset=utf-8');

                $message->setSubject($request->input('subject'));
                $message->setFrom(array('sender@domain.com' => 'Sender'));
                $message->setTo($request->input('to_email'));
                $message->addPart($request->input('content'), 'text/html');

                $mailer = App::make('xmailer');
                $result = $mailer->sendWithDefaultFromAddress($message);
                return response()->json(['status' => 'ok'], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                ], 400);
            }
        }

        return view('settings.mailerTest');
    }
}

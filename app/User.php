<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 发送密码重置通知.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $data = [
            'url' => url('password/reset',$token)
        ];
        /**
         * 重置密码
         * 点击链接 %url%
         */

        $template = new SendCloudTemplate('zhihu_app_reset_password', $data);
        Mail::raw($template, function ($message)  {
            $message->from('postmaster@zhihu.dev', 'zhihu');

            $message->to($this->email);
        });
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $detail;
    public $level;
    public $introLines;
    public $outroLines;
    public $actionText;
    public $actionUrl;
    public $displayableActionUrl;
    public $subcopy;
    public $greeting;

    public function __construct($user)
    {
        $this->level = 'success';
        $this->introLines = [
            __('Thanks for registering on our website!'),
            __('Please click the button below to verify your email address.'),
        ];
        $this->outroLines = [
            __('If you did not create an account, no further action is required.'),
        ];

        $this->greeting = __('Hello!') . ' ' . $user->name . ' ' .  $user->last_name1;

        $this->actionText = __('Verify Email Address');
        $this->actionUrl = url()->previous() . '/api/verifyEmail/' . $user->api_token;
        $this->displayableActionUrl = $this->actionUrl;
        $this->subcopy = __('If you have trouble clicking the ') . $this->actionText . __(' button, copy and paste the URL below into your web browser:') . "<br><br><span class='break-all'>[{$this->displayableActionUrl}]({$this->actionUrl})</span>";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Verify Email Address'))
            ->markdown('emails.accounts.verifyEmail');
    }
}

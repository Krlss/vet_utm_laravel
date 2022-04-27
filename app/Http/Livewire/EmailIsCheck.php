<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class EmailIsCheck extends Component
{
    public $email_verified_at;
    public $send;

    public $api_token;
    public $email;


    public function mount($email_verified_at, $api_token, $email)
    {
        $this->email_verified_at = $email_verified_at;
        $this->send = false;
        $this->api_token = $api_token;
        $this->email = $email;
    }

    public function send_verification()
    {
        sleep(5);

        //host
        $url = substr_replace(explode('dashboard', url()->previous())[0], "", -1);

        //send email
        $detail = [
            'title' => 'Clínica veterinaria de la universidad técnica de manabí',
            'body' => 'Para verificar el correo electrónico da clic en el siguiente link.',
            'api_token' => $this->api_token,
            'backurl' => $url
        ];

        Mail::to($this->email)->send(new VerifyEmail($detail));
        $this->send = true;
    }


    public function render()
    {
        return view('livewire.email-is-check');
    }
}

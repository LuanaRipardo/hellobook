<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

public function testEmail()
{
    $to_email = 'luana.ripardo96@outlook.com';
    $data = [
        'title' => 'Teste de envio de e-mail',
        'body' => 'Este é um teste de envio de e-mail pelo Laravel.'
    ];
    Mail::send('emails.test', $data, function($message) use ($to_email) {
        $message->to($to_email)
                ->subject('Teste de envio de e-mail pelo Laravel');
    });
    return 'E-mail enviado com sucesso.';
}
}

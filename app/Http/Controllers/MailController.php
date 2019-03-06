<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;

class MailController extends Controller
{
    public function basic_email() {
        $data=['name'=>'Felipe S01'];

        Mail::send(['text'=>'mail'], $data, function ($message) {
            $message->to('felipesales007online@hotmail.com', 'felipe 02');
            $message->subject('Envio de mensagem');
            $message->from('felipesales007online@hotmail.com', 'felipe 03');
        });
        echo 'email basico enviado';
    }

    public function html_email() {
        $data=['name'=>'Felipe html01'];

        Mail::send(['text'=>'mail'], $data, function ($message) {
            $message->to('felipesales007online@hotmail.com', 'felipe html02');
            $message->subject('Envio de mensagem com html');
            $message->from('felipesales007online@hotmail.com', 'felipe html03');
        });
        echo 'email com html enviado';
    }

    public function attachment_email() {
        $data=['name'=>'Felipe foto S01'];

        Mail::send(['text'=>'mail'], $data, function ($message) {
            $message->to('felipesales007online@hotmail.com', 'felipe foto02');
            $message->subject('Envio de mensagem com foto');

            $message->attach('/users/felipe/downloads/1.jpg');

            $message->from('felipesales007online@hotmail.com', 'felipe foto03');
        });
        echo 'email com html enviado';
    }
}

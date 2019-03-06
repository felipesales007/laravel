<?php

namespace App\Http\Controllers;
use Mail;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index() {
        $data['titulo'] = "Contato";

        return view('contato', $data);
    }

    public function enviar(Request $request) {
        $dadosEmail = array(
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'assunto' => $request->input('assunto'),
            'msg' => $request->input('msg'),
        );

        Mail::send('email.contato', $dadosEmail, function($message) {
            $message->to('felipesales007@hotmail.com', 'Felipe Sales')
                    ->subject('Formulário de contato');
            $message->from('felipesales007online@hotmail.com', 'Formulário de contato');
            // ->cc('emaitocopial@dominio.com');
        });

        return redirect('contato')->with('success', 'Mensagem enviada, em breve entraremos em contato');
    }
}

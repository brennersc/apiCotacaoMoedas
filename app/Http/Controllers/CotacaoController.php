<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Cotacao;

class CotacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function cotar(Request $request)
    {
        $user   = Auth::user()->name;
        $email  = Auth::user()->email;

        $validator = Validator::make(
            $request->all(),
            [
                'de'    => 'required',
                'para'  => 'required',
            ],
            [
                'required' => 'O :attribute é obrigatorio!',
            ],
        );

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $client = new Client();

            $response = $client->get('https://economia.awesomeapi.com.br/all/'.$request->de.'-'.$request->para.'', [
                'headers' => ['Content-Type' => 'application/json'],
            ]);

            $result = $response->getBody()->getContents();
            $dadosEmJson = json_decode($result, true);
            $result = $dadosEmJson[$request->de];

            //gravar no banco
            $cotacao = new Cotacao();
            $cotacao->nome = $user ;
            $cotacao->email = $email;
            $cotacao->ip = $request->ip();
            $cotacao->de = $request->de;
            $cotacao->para = $request->para;
            $cotacao->cotacao = $result;
            $cotacao->save();
                        
            return $result;

        } catch (RequestException $e) {
            $error = json_decode($e->getResponse()->getBody(), true);
            return $error;
        }
    }
}

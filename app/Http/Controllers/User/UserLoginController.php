<?php

namespace App\Http\Controllers\User;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class UserLoginController extends Controller
{
    public function proses(Request $request){
        $client = new Client();
        $response = Http::post('https://crowdsourcing.usf.my.id/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        $request->session()->put('session', $responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('user.dashboard');
        }

        return redirect('/');

        
    }

    public function dashboard(Request $request){
        $response = $request->session()->get('session');
        if($response['success'] == true){
            return view('user.dashboard');
        }

        dd($response);
    }
}

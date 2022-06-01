<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AdminLoginController extends Controller
{
    public function proses(Request $request){
        $client = new Client();
        $response = Http::post('https://crowdsourcing.usf.my.id/api/admin/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        $request->session()->put('userSession', $responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.dashboard');
        }

        return redirect('/');

        
    }

    public function dashboard(Request $request){
        $response = $request->session()->get('userSession');
        if($response['success'] == true){
            return view('admin.dashboard');
        }

        dd($response);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RincianJasaController extends Controller
{
    public function index(Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/jasa');
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        return view('admin.rincianjasa.index', compact('responseJSON'));
    }

    public function create(Request $request, $id){

        return view('admin.rincianjasa.create', compact('id'));        
    }

    public function store(Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required'
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/rincianjasa/create', [
            'jasa_id' => $request->id,
            'nama' => $request->nama,
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.rincianjasa.index');
        }

        return redirect('/');
    }

    public function edit($id, Request $request){
        $user = $request->session()->get('userSession');

        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/rincianjasa/edit/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON['data']);
        return view('admin.rincianjasa.edit', compact('responseJSON'));
    }

    public function update($id, Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/rincianjasa/edit/'.$id, [
            'nama' => $request->nama
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.rincianjasa.index');
        }

        return redirect('/');
    }

    public function delete($id, Request $request){
        $user = $request->session()->get('userSession');

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/rincianjasa/delete/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.rincianjasa.index');
        }

        return redirect('/');
    }
}

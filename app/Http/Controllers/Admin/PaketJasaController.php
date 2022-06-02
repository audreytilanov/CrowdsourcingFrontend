<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PaketJasaController extends Controller
{
    public function index(Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/paketjasa');
        $responseJSON = json_decode($response->getBody(), true);
        return view('admin.paketjasa.index', compact('responseJSON'));
    }

    public function create(){
        return view('admin.paketjasa.create');        
    }

    public function store(Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/paketjasa/create', [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.paketjasa.index');
        }

        return redirect('/');
    }

    public function edit($id, Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/paketjasa/edit/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON['data']);
        return view('admin.paketjasa.edit', compact('responseJSON'));
    }

    public function update($id, Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/paketjasa/edit/'.$id, [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.paketjasa.index');
        }

        return redirect('/');
    }

    public function delete($id, Request $request){
        $user = $request->session()->get('userSession');

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/paketjasa/delete/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.paketjasa.index');
        }

        return redirect('/');
    }
}

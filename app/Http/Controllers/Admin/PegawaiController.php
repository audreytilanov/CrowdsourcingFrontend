<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PegawaiController extends Controller
{
    public function index(Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/pegawai');
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        return view('admin.pegawai.index', compact('responseJSON'));
    }

    public function create(){
        return view('admin.pegawai.create');        
    }

    public function store(Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'hp' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/pegawai/create', [
            'name' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'password' =>  $request->password,
            'role_id' =>$request->role
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.pegawai.index');
        }

        return redirect('/');
    }

    public function edit($id, Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/pegawai/edit/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON['data']);
        return view('admin.pegawai.edit', compact('responseJSON'));
    }

    public function update($id, Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'hp' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/pegawai/edit/'.$id, [
            'name' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'password' =>  $request->password,
            'role_id' =>$request->role
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.pegawai.index');
        }

        return redirect('/');
    }

    public function delete($id, Request $request){
        $user = $request->session()->get('userSession');

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/pegawai/delete/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.pegawai.index');
        }

        return redirect('/');
    }
}

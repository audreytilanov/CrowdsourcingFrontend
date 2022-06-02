<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class JasaController extends Controller
{
    public function index(Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/jasa');
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responsePaketJasa);
        return view('admin.jasa.index', compact('responseJSON'));
    }

    public function create(Request $request){
        $user = $request->session()->get('userSession');

        $paketjasa = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/paketjasa');
        $kategori = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/kategori');

        $responsePaketJasa = json_decode($paketjasa->getBody(), true);
        $responseKategori = json_decode($kategori->getBody(), true);

        return view('admin.jasa.create', compact('responsePaketJasa', 'responseKategori'));        
    }

    public function store(Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'paketjasa' => 'required',
            'kategori' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/jasa/create', [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'paket_jasa_id' => $request->paketjasa,
            'kategori_id' => $request->kategori,
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.jasa.index');
        }

        return redirect('/');
    }

    public function edit($id, Request $request){
        $user = $request->session()->get('userSession');

        $paketjasa = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/paketjasa');
        $kategori = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/kategori');

        $responsePaketJasa = json_decode($paketjasa->getBody(), true);
        $responseKategori = json_decode($kategori->getBody(), true);
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/jasa/edit/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON['data']);
        return view('admin.jasa.edit', compact('responseJSON','responsePaketJasa', 'responseKategori'));
    }

    public function update($id, Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'paketjasa' => 'required',
            'kategori' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/jasa/edit/'.$id, [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'paket_jasa_id' => $request->paketjasa,
            'kategori_id' => $request->kategori,
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.jasa.index');
        }

        return redirect('/');
    }

    public function delete($id, Request $request){
        $user = $request->session()->get('userSession');

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/jasa/delete/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.jasa.index');
        }

        return redirect('/');
    }
}

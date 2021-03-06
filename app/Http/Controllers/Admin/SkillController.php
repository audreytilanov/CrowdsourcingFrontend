<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SkillController extends Controller
{
    public function index(Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/skill');
        $responseJSON = json_decode($response->getBody(), true);
        return view('admin.skill.index', compact('responseJSON'));
    }

    public function create(){
        return view('admin.skill.create');        
    }

    public function store(Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/skill/create', [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.skill.index');
        }

        return redirect('/');
    }

    public function edit($id, Request $request){
        $user = $request->session()->get('userSession');
        
        $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/skill/edit/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON['data']);
        return view('admin.skill.edit', compact('responseJSON'));
    }

    public function update($id, Request $request){
        $user = $request->session()->get('userSession');
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/skill/edit/'.$id, [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.skill.index');
        }

        return redirect('/');
    }

    public function delete($id, Request $request){
        $user = $request->session()->get('userSession');

        $response = Http::withToken($user['token'])->post('https://crowdsourcing.usf.my.id/api/admin/skill/delete/'.$id);
        $responseJSON = json_decode($response->getBody(), true);
        // dd($responseJSON);
        if($responseJSON['success'] == true){
            return redirect()->route('admin.skill.index');
        }

        return redirect('/');
    }
}

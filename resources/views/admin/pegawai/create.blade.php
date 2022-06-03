@extends('layout.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>PEGAWAI</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pegawai</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><b>TAMBAH PEGAWAI</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.pegawai.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama" value="{{ old('nama') }}" name="nama" required>
                                    @error('nama')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" name="email" required>
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" placeholder="Masukkan alamat" value="{{ old('alamat') }}" name="alamat" required>
                                    @error('alamat')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>HP</label>
                                    <input type="number" class="form-control" placeholder="Masukkan hp" value="{{ old('hp') }}" name="hp" required>
                                    @error('hp')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" placeholder="Masukkan password" value="{{ old('password') }}" name="password" required>
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Roler</label>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">Pilih role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Group Leader</option>
                                        <option value="3">Group Member</option>
                                    </select>
                                    @error('role')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
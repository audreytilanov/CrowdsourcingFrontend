@extends('layout.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>JASA</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Jasa</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><b>TAMBAH JASA</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.jasa.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Jasa</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama" value="{{ old('nama') }}" name="nama" required>
                                    @error('nama')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" class="form-control" placeholder="Masukkan deskripsi" value="{{ old('deskripsi') }}" name="deskripsi" required>
                                    @error('deskripsi')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Harga" value="{{ old('harga') }}" name="harga" required>
                                    @error('harga')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Paket Jasa</label>
                                    <select class="form-control" name="paketjasa" id="paketjasa" required>
                                        <option value="">Pilih Paket Jasa</option>
                                        @foreach ( $responsePaketJasa['data'] as $paketjasa)
                                            <option value="{{ $paketjasa['id'] }}">{{ $paketjasa['nama'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('paketjasa')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori" id="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ( $responseKategori['data'] as $kategori)
                                            <option value="{{ $kategori['id'] }}">{{ $kategori['nama'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
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
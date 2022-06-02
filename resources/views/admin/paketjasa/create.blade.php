@extends('layout.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>PAKET JASA</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Paket Jasa</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><b>TAMBAH PAKET JASA</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.paketjasa.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Paket Jasas</label>
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
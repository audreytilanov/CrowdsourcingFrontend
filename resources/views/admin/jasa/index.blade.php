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
                    <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.jasa.create') }}">
                        Tambah</a>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Jasa</th>
                                                <th>Deskripsi</th>
                                                <th>Harga</th>
                                                <th>Paket Jasa</th>
                                                <th>Kategori</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Tanggal Update</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{ dd($responseJSON) }} --}}
                                            @foreach ( $responseJSON['data'] as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datas['nama'] }}</td>
                                                <td>{{ $datas['deskripsi'] }}</td>
                                                <td>{{ $datas['harga'] }}</td>
                                                <td>{{ $datas['paketjasas']['nama'] }}</td>
                                                <td>{{ $datas['kategoris']['nama'] }}</td>
                                                <td>{{ $datas['created_at'] }}</td>
                                                <td>{{ $datas['updated_at'] }}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.jasa.edit', ['id' => $datas['id']]) }}">
                                                        Edit</a>
                                                    <form style="display: inline" action="{{ route('admin.jasa.delete', ['id' => $datas['id']]) }}" method="post" id="delete-form{{ $datas['id'] }}">
                                                        @csrf
                                                        <button value="{{ $datas['id'] }}" id="btn-submit" class="btn btn-danger btn-flat btn-addon" type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
            </section>
        </div>
    </div>
</div>
@endsection
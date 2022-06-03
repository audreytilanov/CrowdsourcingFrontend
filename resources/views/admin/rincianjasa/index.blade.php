@extends('layout.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>RINCIAN JASA</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Rincian Jasa</li>
                            </ol>
                        </div>
                    </div>
                    
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
                                                <th>Rincian Jasa</th>
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
                                                <td>
                                                    <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.rincianjasa.create', $datas['id']) }}">
                                                        Tambah</a>
                                                        <br>
                                                        <br>
                                                    @foreach ($datas['rincianjasas'] as $data)
                                                        {{ $data['nama'] }}
                                                        <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.rincianjasa.edit', ['id' => $data['id']]) }}">
                                                            Edit</a>
                                                        <form style="display: inline" action="{{ route('admin.rincianjasa.delete', ['id' => $data['id']]) }}" method="post" id="delete-form{{ $datas['id'] }}">
                                                            @csrf
                                                            <button value="{{ $datas['id'] }}" id="btn-submit" class="btn btn-danger btn-flat btn-addon" type="submit">Delete</button>
                                                        </form>
                                                        <br>

                                                    @endforeach
                                                    
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
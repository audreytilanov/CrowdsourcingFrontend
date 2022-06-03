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
                    <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.pegawai.create') }}">
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
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>HP</th>
                                                <th>Role</th>
                                                <th>Dibuat</th>
                                                <th>Diupdate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{ dd($responseJSON) }} --}}
                                            @foreach ( $responseJSON['data'] as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datas['name'] }}</td>
                                                <td>{{ $datas['email'] }}</td>
                                                <td>{{ $datas['alamat'] }}</td>
                                                <td>{{ $datas['hp'] }}</td>
                                                <td>
                                                @if($datas['detailroles']['role_id'] == 1)
                                                    Admin
                                                @elseif ($datas['detailroles']['role_id'] == 2)
                                                    Group Leader
                                                @else
                                                    Group Member
                                                @endif
                                                </td>
                                                <td>{{ $datas['created_at'] }}</td>
                                                <td>{{ $datas['updated_at'] }}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.pegawai.edit', ['id' => $datas['id']]) }}">
                                                        Edit</a>
                                                    <form style="display: inline" action="{{ route('admin.pegawai.delete', ['id' => $datas['id']]) }}" method="post" id="delete-form{{ $datas['id'] }}">
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
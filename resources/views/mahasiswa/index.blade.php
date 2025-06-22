@extends('template.main')

@section('content')

  <!--begin::App Main-->
  <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                    <div class="card-tools">
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>nim</th>
                                    <th>nama</th>
                                    <th>tanggal_lahir</th>
                                    <th>telp</th>
                                    <th>email</th>
                                    <th>prodi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($mahasiswa as $m)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                    <td>{{ $m->Nim }}</td>
                                    <td>{{ $m->Nama }}</td>
                                    <td>{{ $m->Tanggallahir }}</td>
                                    <td>{{ $m->Telp }}</td>
                                    <td>{{ $m->Email }}</td>
                                    <td>{{ $m->Prodi->nama }}</td>

                                    <td>
                                        <form action="{{ route('mahasiswa.destroy', $m->Nim) }}" method="POST"">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
                                        <a class="btn btn-warning" href="{{ route('mahasiswa.edit', $m->Nim) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
            <!-- /.row (main row) -->
                </div>
          <!--end::Container-->
                </div>
        <!--end::App Content-->
            </div>
        </div>
      </main>
      <!--end::App Main-->

@endsection
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
                                    <th>foto</th>
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
                                    <td>
                                        @if($m->foto)
                                            <img src="{{ asset('storage/' . $m->foto) }}" alt="Foto {{ $m->Nama }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;" onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yNSAyM0MyNy4yMDkxIDIzIDI5IDIxLjIwOTEgMjkgMTlDMjkgMTYuNzkwOSAyNy4yMDkxIDE1IDI1IDE1QzIyLjc5MDkgMTUgMjEgMTYuNzkwOSAyMSAxOUMyMSAyMS4yMDkxIDIyLjc5MDkgMjMgMjUgMjNaIiBmaWxsPSIjOUM5Qzk5Ii8+CjxwYXRoIGQ9Ik0zNSAzNUgxNUMxNC40NDc3IDM1IDE0IDM0LjU1MjMgMTQgMzRDMTQgMzAuMTM0IDE3LjEzNCAyNyAyMSAyN0gyOUMzMi44NjYgMjcgMzYgMzAuMTM0IDM2IDM0QzM2IDM0LjU1MjMgMzUuNTUyMyAzNSAzNSAzNVoiIGZpbGw9IiM5QzlDOTkiLz4KPC9zdmc+'; this.title='Foto tidak ditemukan: {{ asset('storage/' . $m->foto) }}';">
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
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
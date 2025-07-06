@extends('template.main')
@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Data Mahasiswa</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            <h3 class="card-title">Edit Mahasiswa</h3>
                        </div>
                        <!-- /.card-header -->

                        <form action="{{ route('mahasiswa.update', $mahasiswa->Nim) }}" method="POST" enctype="multipart/form-data" id="mahasiswaForm" readonly>
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Nim" class="form-label">NIM</label>
                                    <input type="text" name="Nim" id="Nim" class="form-control" value="{{ $mahasiswa->Nim }}">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Nama" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="Nama" id="Nama" class="form-control" value="{{ $mahasiswa->Nama }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="Tanggallahir" id="Tanggallahir" class="form-control" value="{{ $mahasiswa->Tanggallahir }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="telp" class="form-label">Telpon</label>
                                    <input type="text" name="Telp" id="Telp" class="form-control" value="{{ $mahasiswa->Telp }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="Email" id="Email" class="form-control" value="{{ $mahasiswa->Email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="id" class="form-label">Prodi</label>
                                    <select class="form-select" name="id" id="id" >
                                        @foreach ($prodi as $p)
                                            <option value="{{ $p->id }}" {{ $mahasiswa->id == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="foto">Upload Foto</label>
                                    @if($mahasiswa->foto)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto" width="100" class="img-thumbnail">
                                            <p class="text-muted">Foto saat ini</p>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*"/>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Update" class="btn btn-primary">
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row (main row) -->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
</main>
@endsection()
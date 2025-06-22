@extends('template.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Tambah Prodi</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Prodi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Prodi</h3>
                        </div>

                        <form action="{{ route('prodi.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Prodi</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kaprodi">Kaprodi</label>
                                    <input type="text" name="kaprodi" id="kaprodi" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="Jurusan">Jurusan</label>
                                    <input type="text" name="Jurusan" id="Jurusan" class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Simpan" class="btn btn-primary">
                                <a href="{{ route('prodi.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
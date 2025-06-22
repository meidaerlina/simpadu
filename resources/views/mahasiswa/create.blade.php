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
                        <li class="breadcrumb-item"><a href="index.php">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                            <h3 class="card-title">Tambah Mahasiswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ url('mahasiswa') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Nim" class="form-label">NIM</label>
                                    <input type="text" name="Nim" id="Nim" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="Nim" class="form-label">Password</label>
                                    <input type="pxxxassword" name="password" id="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="Nim" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="Nama" id="Nama" class="form-control" required>
                                </div>
                                <table>
                                    <div class="form-group">
                                        <label for="Nim" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="Tanggallahir" id="Tanggallahir" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nim" class="form-label">Telpon</label>
                                        <input type="text" name="Telp" id="Telp" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nim" class="form-label">Email</label>
                                        <input type="text" name="Email" id="Email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_prodi" class="form-label">Prodi</label>
                                        <select class="form-select" name="Id_prodi" id="Id_prodi">
                                            @foreach ($prodi as $p)
                                                <option value="{{ $p->id }}">{{ $p->Nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="foto">Upload Foto</label>
                                        <input type="file" class="form-control" id="foto" name="foto"/>
                                    </div>

                                </table>

                            </div>
                            <div class="card-footer">
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" value="Simpan" class="btn btn-primary">
                                        <input type="reset" value="Batal" class="btn btn-danger">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="index.php" class="btn btn-warning">Kembali</a>
                                    </td>
                                </tr>
                            </div>
                        </form>
                        <!-- /.card-body -->

                        <!-- /.card -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row (main row) -->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
</main>
@endsection()
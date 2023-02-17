@extends('admin.layout.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10 m-auto">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input disabled type="text" class="form-control" name="nama" id="nama" value="{{ $outlet->nama }}" placeholder="nama" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input disabled type="text" class="form-control" name="alamat" id="alamat" value="{{ $outlet->alamat }}" placeholder="alamat" required>
                </div>
                <div class="form-group">
                    <label for="tlp">Telepon</label>
                    <input disabled type="text" class="form-control" name="tlp" id="tlp" value="{{ $outlet->tlp }}" placeholder="tlp" required>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{ route('outlet.index') }}" class="btn btn-primary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  @section('script')
  @endsection
@endsection

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
            <form action="/paket" method="POST">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="nama_paket">Name</label>
                    <input type="text" class="form-control" name="nama_paket" id="nama_paket" min="1" max="" value="{{ old('name') }}" placeholder="nama_paket" required>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Paket</label>
                    <select name="jenis" class="form-control" id="jenis">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="kiloan">Kiloan</option>
                        <option value="selimut">Selimut</option>
                        <option value="bedcover">Bed Cover</option>
                        <option value="kaos">Kaos</option>
                        <option value="lain">Lain-Lain</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" min="1" max="" value="{{ old('harga') }}" placeholder="harga" required>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="/paket" class="btn btn-primary">Kembali</a>
                <button type="submit" class="btn btn-success">Submit</button>
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

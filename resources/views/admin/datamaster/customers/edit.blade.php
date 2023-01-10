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
            <form action="/customer/{{ $customer->id }}" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" min="1" max="" value="{{ $customer->name }}" placeholder="name" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" min="1" max="" value="{{ $customer->alamat }}" placeholder="alamat" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                        <option value="">-- Pilih Gender --</option>
                        <option value="Pria"{{ $customer->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                        <option value="Wanita" {{ $customer->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" name="telepon" id="telepon" min="1" max="" value="{{ $customer->telepon }}" placeholder="telepon" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <select name="keterangan" class="form-control" id="keterangan">
                        <option value="">-- Pilih Keterangan --</option>
                        <option value="member" {{ $customer->keterangan == 'member' ? 'selected' : '' }}>Member</option>
                        <option value="non-member" {{ $customer->keterangan == 'non-member' ? 'selected' : '' }}>Non Member</option>
                    </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-warning text-white">Update</button>
                <a href="/customer" class="btn btn-primary">Kembali</a>
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
@endsection
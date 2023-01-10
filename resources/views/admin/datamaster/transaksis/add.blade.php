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
            <form action="/transaksi" method="POST">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="id_cust">Nama Customer</label>
                    <select name="id_cust" class="form-control" id="id_cust">
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_order">Tanggal Order</label>
                    <input type="datetime-local" class="form-control" name="tanggal_order" id="tanggal_order" value="{{ old('tanggal_order') }}" placeholder="Tanggal Order" required>
                </div>
                <div class="form-group">
                    <label for="paket_id">Nama Paket</label>
                    <select name="paket_id" class="form-control" id="paket_id">
                        <option value="">-- Pilih Paket --</option>
                        @foreach ($pakets as $paket)
                        <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Paket</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" placeholder="Jumlah Paket" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Paket</label>
                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ old('keterangan') }}" placeholder="Keterangan Paket" required>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="/transaksi" class="btn btn-primary">Kembali</a>
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
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
            <form method="POST" action="/transaksi/{{ $transaksi->id }}">
                @method('PUT')
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="id_cust">Nama Customer</label>
                    <select name="id_cust" disabled class="form-control" id="id_cust">
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $customer->id == $transaksi->id_cust ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kode_invoice">Kode Invoice</label>
                    <input type="text" disabled class="form-control" name="kode_invoice" id="kode_invoice" value="{{ $transaksi->kode_invoice }}" placeholder="Kode Invoice" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_bayar">Tanggal Bayar</label>
                    <input type="date" class="form-control" name="tanggal_bayar" id="tanggal_bayar" value="{{ $transaksi->tanggal_bayar }}" placeholder="Tanggal Bayar" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="baru" {{ $transaksi->status == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="proses" {{ $transaksi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="diambil" {{ $transaksi->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dibayar">Dibayar ?</label>
                    <select name="dibayar" id="dibayar" class="form-control">
                        <option value="dibayar" {{ $transaksi->dibayar == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                        <option value="belum_dibayar" {{ $transaksi->dibayar == 'belum_dibayar' ? 'selected' : '' }}>Belum dibayar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="paket_id">Nama Paket</label>
                    <select name="paket_id" disabled class="form-control" id="paket_id">
                        <option value="">-- Pilih Paket --</option>
                        @foreach ($pakets as $paket)
                        <option value="{{ $paket->id }}" {{ $paket->id == $transaksi->detail_transaksi[0]->paket_id ? 'selected' : '' }}>{{ $paket->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Paket</label>
                    <input type="number" disabled class="form-control" name="jumlah" id="jumlah" value="{{ $transaksi->detail_transaksi[0]->jumlah }}" placeholder="Jumlah Paket" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Paket</label>
                    <input type="text" disabled class="form-control" name="keterangan" id="keterangan" value="{{ $transaksi->detail_transaksi[0]->keterangan }}" placeholder="Keterangan Paket" required>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-warning text-white">Edit</button>
                <a href="/transaksi" class="btn btn-primary">Kembali</a>
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
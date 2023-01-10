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
                    <label for="id_cust">Nama Customer</label>
                    <select name="id_cust" class="form-control" id="id_cust" disabled>
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $customer->id == $transaksi->id_cust ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kode_invoice">Kode Invoice</label>
                    <input disabled type="text" class="form-control" name="kode_invoice" id="kode_invoice" value="{{ $transaksi->kode_invoice }}" placeholder="Kode Invoice" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_order">Tanggal Order</label>
                    <input disabled type="date" class="form-control" name="tanggal_order" id="tanggal_order" value="{{ $transaksi->tanggal_order }}" placeholder="Tanggal Order" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_bayar">Tanggal Bayar</label>
                    <input disabled type="date" class="form-control" name="tanggal_bayar" id="tanggal_bayar" value="{{ $transaksi->tanggal_bayar }}" placeholder="Tanggal Bayar" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_order">Batas Waktu</label>
                    <input disabled type="date" class="form-control" name="tanggal_order" id="tanggal_order" value="{{ $transaksi->batas_waktu }}" placeholder="Tanggal Order" required>
                </div>
                <div class="form-group">
                    <label for="biaya_tambahan">Biaya Tambahan</label>
                    <input disabled type="text" class="form-control" name="biaya_tambahan" id="biaya_tambahan" value="{{ $transaksi->biaya_tambahan }}" placeholder="Biaya Tambahan" required>
                </div>
                <div class="form-group">
                    <label for="diskon">Diskon</label>
                    <input disabled type="text" class="form-control" name="diskon" id="diskon" value="{{ $transaksi->diskon }}%" placeholder="Diskon" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input disabled type="text" class="form-control" name="status" id="status" value="{{ $transaksi->status }}" placeholder="Status" required>
                </div>
                <div class="form-group">
                    <label for="dibayar">Dibayar ?</label>
                    <input disabled type="text" class="form-control" name="dibayar" id="dibayar" value="{{ $transaksi->dibayar }}" placeholder="Dibayar" required>
                </div>
                <div class="form-group">
                    <label for="user_id">User</label>
                    <input disabled type="text" class="form-control" name="user_id" id="user_id" value="{{ $transaksi->user->name }}" placeholder="Username" required>
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
                    <input disabled type="number" class="form-control" name="jumlah" id="jumlah" value="{{ $transaksi->detail_transaksi[0]->jumlah }}" placeholder="Jumlah Paket" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Paket</label>
                    <input disabled type="text" class="form-control" name="keterangan" id="keterangan" value="{{ $transaksi->detail_transaksi[0]->keterangan }}" placeholder="Keterangan Paket" required>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
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
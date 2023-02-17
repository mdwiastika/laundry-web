@extends('admin.layout.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $title }}</h1>
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
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('laporan') }}" method="GET">
                    <div class="row mb-4">
                        <div class="col">
                            Range Tanggal
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ isset($_GET['tanggal_awal']) }}">
                        </div>
                        <div class="col-0">
                            -
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ isset($_GET['tanggal_akhir']) }}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Invoice</th>
                  <th>Member</th>
                  <th>Tanggal Order</th>
                  <th>Dibayar</th>
                  <th>User</th>
                  <th>Nama Outlet</th>
                  <th>Batas Waktu</th>
                  <th>Tanggal Bayar</th>
                  <th>Biaya Tambahan</th>
                  <th>Diskon</th>
                  <th>Pajak</th>
                  <th>Status</th>
                  <th>Dibayar</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $key => $transaksi)
                    <tr>
                      <td>{{ ($key+1) }}</td>
                      <td>{{ $transaksi->kode_invoice }}</td>
                      <td>{{ $transaksi->member->nama }}</td>
                      <td>{{ $transaksi->tanggal_order }}</td>
                      <td>{{ $transaksi->dibayar }}</td>
                      <td>{{ $transaksi->user->name }}</td>
                      <td>{{ $transaksi->outlet->nama }}</td>
                      <td>{{ $transaksi->batas_waktu }}</td>
                      <td>{{ $transaksi->tanggal_bayar }}</td>
                      <td>{{ $transaksi->biaya_tambahan }}</td>
                      <td>{{ $transaksi->diskon }}</td>
                      <td>{{ $transaksi->pajak }}</td>
                      <td>{{ $transaksi->status }}</td>
                      <td>{{ $transaksi->dibayar }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Kode Invoice</th>
                    <th>Member</th>
                    <th>Tanggal Order</th>
                    <th>Dibayar</th>
                    <th>User</th>
                    <th>Nama Outlet</th>
                    <th>Batas Waktu</th>
                    <th>Tanggal Bayar</th>
                    <th>Biaya Tambahan</th>
                    <th>Diskon</th>
                    <th>Pajak</th>
                    <th>Status</th>
                    <th>Dibayar</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  @section('script')
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  @endsection
@endsection

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
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="id_member">Nama Member</label>
                    <select required name="id_member" class="form-control" id="id_member">
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_order">Tanggal Order</label>
                    <input type="datetime-local" class="form-control" name="tanggal_order" id="tanggal_order" value="{{ old('tanggal_order') }}" placeholder="Tanggal Order" required>
                </div>
                <div class="form-group">
                    <label for="id_paket">Nama Paket</label>
                    <select required name="id_paket" class="form-control" id="id_paket">
                        <option value="">-- Pilih Paket --</option>
                        @foreach ($pakets as $paket)
                        <option value="{{ $paket->id }}">{{ $paket->nama_paket }} ({{ $paket->harga }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="qty">Qty Paket</label>
                    <input type="number" class="form-control" name="qty" id="qty" value="{{ old('qty') }}" placeholder="Qty Paket" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Paket</label>
                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ old('keterangan') }}" placeholder="Keterangan Paket" required>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali</a>
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

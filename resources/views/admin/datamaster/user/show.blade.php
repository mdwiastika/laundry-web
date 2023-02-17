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
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
              <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input disabled type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input disabled type="text" class="form-control" name="username" id="username" value="{{ $user->username }}" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input disabled type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="Masukkan Email" required>
                </div>
                <div class="form-group">
                    <label for="role">Role User</label>
                    <select disabled name="role" class="form-control" id="role">
                        <option value="owner">-- Pilih Role --</option>
                        <option value="admin" {{ $user->role ==  'admin' ? 'selected' : ''}}>Admin</option>
                        <option value="kasir" {{ $user->role ==  'kasir' ? 'selected' : ''}}>Kasir</option>
                        <option value="owner" {{ $user->role ==  'owner' ? 'selected' : ''}}>Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_outlet">Outlet User</label>
                    <select disabled name="id_outlet" class="form-control" id="outlet">
                        <option value="1">-- Pilih Outlet --</option>
                        @foreach ($outlets as $outlet)
                            <option value="{{ $outlet->id }}" {{ $outlet->id == $user->id_outlet ? 'selected' : '' }}>{{ $outlet->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali</a>
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

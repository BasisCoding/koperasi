
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title float-left">Daftar Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1">
                <table class="table" id="table-users">
                  <thead>
                    <tr>
                      <th class="align-middle" style="width: 10px">#</th>
                      <th class="align-middle text-center">Nama User</th>
                      <th class="align-middle text-center">Username</th>
                      <th class="align-middle text-center">Password</th>
                      <th class="align-middle text-center">Status</th>
                      <th class="align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody id="data-users"></tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title float-left">Tambah Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form class="form" id="form-user">
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_user" class="form-control" required="">
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" required="">
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                          <option value="1">Aktif</option>
                          <option value="2">Tidak Aktif</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md">
                      <div class="form-group">
                        <label for="exampleInputFile">Foto</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <button type="submit" class="col-md btn btn-info">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>  
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

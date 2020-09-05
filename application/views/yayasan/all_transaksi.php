
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Laporan Transaksi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
                <h3 class="card-title float-left">Riwayat Semua Transaksi</h3>
                <div class="float-right">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-sm float-right" id="filter_transaksi">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1">
                <table class="table" id="table-riwayat-all-transaksi">
                  <thead>
                    <tr>
                      <th class="align-middle" style="width: 10px">#</th>
                      <th class="align-middle text-center">Kode Transaksi</th>
                      <th class="align-middle text-center">Kode Barang</th>
                      <th class="align-middle text-center">Nama Barang</th>
                      <th class="align-middle text-center">Jumlah Barang</th>
                      <th class="align-middle text-center">Total Quantity</th>
                      <th class="align-middle text-center">Total Bayar</th>
                      <th class="align-middle text-center">Tanggal</th>
                      <th class="align-middle text-center">Nama Admin</th>
                    </tr>
                  </thead>
                  <tbody id="riwayat-all-transaksi"></tbody>
                </table>
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

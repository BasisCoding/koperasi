
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Transaksi</h1>
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
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-warning">
                <h3 class="card-title">Transaksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
                <!-- <form class="form-horizontal" id="form-add-transaksi">
                  <input type="hidden" name="id_barang_transaksi">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md">
                        <label>Kode Barang</label>
                        <input type="text" name="kode_barang_transaksi" class="form-control" readonly>
                      </div>

                      <div class="col-md">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang_transaksi" class="form-control" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md">
                        <label>Stok</label>
                        <input type="number" name="stok_transaksi" class="form-control" readonly>
                      </div>

                      <div class="col-md">
                        <label>Harga</label>
                        <input type="text" name="harga_transaksi" class="form-control currency" required readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah_transaksi" class="form-control">
                      </div>

                      <div class="col-md">
                        <label>Total Bayar</label>
                        <input type="text" name="total_bayar_transaksi" class="form-control currency" required readonly>
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan_transaksi"></textarea>
                  </div>  

                  <button class="btn btn-info col" id="btn-save-add-transaksi">Beli</button>  
                </form> -->
                <form id="form-add-transaksi">
                  
                  <div class="col">
                    <label class="float-left">Total Order</label>
                    <label class="float-right currency" id="total_bayar_transaksi"></label>
                  </div>
                  
                </form>
                <button type="submit" class="btn btn-info col-md" id="btn-save-add-transaksi" form="form-add-transaksi">Order</button>

              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title">Data Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1">
                <table class="table table-sm" id="table-barang-transaksi">
                  <thead>
                    <tr>
                      <th class="align-middle text-center">Kode Barang</th>
                      <th class="align-middle text-center">Nama Barang</th>
                      <th class="align-middle text-center">Harga</th>
                      <th class="align-middle text-center">Stok</th>
                      <th class="align-middle text-center">Order</th>
                    </tr>
                  </thead>
                  <tbody id="data-barang-transaksi"></tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title float-left">Riwayat Transaksi</h3>
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
                <table class="table" id="table-riwayat-transaksi">
                  <thead>
                    <tr>
                      <th class="align-middle" style="width: 10px">#</th>
                      <th class="align-middle text-center">Kode Transaksi</th>
                      <th class="align-middle text-center">Jumlah Barang</th>
                      <th class="align-middle text-center">Total Quantity</th>
                      <th class="align-middle text-center">Total Bayar</th>
                      <th class="align-middle text-center">Tanggal</th>
                      <th class="align-middle text-center">Nama Admin</th>
                      <th class="align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody id="riwayat-transaksi"></tbody>
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

  <div class="modal fade" id="modal-detail-transaksi" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Transaksi #<span class="kode_transaksi_detail"></span></h5>
          <button type="button" class="close hidden-print" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <table>
            <tr>
              <td>Kode Transaksi</td>
              <td>:</td>
              <td class="kode_transaksi_detail"></td>
            </tr>

            <tr>
              <td>Jumlah Barang</td>
              <td>:</td>
              <td class="jumlah_barang_detail"></td>
            </tr>

            <tr>
              <td>Total Quantity</td>
              <td>:</td>
              <td class="total_quantity_detail"></td>
            </tr>

            <tr>
              <td>Total Bayar</td>
              <td>:</td>
              <td class="total_bayar_detail"></td>
            </tr>

            <tr>
              <td>Tanggal Transaksi</td>
              <td>:</td>
              <td class="created_at_detail"></td>
            </tr>

            <tr>
              <td>Nama Admin</td>
              <td>:</td>
              <td class="created_by_detail"></td>
            </tr>
          </table>

          <table style="width: 100%; margin-top: 10px;">
            <!-- <thead>
              <th class="align-middle">Kode Barang</th>
              <th class="align-middle">Nama Barang</th>
              <th class="align-middle">Harga Satuan</th>
              <th class="align-middle">Jumlah</th>
              <th class="align-middle">Total Bayar</th>
            </thead> -->
            
            <tbody id="detail-transaksi">
            </tbody>
          </table>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default hidden-print" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary hidden-print" id="btn-cetak-struk">Cetak</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
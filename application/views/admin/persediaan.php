
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Data Barang</li>
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
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-warning">
                <h3 class="card-title">Tambah Persediaan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form class="form-horizontal" id="form-add-persediaan">
                  <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="kode_barang_persediaan" id="kode_barang_persediaan" class="form-control select2" style="width: 100%;" required>
                      <option>Pilih Barang</option>
                      <?php 
                        $barang = $this->db->get('barang')->result();

                        foreach ($barang as $br) {?>
                          <option value="<?= $br->id ?>"><?= $br->kode_barang.' | '.$br->nama_barang ?></option>
                      <?php }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Pilih Supplier</label>
                    <select name="supplier_barang_persediaan" class="form-control select2" style="width: 100%;" required>
                      <option>Pilih Supplier</option>
                      <?php 
                        $supplier = $this->db->get('supplier')->result();

                        foreach ($supplier as $sr) {?>
                          <option value="<?= $sr->id_supplier ?>"><?= $sr->id_supplier.' | '.$sr->nama_supplier ?></option>
                      <?php }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Stok Saat ini</label>
                    <input type="number" name="stok_persediaan" class="form-control">
                  </div>   
                  <div class="form-group">
                    <label>Tambah Stok</label>
                    <input type="number" name="tambah_stok_persediaan" class="form-control" required>
                  </div>  

                  <button class="btn btn-info col" id="btn-save-add-persediaan">Tambah Persediaan</button>  
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title">Data Persediaan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1">
                <table class="table table-sm" id="table-persediaan">
                  <thead>
                    <tr>
                      <th class="align-middle" style="width: 10px">#</th>
                      <th class="align-middle text-center">Kode Barang</th>
                      <th class="align-middle text-center">Nama Barang</th>
                      <th class="align-middle text-center">Stok</th>
                      <th class="align-middle text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody id="data-persediaan"></tbody>
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
                <h3 class="card-title">Riwayat Persediaan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1">
                <table class="table table-sm" id="table-riwayat-persediaan">
                  <thead>
                    <tr>
                      <th class="align-middle" style="width: 10px">#</th>
                      <th class="align-middle text-center">Kode Barang</th>
                      <th class="align-middle text-center">Nama Barang</th>
                      <th class="align-middle text-center">Stok Lama</th>
                      <th class="align-middle text-center">Tambahan Stok</th>
                      <th class="align-middle text-center">Nama Supplier</th>
                      <th class="align-middle text-center">Waktu</th>
                      <th class="align-middle text-center">Nama Admin</th>
                    </tr>
                  </thead>
                  <tbody id="riwayat-persediaan"></tbody>
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
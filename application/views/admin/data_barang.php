
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
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-warning">
                <h3 class="card-title">Kategori</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="data-kategori"></div>
                <button type="button" class="col btn btn-danger float-right" data-toggle="modal" data-target="#modal-add-kategori">
                  Tambah Kategori
                </button>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title">Data Barang</h3>
                <button type="button" class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#modal-add-barang">
                  <span class="fa fa-plus"></span>
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1">
                <table class="table table-sm" id="table-barang">
                  <thead>
                    <tr>
                      <th class="align-middle" style="width: 10px">#</th>
                      <th class="align-middle text-center">Kode Barang</th>
                      <th class="align-middle text-center">Nama Barang</th>
                      <th class="align-middle text-center">Kategori</th>
                      <th class="align-middle text-center">Harga</th>
                      <th class="align-middle text-center">Stok</th>
                      <th class="align-middle text-center">Deskripsi</th>
                    </tr>
                  </thead>
                  <tbody id="data-barang"></tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="modal-add-barang" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
         <form id="form-add-barang" method="POST">

          <div class="row">

            <div class="col-md">
              <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" maxlength="10" required>
              </div>
            </div>

            <div class="col-md"> 
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
              </div>
            </div>

          </div>
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label>Kategori Barang</label>
                <select class="form-control select2" style="width: 100%;" name="kategori">
                  <?php 
                    $select = $this->db->get('kategori')->result();
                    foreach ($select as $sl) {?>
                      <option value="<?= $sl->id_kategori ?>"><?= $sl->nama_kategori ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="row">

                <div class="col-md-8">
                  <div class="form-group">
                    <label>Harga Barang</label>
                    <input type="text" name="harga" class="form-control currency" required>
                  </div>
                </div>

                <div class="col-md">
                  <div class="form-group">
                    <label>Stok Awal</label>
                    <input type="number" name="stok" class="form-control" required>
                  </div>
                </div>

              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-md">
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required></textarea>
              </div>
            </div>

          </div>

         </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="form-add-barang" id="btn-save-add-barang">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-update-barang" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Data Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
         <form id="form-update-barang" method="POST">

          <div class="row">
            <input type="hidden" name="id_barang_update">
            <div class="col-md">
              <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang_update" class="form-control" maxlength="10" readonly>
              </div>
            </div>

            <div class="col-md"> 
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang_update" class="form-control" required>
              </div>
            </div>

          </div>
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label>Kategori Barang</label>
                <select class="form-control" name="kategori_update">
                  <?php 
                    $select = $this->db->get('kategori')->result();
                    foreach ($select as $sl) {?>
                      <option value="<?= $sl->id_kategori ?>"><?= $sl->nama_kategori ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Harga Barang</label>
                <input type="text" name="harga_update" class="form-control currency" required>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-md">
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi_update" required></textarea>
              </div>
            </div>

          </div>

         </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="form-update-barang" id="btn-update-barang">Update</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-add-kategori" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-add-kategori" method="POST">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control">
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="form-add-kategori" id="btn-save-add-kategori">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-update-kategori" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Data Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-update-kategori" method="POST">
            <input type="hidden" name="id_kategori_update">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori_update" class="form-control">
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="form-update-kategori" id="btn-update-kategori">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
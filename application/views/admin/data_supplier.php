
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
                <form class="form-horizontal" id="form-add-supplier">
                  <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="nama_supplier" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-info col" id="btn-save-add-supplier">Tambah Supplier</button>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title">Data Supplier</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1">
                <table class="table table-sm" id="table-supplier">
                  <thead>
                    <tr>
                      <th class="align-middle" style="width: 10px">#</th>
                      <th class="align-middle text-center">Nama Supplier</th>
                      <th class="align-middle text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="data-supplier"></tbody>
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

<div class="modal fade" id="modal-update-supplier" data-backdrop="false" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Data Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-update-supplier" method="POST">
          <input type="hidden" name="id_supplier_update">
          <label>Nama Supplier</label>
          <input type="text" name="nama_supplier_update" class="form-control">
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="form-update-supplier" id="btn-update-supplier">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
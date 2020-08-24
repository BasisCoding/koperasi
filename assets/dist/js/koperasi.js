$(document).ready(function() {
    
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

	data_reload();
    data_persediaan_reload();
    data_supplier_reload();
    data_reload_transaksi();
    laporan_persediaan();

// Halaman Barang
	function data_reload() {
		$.ajax({
			url: base_url+'admin/Master/data_barang',
			type: 'POST',
			dataType: 'HTML',
			async:false,
			success:function (data) {
	    		$('#data-barang').html(data);
			}
		});

		$.ajax({
			url: base_url+'admin/Master/data_kategori',
			type: 'POST',
			dataType: 'HTML',
			async:false,
			success:function (data) {
	    		$('#data-kategori').html(data);
			}
		});
	}

	$('#table-barang').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 mt-1'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend:    'excel',
                className: 'btn btn-sm',
            },
            {
                extend:    'pdf',
                className: 'btn btn-sm',

            },
            {
                extend:    'print',
                className: 'btn btn-sm',

            }
        ],
        responsive:true
    });

    $('#table-riwayat-persediaan').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 mt-1'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend:    'excel',
                className: 'btn btn-sm',
            },
            {
                extend:    'pdf',
                className: 'btn btn-sm',

            },
            {
                extend:    'print',
                className: 'btn btn-sm',

            }
        ],
        responsive:true
    });

    $('#form-add-barang').submit(function() {
        
        $.ajax({
            url: base_url+'admin/Master/add_barang',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-save-add-barang").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
            },
            success:function(response) {
                $("#form-add-barang").trigger("reset");
                $('#modal-add-barang').modal('hide');
                $("#btn-save-add-barang").html('Save');

                Toast.fire({
			        icon: response.status,
			        title: response.message
			    });
                data_reload();
            }
        });

        return false;
    });

    $('.dropdown-menu').on('click', '.update-barang', function(event) {
    	event.preventDefault();
    	var id = $(this).attr('data-id');
    	var kode = $(this).attr('data-kode');
    	var nama = $(this).attr('data-nama');
    	var kategori = $(this).attr('data-kategori');
    	var harga = $(this).attr('data-harga');
    	var deskripsi = $(this).attr('data-deskripsi');

    	$('[name="id_barang_update"]').val(id);
    	$('[name="nama_barang_update"]').val(nama);
    	$('[name="kategori_barang_update"]').val(kategori);
    	$('[name="harga_update"]').val(harga);
    	$('[name="deskripsi_update"]').val(deskripsi);
    	$('[name="kode_barang_update"]').val(kode);

    	$('#modal-update-barang').modal('show');
    });

    $('.dropdown-menu').on('click', '.delete-barang', function(event) {
    	event.preventDefault();
    	var id = $(this).attr('data-id');
    	var nama = $(this).attr('data-nama');

    	Swal.fire({
		  title: 'Apakah Anda Yakin Ingin Menghapus Data '+nama+'?',
		  text: "Data Akan Di Hapus Secara Permanen !!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, Delete!'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
		  		url: base_url+'admin/Master/delete_barang',
		  		type: 'POST',
		  		dataType: 'JSON',
		  		data:{id:id},
		  		success:function (response) {
		  			Swal.fire(
				      'Deleted!',
				      'Data Telah Di Hapus',
				      'success'
				    );
                	data_reload();
		  		}
		  	});
		  }
		})
    });

    $('#form-update-barang').submit(function() {
    	$.ajax({
            url: base_url+'admin/Master/update_barang',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-update-barang").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
            },
            success:function(response) {
                $("#form-update-barang").trigger("reset");
                $('#modal-update-barang').modal('hide');
                $("#btn-update-barang").html('Save');

                Toast.fire({
			        icon: response.status,
			        title: response.message
			    });
                data_reload();
            }
        });
    });

    $('#form-add-kategori').submit(function() {
        
        $.ajax({
            url: base_url+'admin/Master/add_kategori',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-save-add-kategori").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
            },
            success:function(response) {
                $("#form-add-kategori").trigger("reset");
                $('#modal-add-kategori').modal('hide');
                $("#btn-save-add-kategori").html('Save');

                Toast.fire({
			        icon: response.status,
			        title: response.message
			    });
                data_reload();
            }
        });

        return false;
    });

    $('#data-kategori').on('click', '.update-kategori', function(event) {
    	event.preventDefault();
    	var id = $(this).attr('data-id');
    	var nama = $(this).attr('data-nama');

    	$('[name="id_kategori_update"]').val(id);
    	$('[name="nama_kategori_update"]').val(nama);

    	$('#modal-update-kategori').modal('show');
    });

    $('#form-update-kategori').submit(function() {
    	$.ajax({
            url: base_url+'admin/Master/update_kategori',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-update-kategori").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
            },
            success:function(response) {
                $("#form-update-kategori").trigger("reset");
                $('#modal-update-kategori').modal('hide');
                $("#btn-update-kategori").html('Save');

                Toast.fire({
			        icon: response.status,
			        title: response.message
			    });
                data_reload();
            }
        });
    });

    $('#data-kategori').on('click', '.delete-kategori', function(event) {
    	event.preventDefault();
    	var id = $(this).attr('data-id');
    	var nama = $(this).attr('data-nama');

    	Swal.fire({
		  title: 'Apakah Anda Yakin Ingin Menghapus Data '+nama+'?',
		  text: "Data Akan Di Hapus Secara Permanen !!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, Delete!'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
		  		url: base_url+'admin/Master/delete_kategori',
		  		type: 'POST',
		  		dataType: 'JSON',
		  		data:{id:id},
		  		success:function (response) {
		  			Swal.fire(
				      'Deleted!',
				      'Data Telah Di Hapus',
				      'success'
				    );
                	data_reload();
		  		}
		  	});
		  }
		})
    });
// End Halaman Barang

// Halaman Persediaan
    function data_persediaan_reload() {
        $.ajax({
            url: base_url+'admin/Persediaan/data_persediaan',
            type: 'POST',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#data-persediaan').html(data);
            }
        });

        $.ajax({
            url: base_url+'admin/Persediaan/riwayat_persediaan',
            type: 'POST',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#riwayat-persediaan').html(data);
            }
        });
    }

    $('#kode_barang_persediaan').change(function() {
        var id = $(this).val();
        $.ajax({
            url: base_url+'admin/Master/get_by_id',
            type: 'POST',
            async:false,
            dataType : 'json',
            data:{id:id},
            success:function (data) {
                $('[name="stok_persediaan"]').val(data.stok);
                $('[name="stok_persediaan"]').attr('readonly', true);
            }
        });
        return false;
    });

    $('#form-add-persediaan').submit(function() {
        
        $.ajax({
            url: base_url+'admin/Persediaan/add_persediaan',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-save-add-persediaan").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
                $("#btn-save-add-persediaan").attr('disabled', true);
            },
            success:function(response) {
                $("#form-add-persediaan").trigger("reset");
                $("#btn-save-add-persediaan").html('Save');
                $("#btn-save-add-persediaan").attr('disabled', false);
                $('#kode_barang_persediaan').val('');
                Toast.fire({
                    icon: response.status,
                    title: response.message
                });
                data_persediaan_reload();
            }
        });

        return false;
    });    
// End Halaman Persediaan

// Halaman Supplier
    function data_supplier_reload() {
        $.ajax({
            url: base_url+'admin/Master/data_supplier',
            type: 'POST',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#data-supplier').html(data);
            }
        });
    }

    $('#form-add-supplier').submit(function() {
        
        $.ajax({
            url: base_url+'admin/Master/add_supplier',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-save-add-supplier").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
                $("#btn-save-add-supplier").attr('disabled', true);
            },
            success:function(response) {
                $("#form-add-supplier").trigger("reset");
                $("#btn-save-add-supplier").html('Save');
                $("#btn-save-add-supplier").attr('disabled', false);
                Toast.fire({
                    icon: response.status,
                    title: response.message
                });
                data_supplier_reload();
            }
        });

        return false;
    });    

    $('#data-supplier').on('click', '.edit-supplier', function() {
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        $('#modal-update-supplier').modal('show');

        $('[name="id_supplier_update"]').val(id);
        $('[name="nama_supplier_update"]').val(nama);
    });

    $('#form-update-supplier').submit(function() {
        $.ajax({
            url: base_url+'admin/Master/update_supplier',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-update-supplier").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
            },
            success:function(response) {
                $("#form-update-supplier").trigger("reset");
                $('#modal-update-supplier').modal('hide');
                $("#btn-update-supplier").html('Save');

                Toast.fire({
                    icon: response.status,
                    title: response.message
                });
                data_supplier_reload();
            }
        });

        return false;
    });

    $('#data-supplier').on('click', '.delete-supplier', function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        Swal.fire({
          title: 'Apakah Anda Yakin Ingin Menghapus Data '+nama+'?',
          text: "Data Akan Di Hapus Secara Permanen !!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                url: base_url+'admin/Master/delete_supplier',
                type: 'POST',
                dataType: 'JSON',
                data:{id:id},
                success:function (response) {
                    Swal.fire(
                      'Deleted!',
                      'Data Telah Di Hapus',
                      'success'
                    );
                    data_supplier_reload();
                }
            });
          }
        })
    });
// End Halaman Supplier

// Halaman Transaksi
    function data_reload_transaksi() {
        $.ajax({
            url: base_url+'admin/Transaksi/data_barang',
            type: 'POST',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#data-barang-transaksi').html(data);
            }
        });

        $.ajax({
            url: base_url+'admin/Transaksi/riwayat_transaksi',
            type: 'POST',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#riwayat-transaksi').html(data);
            }
        });
    }

    $('#table-barang-transaksi').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#data-barang-transaksi').on('click', '.proses-transaksi', function() {
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        var kode = $(this).attr('data-kode');
        var harga = $(this).attr('data-harga');
        var stok = $(this).attr('data-stok');

        $('[name="kode_barang_transaksi"]').val(kode);
        $('[name="id_barang_transaksi"]').val(id);
        $('[name="nama_barang_transaksi"]').val(nama);
        $('[name="harga_transaksi"]').val(harga);
        $('[name="stok_transaksi"]').val(stok);
    });

    $('[name="jumlah_transaksi"]').keyup(function() {
        var total_bayar = parseInt($(this).val()) * parseInt($('[name="harga_transaksi"]').val());
        $('[name="total_bayar_transaksi"]').val(total_bayar);
    });

    $('#form-add-transaksi').submit(function() {
        
        $.ajax({
            url: base_url+'admin/Transaksi/add_transaksi',
            type: 'POST',
            dataType:'JSON',
            data: $(this).serialize(),
            beforeSend: function()
            { 
                $("#btn-save-add-transaksi").html('<span class="fa fa-spinner fa-spin fa-fw""></span> Loading ...');
                $("#btn-save-add-transaksi").attr('disabled', true);
            },
            success:function(response) {
                $("#form-add-transaksi").trigger("reset");
                $("#btn-save-add-transaksi").html('Beli Lagi');
                $("#btn-save-add-transaksi").attr('disabled', false);
                Toast.fire({
                    icon: response.status,
                    title: response.message
                });
                data_reload_transaksi();
            }
        });

        return false;
    });    
// End Halaman Transaksi

// Halaman Laporan Persediaan
    function laporan_persediaan() {
        $.ajax({
            url: base_url+'yayasan/Persediaan/data_persediaan',
            type: 'POST',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#data-laporan-persediaan').html(data);
            }
        });
    }

    $('#table-laporan-persediaan').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 mt-1'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend:    'excel',
                className: 'btn btn-sm',
            },
            {
                extend:    'pdf',
                className: 'btn btn-sm',

            },
            {
                extend:    'print',
                className: 'btn btn-sm',

            }
        ],
        responsive:true
    });

    $('#table-riwayat-transaksi').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 mt-1'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend:    'excel',
                className: 'btn btn-sm',
            },
            {
                extend:    'pdf',
                className: 'btn btn-sm',

            },
            {
                extend:    'print',
                className: 'btn btn-sm',

            }
        ],
        responsive:true
    });
// End Halaman Laporan Persediaan
});
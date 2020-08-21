$(function() {

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

	data_reload();
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
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
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

});
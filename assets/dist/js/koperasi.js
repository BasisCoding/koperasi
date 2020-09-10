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
    data_users();

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

    $('#data-barang').on('click', '.update-barang', function(event) {
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

    $('#data-barang').on('click', '.delete-barang', function(event) {
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
    function data_reload_transaksi(dari, sampai) {
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
            data:{dari:dari, sampai:sampai},
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#riwayat-transaksi').html(data);
            }
        });

        $.ajax({
            url: base_url+'admin/Transaksi/riwayat_all_transaksi',
            type: 'POST',
            data:{dari:dari, sampai:sampai},
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#riwayat-all-transaksi').html(data);
            }
        });
    }

    $('#filter_transaksi').daterangepicker({
        opens: 'right'
    }, function(start, end, label) {
        data_reload_transaksi(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

    $('#data-barang-transaksi').on('click', '.proses-transaksi', function() {

        var format = new Intl.NumberFormat('en-IN', { 
                style: 'currency', 
                currency: 'IDR', 
                minimumFractionDigits: 0, 
            });
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        var kode = $(this).attr('data-kode');
        var harga = $(this).attr('data-harga');
        var stok = $(this).attr('data-stok');

        $('#form-add-transaksi').prepend(''+
            '<div class="card order-produk" id="'+kode+'">'+
              '<div class="card-body p-3 row align-middle">'+
                '<div class="col">'+
                  '<h6 class="text-bold">'+
                    '<label class="float-left">'+nama+'</label>'+
                    '<label class="float-right">'+format.format(harga)+'</label>'+
                  '</h6>'+
                  '<input type="hidden" value="'+id+'" name="id_barang_transaksi[]">'+
                  '<input type="hidden" value="'+kode+'" name="kode_barang_transaksi[]">'+
                  '<input type="hidden" value="'+harga+'" name="harga_transaksi[]">'+
                  '<input type="hidden" value="'+stok+'" name="stok_transaksi[]">'+
                  '<input type="number" required name="jumlah_transaksi[]" placeholder="Jumlah" class="form-control form-control-sm">'+
                '</div>'+
                '<button type="button" class="col-2 btn btn-danger delete-order" data-id="'+kode+'"><span class="fas fa-minus-circle"></span></button>'+
              '</div>'+
            '</div>'+
        '');
    
        $(this).attr('disabled', true);
    });

    $('#form-add-transaksi').on('click', '.delete-order', function() {
        var id = $('.delete-order').attr('data-id');
        $('#'+id).remove();
        var barang = $('.proses-transaksi').attr('data-kode', id).attr('disabled', false);;

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
                $("#form-add-transaksi").find(".card").remove();
                $("#btn-save-add-transaksi").html('Order');
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

    function printDiv() {
        $('.hidden-print').css('display', 'none');

        var divToPrint=document.getElementById('modal-detail-transaksi');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        setTimeout(function(){
            newWin.close();
            $('.hidden-print').css('display', 'block');
        },10);

    }

    $('#btn-cetak-struk').click(function() {
        printDiv();
    });

    $('#riwayat-transaksi').on('click', '.detail-transaksi', function() {
        var kode = $(this).attr('data-kode_transaksi');
        var jumlah = $(this).attr('data-jumlah_barang');
        var quantity = $(this).attr('data-total_quantity');
        var tharga = $(this).attr('data-total_harga');
        var created_at = $(this).attr('data-created_at');
        var created_by = $(this).attr('data-created_by');

        $('.kode_transaksi_detail').html(kode);
        $('.jumlah_barang_detail').html(jumlah);
        $('.total_quantity_detail').html(quantity);
        $('.total_bayar_detail').html('Rp. '+tharga);
        $('.created_at_detail').html(created_at);
        $('.created_by_detail').html(created_by);

        $('#modal-detail-transaksi').modal('show');

        $.ajax({
            url: base_url+'admin/Transaksi/get_detail_transaksi',
            type: 'POST',
            dataType: 'HTML',
            data:{kode:kode},
            success:function (data) {
                $('#detail-transaksi').html(data);
            }
        });
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

    $('#table-riwayat-all-transaksi').DataTable({
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

// Users
    
     function data_users() {
        $.ajax({
            url: base_url+'yayasan/Users/data_users',
            type: 'POST',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#data-users').html(data);
            }
        });
    }

    $('#form-user').submit(function() {

        var formData = new FormData();
        formData.append('username', $('[name="username"]').val()); 
        formData.append('nama_user', $('[name="nama_user"]').val()); 
        formData.append('password', $('[name="password"]').val()); 
        formData.append('status', $('[name="status"]').val()); 
        
        formData.append('foto', $('[name="foto"]')[0].files[0]);


        $.ajax({
            url: base_url+'yayasan/Users/add_user',
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(response){
                $('#form-user').trigger("reset");
                Toast.fire({
                    icon: response.status,
                    title: response.message
                });
                data_users();
            }
        });
        
        return false;
    });

     $('#data-users').on('click', '.delete-user', function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        var username = $(this).attr('data-username');

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
                url: base_url+'yayasan/Users/delete_user',
                type: 'POST',
                dataType: 'JSON',
                data:{id:id, username:username},
                success:function (response) {
                    Swal.fire(
                      'Deleted!',
                      'Data Telah Di Hapus',
                      'success'
                    );
                    data_users();
                }
            });
          }
        })
    });

// Users
// Datatable   
    $('#table-barang-transaksi').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6 mt-1'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        responsive:true
    });

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
// Datatable

});
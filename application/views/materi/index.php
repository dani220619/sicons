    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-12">
    				<div class="card">
    					<div class="card-header bg-light">
    						<h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Materi</h3>
    						<div class="text-right">

    							<button type="button" class="btn btn-sm btn-outline-primary" onclick="add_menu()" title="Add Data"><i class="fas fa-plus"></i> Add</button>

    						</div>
    					</div>
    					<!-- /.card-header -->
    					<div class="card-body table-responsive">
    						<table id="tabelmenu" class="table table-bordered table-striped table-hover">
    							<thead>
    								<tr class="bg-info">
    									<th>Title</th>
    									<th>Tanggal</th>
    									<th>Deskripsi</th>
    									<th>link</th>
    									<th>File</th>
    									<th>Is Active</th>
    									<th>Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    							</tbody>
    						</table>
    					</div>
    					<!-- /.card-body -->
    				</div>
    				<!-- /.card -->
    			</div>
    			<!-- /.col -->
    		</div>
    		<!-- /.row -->
    	</div>
    	<!-- /.container-fluid -->
    </section>

    <!-- Modal Hapus-->
    <div class="modal fade" id="myModal">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h4 class="modal-title">Konfirmasi</h4>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<input type="hidden" name="idhapus" id="idhapus">
    				<p>Apakah anda yakin ingin menghapus menu <strong class="text-konfirmasi"> </strong> ?</p>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Batal</button>
    				<button type="button" class="btn btn-danger btn-xs" id="konfirmasi">Hapus</button>
    			</div>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="modal-default">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h4 class="modal-title ">View Menu</h4>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body text-center" id="md_def">
    			</div>
    		</div>
    		<!-- /.modal-content -->
    	</div>
    	<!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <script type="text/javascript">
    	var save_method; //for save method string
    	var table;

    	$(document).ready(function() {

    		table = $("#tabelmenu").DataTable({
    			"responsive": true,
    			"autoWidth": false,
    			"language": {
    				"sEmptyTable": "Data menu Belum Ada"
    			},
    			"processing": true, //Feature control the processing indicator.
    			"serverSide": true, //Feature control DataTables' server-side processing mode.
    			"order": [], //Initial no order.

    			// Load data for the table's content from an Ajax source
    			"ajax": {
    				"url": "<?php echo site_url('materi/ajax_list') ?>",
    				"type": "POST"
    			},
    			//Set column definition initialisation properties.
    			"columnDefs": [{
    				"targets": [-1], //last column
    				"render": function(data, type, row) {


    					if (row[4] == "N") {
    						return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vmateri(" + row[6] + ")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"delmateri(" + row[6] + ")\"><i class=\"fas fa-trash\"></i></a>"
    					} else {
    						return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vmateri(" + row[6] + ")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"delmateri(" + row[6] + ")\"><i class=\"fas fa-trash\"></i></a>";
    					}

    				},
    				"orderable": false, //set not orderable

    			}, ],
    		});
    		$("input").change(function() {
    			$(this).parent().parent().removeClass('has-error');
    			$(this).next().empty();
    			$(this).removeClass('is-invalid');
    		});
    		$("textarea").change(function() {
    			$(this).parent().parent().removeClass('has-error');
    			$(this).next().empty();
    			$(this).removeClass('is-invalid');
    		});
    		$("select").change(function() {
    			$(this).parent().parent().removeClass('has-error');
    			$(this).next().empty();
    			$(this).removeClass('is-invalid');
    		});
    	});

    	function reload_table() {
    		table.ajax.reload(null, false); //reload datatable ajax 
    	}

    	const Toast = Swal.mixin({
    		toast: true,
    		position: 'top-end',
    		showConfirmButton: false,
    		timer: 3000
    	});




    	//view
    	function vmateri(id) {
    		$('.modal-title').text('View Materi');
    		$("#modal-default").modal('show');
    		$.ajax({
    			url: '<?php echo base_url('materi/viewmateri'); ?>',
    			type: 'post',
    			data: 'table=materi&id=' + id,
    			success: function(respon) {
    				$("#md_def").html(respon);
    			}
    		})
    	}

    	//delete
    	function delmateri(id) {
    		Swal.fire({
    			title: 'Are you sure?',
    			text: "You won't be able to revert this!",
    			icon: 'warning',
    			showCancelButton: true,
    			confirmButtonColor: '#3085d6',
    			cancelButtonColor: '#d33',
    			confirmButtonText: 'Yes, delete it!'
    		}).then((result) => {

    			$.ajax({
    				url: "<?php echo site_url('materi/delete'); ?>",
    				type: "POST",
    				data: "id=" + id,
    				cache: false,
    				dataType: 'json',
    				success: function(respone) {
    					if (respone.status == true) {
    						reload_table();
    						Swal.fire(
    							'Deleted!',
    							'Your file has been deleted.',
    							'success'
    						);
    					} else {
    						Toast.fire({
    							icon: 'error',
    							title: 'Delete Error!!.'
    						});
    					}
    				}
    			});

    		})
    	}




    	function add_menu() {
    		save_method = 'add';
    		$('#form')[0].reset(); // reset form on modals
    		$('.form-group').removeClass('has-error'); // clear error class
    		$('.help-block').empty(); // clear error string
    		$('#modal_form').modal('show'); // show bootstrap modal
    		$('.modal-title').text('Add Materi'); // Set Title to Bootstrap modal title
    	}

    	function edit_materi(id) {

    		save_method = 'update';
    		$('#form')[0].reset(); // reset form on modals
    		$('.form-group').removeClass('has-error'); // clear error class
    		$('.help-block').empty(); // clear error string

    		//Ajax Load data from ajax
    		$.ajax({
    			url: "<?php echo site_url('materi/editmateri') ?>/" + id,
    			type: "GET",
    			dataType: "JSON",
    			success: function(data) {

    				$('[name="id"]').val(data.id);
    				$('[name="id_sekolah"]').val(data.title);
    				$('[name="title"]').val(data.title);
    				$('[name="tanggal"]').val(data.tanggal);
    				$('[name="deskripsi"]').val(data.deskripsi);
    				$('[name="link"]').val(data.link);
    				$('[name="is_active"]').val(data.is_active);

    				if (data.image == null) {
    					var image = "<?php echo base_url('assets/file/materi_session/default.png') ?>";
    					$("#v_image").attr("src", image);
    				} else {
    					var image = "<?php echo base_url('assets/file/materi_session/') ?>";
    					$("#v_image").attr("src", image + data.image);
    				}

    				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    				$('.modal-title').text('Edit Materi session'); // Set title to Bootstrap modal title

    			},
    			error: function(jqXHR, textStatus, errorThrown) {
    				alert('Error get data from ajax');
    			}
    		});
    	}

    	function save() {
    		$('#btnSave').text('saving...'); //change button text
    		$('#btnSave').attr('disabled', true); //set button disable 
    		var url;

    		if (save_method == 'add') {
    			url = "<?php echo site_url('materi/insert') ?>";
    		} else {
    			url = "<?php echo site_url('materi/update') ?>";
    		}
    		var formdata = new FormData($('#form')[0]);
    		// ajax adding data to database
    		$.ajax({
    			url: url,
    			type: "POST",
    			data: formdata,
    			dataType: "JSON",
    			cache: false,
    			contentType: false,
    			processData: false,
    			success: function(data) {

    				if (data.status) //if success close modal and reload ajax table
    				{
    					$('#modal_form').modal('hide');
    					reload_table();
    					Toast.fire({
    						icon: 'success',
    						title: 'Success!!.'
    					});
    				} else {
    					for (var i = 0; i < data.inputerror.length; i++) {
    						$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
    						$('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
    						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
    					}
    				}
    				$('#btnSave').text('save'); //change button text
    				$('#btnSave').attr('disabled', false); //set button enable 


    			},
    			error: function(jqXHR, textStatus, errorThrown) {
    				alert('Error adding / update data');
    				$('#btnSave').text('save'); //change button text
    				$('#btnSave').attr('disabled', false); //set button enable 

    			}
    		});
    	}
    	var loadFile = function(event) {
    		var image = document.getElementById('v_image');
    		image.src = URL.createObjectURL(event.target.files[0]);
    	};

    	function batal() {
    		$('#form')[0].reset();
    		reload_table();
    		var image = document.getElementById('v_image');
    		image.src = "";
    	}
    </script>


    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
    	<div class="modal-dialog">
    		<div class="modal-content">

    			<div class="modal-header">
    				<h3 class="modal-title">Materi Session</h3>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>

    			</div>
    			<div class="modal-body form">
    				<form action="#" id="form" class="form-horizontal">
    					<input type="hidden" value="" name="id" />
    					<input type="hidden" value="" name="id_sekolah" />
    					<div class="card-body">
    						<div class="form-group row ">
    							<label for="title" class="col-sm-3 col-form-label">Title</label>
    							<div class="col-sm-9 kosong">
    								<input type="text" class="form-control" name="title" id="title" placeholder="Title">
    							</div>
    						</div>
    						<div class="form-group row ">
    							<label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
    							<div class="col-sm-9 kosong">
    								<input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal">
    							</div>
    						</div>
    						<div class="form-group row ">
    							<label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
    							<div class="col-sm-9 kosong">
    								<input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi">
    							</div>
    						</div>
    						<div class="form-group">
    							<label>Pilih Link / File</label>
    							<select class="form-control" id="filter" style="width: 50%">
    								<option value="" selected></option>
    								<option value="1">Link</option>
    								<option value="2">File</option>
    							</select>
    						</div>

    						<div class="" id="linku">
    							<div class="form-group row ">
    								<label for="link" class="col-sm-3 col-form-label">link</label>
    								<div class="col-sm-9 kosong">
    									<input type="text" class="form-control" name="link" id="link" placeholder="link">
    								</div>
    							</div>
    						</div>
    						<div id="file">
    							<div class="form-group row ">
    								<label for="image" class="col-sm-3 col-form-label">File</label>
    								<div class="col-sm-9 kosong ">
    									<img id="v_image" width="100px" height="100px">
    									<input type="file" class="form-control btn-file" onchange="loadFile(event)" name="image" id="image" placeholder="Image" value="UPLOAD">
    								</div>
    							</div>
    						</div>
    						<div class="form-group row ">
    							<label for="is_active" class="col-sm-3 col-form-label">Is Active</label>
    							<div class="col-sm-9 kosong">
    								<select class="form-control" name="is_active" id="is_active">
    									<option value=""></option>
    									<option value="Y">Y</option>
    									<option value="N">N</option>
    								</select>
    							</div>

    						</div>
    					</div>
    				</form>
    			</div>
    			<div class="modal-footer">
    				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
    				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    			</div>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->
    <script>
    	$(document).ready(function() { // Ketika halaman selesai di load
    		$('#file, #linku').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
    		$('#filter').change(function() { // Ketika user memilih filter
    			if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
    				$('#file').hide();
    				$('#linku').show(); // Tampilkan form tanggal

    			} else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
    				$('#linku').hide();
    				$('#file').show();
    			} else { // Jika filternya 3 (per tahun)
    				$('#linku, #file').hide();
    			}

    		})
    	})
    </script>
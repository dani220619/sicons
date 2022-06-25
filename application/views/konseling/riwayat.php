    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    			<?= form_error('menu', '<div class="alert alert-danger close" role="alert">', '
          </div>') ?>
    			<?= $this->session->flashdata('message') ?>
    			<div class="col-12">
    				<div class="card">
    					<div class="card-header bg-light">
    						<h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Konseling</h3>

    					</div>
    					<!-- /.card-header -->
    					<div class="card-body table-responsive">
    						<table id="datatable" class="table table-bordered table-striped">
    							<thead>
    								<tr class="bg-info">
    									<th>NO</th>
    									<th>ID</th>
    									<th>NAMA GURU</th>
    									<th>NIS</th>
    									<th>SUBJECT</th>
    									<th>PESAN</th>
    									<th>DIBUAT</th>
    									<th>AKSI</th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php
									$no = 1;
									$saldo = 0;
									foreach ($konseling as $d) :
									?>
    									<tr>
    										<td><?= $no ?></td>
    										<td><?= $d->id ?></td>
    										<td><?= $d->full_name ?></td>
    										<td><b><?= $d->nis ?></b></td>
    										<td><?= $d->subject ?></td>
    										<td><?= $d->pesan ?></td>
    										<td><?= $d->date_created ?></td>
    										<td>

    											<a class="btn btn-xs btn-outline-info" title="View" data-toggle="modal" data-target="#modal-view<?= $d->id ?>"><i class="fas fa-eye"></i></a>
    											<a class="btn btn-xs btn-outline-primary" title="Edit" data-toggle="modal" data-target="#modal-edit<?= $d->id ?>"><i class="fas fa-edit"></i></a>
    											<a class="btn btn-xs btn-outline-danger" title="Delete" data-toggle="modal" data-target="#modal-delete<?= $d->id ?>"><i class="fas fa-trash"></i></a>
    										</td>
    									</tr>
    									<div class="modal fade" id="modal-edit<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="edit-kuesioner" aria-hidden="true">
    										<div class="modal-dialog">
    											<div class="modal-content">
    												<div class="modal-header">
    													<h4 class="modal-title" id="edit-kuesioner">Edit kuesioner</h4>
    													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    														<span aria-hidden="true">&times;</span>
    													</button>
    												</div>
    												<div class="p-5">
    													<form class="user" method="post" action="<?= base_url('konseling/update'); ?>" enctype="multipart/form-data">
    														<div class="form-group">
    															<label for="id">Id</label><br>
    															<input type="hidden" name="nis" value="<?php echo $d->nis ?>">
    															<input type="text" class="form-control form-control-user" id="id" name="id" value="<?php echo $d->id ?>" readonly>
    														</div>
    														<div class="form-group">
    															<label>Nama Guru</label>
    															<select class="form-control select2" name="id_user" onchange="nilai_level(this.value)" data-placeholder="To:">
    																<option value="<?php $d->id_user ?>" selected="selected"></option>
    																<?php
																	foreach ($guru as $gr) { ?>
    																	<option <?= ($gr->id_user == $d->id_user ? 'selected=""' : '') ?> value="<?= $gr->id_user ?>"><?= $gr->full_name; ?></option>
    																<?php } ?>
    															</select>
    														</div>
    														<!-- <input class="form-control" placeholder="id_level" name="id_level" id="id_level" hidden>
    														<input class="form-control" placeholder="id_user" name="id_user" id="id_user" hidden> -->
    														<div class="form-group">
    															<label for="subject">Subject</label><br>
    															<input type="text" class="form-control form-control-user" id="subject" name="subject" value="<?php echo $d->subject ?>">
    														</div>
    														<div class="form-group">
    															<label for="pesan">Pesan</label><br>
    															<input type="text" class="form-control form-control-user" id="pesan" name="pesan" value="<?php echo $d->pesan ?>">
    														</div>
    														<div class="form-group">
    															<label for="date_created">Dibuat</label><br>
    															<input type="text" class="form-control form-control-user" id="date_created" name="date_created" value="<?php echo $d->date_created ?>">
    														</div>

    														<div class="modal-footer">
    															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    															<button type="submit" name="tambah" class="btn btn-primary">Update</button>
    														</div>
    													</form>
    												</div>
    												<div class="modal-body text-center" id="md_def">
    												</div>
    											</div>
    											<!-- /.modal-content -->
    										</div>
    										<!-- /.modal-dialog -->
    									</div>
    									<div class="modal fade" id="modal-view<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="view-kuesioner" aria-hidden="true">
    										<div class="modal-dialog">
    											<div class="modal-content">
    												<div class="modal-header">
    													<h4 class="modal-title" id="view-kuesioner">View kuesioner</h4>
    													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    														<span aria-hidden="true">&times;</span>
    													</button>
    												</div>
    												<div class="p-5">
    													<form class="user" method="post" action="<?= base_url('kas_masuk/update'); ?>" enctype="multipart/form-data">
    														<div class="form-group">
    															<label for="id">Id</label><br>
    															<input type="hidden" name="id" value="<?php echo $d->id ?>">
    															<input type="text" class="form-control form-control-user" id="id" name="id" value="<?php echo $d->id ?>" readonly="">
    														</div>
    														<div class="form-group">
    															<label>Nama Guru</label>
    															<select class="select2" name="id_level" value="<?php echo $d->id_user ?>" data-placeholder="To:" readonly="" style="width: 100%;">
    																<?php
																	foreach ($guru as $gr) { ?>
    																	<option <?= ($gr->id_user == $d->id_user ? 'selected=""' : '') ?> value="<?= $gr->id_level; ?>"><?= $gr->full_name; ?> </option>
    																<?php } ?>
    															</select>
    														</div>
    														<div class="form-group">
    															<label for="subject">Subject</label><br>
    															<input type="text" class="form-control form-control-user" id="subject" name="subject" value="<?php echo $d->subject ?>" readonly>
    														</div>
    														<div class="form-group">
    															<label for="pesan">Pesan</label><br>
    															<input type="text" class="form-control form-control-user" id="pesan" name="pesan" value="<?php echo $d->pesan ?>" readonly>
    														</div>
    														<div class="form-group">
    															<label for="date_created">Dibuat</label><br>
    															<input type="text" class="form-control form-control-user" id="date_created" name="date_created" value="<?php echo $d->date_created ?>" readonly>
    														</div>
    													</form>
    												</div>
    												<div class="modal-body text-center" id="md_def">
    												</div>
    											</div>
    											<!-- /.modal-content -->
    										</div>
    										<!-- /.modal-dialog -->
    									</div>
    									<div class="modal fade" id="modal-delete<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
    										<div class="modal-dialog" role="document">
    											<div class="modal-content">
    												<div class="modal-header">
    													<h5 class="modal-title" id="addNewDonaturLabel">Hapus Kas</h5>
    													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    														<span aria-hidden="true">&times;</span>
    													</button>
    												</div>
    												<div class="modal-body">
    													<p>Anda yakin ingin menghapus <?= $d->id ?></p>
    												</div>
    												<div class="modal-footer">
    													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    													<a href="<?= base_url('konseling/delete?id=') ?><?= $d->id ?>" class="btn btn-primary">Hapus</a>
    												</div>
    											</div>
    										</div>
    									</div>
    								<?php $no++;
									endforeach ?>
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

    <script>
    	$(function() {
    		//Initialize Select2 Elements
    		$('.select2').select2()

    		//Initialize Select2 Elements
    		$('.select2bs4').select2({
    			theme: 'bootstrap4'
    		})
    	})
    	$(function() {
    		//Add text editor
    		$('#compose-textarea').summernote()
    	})

    	$(document).ready(function() {
    		$('#datatable').DataTable();
    	});

    	function nilai_level(id_level) {
    		var explode = id_level.split("|");
    		$("#id_user").val(explode[0]);
    		$("#id_level").val(explode[1]);
    	}
    </script>
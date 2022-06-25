    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-12">
    				<div class="card">
    					<div class="card-header bg-light">
    						<h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Materi Session</h3>

    					</div>
    					<!-- /.card-header -->
    					<div class="card-body table-responsive">
    						<table class=" table table-head-fixed text-nowrap" id="datatable">
    							<thead>
    								<tr>
    									<th>No</th>
    									<th>Deskripsi</th>
    									<th>Tanggal Upload</th>
    									<th>Jenis</th>
    									<th>Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								<?php
									$no = 1;
									foreach ($posts as $p) {

									?>
    									<tr>
    										<th scope="row"><?= $no++ ?></th>
    										<td><?= $p->deskripsi ?></td>
    										<td><?= $p->tanggal ?></td>
    										<td><?php
												if ($p->file == null) { ?>
    												<a>Link</a>
    											<?php } else { ?>
    												<a>File</a>
    											<?php }
												?>
    										</td>
    										<td>
    											<a href="<?= base_url('materi/open_file/' . $p->id . '') ?>" class="btn btn-primary">Open file</a>
    										</td>
    									</tr>
    								<?php }
									?>
    							</tbody>
    						</table>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    <script>
    	$(document).ready(function() {
    		$('#datatable').DataTable();
    	});
    </script>
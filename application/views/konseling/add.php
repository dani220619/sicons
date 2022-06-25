<div class="col-md-12">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h3 class="card-title">Tambah Pesan</h3>
		</div>
		<!-- /.card-header -->

		<form class="pesan" method="post" action="<?= base_url('konseling/insert'); ?>" enctype="multipart/form-data">
			<div class="card-body">

				<input class="form-control" placeholder="nis" name="nis" id="nis" value="<?= $nis['nis'] ?>" hidden>

				<div class="form-group">
					<label>Nama Guru</label>
					<select class="form-control" onchange="nilai_level(this.value)" data-placeholder="To:">
						<option value="" selected="selected"></option>
						<?php
						foreach ($guru as $gr) { ?>

							<option value="<?= $gr->id_user ?>|<?= $gr->id_level ?>"><?= $gr->full_name; ?></option>
						<?php } ?>
					</select>
				</div>
				<input class="form-control" placeholder="id_level" name="id_level" id="id_level" hidden>
				<input class="form-control" placeholder="id_user" name="id_user" id="id_user" hidden>
				<div class="form-group">
					<input class="form-control" placeholder="Subject:" name="subject" id="subject">
				</div>
				<div class="form-group">
					<textarea id="compose-textarea" name="pesan" cols="50" rows="5">
                    </textarea>
				</div>
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<div class="float-right">
					<button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>
</section>
</div>
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

	function nilai_level(id_level) {
		var explode = id_level.split("|");
		$("#id_user").val(explode[0]);
		$("#id_level").val(explode[1]);
	}
</script>
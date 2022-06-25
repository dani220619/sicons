<div class="col-md-12">
	<!-- Application buttons -->
	<div class="card text-center">
		<?= form_error('konseling', '<div class="alert alert-danger close" role="alert">', '
          </div>') ?>

		<div class="card-header">
			<a class="card-title">Individual Konseling</a>
		</div>
		<div class="card-body">

			<div class="row">
				<div class="col-sm-4">
					<a href="<?= base_url('konseling/add/' . $nis['nis'] . '') ?>" class="btn btn-app bg-secondary col-md-5 ">
						<span class="badge bg-success"></span>
						<i class="fas fa-ad"></i> Tambah Konseling
					</a>
				</div>
				<div class="col-sm-4">
					<a href="<?= base_url('konseling/detail_riwayat/' . $nis['nis'] . '') ?>" class="btn btn-app bg-success col-md-5">
						<span class="badge bg-purple"></span>
						<i class="fas fa-envelope"></i> Riwayat konseling
					</a>
				</div>
				<div class="col-sm-4">
					<a href="<?= base_url('konseling/jawaban/' . $nis['nis'] . '') ?>" class="btn btn-app bg-warning col-md-5">
						<span class="badge bg-info"></span>
						<i class="fas fa-users"></i> Jawaban
					</a>
				</div>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
</div>
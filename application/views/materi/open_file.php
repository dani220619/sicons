<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-text-width"></i>
          Materi Session
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="timeline-body">
          <?php foreach ($link as $li) { ?>
            <?php if ($li->link == null) { ?>
              <a>Silahkan Download File Di Bawah Ini</a> <br>
              <a style="font-size: 50px;">Title: <?= $li->title ?></a><br>

              <a href="<?php echo base_url() . 'materi/aksi_download/' . $li->id ?>"><button type="button" class="btn btn-block bg-gradient-primary btn-lg">Download file</button></a>
            <?php } ?>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?= $li->link ?>" allowfullscreen></iframe>
            </div>
          <?php } ?>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
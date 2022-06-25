<?php if ($_SESSION["id_level"] != ("3")) { ?>
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->

      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $totklayent['total_siswa'] ?></h3>

              <p>Total Klayent</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $totkonsoler['total_siswa'] ?></h3>

              <p>Total Konsoler</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $totadmin['total_siswa'] ?></h3>

              <p>Total admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- ./col -->

      <!-- ./col -->
    </div>
  </section>
<?php } ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">

        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url("assets/foto/user/") . $detail['image']; ?>" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center"><?= $detail['full_name'] ?></h3>
            <p class="text-muted text-center"><?= $detail['tempat_lahir'] ?></p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Email: <?= $detail['email'] ?></b>
              </li>
              <li class="list-group-item">
                <b>Alamat: <?= $detail['alamat'] ?></b>
              </li>
              <li class="list-group-item">
                <b>Tanggal Lahir: <?= $detail['tgl_lahir'] ?></b>
              </li>
            </ul>

          </div>

        </div>
      </div>
    </div>
</section>
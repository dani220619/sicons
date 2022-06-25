<?php
$profpic = "assets/foto/bg/sicons.jpeg";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $aplikasi->title; ?> | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-5.5.0/css/all.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-4.3.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
</head>
<style type="text/css">
    body {
        background-image: url('<?php echo $profpic; ?>');
    }
</style>

<body class="hold-transition login-page">
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-sm-11 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-0">
                            <img src="<?= base_url('') ?>assets/foto/logo/<?= $aplikasi->logo ?> " height="100" class='mb-4'>
                            <h3>Sign Up</h3>
                            <p>Please fill the form to register.</p>
                        </div>
                        <form action="<?= base_url('login/insert') ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <input hidden type="number" id="id_user" class="form-control" value="<?= set_value('id_user') ?>" name="id_user">
                                <input hidden type="number" id="id_level" class="form-control" value="<?= set_value('id_level') ?>" name="id_level">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nis">NIS</label>
                                        <input type="number" id="nis" class="form-control" value="<?= set_value('nis') ?>" name="nis">
                                        <?= form_error('nis', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" class="form-control" value="<?= set_value('username') ?>" name="username">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" id="full_name" class="form-control" value="<?= set_value('full_name') ?>" name="full name">
                                        <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control" aria-label="jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin" value="<?= set_value('jenis_kelamin') ?>">
                                            <option selected disabled>Jenis Kelamin</option>
                                            <option value="laki-laki">Laki - Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir') ?>" name="tempat_lahir">
                                        <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" id="tgl_lahir" class="form-control" value="<?= set_value('tgl_lahir') ?>" name="tgl_lahir">
                                        <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" class="form-control" name="password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="alamat">No Hp</label>
                                        <input type="text" class="form-control" name="no_tlp" id="no_tlp" required>
                                        <?= form_error('no_tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control" value="<?= set_value('email') ?>" name="email">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="file">Image</label>
                                        <input type="file" id="imagefile" class="form-control" value="<?= set_value('imagefile') ?>" name="imagefile">
                                        <?= form_error('imagefile', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <label for="level" class="col-sm-3 col-form-label">Sekolah</label>
                                    <div class="col-md-12 kosong">
                                        <select class="form-control" name="id_sekolah" id="id_sekolah">
                                            <option value="">Pilih Sekolah</option>
                                            <?php
                                            foreach ($sekolah as $level) { ?>
                                                <option value="<?= $level->id; ?>"><?= $level->nama; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" aria-label="With textarea"></textarea>
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </diV>

                            <a href="<?= base_url('login') ?>">Have an account? Login</a>
                            <div class="clearfix">
                                <button class="btn btn-primary float-end" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- jquery-validation -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

</body>

</html>
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
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="<?= base_url('assets/foto/logo/' . $aplikasi->logo . '') ?>" alt="" class="logo" style="height: 80px;">
        <br>
        <a href="<?php echo base_url(); ?>">
          <b>
            <?php
            echo $aplikasi->nama_aplikasi;
            ?>
          </b></a>

      </div>
      <div class="card-body">
        <p class="login-box-msg">Login Siswa</p>

        <form action="" role="form" id="quickForm" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <!-- /.col -->
          <div class="col-md-12">
            <button type="button" id="masuk" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter" style="margin-bottom: 10px;">Admin</button>
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#konsoler">Guru</button>
            </div>
          </div>
          <!-- /.col -->
      </div>
      </form>
      <p class="col-mb-4">
      <p style="text-align: center;">Belum Punya Akun? <a href="<?= base_url('login/register') ?>" class="text-center">Register</a></p>
      </p>
    </div>

    <!-- /.login-card-body -->

    <!-- /.login-box -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <p class="login-box-msg">Login Admin</p>

              <form action="" role="form" id="admin" method="post">
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                  <button type="button" id="login" class="btn btn-primary btn-block">Sign In</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="konsoler" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <p class="login-box-msg">Login Guru</p>

              <form action="" role="form" id="log" method="post">
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-12">
                  <button type="button" id="kons" class="btn btn-primary btn-block">Sign In</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

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
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
    <script>
      $("#masuk").on('click', function() {
        $.ajax({
          url: '<?php echo base_url('login/login') ?>',
          type: 'POST',
          data: $('#quickForm').serialize(),
          dataType: 'JSON',
          success: function(data) {
            if (data.status) {
              toastr.success('Login Berhasil!');
              var url = '<?php echo base_url('dashboard') ?>';
              window.location = url;
            } else if (data.error) {
              toastr.error(
                data.pesan
              );
            } else {
              for (var i = 0; i < data.inputerror.length; i++) {
                $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                $('[name="' + data.inputerror[i] + '"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
              }
            }
          }
        });

      });
    </script>
    <script>
      $("#kons").on('click', function() {
        $.ajax({
          url: '<?php echo base_url('login/login') ?>',
          type: 'POST',
          data: $('#log').serialize(),
          dataType: 'JSON',
          success: function(data) {
            if (data.status) {
              toastr.success('Login Berhasil!');
              var url = '<?php echo base_url('dashboard') ?>';
              window.location = url;
            } else if (data.error) {
              toastr.error(
                data.pesan
              );
            } else {
              for (var i = 0; i < data.inputerror.length; i++) {
                $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                $('[name="' + data.inputerror[i] + '"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
              }
            }
          }
        });

      });
    </script>
    <script>
      $("#login").on('click', function() {
        $.ajax({
          url: '<?php echo base_url('login/login') ?>',
          type: 'POST',
          data: $('#admin').serialize(),
          dataType: 'JSON',
          success: function(data) {
            if (data.status) {
              toastr.success('Login Berhasil!');
              var url = '<?php echo base_url('dashboard') ?>';
              window.location = url;
            } else if (data.error) {
              toastr.error(
                data.pesan
              );
            } else {
              for (var i = 0; i < data.inputerror.length; i++) {
                $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                $('[name="' + data.inputerror[i] + '"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
              }
            }
          }
        });

      });
    </script>
    <script type="text/javascript">
      (function() {
        var options = {
          whatsapp: "085797887711", // WhatsApp number
          call_to_action: "Message us", // Call to action
          button_color: "#FF6550", // Color of button
          position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol,
          host = "getbutton.io",
          url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function() {
          WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
      })();
    </script>
</body>

</html>
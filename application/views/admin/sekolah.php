<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sekolahan Data</h3>
                <div class="card-tools">
                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_sekolah()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-head-fixed text-nowrap" id="datatable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $saldo = 0;
                        foreach ($sekolah as $d) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><b><?= $d->nama ?></b></td>
                                <td><?= $d->alamat ?></td>
                                <td>

                                    <a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Tambah Jawaban" data-toggle="modal" data-target="#modal-edit<?= $d->id ?>"><i class="fa fa-edit"></i>
                                        <a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Delete" data-toggle="modal" data-target="#modal-delete<?= $d->id ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-edit<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="edit-kuesioner" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title ">Edit Sekolah</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="sekolah" method="post" action="<?= base_url('sekolah/update'); ?>" enctype="multipart/form-data">
                                                <input type="hidden" value="<?php echo $d->id ?>" name="id" id="id" />
                                                <div class="form-group">
                                                    <label for="nama">Nama</label><br>
                                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?= $d->nama ?>"></input>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label><br>
                                                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" value="<?= $d->alamat ?>"></input>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="tambah" class="btn btn-primary">Kirim</button>
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
                                            <h5 class="modal-title" id="addNewDonaturLabel">Pertanyaan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $d->nama ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('sekolah/delete?id=') ?><?= $d->id ?>" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="modal fade" id="modal-add" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Sekolah Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form class="sekolah" method="post" action="<?= base_url('sekolah/insert'); ?>" enctype="multipart/form-data">
                    <!-- <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'form')) ?> -->
                    <input type="hidden" value="" name="id_user" />
                    <div class="card-body">
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">NAMA</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="alamat" class="col-sm-3 col-form-label">ALAMAT</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
    function updatekuesioner() {
        $('#modal-edit').modal('show');
    }

    function add_sekolah() {
        $('#modal-add').modal('show');
    }
</script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
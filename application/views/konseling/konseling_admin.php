<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Jawaban</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> -->

                        <!-- <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-head-fixed text-nowrap" id="datatable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>NAMA</th>
                            <th>PERTANYAAN</th>
                            <th>JAWABAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $saldo = 0;
                        foreach ($jawaban_konseling as $d) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><b><?= $d->nis ?></b></td>
                                <td><?= $d->full_name ?></td>
                                <td><?= $d->pesan ?></td>
                                <td><?= $d->jawaban ?></td>
                                <td>

                                    <a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Tambah Jawaban" data-toggle="modal" data-target="#modal-edit<?= $d->id ?>"><i class="fa fa-plus"></i>
                                        <a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Delete" data-toggle="modal" data-target="#modal-delete<?= $d->id ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-edit<?= $d->id ?>" tabindex="-1" role="dialog" aria-labelledby="edit-kuesioner" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title ">Jawaban</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">
                                            <form class="user" method="post" action="<?= base_url('konseling/update_jawaban'); ?>" enctype="multipart/form-data">
                                                <input type="hidden" value="<?php echo $d->id ?>" name="id" id="id" />
                                                <div class="form-group">
                                                    <label for="pesan">Jawaban</label><br>
                                                    <textarea type="text" class="form-control form-control-user" id="jawaban" name="jawaban" value=""><?= $d->jawaban ?></textarea>
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
                                            <p>Anda yakin ingin menghapus <?= $d->full_name ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('konseling/delete_jawaban?id=') ?><?= $d->id ?>" class="btn btn-primary">Hapus</a>
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
<script>
    function updatekuesioner() {
        $('#modal-edit').modal('show');
    }
</script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kuesioner Admin</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100px;">
                        <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> -->
                        <div class="input-group-append">
                            <a href="<?php echo base_url('kuesioner/cetak') ?>" type="button" class="btn btn-sm btn-outline-info" id="dwn_menu" target="_blank" title="Download"><i class="fas fa-download"></i> Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class=" table table-head-fixed text-nowrap" id="datatable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>NAMA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $saldo = 0;
                        foreach ($career_admin as $d) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><b><?= $d->nis ?></b></td>
                                <td><?= $d->full_name ?></td>
                                <td>

                                    <a class="btn btn-xs btn-outline-primary" href="<?= base_url('kuesioner/detail_kuesioner/' . $d->nis . '') ?>" title="Tambah Jawaban"><i class="fa fa-plus"></i>
                                        <!-- <a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Delete" data-toggle="modal" data-target="#modal-delete<?= $d->nis ?>"><i class="fas fa-trash"></i></a> -->
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-edit">
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
                                                    <textarea type="text" class="form-control form-control-user" id="jawaban" name="jawaban" value=""></textarea>
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
                            <div class="modal fade" id="modal-delete<?= $d->nis ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
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
                                            <a href="<?= base_url('konseling/delete_jawaban?id=') ?><?= $d->id_respond ?>" class="btn btn-primary">Hapus</a>
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
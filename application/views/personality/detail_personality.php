<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <h2 class="text-center">Jawaban Personality Test</h2>
                <table id="datatable" class="table table-bordered table-striped table-hover responsive">
                    <thead>
                        <tr class="bg-info">
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $saldo = 0;

                        foreach ($detail_personality as $d) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d->pertanyaan ?></td>
                                <?php if ($d->jawabanHarapan == '1') { ?>
                                    <td>Tidak</td>
                                <?php } elseif ($d->jawabanHarapan == '2') { ?>
                                    <td>Ya</td>
                                <?php } else { ?>
                                    <td>Netral</td>
                                <?php } ?>
                            </tr>
                        <?php $no++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
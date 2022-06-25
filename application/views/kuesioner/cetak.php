<div class="card-body table-responsive">
    <table class=" table table-head-fixed text-nowrap" id="datatable">
        <thead>
            <tr>
                <th>NO</th>
                <th>NIS</th>
                <th>NAMA</th>
                <th>HASIL</th>
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
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
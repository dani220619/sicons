<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <h2 class="text-center">CSI Result</h2>
                <?php
                $h = 1;
                $ws = 0;
                foreach ($total->result_array() as $tot) {
                    // $ms += $tot['nyata'];
                    $ws += ((($tot['harapan'] / $h) * 100) / 100);
                } ?>
                <div class="row">
                    <div class="col-lg-4 col-xs-6">
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h1 class="text-center" style="font-size: 20px"><?= $a ?></h1>
                                <br>
                                <br>
                                <h3 class="text-center"><?= number_format((($ws / 59) / (100 / 100) * 100), 2) ?><sup style="font-size: 20px">%</sup></h3>
                                <?php if (number_format((($ws / 59) / (100 / 100) * 100), 2) <= 25) {
                                    $ket = "Kurang";
                                } elseif (number_format((($ws / 59) / (100 / 100) * 100), 2) >= 26 && number_format((($ws / 59) / (100 / 100) * 100), 2) <= 50) {
                                    $ket = "Cukup";
                                } elseif (number_format((($ws / 59) / (100 / 100) * 100), 2) >= 51 && number_format((($ws / 59) / (100 / 100) * 100), 2) <= 75) {
                                    $ket = "Baik";
                                } else {
                                    $ket = "Sangat Baik";
                                } ?>
                                <p class="text-center"><?= $ket ?></p>
                            </div>
                            <div class="icon">
                                <br> <i class="ion ion-stats-bars"></i>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $row = $db->get_results("SELECT nilai FROM tb_rel_alternatif WHERE nilai IS NULL");
    if (!$ALTERNATIF || !$KRITERIA):
        echo "Tampaknya anda belum mengatur alternatif dan kriteria. Silahkan tambahkan minimal 3 alternatif dan 3 kriteria.";
    elseif ($row):
        echo "Tampaknya anda belum mengatur semua nilai alternatif. Silahkan atur pada menu <strong>Nilai Alternatif</strong>.";
    else:
?>
<?php
    $row = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
?>
<div class="page-header">
    <h2>Perhitungan</h2>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Analisa</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <th>Nama</th>
                <?php
                $data = get_data();
                foreach($KRITERIA as $key => $val):?>
                <th><?=$val->nama_kriteria?></th>
                <?php endforeach;?>
            </tr></thead>
            <?php foreach($data as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$ALTERNATIF[$key]?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,5)?></td>
                <?php endforeach;?>
            </tr>
            <?php endforeach?>
            <tfoot><tr>
                <td colspan="2">Cost/Benefit</td>
                <?php foreach($KRITERIA as $key => $val):?>
                <td><?=$val->atribut=='benefit' ? 1 : -1?></td>
                <?php endforeach?>
            </tr></tfoot>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Konversi</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <th>Nama</th>
                <?php
                $data_cb = get_data_cb($data);
                $minmax = get_minmax($data_cb);
                foreach($KRITERIA as $key => $val):?>
                <th><?=$val->nama_kriteria?></th>
                <?php endforeach;?>
            </tr></thead>
            <?php foreach($data_cb as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$ALTERNATIF[$key]?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,5)?></td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>
            <tfoot><tr>
                <td colspan="2">Max</td>
                <?php foreach($minmax['max'] as $key => $val):?>
                <td><?=$val?></td>
                <?php endforeach?>
            </tr><tr>
                <td colspan="2">Min</td>
                <?php foreach($minmax['min'] as $key => $val):?>
                <td><?=$val?></td>
                <?php endforeach?>
            </tr></tfoot>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">N<sub>ij</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <?php
                $nij = get_nij($data_cb, $minmax);
                foreach($KRITERIA as $key => $val):?>
                <th><?=$key?></th>
                <?php endforeach;?>
            </tr></thead>
            <?php foreach($nij as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,5)?></td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Terbobot</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <?php
                $terbobot = get_terbobot($nij);
                foreach($KRITERIA as $key => $val):?>
                <th><?=$key?></th>
                <?php endforeach;?>
            </tr></thead>
            <?php foreach($terbobot as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <?php foreach($val as $k => $v):?>
                <td><?=round($v,5)?></td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Nilai Utilitas (S) dan Ukuran Regret (R)</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th>Kode</th>
                <?php
                $sr = get_utilitas_regret($terbobot);
                foreach($KRITERIA as $key => $value):?>
                <th><?=$key?></th>
                <?php endforeach;?>
                <th>S</th>
                <th>R</th>
            </tr></thead>
            <?php foreach($terbobot as $key => $value):?>
            <tr>
                <td><?=$key?></td>
                <?php foreach($value as $k => $v):?>
                <td><?=round($v,5)?></td>
                <?php endforeach;?>
                <td><?=round($sr['s'][$key], 5)?></td>
                <td><?=round($sr['r'][$key], 5)?></td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">S+</td>
                <td><?=round(max($sr['s']), 5)?></td>
                <td>&nbsp;</td>
            </tr><tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">S-</td>
                <td><?=round(min($sr['s']), 5)?></td>
                <td>&nbsp;</td>
            </tr><tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">R+</td>
                <td>&nbsp;</td>
                <td><?=round(max($sr['r']), 5)?></td>
            </tr><tr>
                <td colspan="<?=count($KRITERIA) + 1?>" class="text-right">R-</td>
                <td>&nbsp;</td>
                <td><?=round(min($sr['r']), 5)?></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Indeks Vikor</h3>
    </div>
    <div class="table-responsive">
        <?php
        $rows = $db->get_results("SELECT * FROM tb_alternatif INNER JOIN tb_kategori_wilayah ON
          tb_alternatif.id_kategori_wilayah=tb_kategori_wilayah.id");

          echo '<br>';

        $indeks = array(0.4, 0.5, 0.6);
        $q = get_q($sr, $indeks);
        $rank_q = get_rank_q($q);
        $rata = get_rata($rank_q);
        $rank_rata = get_rank($rata);
        ?>

 
        
        <form action="./checklist_post.php" id="form-checklist" method="post">
        <table class="table table-bordered table-striped table-hover">
          <thead><tr>
            <th rowspan="2">Kode</th>
            <th rowspan="2">Nama</th>
            <th colspan="<?=count($indeks)?>">Indeks Vikor (Q)</th>
            <th colspan="<?=count($indeks)?>">Rank</th>
            <th rowspan="2">Rata</th>
            <th rowspan="2">Wilayah</th>
            <th rowspan="2">Status Survei</th>
          </tr><tr>
            <?php foreach($indeks as $key => $val): ?>
              <th>v=<?=$val?></th>
            <?php endforeach?>
            <?php foreach($indeks as $key => $val):?>
              <th>v<?=$key+1?></th>
            <?php endforeach?>
          </tr></thead>

          <?php foreach($rank_rata as $key => $val):?>
            <?php $filter = array_filter($rows, function($item) use ($key){
                    return $item->kode_alternatif == $key; 
                  });
                  ?>
            <tr>
                <td><?=$key?></td>
                <td><?=reset($filter)->nama_alternatif?></td>
                <?php foreach($q[$key] as $k => $v):?>
                    <td><?=round($v,5)?></td>
                    <?php endforeach?>
                    <?php foreach($q[$key] as $k => $v):?>
                    <td><?=$rank_q[$key][$k]?></td>
                    <?php endforeach?>
                    <td><?=round($rata[$key],5)?></td>
                    <td><?=reset($filter)->wilayah?></td>
                    <td>
                    <?php
                    if (isset($_POST['getchecklist'])){
                        foreach ($_POST['getchecklist'] as $selectedchecklist)
                        $selected[$selectedchecklist] = "checked";
                    }
                    if(reset($filter)->is_checked) {
                    ?>
                        <input type="checkbox" checked name="getchecklist[]" <?php echo $selected[$checklist] ?> value="<?php echo $key; ?>" />
                    <?php
                    } else {
                    ?>
                        <input type="checkbox" name="getchecklist[]" <?php echo $selected[$checklist] ?> value="<?php echo $key; ?>" />
                    <?php
                    }
                    ?>
                    </td>
            </tr>
          <?php endforeach;?>
        </table>
        </form>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <a class="btn btn-default" target="_blank" href="cetak.php?m=hitung"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            <?php if($_POST) include'aksi.php'?>
            <button class="btn btn-primary pull-right" type="submit" form="form-checklist" name="btn-checklist"><span class="glyphicon glyphicon-save"></span> Simpan Checklist</button>
        </div>
    </div>
</div>
<?php endif; ?>

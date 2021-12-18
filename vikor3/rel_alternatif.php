<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>

<div class="panel panel-default">
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
                </tr>
            </thead>
            <?php foreach($data as $key => $value):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$ALTERNATIF[$key]?></td>
                <?php foreach($value as $k => $v):?>
                <td><?=$v?></td>
                <?php endforeach;?>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
<a href="?m=rel_alternatif_ubah"><button class="btn btn-warning"><span class="glyphicon glyphicon-arrow-edit"></span> Ubah</button>
<a href="?m=hitung"><button class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selanjutnya</button>

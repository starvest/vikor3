
<div class="page-header">
    <h1>Ubah nilai bobot &raquo; <small></small></h1>
</div>

<div class="table-responsive">
  <form class="" action="aksi.php?act=rel_alternatif_ubah" method="post">

<table class="table table-bordered table-striped table-hover">
    <thead><tr>
        <th>Nama</th>
        <?php

        $data = get_data();
        $size =  sizeOf($data);
        foreach($KRITERIA as $key => $val):?>
        <th><?=$val->nama_kriteria?></th>
        <?php endforeach;?>
        </tr>
    </thead>
    <input type="text" hidden name="size" value="<?=$size?>">
    <?php foreach($data as $key => $value):?>
    <tr>
        <td><?=$ALTERNATIF[$key]?></td>
        <input type="text" hidden name="id-alternatif[]" value="<?=$key?>">
        <?php
         foreach($value as $k => $v):
           ?>
        <td><input class="form-control" type="text" name="<?=$k?>[]" value="<?=$v?>"/> </td>
        <?php endforeach;?>
    </tr>
    <?php endforeach;?>
</table>
<div class="form-group">
    <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
    <a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</div>
</form>
</div>

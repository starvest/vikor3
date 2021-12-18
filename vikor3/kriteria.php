<div class="page-header">
    <h1>Kriteria</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="kriteria" />
                        <div class="form-group">
                <a class="btn btn-primary" href="?m=kriteria_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah Kriteria</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="nw">
                <th>Kode</th>
                <th>Nama</th>
                <th>Atribut</th>
                <th>Bobot</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
         $q = $_GET['q'];
        $rows = $db->get_results("SELECT * FROM tb_kriteria 
        WHERE kode_kriteria LIKE '%$q%' OR nama_kriteria LIKE '%$q%' 
        ORDER BY kode_kriteria");
        
        foreach($rows as $row):?>
        <tr>
            
            <td><?=$row->kode_kriteria?></td>
            <td><?=$row->nama_kriteria?></td>
            <td><?=$row->atribut?></td>
            <td><?=$row->bobot?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=kriteria_ubah&amp;ID=<?=$row->kode_kriteria?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=kriteria_hapus&amp;ID=<?=$row->kode_kriteria?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>
<a href="?m=alternatif"><button class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selanjutnya</button>
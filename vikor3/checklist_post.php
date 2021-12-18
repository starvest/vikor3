<?php
require_once'functions.php';

$row = $db->get_results("SELECT * FROM tb_alternatif");
if(isset($_POST['btn-checklist'])){
    if(sizeof($_POST['getchecklist']) > 0) {
        foreach($row as $keyDb => $valDb) {
            $inTrue = 0;
            foreach($_POST['getchecklist'] as $key => $val) {
                if($val == $valDb->kode_alternatif) {
                    $inTrue = 1;
                    break;
                }
            }
            $db->query("UPDATE tb_alternatif SET is_checked='$inTrue' WHERE kode_alternatif='$valDb->kode_alternatif'");
        }
    } else {
        $inFalse = 0;
        foreach ($row as $key => $val) {
            $db->query("UPDATE tb_alternatif SET is_checked='$inFalse' WHERE kode_alternatif='$val->kode_alternatif'");
        }
    }
}
header("location:javascript://history.go(-1)");
?>
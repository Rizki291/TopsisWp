<?php

require "../crud/koneksi.php";

if (isset($_GET['id'])) {
    //membuat query untuk menghapus data user
    $query = "DELETE FROM tbl_kriteria WHERE id_kriteria = '$_GET[id]'";

    //mengeksekusi query
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo 'berhasil';
        header('location:../admin/form_kriteria.php');
    } else {
        echo 'gagal' . mysqli_error($koneksi);
    }
}
?>
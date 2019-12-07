<?php

require "../crud/koneksi.php";

if (isset($_GET['id'])) {
    //membuat query untuk menghapus data user
    $query = "DELETE FROM tbl_peringkat WHERE nisn = '$_GET[id]'";

    //mengeksekusi query
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo 'berhasil';
        header('location:../admin/form_rangking.php');
    } else {
        echo 'gagal' . mysqli_error($koneksi);
    }
}
?>
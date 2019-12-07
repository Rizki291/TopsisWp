<?php

include '../crud/koneksi.php';
if (isset($_POST['submit'])) {

    
    $nama_pelatih = $_POST ['nama_pelatih'];
    $instansi = $_POST ['instansi'];
    $kedudukan = $_POST ['kedudukan'];
    

    $query = "INSERT INTO tbl_pelatih VALUES(null,'$nama_pelatih','$instansi','$kedudukan')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        ?>

        <script language="javascript">
            alert('Data Berhasil Tersimpan');
            window.location = '../admin/form_tambah_pelatih.php';
        </script>
        <?php

    } else {
        echo "GAGAL TERSIMPAN" . mysqli_error($koneksi);
    }
}
?>
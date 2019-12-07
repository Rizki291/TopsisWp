<?php

include '../crud/koneksi.php';
if (isset($_POST['submit'])) {

    
    $nama_kriteria= $_POST ['nama_kriteria'];
    $tipe_kriteria= $_POST ['tipe_kriteria'];
    $bobot= $_POST ['bobot'];
    $nilai= $_POST ['nilai'];
   
    
    $query = "INSERT INTO tbl_kriteria VALUES(null,'$nama_kriteria','$tipe_kriteria','$bobot','$nilai')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        ?>

        <script language="javascript">
            alert('Data Berhasil Tersimpan');
            window.location = '../admin/form_tambah_kriteria.php';
        </script>
        <?php

    } else {
        echo "GAGAL TERSIMPAN" . mysqli_error($koneksi);
    }
}
?>
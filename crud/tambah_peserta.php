<?php

include '../crud/koneksi.php';
if (isset($_POST['submit'])) {

    
    
    $nisn = $_POST ['nisn'];
    $nama_peserta = $_POST ['nama_peserta'];
    $ttl = $_POST ['ttl'];
    $alamat = $_POST ['alamat'];
    $asal_sekolah = $_POST ['asal_sekolah'];
    

    $query = "INSERT INTO tbl_peserta VALUES(null,'$nisn','$nama_peserta','$ttl','$alamat','$asal_sekolah')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        ?>

        <script language="javascript">
            alert('Data Berhasil Tersimpan');
            window.location = '../admin/form_tambah_peserta.php';
        </script>
        <?php

    } else {
        echo "GAGAL TERSIMPAN" . mysqli_error($koneksi);
    }
}
?>
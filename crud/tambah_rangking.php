<?php

include '../crud/koneksi.php';
if (isset($_POST['submit'])) {

    $nisn = $_POST ['nisn'];
    $nama_peserta = $_POST ['nama_peserta'];
 

    $query1 = mysqli_query($koneksi,"select * from tbl_kriteria");
    while ($data = mysqli_fetch_array($query1)) {
        $stripped = str_replace(' ', '', $data['nama_kriteria']);
        $query = "INSERT INTO tbl_peringkat VALUES(null,'$nisn','$nama_peserta','".$data['nama_kriteria']."','".$_POST[$stripped]."')";
        $result = mysqli_query($koneksi,$query);
    }
    

    if ($result) {
        ?>

        <script language="javascript">
            alert('Data Berhasil Tersimpan');
            window.location = '../admin/form_tambah_rangking.php';
        </script>
        <?php

    } else {
        echo "GAGAL TERSIMPAN" . mysqli_error($koneksi);
    }
}
?>
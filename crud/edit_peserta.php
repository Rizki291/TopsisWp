<?php

require "../crud/koneksi.php";
?>
<?php

if (isset($_POST['submit'])) {
    $id = $_POST ['id'];
    $nisn = $_POST ['nisn'];
    $nama_peserta = $_POST ['nama_peserta'];
    $ttl = $_POST ['ttl'];
    $alamat = $_POST ['alamat'];
    $asal_sekolah = $_POST ['asal_sekolah'];


    $sql = "UPDATE tbl_peserta SET nisn='$nisn',nama_peserta='$nama_peserta',ttl='$ttl',alamat='$alamat', asal_sekolah='$asal_sekolah' where tbl_peserta.id='$id'";
    $eks = mysqli_query($koneksi, $sql);
    if ($eks) {
        ?>
        <script language="javascript">
            alert('Data Berhasil DI UBAH');
            window.location = '../admin/form_peserta.php'
        </script>
        <?php

    } else {
        echo "GAGAL Di UBAH" . mysqli_error($koneksi);
    }
}
?>
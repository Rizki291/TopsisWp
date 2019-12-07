<?php

require "../crud/koneksi.php";
?>
<?php

if (isset($_POST['submit'])) {
    $id_pelatih = $_POST ['id_pelatih'];
    $nama_pelatih = $_POST ['nama_pelatih'];
    $instansi= $_POST ['instansi'];
    $kedudukan = $_POST ['kedudukan'];
    

    $sql = "UPDATE tbl_pelatih SET nama_pelatih='$nama_pelatih',instansi='$instansi',kedudukan='$kedudukan' where tbl_pelatih.id_pelatih='$id_pelatih'";
    $eks = mysqli_query($koneksi, $sql);
    if ($eks) {
        ?>
        <script language="javascript">
            alert('Data Berhasil Di UBAH');
            window.location = '../admin/form_pelatih.php'
        </script>
        <?php

    } else {
        echo "GAGAL Di UBAH" . mysqli_error($koneksi);
    }
}
?>
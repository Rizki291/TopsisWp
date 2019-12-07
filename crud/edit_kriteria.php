<?php

require "../crud/koneksi.php";
?>
<?php

if (isset($_POST['submit'])) {
    $id_kriteria = $_POST ['id_kriteria'];
    $nama_kriteria = $_POST ['nama_kriteria'];
    $tipe_kriteria = $_POST ['tipe_kriteria'];
    $bobot = $_POST ['bobot'];
    $nilai = $_POST ['nilai'];
         

    $sql = "UPDATE tbl_kriteria SET nama_kriteria='$nama_kriteria', tipe_kriteria='$tipe_kriteria', bobot='$bobot', nilai='$nilai' where tbl_kriteria.id_kriteria='$id_kriteria'";
    $eks = mysqli_query($koneksi, $sql);
    if ($eks) {
        ?>
        <script language="javascript">
            alert('Data Berhasil Di UBAH');
            window.location = '../admin/form_kriteria.php'
        </script>
        <?php

    } else {
        echo "GAGAL Di UBAH" . mysqli_error($koneksi);
    }
}
?>
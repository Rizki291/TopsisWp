<?php

require "../crud/koneksi.php";
?>
<?php

if (isset($_POST['submit'])) {
    $id_admin = $_POST ['id_admin'];
    $nama_lengkap = $_POST ['nama_lengkap'];
    $username= $_POST ['username'];
    $password = $_POST ['password'];
    

    $sql = "UPDATE tbl_admin SET nama_lengkap='$nama_lengkap',username='$username',password='$password' where tbl_admin.id_admin='$id_admin'";
    $eks = mysqli_query($koneksi, $sql);
    if ($eks) {
        ?>
        <script language="javascript">
            alert('Data Berhasil Di UBAH');
            window.location = '../admin/form_admin.php'
        </script>
        <?php

    } else {
        echo "GAGAL Di UBAH" . mysqli_error($koneksi);
    }
}
?>
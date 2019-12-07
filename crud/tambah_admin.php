<?php

include '../crud/koneksi.php';
if (isset($_POST['submit'])) {

    
    $nama_lengkap = $_POST ['nama_lengkap'];
    $username = $_POST ['username'];
    $password = $_POST ['password'];
    

    $query = "INSERT INTO tbl_admin VALUES(null,'$nama_lengkap','$username','$password')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        ?>

        <script language="javascript">
            alert('Data Berhasil Tersimpan');
            window.location = '../admin/form_tambah_admin.php';
        </script>
        <?php

    } else {
        echo "GAGAL TERSIMPAN" . mysqli_error($koneksi);
    }
}
?>
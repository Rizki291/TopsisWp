<?php

require "../crud/koneksi.php";
?>
<?php

if (isset($_POST['submit'])) {
    $id_peringkat = $_POST ['id_peringkat'];



    $query1 = mysqli_query($koneksi,"select * from tbl_kriteria");
    while ($data = mysqli_fetch_array($query1)) {
        $stripped = str_replace(' ', '', $data['nama_kriteria']);
        $query = "UPDATE tbl_peringkat SET nilai='".$_POST[$stripped]."' where nisn=$id_peringkat and nama_kriteria='".$data['nama_kriteria']."'";
        $result = mysqli_query($koneksi,$query);
    }

   
    if ($result) {
        ?>
        <script language="javascript">
            alert('Data Berhasil Di UBAH');
            window.location = '../admin/form_rangking.php'
        </script>
        <?php

    } else {
        echo "GAGAL Di UBAH" . mysqli_error($koneksi);
    }
}
?>
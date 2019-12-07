<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=testexport.xls");

?>
<table border="1">
	<tr><th>TABLE WP</th></tr>
	<tr>
		<th>NO.</th>
		<th>ID</th>
		<th>NAMA</th>
		<th>HASIL</th>
		<th>PERINGKAT</th>
	</tr>
	<?php
	//koneksi ke database
	include '../crud/koneksi.php';
	//query menampilkan data
	$sql = mysqli_query($koneksi,"SELECT * FROM tbl_finis where Banding='WP' ORDER BY peringkat ASC");
	$no = 1;
	while($data = mysqli_fetch_array($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['id_alternatif'].'</td>';
			$query = mysqli_query($koneksi,"SELECT * FROM tbl_peringkat where nisn='".$data['id_alternatif']."'");
			$data2 = mysqli_fetch_array($query);
		echo '
			<td>'.$data2['nama_peserta'].'</td>
			<td>'.$data['hasil'].'</td>
			<td>'.$data['peringkat'].'</td>
		</tr>
		';
		$no++;
	}
	?>
</table>
<br>
<br>
<table border="1">
	<tr><th>TABLE TOPSIS</th></tr>
	<tr>
		<th>NO.</th>
		<th>ID</th>
		<th>NAMA</th>
		<th>HASIL</th>
		<th>TOPSIS</th>
	</tr>
	<?php
	//koneksi ke database
	include '../crud/koneksi.php';
	//query menampilkan data
	$sql1 = mysqli_query($koneksi,"SELECT * FROM tbl_finis where Banding='TOPSIS' ORDER BY peringkat ASC");
	$no = 1;
	while($data = mysqli_fetch_array($sql1)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['id_alternatif'].'</td>';
			$query = mysqli_query($koneksi,"SELECT * FROM tbl_peringkat where nisn='".$data['id_alternatif']."'");
			$data2 = mysqli_fetch_array($query);
		echo '
			<td>'.$data2['nama_peserta'].'</td>
			<td>'.$data['hasil'].'</td>
			<td>'.$data['peringkat'].'</td>
			
		</tr>
		';
		$no++;
	}
	?>
</table>
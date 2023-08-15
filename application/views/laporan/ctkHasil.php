<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Penilaian Karyawan Kontrak</title>
	<style>
		table tr td{
			padding-left:10px;
			padding-right:10px;
		}
	</style>
</head>
<body>
 
<div id="container">
	<h3>Laporan Hasil Penilaian Karyawan Kontrak</h3>
	<p>Period: <?= $from ?> Sampai <?= $to ?></p>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
		<thead>
	  		<tr>
          <th class="normal">Rank</th>
          <th class="normal">Tgl Penilaian</th>
		  <th style="width:120px">Unit</th>
		  <th>Penanggung Jawab</th>
          <th class="normal">Karyawan</th>
          <th class="normal">Batas Rekrutmen</th>
          <th class="normal">Batas Nilai</th>
          <th class="normal">Nilai</th>
          <th class="normal">Habis Kontrak</th>
          <th class="normal">Keterangan</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
          			<td><?php echo $row['rank']; ?></td>
					<td><?php echo $row['tgl_penilaian']; ?></td>
					<td><?php echo $row['id_unit']."</br>".$row['nm_unit']; ?></td>
					<td><?php echo $row['kepala_unit']; ?></td>
					<td><?php echo $row['id_karyawan']."</br>".$row['nm_karyawan']; ?></td>
					<td><?php echo $row['kebutuhan_karyawan']; ?></td>
					<td><?php echo $row['nilai_batas']; ?></td>
					<td><?php echo $row['nilai']; ?></td>
          <td><?php echo $row['tgl_kontrak']; ?></td>
					<td style="<?= $row['keterangan'] == "Dirumahkan" ? 'background-color:red;' : ''; ?>" ><?php echo $row['keterangan']; ?></td>
				</tr>
	  		<?php endforeach; ?>
	  	</tbody>

	  </table>
 
</div>
 
</body>
</html>

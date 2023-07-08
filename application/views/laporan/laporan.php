<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Penilaian Karyawan Kontrak</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Hasil Penilaian Karyawan Kontrak</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
		<thead>
	  		<tr>
          <th class="normal">Rank</th>
          <th class="normal">Tgl Penilaian</th>
          <th class="normal">ID Karyawan</th>
          <th class="normal">Nama Karyawan</th>
          <th class="normal">Batas Rekrutmen</th>
          <th class="normal">Batas Nilai</th>
          <th class="normal">Nilai</th>
          <th class="normal">Keterangan</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
          <td><?php echo $row['rank']; ?></td>
					<td><?php echo $row['tgl_penilaian']; ?></td>
					<td><?php echo $row['id_karyawan']; ?></td>
					<td><?php echo $row['nm_karyawan'] ?></td>
					<td><?php echo $row['kebutuhan_karyawan']; ?></td>
          <td><?php echo $row['nilai_batas']; ?></td>
          <td><?php echo $row['nilai']; ?></td>
          <td style="<?= $row['keterangan'] == "Dirumahkan" ? 'background-color:red;' : ''; ?>" ><?php echo $row['keterangan']; ?></td>
				</tr>
	  		<?php endforeach; ?>
	  	</tbody>

	  </table>
 
</div>
 
</body>
</html>

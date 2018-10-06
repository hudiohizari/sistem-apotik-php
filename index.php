<?php
	include('koneksi.php');
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Apotik</title>
	</head>
	<body>
		<div class = "dokter" style="margin-bottom:20px;">
			<h3 style="margin-bottom:0;display:inline">Dokter</h3>
			<a href="kelola.php?kelola=dokter" style="font-size:12px">(kelola dokter)</a>
			<table border="1">
				<tr>
					<td>Nomor Dokter</td>
					<td>Nama Dokter</td>
					<td>No. Telpon</td>
					<td>Jenis Kelamin</td>
					<td>Alamat</td>
				</tr>
				<?php
					$result = getAllManusia("dokter");
					while($row = mysqli_fetch_array($result)) {
						echo '
						<tr>
							<td>'.$row["no_primary"].'</td>
							<td>'.$row["nama"].'</td>
							<td>'.$row["no_telp"].'</td>
							<td>'.$row["jenis_kelamin"].'</td>
							<td>'.$row["alamat"].'</td>
						</tr>
						';
					}
				?>
			</table>
		</div>
		<div class = "karyawan" style="margin-bottom:20px;">
			<h3 style="margin-bottom:0;display:inline">Karyawan</h3>
			<a href="kelola.php?kelola=karyawan" style="font-size:12px">(kelola karyawan)</a>
			<table border="1">
				<tr>
					<td>Nomor karyawan</td>
					<td>Nama karyawan</td>
					<td>No. Telpon</td>
					<td>Jenis Kelamin</td>
					<td>Alamat</td>
				</tr>
				<?php
					$result = getAllManusia("karyawan");
					while($row = mysqli_fetch_array($result)) {
						echo '
						<tr>
							<td>'.$row["no_primary"].'</td>
							<td>'.$row["nama"].'</td>
							<td>'.$row["no_telp"].'</td>
							<td>'.$row["jenis_kelamin"].'</td>
							<td>'.$row["alamat"].'</td>
						</tr>
						';
					}
				?>
			</table>
		</div>
		<div class = "pelanggan" style="margin-bottom:20px;">
			<h3 style="margin-bottom:0;display:inline">Pelanggan</h3>
			<a href="kelola.php?kelola=pelanggan" style="font-size:12px">(kelola pelanggan)</a>
			<table border="1">
				<tr>
					<td>Nomor Pelanggan</td>
					<td>Nama Pelanggan</td>
					<td>No. Telpon</td>
					<td>Jenis Kelamin</td>
					<td>Alamat</td>
				</tr>
				<?php
					$result = getAllManusia("pelanggan");
					while($row = mysqli_fetch_array($result)) {
						echo '
						<tr>
							<td>'.$row["no_primary"].'</td>
							<td>'.$row["nama"].'</td>
							<td>'.$row["no_telp"].'</td>
							<td>'.$row["jenis_kelamin"].'</td>
							<td>'.$row["alamat"].'</td>
						</tr>
						';
					}
				?>
			</table>
		</div>
		<div class = "obat" style="margin-bottom:20px;">
			<h3 style="margin-bottom:0;display:inline">Obat</h3>
			<a href="kelola.php?kelola=obat" style="font-size:12px">(kelola obat)</a>
			<table border="1">
				<tr>
					<td>Nomor Obat</td>
					<td>Nama Obat</td>
					<td>Jenis Obat</td>
					<td>Harga</td>
					<td>Stok</td>
				</tr>
				<?php
					$result = getAllObat();
					while($row = mysqli_fetch_array($result)) {
						echo '
						<tr>
							<td>'.$row["no_obat"].'</td>
							<td>'.$row["nama_obat"].'</td>
							<td>'.$row["jenis_obat"].'</td>
							<td>Rp '.$row["harga"].'</td>
							<td>'.$row["stok"].' buah</td>
						</tr>
						';
					}
				?>
			</table>
		</div>
		<div class = "Transaksi" style="margin-bottom:20px;">
			<h3 style="margin-bottom:0;display:inline">Transaksi</h3>
			<a href="kelola.php?kelola=transaksi" style="font-size:12px">(kelola dokter)</a>
			<table border="1">
				<tr>
					<td>Nomor Transaksi</td>
					<td>Tanggal Transaksi</td>
					<td>Jumlah Obat</td>
					<td>Biaya</td>
					<td>Nama Pelanggan</td>
					<td>Nama Karyawan</td>
					<td>Nama Dokter</td>
					<td>Nama Obat</td>
				</tr>
				<?php
					$result = getAllTransaksi();
					while($row = mysqli_fetch_array($result)) {
						$res = getSingleManusia("pelanggan", $row["no_pelanggan"]);
						$pelanggan = mysqli_fetch_array($res);
						$res = getSingleManusia("karyawan", $row["no_karyawan"]);
						$karyawan = mysqli_fetch_array($res);
						$res = getSingleManusia("dokter", $row["no_dokter"]);
						$dokter = mysqli_fetch_array($res);
						$res = getSingleObat($row["no_obat"]);
						$obat = mysqli_fetch_array($res);
						echo '
						<tr>
							<td>'.$row["no_transaksi"].'</td>
							<td>'.$row["tanggal_transaksi"].'</td>
							<td>'.$row["jumlah_obat"].' buah</td>
							<td>Rp '.$row["biaya_transaksi"].'</td>
							<td>'.$pelanggan['nama'].'</td>
							<td>'.$karyawan['nama'].'</td>
							<td>'.$dokter['nama'].'</td>
							<td>'.$obat['nama_obat'].'</td>
						</tr>
						';
					}
				?>
			</table>
		</div>
	</body>
</html>
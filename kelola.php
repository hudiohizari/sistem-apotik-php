<?php
include('koneksi.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Kelola </title>
	</head>
	<body>
		<?php
		if(isset($_POST['submit'])){
			if($_POST['submit'] == "Tambah Dokter"){
				insertManusia('dokter', $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);
				header("Location: kelola.php?kelola=dokter");
			}
			else if($_POST['submit'] == "Edit Dokter"){
				updateManusia('dokter', $_POST['primary'], $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);			
				header("Location: kelola.php?kelola=dokter");
			}

			if($_POST['submit'] == "Tambah Karyawan"){
				insertManusia('karyawan', $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);
				header("Location: kelola.php?kelola=karyawan");
			}
			else if($_POST['submit'] == "Edit Karyawan"){
				updateManusia('karyawan', $_POST['primary'], $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);			
				header("Location: kelola.php?kelola=karyawan");
			}

			if($_POST['submit'] == "Tambah Pelanggan"){
				insertManusia('pelanggan', $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);
				header("Location: kelola.php?kelola=pelanggan");
			}
			else if($_POST['submit'] == "Edit Pelanggan"){
				updateManusia('pelanggan', $_POST['primary'], $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);			
				header("Location: kelola.php?kelola=pelanggan");
			}
		}
		else if(isset($_GET['hapus'])) {
			hapusManusia($_GET['hapus'], $_GET['primary'], $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);			
			header("Location: kelola.php?kelola=".$_GET['hapus']);
		}
		else if(isset($_GET['kelola'])) {
			if ($_GET['kelola'] == "dokter" || $_GET['kelola'] == "edit_dokter") {
				if ($_GET['kelola'] == "edit_dokter"){
					$res = getSingleManusia('dokter', $_GET['primary']);
					$manusia = mysqli_fetch_array($res);
				}
				?>
				<form action="kelola.php" method="post">
					<?php
					if($_GET['kelola'] == "dokter"){
						?>
						<h3 style="margin-bottom:10px;display:inline">Tambah Dokter</h3>
						<?php
					}
					else{
						?>
						<h3 style="margin-bottom:10px;display:inline">Edit Dokter</h3>
						<input type="hidden" name="primary" size="25" value="<?php echo $dokter['no_primary']; ?>">
						<?php
					}
					?>
					<table border="0">
						<tr>
							<td>Nama</td>
							<td><input type="text" name="nama" size="25" value="<?php echo $manusia['nama']; ?>"></td>
						</tr>
						<tr>
							<td>No. Telpon</td>
							<td><input type="text" name="no_telp" size="25" value="<?php echo $manusia['no_telp']; ?>"></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>
								<select name="jenis_kelamin">
									<option value="laki - laki">laki - laki</option>
									<option value="perempuan">perempuan</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><textarea name="alamat"><?php echo $manusia['alamat']; ?></textarea></td>
						</tr>
						<tr>
							<?php
							if($_GET['kelola'] == "dokter"){
								?>
								<td><input type="submit" value="Tambah Dokter" name="submit"></td>
								<?php
							}
							else{
								?>
								<td><input type="submit" value="Edit Dokter" name="submit"></td>
								<?php
							}
							?>
						</tr>
					</table>
				</form>
				<h3 style="margin-bottom:0;margin-top:20px;">Daftar Dokter</h3>
				<table border="1">
					<tr>
						<td>Nomor Dokter</td>
						<td>Nama Dokter</td>
						<td>No. Telpon</td>
						<td>Jenis Kelamin</td>
						<td>Alamat</td>
						<td>Aksi</td>
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
								<td>
									<a href="kelola.php?kelola=edit_dokter&primary='.$row["no_primary"].'">edit</a> |
									<a href="kelola.php?hapus=dokter&primary='.$row["no_primary"].'">hapus</a>
								</td>
							</tr>
							';
						}
					?>
				</table>
				<a href="index.php">kembali ke Index</a>
				<?php
			}
			else if($_GET['kelola'] == "karyawan" || $_GET['kelola'] == "edit_karyawan"){
				if ($_GET['kelola'] == "edit_karyawan"){
					$res = getSingleManusia('karyawan', $_GET['primary']);
					$manusia = mysqli_fetch_array($res);
				}
				?>
				<form action="kelola.php" method="post">
					<?php
					if($_GET['kelola'] == "karyawan"){
						?>
						<h3 style="margin-bottom:10px;display:inline">Tambah Karyawan</h3>
						<?php
					}
					else{
						?>
						<h3 style="margin-bottom:10px;display:inline">Edit Karyawan</h3>
						<input type="hidden" name="primary" size="25" value="<?php echo $manusia['no_primary']; ?>">
						<?php
					}
					?>
					<table border="0">
						<tr>
							<td>Nama</td>
							<td><input type="text" name="nama" size="25" value="<?php echo $manusia['nama']; ?>"></td>
						</tr>
						<tr>
							<td>No. Telpon</td>
							<td><input type="text" name="no_telp" size="25" value="<?php echo $manusia['no_telp']; ?>"></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>
								<select name="jenis_kelamin">
									<option value="laki - laki">laki - laki</option>
									<option value="perempuan">perempuan</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><textarea name="alamat"><?php echo $manusia['alamat']; ?></textarea></td>
						</tr>
						<tr>
							<?php
							if($_GET['kelola'] == "karyawan"){
								?>
								<td><input type="submit" value="Tambah Karyawan" name="submit"></td>
								<?php
							}
							else{
								?>
								<td><input type="submit" value="Edit Karyawan" name="submit"></td>
								<?php
							}
							?>
						</tr>
					</table>
				</form>
				<h3 style="margin-bottom:0;margin-top:20px;">Daftar Karyawan</h3>
				<table border="1">
					<tr>
						<td>Nomor Karyawan</td>
						<td>Nama Karyawan</td>
						<td>No. Telpon</td>
						<td>Jenis Kelamin</td>
						<td>Alamat</td>
						<td>Aksi</td>
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
								<td>
									<a href="kelola.php?kelola=edit_karyawan&primary='.$row["no_primary"].'">edit</a> |
									<a href="kelola.php?hapus=karyawan&primary='.$row["no_primary"].'">hapus</a>
								</td>
							</tr>
							';
						}
					?>
				</table>
				<a href="index.php">kembali ke Index</a>
				<?php
			}
			else if($_GET['kelola'] == "pelanggan" || $_GET['kelola'] == "edit_pelanggan"){
				if ($_GET['kelola'] == "edit_pelanggan"){
					$res = getSingleManusia('pelanggan', $_GET['primary']);
					$manusia = mysqli_fetch_array($res);
				}
				?>
				<form action="kelola.php" method="post">
					<?php
					if($_GET['kelola'] == "pelanggan"){
						?>
						<h3 style="margin-bottom:10px;display:inline">Tambah Pelanggan</h3>
						<?php
					}
					else{
						?>
						<h3 style="margin-bottom:10px;display:inline">Edit Pelanggan</h3>
						<input type="hidden" name="primary" size="25" value="<?php echo $manusia['no_primary']; ?>">
						<?php
					}
					?>
					<table border="0">
						<tr>
							<td>Nama</td>
							<td><input type="text" name="nama" size="25" value="<?php echo $manusia['nama']; ?>"></td>
						</tr>
						<tr>
							<td>No. Telpon</td>
							<td><input type="text" name="no_telp" size="25" value="<?php echo $manusia['no_telp']; ?>"></td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>
								<select name="jenis_kelamin">
									<option value="laki - laki">laki - laki</option>
									<option value="perempuan">perempuan</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><textarea name="alamat"><?php echo $manusia['alamat']; ?></textarea></td>
						</tr>
						<tr>
							<?php
							if($_GET['kelola'] == "pelanggan"){
								?>
								<td><input type="submit" value="Tambah Pelanggan" name="submit"></td>
								<?php
							}
							else{
								?>
								<td><input type="submit" value="Edit Pelanggan" name="submit"></td>
								<?php
							}
							?>
						</tr>
					</table>
				</form>
				<h3 style="margin-bottom:0;margin-top:20px;">Daftar Pelanggan</h3>
				<table border="1">
					<tr>
						<td>Nomor Pelanggan</td>
						<td>Nama Pelanggan</td>
						<td>No. Telpon</td>
						<td>Jenis Kelamin</td>
						<td>Alamat</td>
						<td>Aksi</td>
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
								<td>
									<a href="kelola.php?kelola=edit_pelanggan&primary='.$row["no_primary"].'">edit</a> |
									<a href="kelola.php?hapus=pelanggan&primary='.$row["no_primary"].'">hapus</a>
								</td>
							</tr>
							';
						}
					?>
				</table>
				<a href="index.php">kembali ke Index</a>
				<?php
			}
			else if($_GET['kelola'] == "obat"){
	
			}
			else if($_GET['kelola'] == "transaksi"){
	
			}
			else{
				header("Location: index.php");
				die();
			}
		}
		else{
			header("Location: ./index.php");
			die();
		}
		?>
	</body>
</html>


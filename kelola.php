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
			
			if($_POST['submit'] == "Tambah Obat"){
				insertObat($_POST['nama'], $_POST['jenis'], $_POST['harga'], $_POST['stok']);
				header("Location: kelola.php?kelola=obat");
			}
			else if($_POST['submit'] == "Edit Obat"){
				updateObat($_POST['primary'], $_POST['nama'], $_POST['jenis'], $_POST['harga'], $_POST['stok']);			
				header("Location: kelola.php?kelola=obat");
			}

			if($_POST['submit'] == "Tambah Transaksi"){
				insertTransaksi($_POST['jumlah'], $_POST['pelanggan'], $_POST['karyawan'], $_POST['dokter'], $_POST['obat']);
				updateStokObat($_POST['obat'], $_POST['jumlah']);
				header("Location: kelola.php?kelola=transaksi");
			}
			else if($_POST['submit'] == "Edit Transaksi"){
				updateTransaksi($_POST['primary'], $_POST['jumlah'], $_POST['pelanggan'], $_POST['karyawan'], $_POST['dokter'], $_POST['obat']);			
				header("Location: kelola.php?kelola=transaksi");
			}
		}
		else if(isset($_GET['hapus'])) {
			if($_GET['hapus'] == "obat"){
				hapusObat($_GET['primary']);			
				header("Location: kelola.php?kelola=obat");
			}
			elseif($_GET['hapus'] == "transaksi"){
				hapusTransaksi($_GET['primary']);
				header("Location: kelola.php?kelola=transaksi");
			}
			else{
				hapusManusia($_GET['hapus'], $_GET['primary'], $_POST['nama'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['alamat']);			
				header("Location: kelola.php?kelola=".$_GET['hapus']);
			}
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
			else if($_GET['kelola'] == "obat" || $_GET['kelola'] == "edit_obat"){
				if ($_GET['kelola'] == "edit_obat"){
					$res = getSingleObat($_GET['primary']);
					$obat = mysqli_fetch_array($res);
				}
				?>
				<form action="kelola.php" method="post">
					<?php
					if($_GET['kelola'] == "obat"){
						?>
						<h3 style="margin-bottom:10px;display:inline">Tambah Obat</h3>
						<?php
					}
					else{
						?>
						<h3 style="margin-bottom:10px;display:inline">Edit Obat</h3>
						<input type="hidden" name="primary" size="25" value="<?php echo $obat['no_obat']; ?>">
						<?php
					}
					?>
					<table border="0">
						<tr>
							<td>Nama Obat</td>
							<td><input type="text" name="nama" size="25" value="<?php echo $obat['nama_obat']; ?>"></td>
						</tr>
						<tr>
							<td>Jenis Obat</td>
							<td><input type="text" name="jenis" size="25" value="<?php echo $obat['jenis_obat']; ?>"></td>
						</tr>
						<tr>
							<td>Harga</td>
							<td><input type="number" name="harga" size="25" value="<?php echo $obat['harga']; ?>"></td>
						</tr>
						<tr>
							<td>Stok</td>
							<td><input type="number" name="stok" size="25" value="<?php echo $obat['stok']; ?>"></td>
						</tr>
						<tr>
							<?php
							if($_GET['kelola'] == "obat"){
								?>
								<td><input type="submit" value="Tambah Obat" name="submit"></td>
								<?php
							}
							else{
								?>
								<td><input type="submit" value="Edit Obat" name="submit"></td>
								<?php
							}
							?>
						</tr>
					</table>
				</form>
				<h3 style="margin-bottom:0;margin-top:20px;">Daftar Obat</h3>
				<table border="1">
					<tr>
						<td>Nomor Obat</td>
						<td>Nama Obat</td>
						<td>Jenis</td>
						<td>Harga</td>
						<td>Stok</td>
						<td>Aksi</td>
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
								<td>
									<a href="kelola.php?kelola=edit_obat&primary='.$row["no_obat"].'">edit</a> |
									<a href="kelola.php?hapus=obat&primary='.$row["no_obat"].'">hapus</a>
								</td>
							</tr>
							';
						}
					?>
				</table>
				<a href="index.php">kembali ke Index</a>
				<?php
			}
			else if($_GET['kelola'] == "transaksi" || $_GET['kelola'] == "edit_transaksi"){
				if ($_GET['kelola'] == "edit_transaksi"){
					$res = getSingleTransaksi($_GET['primary']);
					$transaksi = mysqli_fetch_array($res);
				}
				?>
				<form action="kelola.php" method="post">
					<?php
					if($_GET['kelola'] == "transaksi"){
						?>
						<h3 style="margin-bottom:10px;display:inline">Tambah Transaksi</h3>
						<?php
					}
					else{
						?>
						<h3 style="margin-bottom:10px;display:inline">Edit Transaksi</h3>
						<input type="hidden" name="primary" size="25" value="<?php echo $transaksi['no_transaksi']; ?>">
						<?php
					}
					?>
					<table border="0">
						<tr>
							<td>Jumlah Obat</td>
							<td><input type="number" name="jumlah" size="25" value="<?php echo $transaksi['jumlah_obat']; ?>"></td>
						</tr>
						<tr>
							<td>Nama pelanggan</td>
							<td>
								<select name="pelanggan">
									<?php
									$result = getAllManusia("pelanggan");
									while($row = mysqli_fetch_array($result)) {
										if($transaksi['no_pelanggan'] == $row['no_primary']){
											echo "<option selected value=".$row['no_primary'].">".$row['nama']."</option>";
										}
										else{
											echo "<option value=".$row['no_primary'].">".$row['nama']."</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Dokter yang melayani</td>
							<td>
								<select name="dokter">
									<?php
									$result = getAllManusia("dokter");
									while($row = mysqli_fetch_array($result)) {
										if($transaksi['no_dokter'] == $row['no_primary']){
											echo "<option selected value=".$row['no_primary'].">".$row['nama']."</option>";
										}
										else{
											echo "<option value=".$row['no_primary'].">".$row['nama']."</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Nama karyawan</td>
							<td>
								<select name="karyawan">
									<?php
									$result = getAllManusia("karyawan");
									while($row = mysqli_fetch_array($result)) {
										if($transaksi['no_karyawan'] == $row['no_primary']){
											echo "<option selected value=".$row['no_primary'].">".$row['nama']."</option>";
										}
										else{
											echo "<option value=".$row['no_primary'].">".$row['nama']."</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Obat yang dipesan</td>
							<td>
								<select name="obat">
									<?php
									$result = getAllObat();
									while($row = mysqli_fetch_array($result)) {
										if($transaksi['no_obat'] == $row['no_obat']){
											echo "<option selected value=".$row['no_obat'].">".$row['nama_obat']."</option>";
										}
										else{
											echo "<option value=".$row['no_obat'].">".$row['nama_obat']."</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<?php
							if($_GET['kelola'] == "transaksi"){
								?>
								<td><input type="submit" value="Tambah Transaksi" name="submit"></td>
								<?php
							}
							else{
								?>
								<td><input type="submit" value="Edit Transaksi" name="submit"></td>
								<?php
							}
							?>
						</tr>
					</table>
				</form>
				<h3 style="margin-bottom:0;margin-top:20px;">Daftar Transaksi</h3>
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
						<td>Aksi</td>
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
								<td>Rp '.$row["jumlah_obat"] * $obat["harga"].'</td>
								<td>'.$pelanggan['nama'].'</td>
								<td>'.$karyawan['nama'].'</td>
								<td>'.$dokter['nama'].'</td>
								<td>'.$obat['nama_obat'].'</td>
								<td>
									<a href="kelola.php?kelola=edit_transaksi&primary='.$row["no_transaksi"].'">edit</a> |
									<a href="kelola.php?hapus=transaksi&primary='.$row["no_transaksi"].'">hapus</a>
								</td>
							</tr>
							';
						}
					?>
				</table>
				<a href="index.php">kembali ke Index</a>
				<?php
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


<?php
	//Inisialisasi koneksi
	$conn = mysqli_connect("localhost", "root", "", "apotik");
	//End
	
	//Manusia
	function getSingleManusia($tabel, $primary){
		global $conn;
		$sql = "select * from $tabel where no_primary = $primary";
		return mysqli_query($conn, $sql);
	}
	function getAllManusia($tabel){
		global $conn;
		$sql = "select * from $tabel";
		return mysqli_query($conn, $sql);
	}
	function insertManusia($tabel, $nama, $no_telp, $jenis_kelamin, $alamat){
		global $conn;
		$sql = "insert into $tabel values ('', '$nama', '$no_telp', '$jenis_kelamin', '$alamat')";
		mysqli_query($conn, $sql);
	}
	function updateManusia($tabel, $primary, $nama, $no_telp, $jenis_kelamin, $alamat){
		global $conn;
		$sql = "
			update $tabel set
			nama = '$nama',
			no_telp = '$no_telp',
			jenis_kelamin = '$jenis_kelamin',
			alamat = '$alamat'
			where no_primary = $primary
			";
		mysqli_query($conn, $sql);
	}
	function hapusManusia($tabel, $primary){
		global $conn;
		$sql = "delete from $tabel where no_primary = $primary";
		mysqli_query($conn, $sql);
		if (!mysqli_query($conn, $sql)){
			echo("Error description: " . mysqli_error($conn));
		}
	}
	//End

	//Obat
	function getSingleObat($primary){
		global $conn;
		$sql = "select * from obat where no_obat = $primary";
		return mysqli_query($conn, $sql);
	}
	function getAllObat(){
		global $conn;
		$sql = "select * from obat";
		return mysqli_query($conn, $sql);
	}
	function insertObat($nama, $jenis, $harga, $stok){
		global $conn;
		$sql = "insert into obat values ('', '$nama', '$jenis', '$harga', '$stok')";
		mysqli_query($conn, $sql);
	}
	function updateObat($primary, $nama, $jenis, $harga, $stok){
		global $conn;
		$sql = "
			update obat set
			nama_obat = '$nama',
			jenis_obat = '$jenis',
			harga = '$harga',
			stok = '$stok'
			where no_obat = $primary
		";
		mysqli_query($conn, $sql);
	}
	function updateStokObat($primary, $jumlah_beli){
		global $conn;
		$res = getSingleObat($row["no_obat"]);
		$obat = mysqli_fetch_array($res);
		$stok = $obat['stok'] - $jumlah_beli;
		$sql = "
			update obat set
			stok = '$stok'
			where no_obat = $primary
		";
		mysqli_query($conn, $sql);
	}
	function hapusObat($primary){
		global $conn;
		$sql = "delete from obat where no_obat = $primary";
		mysqli_query($conn, $sql);
	}
	//End

	//Transaksi
	function getSingleTransaksi($primary){
		global $conn;
		$sql = "select * from transaksi where no_transaksi = $primary";
		return mysqli_query($conn, $sql);
	}
	function getAllTransaksi(){
		global $conn;
		$sql = "select * from transaksi";
		return mysqli_query($conn, $sql);
	}
	function insertTransaksi($jumlah_obat, $primary_pelanggan, $primary_karyawan, $primary_dokter, $primary_obat){
		global $conn;
		$sql = "insert into transaksi values ('', '".getCurrentTanggal()."', '$primary_pelanggan', '$primary_karyawan', '$primary_dokter', '$primary_obat', '$jumlah_obat')";
		mysqli_query($conn, $sql);
	}
	function updateTransaksi($primary, $jumlah_obat, $primary_pelanggan, $primary_karyawan, $primary_dokter, $primary_obat){
		global $conn;
		$sql = "
			update transaksi set
			jumlah_obat = '$jumlah_obat',
			no_pelanggan = '$primary_pelanggan',
			no_karyawan= '$primary_karyawan',
			no_dokter = '$primary_dokter',
			no_obat = '$primary_obat'
			where no_transaksi = $primary
		";
		mysqli_query($conn, $sql);
	}
	function hapusTransaksi($primary){
		global $conn;
		$sql = "delete from transaksi where no_transaksi = $primary";
		mysqli_query($conn, $sql);
	}
	//End

	//function else
	function getCurrentTanggal(){
		return date("d/m/Y");
	}
	//End

/*
if (!mysqli_query($conn, $sql)){
	echo("Error description: " . mysqli_error($conn));
}
*/

?>
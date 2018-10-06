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
	//End
?>
<?php

include 'koneksi.php';
session_start();
$username=$_POST['username'];
$password=md5($_POST['password']);
$jenis=$_POST['jenis'];

$data=mysqli_query($koneksi,"SELECT * FROM user WHERE nip='$username' AND password='$password' AND jenis='$jenis'");
$a=mysqli_fetch_array($data);
$cek=mysqli_num_rows($data);

$data1=mysqli_query($koneksi,"SELECT * FROM user WHERE email='$username' AND password='$password' AND jenis='$jenis'");
$a1=mysqli_fetch_array($data1);
$cek1=mysqli_num_rows($data1);

if($cek>0){
$_SESSION['username']=$username;
$_SESSION['nama']=$a['nama'];
$_SESSION['status'] = "login";

	if ($a['jenis']=='Admin') {
		header("location:admin/beranda.php");
	}else{
		header("location:dosen/beranda.php");
	}
}elseif($cek1>0){
	$_SESSION['username']=$a1['nip'];
	$_SESSION['nama']=$a1['nama'];
	$_SESSION['status'] = "login";

	if ($a1['jenis']=='Admin') {
		header("location:admin/beranda.php");
	}else{
		header("location:dosen/beranda.php");
	}
	
}else {
	echo "<script>alert('Periksa Kembali Username Password atau Jenis Pengguna Anda'); history.go(-1);</script>";
}
?>
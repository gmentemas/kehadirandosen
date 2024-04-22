<?php
include "../koneksi.php";
$id=$_POST['id'];
$nip=$_POST['nip'];
$email=$_POST['email'];
$nama=$_POST['nama'];
$prodi=$_POST['prodi'];
$jabatan1=$_POST['jabatan'];
if ($jabatan1==null) {
	mysqli_query($koneksi,"UPDATE user SET nama='$nama', nip='$nip', email='$email', jenis='Dosen', prodi='$prodi' WHERE nip='$id'");
	header("location:data.php?alert=berhasil");
}else{
	$jabat=mysqli_query($koneksi,"SELECT * FROM user WHERE jenis='Kaprodi' AND prodi='$prodi'");
	$cek=mysqli_num_rows($jabat);

	if($cek>0){
		echo "<script>alert('Kaprodi Sudah diinput, silakan ubah kaprodi sebelumnya menjadi dosen pengajar'); history.go(-1);</script>";
	}else{

	mysqli_query($koneksi,"UPDATE user SET nama='$nama', nip='$nip', email='$email', jenis='$jabatan1', prodi='$prodi' WHERE nip='$id'");
	header("location:data.php?alert=berhasil");
	}
}


?>

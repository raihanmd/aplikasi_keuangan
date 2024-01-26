<?php
include '../koneksi.php';
$nama  = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];

$rand = rand();
$allowed =  array('gif', 'png', 'jpg', 'jpeg');
$filename = $_FILES['foto']['name'];

if ($filename == "") {
	mysqli_query($koneksi, "insert into user values (NULL,'$nama','$username','$password','','$level')");
	if ($level == 'nasabah') {
		$data = mysqli_query(
			$koneksi,
			"SELECT user_id FROM user
			WHERE user_username = '$username'"
		);
		$d = mysqli_fetch_array($data);
		mysqli_query($koneksi, "insert into saldo values ($d[0], 0)");
	}
} else {
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if (!in_array($ext, $allowed)) {
		header("location:user.php?alert=gagal");
	} else {
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/' . $rand . '_' . $filename);
		$file_gambar = $rand . '_' . $filename;
		mysqli_query($koneksi, "insert into user values (NULL,'$nama','$username','$password','$file_gambar','$level')");
	}
}

header("location:user.php");

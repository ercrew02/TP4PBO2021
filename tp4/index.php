<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// insert data
if(isset($_POST['add'])){
	$nama_hewan = $_POST['nama'];
	$kodehewan =  $_POST['kode'];
	$jk_hewan = $_POST['jk'];
	$kategori_hewan = $_POST['kategori'];
	$berat_hewan = $_POST['berat'];
	$status_hewan = "Dijual";

	$otask->insertTask($nama_hewan, $kodehewan, $jk_hewan, $kategori_hewan, $berat_hewan, $status_hewan);



	header('Location: index.php');
}

// delete data hewan
if(isset($_GET['kodehewan_hapus'])){
	$kodehewan = $_GET['kodehewan_hapus'];
	$otask->delete($kodehewan);

        header('Location: index.php');
}

// update status data hewan
if(isset($_GET['kodehewan_status'])){
	$kodehewan = $_GET['kodehewan_status'];
	$otask->update($kodehewan);

	header('Location: index.php');
}

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($kodehewan, $nama, $jk, $kategori, $berat, $status) = $otask->getResult()) {
	// Tampilan jika status nya sudah terjual
	if($status == "Terjual"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $kodehewan . "</td>
		<td>" . $nama . "</td>
		<td>" . $jk . "</td>
		<td>" . $kategori . "</td>
		<td>" . $berat . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?kodehewan_hapus=" . $kodehewan . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}
	
	// Tampilan jika status nya belum terjual
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $kodehewan . "</td>
		<td>" . $nama . "</td>
		<td>" . $jk . "</td>
		<td>" . $kategori . "</td>
		<td>" . $berat . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?kodehewan_hapus=" . $kodehewan . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success'><a href='index.php?kodehewan_status=" . $kodehewan .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}



// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Menutup koneksi database
$otask->close();


// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();

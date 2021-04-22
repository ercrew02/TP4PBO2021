<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke data_hewan
		$query = "SELECT * FROM data_hewan";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	// memasukan data ke data_hewan
	function insertTask($nama_hewan, $kodehewan, $jk_hewan, $kategori_hewan, $berat_hewan, $status_hewan){
		// query insert
		$sql_add = "INSERT INTO data_hewan  
		(kodehewan, nama_hewan, jk_hewan, kategori_hewan, berat_hewan, status_hewan) VALUES ('$kodehewan', '$nama_hewan', '$jk_hewan', '$kategori_hewan', '$berat_hewan', '$status_hewan')";
				

		return $this->execute($sql_add);
		
	}

	// hapus data dari data_hewan
	function delete($data){
		// query delete dari kode yang dipilih
        $sql = "DELETE FROM data_hewan WHERE kodehewan=$data";

		return $this->execute($sql);
    }

	// update status hewan
	function update($data){
		// query update statusnya menjadi terjual
		$sql = "UPDATE data_hewan SET status_hewan='Terjual' WHERE kodehewan=$data";

		return $this->execute($sql);
	}

}



?>

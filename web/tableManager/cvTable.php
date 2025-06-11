<?php
include __DIR__ ."/../DBmanager/DBconnection.php";
include __DIR__ ."/../dataManager/cv.php"; // Include the loker class file
class cvTable{
    private mysqli $connection;
    function __construct(mysqli $conn){
        $this->connection = $conn;
    }

    function getCV(string $email,string $namaPerusahaan, string $job){
        $data = $this->connection->query("SELECT * FROM cv WHERE _email = '$email' AND _namaPerusahaan = '$namaPerusahaan' AND _job = '$job'");
        
        if ($data->num_rows > 0){
            $data = $data->fetch_assoc();
            $nama = $data["_nama"];
            $alamat = $data["_alamat"];
            $noTelp = $data["_noTelp"];
            $tanggalLahir = $data["_tanggalLahir"];
            $email = $data["_email"];
            $gender = $data["_gender"];
            $cv = $data["_cv"];
            $namaPerusahaan = $data["_namaPerusahaan"];
            $job = $data["_job"];
            
            
            $client = new cv($nama,$alamat,$noTelp,$tanggalLahir,$email,$gender,$cv,$namaPerusahaan,$job);
            return $client;

        }
    }

    function getAllCV(string $namaPerusahaan, string $job){
        $allData = [];
        $result = $this->connection->query("SELECT * FROM cv WHERE _namaPerusahaan = '$namaPerusahaan' AND _job = '$job'");
        
        if ($result && $result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $nama = $data["_nama"];
                $alamat = $data["_alamat"];
                $noTelp = $data["_noTelp"];
                $tanggalLahir = $data["_tanggalLahir"];
                $email = $data["_email"];
                $gender = $data["_gender"];
                $cv = $data["_cv"];
                $namaPerusahaan = $data["_namaPerusahaan"];
                $job = $data["_job"];

                $client = new cv($nama, $alamat, $noTelp, $tanggalLahir, $email, $gender, $cv, $namaPerusahaan, $job);

                $allData[] = $client;
            }
        }

        return $allData;
    }


    function addCV(CV $cv){
        $nama = $cv->getNama();
        $alamat = $cv->getAlamat();
        $noTelp = $cv->getNoTelp();
        $tanggalLahir = $cv->getTanggalLahir();
        $email = $cv->getEmail();
        $gender = $cv->getGender();
        $CV = $cv->getCV();
        $namaPerusahaan = $cv->getNamaPerusahaan();
        $job = $cv->getJob();
        $query = $this->connection->query("INSERT INTO cv VALUES ('$nama','$alamat','$noTelp','$tanggalLahir','$email','$gender','$CV','$namaPerusahaan','$job')");
        
        return $query === true;
    }

    

}

?>
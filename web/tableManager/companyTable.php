<?php
include __DIR__ ."/../DBmanager/DBconnection.php";
include __DIR__ ."/../dataManager/company.php"; // Include the loker class file
class companyTable{
    private mysqli $connection;
    function __construct(mysqli $conn){
        $this->connection = $conn;
    }
    
    function getCompanyByEmail(string $email){
        $data = $this->connection->query("SELECT * FROM company WHERE _email = '$email'");
        
        if ($data->num_rows > 0){
            $data = $data->fetch_assoc();
            $email = $data["_email"];
            $password = $data["_password"];
            $namaPerusahaan = $data["_namaPerusahaan"];
            $tanggalBerdiri = $data["_tanggalBerdiri"];
            $alamat = $data["_alamat"];
            $profilePicture = $data["_pictpath"];
            $tipeUser = $data["_user_type"];
            
            $client = new company($email,$password,$namaPerusahaan,$tanggalBerdiri,$alamat,$profilePicture,$tipeUser);
            return $client;

        }
    }

    function addCompany(company $company){
        $email =  $company->getEmail();
        $password =  $company->getPassword();
        $namaPerusahaan =  $company->getNamaPerusahaan();
        $tanggalBerdiri =  $company->getTanggalBerdiri();
        $alamat =  $company->getAlamat();
        $profilePicture =  $company->getProfilePicture();
        $tipeUser =  $company->getTipeUser();
        $query = $this->connection->query("INSERT INTO company VALUES ('$email','$password','$namaPerusahaan','$tanggalBerdiri','$alamat','$profilePicture','$tipeUser')");
        
        return $query === true;
    }

}

?>
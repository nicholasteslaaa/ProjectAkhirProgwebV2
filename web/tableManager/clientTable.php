<?php
include __DIR__ ."/../DBmanager/DBconnection.php";
include __DIR__ ."/../dataManager/client.php";
class clientTable{
    private mysqli $connection;
    
    function __construct(mysqli $conn){
        $this->connection = $conn;
    }

    function getClientByEmail(string $email): client|null{
        $data = $this->connection->query("SELECT * FROM client WHERE _email = '$email'");
        
        if ($data->num_rows > 0){
            $data = $data->fetch_assoc();
            $email = $data["_email"];
            $password = $data["_password"];
            $namaDepan = $data["_namadepan"];
            $namaBelakang = $data["_namabelakang"];
            $tanggalLahir = $data["_tanggallahir"];
            $alamat = $data["_alamat"];
            $profilePicture = $data["_pictpath"];
            $tipeUser = $data["_user_type"];
            
            $client = new client($email,$password,$namaDepan,$namaBelakang,$tanggalLahir,$alamat,$profilePicture,$tipeUser);
            return $client;
        }
        else {
            return null;
        }

    }

    function addClient(client $client){
        $email = $client->getEmail();
        $password = $client->getPassword();
        $namaDepan = $client->getNamaDepan();
        $namaBelakang = $client->getNamaBelakang();
        $tanggalLahir = $client->getTanggalLahir();
        $alamat = $client->getAlamat();
        $profilePicture = $client->getProfilePicture();
        $tipeUser = $client->getTipeUser();
        $query = $this->connection->query("INSERT INTO client VALUES ('$email','$password','$namaDepan','$namaBelakang','$tanggalLahir','$alamat','$profilePicture','$tipeUser')");
        
        return $query === true;
    }
    function deleteClient(client $client){
        $email = $client->getEmail();
        $query = $this->connection->query("DELETE FROM client WHERE _email = '$email'");
        
        return $query === true;
    }

}

?>
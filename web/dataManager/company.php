<?php
class company{
    private string $email;
    private string $password;
    private string $namaPerusahaan;
    private string $tanggalBerdiri;
    private string $alamat;
    private string $profilePicture;
    private string $tipeUser;


    function __construct($email,$password,$namaPerusahaan,$tanggalBerdiri,$alamat,$profilePicture,$tipeUser){
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setNamaPerusahaan($namaPerusahaan);
        $this->setTanggalBerdiri($tanggalBerdiri);
        $this->setAlamat($alamat);
        $this->setProfilePicture($profilePicture);
        $this->setTipeUser($tipeUser);
    }

    public function setEmail(string $email){
        $this->email = $email;
    }
    public function setPassword(string $password){
        $this->password = $password;
    }
    public function setNamaPerusahaan(string $namaPerusahaan){
        $this->namaPerusahaan = $namaPerusahaan;
    }
    public function setTanggalBerdiri(string $tanggalBerdiri){
        $this->tanggalBerdiri = $tanggalBerdiri;
    }
    public function setAlamat(string $alamat){
        $this->alamat = $alamat;
    }
    public function setProfilePicture(string $profilePicture){
        $this->profilePicture = $profilePicture;
    }
    public function setTipeUser(string $tipeUser){
        $this->tipeUser = $tipeUser;
    }
    

    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getNamaPerusahaan(){
        return $this->namaPerusahaan;
    }
    public function getTanggalBerdiri(){
        return $this->tanggalBerdiri;
    }
    public function getAlamat(){
        return $this->alamat;
    }
    public function getProfilePicture(){
        return $this->profilePicture;
    }
    public function getTipeUser(){
        return $this->tipeUser;
    }
}

?>
<?php
class client{
    private string $password;
    private string $email;
    private string $namaDepan;
    private string $namaBelakang;
    private string $tanggalLahir;
    private string $alamat;
    private string $profilePicture;
    private string $tipeUser;
    
    
    function __construct($email,$password,$namaDepan,$namaBelakang,$tanggalLahir,$alamat,$profilePicture,$tipeUser){
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setNamaDepan($namaDepan);
        $this->setNamaBelakang($namaBelakang);
        $this->setTanggalLahir($tanggalLahir);
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
    public function setNamaDepan(string $namaDepan){
        $this->namaDepan = $namaDepan;
    }
    public function setNamaBelakang(string $namaBelakang){
        $this->namaBelakang = $namaBelakang;
    }
    public function setTanggalLahir(string $tanggalLahir){
        $this->tanggalLahir = $tanggalLahir;
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
    public function getNamaDepan(){
        return $this->namaDepan;
    }
    public function getNamaBelakang(){
        return $this->namaBelakang;
    }
    public function getTanggalLahir(){
        return $this->tanggalLahir;
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
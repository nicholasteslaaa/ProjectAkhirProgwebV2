<?php
class cv{
    private string $nama;
    private string $alamat;
    private string $noTelp;
    private string $tanggalLahir;
    private string $email;
    private string $gender;
    private string $cv;
    private string $namaPerusahaan;
    private string $job;
    
    
     
    public function __construct(string $nama,string $alamat,string $noTelp,string $tanggalLahir,string $email,string $gender,string $cv,string $namaPerusahaan,string $job) {
        $this->setNama($nama);
        $this->setAlamat($alamat);
        $this->setNoTelp($noTelp);
        $this->setTanggalLahir($tanggalLahir);
        $this->setEmail($email);
        $this->setGender($gender);
        $this->setCV($cv);
        $this->setNamaPerusahaan($namaPerusahaan);
        $this->setJob($job);
    }

    public function setNama(String $nama){
        $this->nama = $nama;
    }
    public function setAlamat(string $alamat){
        $this->alamat = $alamat;
    }
    public function setNoTelp(string $noTelp){
        $this->noTelp = $noTelp;
    }
    public function setTanggalLahir(string $tanggalLahir){
        $this->tanggalLahir = $tanggalLahir;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }
    public function setGender(string $gender){
        $this->gender = $gender;
    }
    public function setCV(string $cv){
        $this->cv = $cv;
    }
    public function setNamaPerusahaan(string $namaPerusahaan){
        $this->namaPerusahaan = $namaPerusahaan;
    }
    public function setJob(string $job){
        $this->job = $job;
    }
    

    public function getNama(){
        return $this->nama;
    }
    public function getAlamat(){
        return $this->alamat;
    }
    public function getNoTelp(){
        return $this->noTelp;
    }
    public function getTanggalLahir(){
        return $this->tanggalLahir;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getGender(){
        return $this->gender;
    }
    public function getCV(){
        return $this->cv;
    }
    public function getNamaPerusahaan(){
        return $this->namaPerusahaan;
    }
    public function getJob(){
        return $this->job;
    }
}

?>
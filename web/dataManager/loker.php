<?php
class loker {
    private string $deskripsi;
    private string $kualifikasi;
    private string $namaPerusahaan;
    private string $gaji;
    private string $gajiPer;
    private string $lokerPicture;
    private string $deadline;
    private string $alamat;
    private string $tipe;
    private string $job;
    private string $jobKategori;
    private string $keuntungan;

    public function __construct(string $deskripsi,string $kualifikasi,string $namaPerusahaan,string $gaji,string $gajiPer,string $lokerPicture,string $deadline,string $alamat,string $tipe,string $job,string $jobKategori,string $keuntungan) {
        $this->setDeskripsi($deskripsi);
        $this->setKualifikasi($kualifikasi);
        $this->setNamaPerusahaan($namaPerusahaan);
        $this->setGaji($gaji);
        $this->setGajiPer($gajiPer);
        $this->setLokerPicture($lokerPicture);
        $this->setDeadline($deadline);
        $this->setAlamat($alamat);
        $this->setTipe($tipe);
        $this->setJob($job);
        $this->setJobKategori($jobKategori);
        $this->setKeuntungan($keuntungan);
    }

    public function getDeskripsi(): string {
        return $this->deskripsi;
    }

    public function setDeskripsi(string $deskripsi): void {
        $this->deskripsi = $deskripsi;
    }

    public function getKualifikasi(): string {
        return $this->kualifikasi;
    }

    public function setKualifikasi(string $kualifikasi): void {
        $this->kualifikasi = $kualifikasi;
    }

    public function getNamaPerusahaan(): string {
        return $this->namaPerusahaan;
    }

    public function setNamaPerusahaan(string $namaPerusahaan): void {
        $this->namaPerusahaan = $namaPerusahaan;
    }

    public function getGaji(): string {
        return $this->gaji;
    }

    public function setGaji(string $gaji): void {
        $this->gaji = $gaji;
    }

    public function getGajiPer(): string {
        return $this->gajiPer;
    }

    public function setGajiPer(string $gajiPer): void {
        $this->gajiPer = $gajiPer;
    }

    public function getLokerPicture(): string {
        return $this->lokerPicture;
    }

    public function setLokerPicture(string $lokerPicture): void {
        $this->lokerPicture = $lokerPicture;
    }

    public function getDeadline(): string {
        return $this->deadline;
    }

    public function setDeadline(string $deadline): void {
        $this->deadline = $deadline;
    }

    public function getAlamat(): string {
        return $this->alamat;
    }

    public function setAlamat(string $alamat): void {
        $this->alamat = $alamat;
    }

    public function getTipe(): string {
        return $this->tipe;
    }

    public function setTipe(string $tipe): void {
        $this->tipe = $tipe;
    }

    public function getJob(): string {
        return $this->job;
    }

    public function setJob(string $job): void {
        $this->job = $job;
    }

    public function getJobKategori(): string {
        return $this->jobKategori;
    }

    public function setJobKategori(string $jobKategori): void {
        $this->jobKategori = $jobKategori;
    }

    public function getKeuntungan(): string {
        return $this->keuntungan;
    }

    public function setKeuntungan(string $keuntungan): void {
        $this->keuntungan = $keuntungan;
    }
}
?>

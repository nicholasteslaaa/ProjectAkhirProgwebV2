<?php
include __DIR__ ."/../DBmanager/DBconnection.php";
include __DIR__ ."/../dataManager/loker.php"; // Include the loker class file

class lokerTable {
    private mysqli $connection;

    public function __construct(mysqli $conn) {
        $this->connection = $conn;
    }

    public function getLoker(string $namaPerusahaan,string $job): loker|null {
        $query = $this->connection->query("SELECT * FROM loker WHERE _namaPerusahaan = '$namaPerusahaan' AND _job = '$job'");

        if ($query && $query->num_rows > 0) {
            $data = $query->fetch_assoc();

            $loker = new loker($data["_deskripsi"],$data["_kualifikasi"],$data["_namaPerusahaan"],$data["_gaji"],$data["_gajiPer"],$data["_pictpath"],$data["_deadline"],$data["_alamat"],$data["_tipe"],$data["_job"],$data["_jobKategori"],$data["_keuntungan"]);

            return $loker;
        }

        return null;
    }

    public function getAllLoker($query): array{
        $loker = [];
        if ($query && $query->num_rows > 0) {
            while($data = $query->fetch_assoc()){
                $loker[] = new loker($data["_deskripsi"],$data["_kualifikasi"],$data["_namaPerusahaan"],$data["_gaji"],$data["_gajiPer"],$data["_pictpath"],$data["_deadline"],$data["_alamat"],$data["_tipe"],$data["_job"],$data["_jobKategori"],$data["_keuntungan"]);
            }

        }
        
        return array_reverse($loker);
    }

    public function addLoker(loker $loker): bool {
        $deskripsi = $loker->getDeskripsi();
        $kualifikasi = $loker->getKualifikasi();
        $namaPerusahaan = $loker->getNamaPerusahaan();
        $gaji = $loker->getGaji();
        $gajiPer = $loker->getGajiPer();
        $lokerPicture = $loker->getLokerPicture();
        $deadline = $loker->getDeadline();
        $alamat = $loker->getAlamat();
        $tipe = $loker->getTipe();
        $job = $loker->getJob();
        $jobKategori = $loker->getJobKategori();
        $keuntungan = $loker->getKeuntungan();

        $query = $this->connection->query(
            "INSERT INTO loker VALUES ('$deskripsi', '$kualifikasi', '$namaPerusahaan', '$gaji', '$gajiPer', '$lokerPicture', '$deadline', '$alamat', '$tipe', '$job', '$jobKategori', '$keuntungan')");

        return $query === true;
    }

    public function editLoker(loker $loker){
        $deskripsi = $loker->getDeskripsi();
        $kualifikasi = $loker->getKualifikasi();
        $namaPerusahaan = $loker->getNamaPerusahaan();
        $gaji = $loker->getGaji();
        $gajiPer = $loker->getGajiPer();
        $lokerPicture = $loker->getLokerPicture();
        $deadline = $loker->getDeadline();
        $alamat = $loker->getAlamat();
        $tipe = $loker->getTipe();
        $job = $loker->getJob();
        $jobKategori = $loker->getJobKategori();
        $keuntungan = $loker->getKeuntungan();

        $query = $this->connection->query("UPDATE loker SET _deskripsi = '$deskripsi',_kualifikasi = '$kualifikasi',_namaPerusahaan = '$namaPerusahaan',_gaji = '$gaji',_gajiPer = '$gajiPer',_pictpath = '$lokerPicture',_deadline = '$deadline',_alamat = '$alamat',_tipe = '$tipe',_job = '$job',_jobKategori = '$jobKategori',_keuntungan = '$keuntungan' WHERE _namaPerusahaan = '$namaPerusahaan' and _job = '$job'");
        return $query === true;
    }

    public function deleteLoker(loker $loker){
        $namaPerusahaan = $loker->getNamaPerusahaan();
        $job = $loker->getJob();

        $query = $this->connection->query("DELETE FROM loker WHERE _namaPerusahaan = '$namaPerusahaan' and _job = '$job'");
        return $query === true;
    }
}
?>

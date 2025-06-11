<?php
require_once "DBmanager/DBconnection.php";
require __DIR__ . "/method.php";
require __DIR__ . "/tableManager/cvTable.php";
require __DIR__ . "/tableManager/lokerTable.php";
session_start();
$cvTable = new cvTable($conn);
$lokerTable = new lokerTable($conn);


if (!isset($_SESSION["email"]) || !isset($_SESSION["tipeUser"])) {
    header("Location: login_page.php");
}
$tipe = $_SESSION["tipeUser"]; 
$email = $_SESSION["email"];
$namaPerusahaan = $_SESSION["namaPerusahaan"];
$job = $_SESSION["job"];

$row = $conn->query("SELECT * FROM $tipe WHERE _email = '$email'");
$nama = getName($conn,$email);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["form_type"])) {
        if ($_POST["form_type"] == "main_menu"){
            if ($tipe == "company"){
                $_SESSION["edit"] = "false";
                header("location: main_page.php");
            }
            else if ($tipe == "client"){
                header("location: detail.php");
            }
        }
    }
    if (isset($_POST["Lamaran"])) {
        if ($_POST["Lamaran"] == "UnggahLamaran"){
            $namaPerusahaan = $_SESSION["namaPerusahaan"];
            $job = $_SESSION["job"];
            $name = $_POST['name'];
            $alamat = $_POST['alamat'];
            $phone = $_POST['phone'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $cv = getPDF("pdf");

            if ($_FILES['pdf']['size'] > 5242880) {
                echo "<script>alert('File Terlalu Besar Minimal 5MB');</script>";
            }
            else if (checkCV($conn,$name,$namaPerusahaan,$job)){
                echo $nama." sudah pernah mendaftar sebagai ".$job." di ".$namaPerusahaan;
            }
            else {
                // $conn->query("INSERT INTO cv VALUES('$name','$alamat','$phone','$dob','$email','$gender','$cv','$namaPerusahaan','$job')");
                $CV = new cv($name,$alamat,$phone,$dob,$email,$gender,$cv,$namaPerusahaan,$job);
                $cvTable->addCV($CV);
            }
            
        }
    }
    if (isset($_POST["Lowongan"])) {
        if ($_POST["Lowongan"] == "UnggahLowongan"){
            $nama = $_POST["namaPerusahaan"] ?? '';
            $jobdesk = $_POST["jobdesk"] ?? '';
            $KategoriJob = $_POST["Jobkategori"] ?? '';
            $deskripsi = $_POST["deskripsi"] ?? '';
            $kualifikasi = $_POST["kualifikasi"] ?? '';
            $keuntungan = $_POST["keuntungan"] ?? '';
            $jenis = $_POST["jenis"] ?? '';
            $lokasi = $_POST["lokasi"] ?? '';
            $deadline = $_POST["deadline"] ?? '';
            $gaji = $_POST["gaji"] ?? '';
            $gajiPer = $_POST["terimagaji"] ?? '';
            $foto = getFile("../Images") ?? '';

            $check = $lokerTable->getLoker($nama,$jobdesk);
            if ($check == null){
                // $conn->query("INSERT INTO loker VALUES('$deskripsi','$kualifikasi','$nama','$gaji','$gajiPer','$foto','$deadline','$lokasi','$jenis','$jobdesk','$KategoriJob','$keuntungan')");
                $loker = new loker($deskripsi,$kualifikasi,$nama,$gaji,$gajiPer,$foto,$deadline,$lokasi,$jenis,$jobdesk,$KategoriJob,$keuntungan);
                $lokerTable->addLoker($loker);
                $check = $lokerTable->getLoker($nama,$jobdesk);
                if ($check != null){
                    $_SESSION["edit"] = "false";
                    header("Location: main_page.php");
                }
                else{
                    echo "Gagal mengunggah!";
                }
            }
            else{
                echo "Lowongan ".$jobdesk." di perusahaan ".$nama." sudah ter-unggah!";
            }
        }
    }

    if (isset($_POST["Edit"])) {
        if ($_POST["Edit"] == "EditLowongan"){
            $nama = $_POST["namaPerusahaan"] ?? '';
            $jobdesk = $_POST["jobdesk"] ?? '';
            $KategoriJob = $_POST["Jobkategori"] ?? '';
            $deskripsi = $_POST["deskripsi"] ?? '';
            $kualifikasi = $_POST["kualifikasi"] ?? '';
            $keuntungan = $_POST["keuntungan"] ?? '';
            $jenis = $_POST["jenis"] ?? '';
            $lokasi = $_POST["lokasi"] ?? '';
            $deadline = $_POST["deadline"] ?? '';
            $gaji = $_POST["gaji"] ?? '';
            $gajiPer = $_POST["terimagaji"] ?? '';
            $foto = getFile("../Images") ?? '';

            $check = $lokerTable->getLoker($nama,$jobdesk);
            if ($check != null){
                $loker = new loker($deskripsi,$kualifikasi,$nama,$gaji,$gajiPer, $foto, $deadline,$lokasi,$jenis,$jobdesk,$KategoriJob,$keuntungan);
                $lokerTable->editLoker($loker);

                $check = $lokerTable->getLoker($nama,$jobdesk);
                if ($check != null){
                    $_SESSION["edit"] = "false";
                    header("Location: main_page.php");
                }
                else{
                    echo "Gagal mengedit!";
                }
            }
            else{
                echo "Lowongan ".$jobdesk." di perusahaan ".$nama." tidak di temukan!";
            }
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/tampilan_halaman.css">
    <link rel="stylesheet" href="style/tampilan_pengajuan.css">
    
    <title>Pengajuan Lamaran</title>
</head>
<body>
    <header>
        <h1>Lowongan Pekerjaan</h1>
        <form action="" method="post"> 
            <input type="hidden" name="form_type" value="main_menu">
            <button type="submit" class="back-link">  	&lt; Kembali ke Halaman Utama </button>
        </form>
    </header>

    <?php 
    if ($tipe == "client"){
        echo "
            <div class='container'>
                <h1>Pengajuan Lamaran</h1>
                <form method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='Lamaran' value='UnggahLamaran'>

                    <label for='name'>Nama :</label>
                    <input type='text' id='name' name='name' value='$nama' readonly>

                    <label for='alamat'>Alamat :</label>
                    <input type='text' id='alamat' name='alamat' required>

                    <label for='phone'>Nomor Telepon :</label>
                    <input type='tel' id='phone' name='phone' required>

                    <label for='dob'>Tanggal Lahir :</label>
                    <input type='date' id='dob' name='dob' required>

                    <label for='email'>Email :</label>
                    <input type='email' id='email' name='email' value='$email' readonly>

                    <label for='gender'>Jenis Kelamin :</label>
                    <select name='gender' id='gender' required>
                        <option value='Laki-laki'>Laki-laki</option>
                        <option value='Perempuan'>Perempuan</option>
                    </select>

                    <label for='cv'>Unggah CV (PDF):</label>
                    <input id='cv' type='file' name='pdf' accept='.pdf' required>

                    <button type='submit' class='submit-btn'>Kirim Lamaran</button>
                </form>
                ";
            if ($cvTable->getCV($email,$namaPerusahaan,$job) != null){
                echo "<p class='Terimakasih'> Terimakasih sudah memasukan lamaran🙏</p>";
            }
            echo "</div>";
        }
        
        if ($tipe == "company"){
            $namaPerusahaan = $_SESSION["namaPerusahaan"];
            $jobdesk = $_SESSION["job"] ?? "";
            $checkEdit = $_SESSION["edit"];

            $checkloker = $lokerTable->getLoker($namaPerusahaan,$jobdesk);
            if($checkEdit == "true"){
                if ($checkloker != null){
                    echo "
                        <div class='container'>
                        <h1>Edit Lowongan Kerja</h1>
                        <form method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='Edit' value='EditLowongan'>
                        
                        <label for='nama'>Nama Perusahaan : </label>
                        <input type='text' id='nama' name='namaPerusahaan' value='$nama' placeholder='Masukkan Nama Perusahaan' readonly>
                        
                        <label for='Jobdesk'>JobDesk : </label>
                        <input type='text' id='Jobdesk' name='jobdesk' placeholder='Masukkan JobDesk' value='{$checkloker->getJob()}' readonly>

                        <label for='Jobkategori'>Job kategori : </label>
                        <input type='text' id='Jobkategori' name='Jobkategori' value='{$checkloker->getJobKategori()}' readonly>
                        
                        <label for='deskripsi'>Deskripsi : </label>
                        <textarea name='deskripsi' id='deskripsi' cols='30' rows='10' >{$checkloker->getDeskripsi()}</textarea>
                        
                        <label for='kualifikasi'>Kualifikasi : </label>
                        <textarea name='kualifikasi' id='kualifikasi' cols='30' rows='10'>{$checkloker->getKualifikasi()}</textarea>
                        
                        <label for='keuntungan'>Keuntungan : </label>
                        <textarea name='keuntungan' id='keuntungan' cols='30' rows='10'>{$checkloker->getKeuntungan()}</textarea>
                        
                        <label for='jenis'>Jenis : </label>
                            <select name='jenis' id='jenis' required>
                                <option value='Full Time'>Full Time</option>
                                <option value='Part Time'>Part Time</option>
                                <option value='Remote'>Remote</option>
                                <option value='FreeLance'>FreeLance</option>
                        </select>
                        
                        <label for='gaji'>Gaji : </label>
                        <input type='number' id='gaji' name='gaji' placeholder='Masukan gaji' value={$checkloker->getGaji()} required>
                        
                        <label for='terimaGaji'>Terima gaji : </label>
                        <select name='terimagaji' id='terimaGaji' required>
                        <option value='Hari'>Per Hari</option>
                            <option value='Minggu'>Per Minggu</option>
                            <option value='Bulan'>Per Bulan</option>
                            <option value='Tahun'>Per Tahun</option>
                        </select>
                            
                        <label for='lokasi'>lokasi : </label>
                        <input type='text' id='lokasi' name='lokasi' placeholder='Masukan alamat' value='{$checkloker->getAlamat()}' required>
                        
                        <label for='deadline'>Deadline :</label>
                        <input type='date' id='deadline' name='deadline' value='{$checkloker->getDeadline()}' required>
                        
                        <label for='foto'>Unggah foto :</label>
                        <input type='file' name='image' id='foto' accept=.jpg,.png,.jpeg required>
                        <button type='submit' class='submit-btn'>Edit Lowongan</button>
                        </form>
                        </div>
                    ";}
            }else{
                echo "
                    <div class='container'>
                    <h1>Buat Lowongan Kerja</h1>
                    <form method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='Lowongan' value='UnggahLowongan'>
                    
                    <label for='nama'>Nama Perusahaan : </label>
                    <input type='text' id='nama' name='namaPerusahaan' value='$nama' placeholder='Masukkan Nama Perusahaan' readonly>
                    
                    <label for='Jobdesk'>JobDesk : </label>
                    <input type='text' id='Jobdesk' name='jobdesk' placeholder='Masukkan JobDesk' required>
                    
                    <label for='Jobkategori'>Job kategori : </label>
                    <input type='text' id='Jobkategori' name='Jobkategori' placeholder='Masukkan kategori job' required>
                    
                    <label for='deskripsi'>Deskripsi : </label>
                    <textarea name='deskripsi' id='deskripsi' cols='30' rows='10'></textarea>
                    
                    <label for='kualifikasi'>Kualifikasi : </label>
                    <textarea name='kualifikasi' id='kualifikasi' cols='30' rows='10'></textarea>
                    
                    <label for='keuntungan'>Keuntungan : </label>
                    <textarea name='keuntungan' id='keuntungan' cols='30' rows='10'></textarea>
                    
                    <label for='jenis'>Jenis : </label>
                    <select name='jenis' id='jenis' required>
                    <option value='Full Time'>Full Time</option>
                    <option value='Part Time'>Part Time</option>
                    </select>
                    
                    <label for='gaji'>Gaji : </label>
                    <input type='number' id='gaji' name='gaji' placeholder='Masukan gaji' required>
                    
                    <label for='terimaGaji'>Terima gaji : </label>
                    <select name='terimagaji' id='terimaGaji' required>
                    <option value='Hari'>Per Hari</option>
                    <option value='Minggu'>Per Minggu</option>
                    <option value='Bulan'>Per Bulan</option>
                    <option value='Tahun'>Per Tahun</option>
                    </select>
                    
                    
                    
                    <label for='lokasi'>lokasi : </label>
                    <input type='text' id='lokasi' name='lokasi' placeholder='Masukan alamat' required>
                    
                    <label for='deadline'>Deadline :</label>
                    <input type='date' id='deadline' name='deadline' required>
                    
                    <label for='foto'>Unggah foto :</label>
                    <input type='file' name='image' id='foto' accept=.jpg,.png,.jpeg required>
                    <button type='submit' class='submit-btn'>Unggah Lowongan</button>
                    </form>
                    </div>
                ";
                }
            }
        ?>
        
        <footer>
            2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍
        </footer>
        
</body>
</html>
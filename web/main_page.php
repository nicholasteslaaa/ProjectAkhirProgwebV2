<?php
require_once "DBmanager/DBconnection.php";
require __DIR__ . "/method.php";
// require __DIR__ . "/tableManager/cvTable.php";
require __DIR__ . "/tableManager/lokerTable.php";
$lokerTable = new lokerTable($conn);

session_start();

// if (!isset($_SESSION["email"]) && !isset($_SESSION["tipeUser"])) {
//     header("Location: login_page.php");
// }

$tipe = $_SESSION["tipeUser"] ?? "guest";
$curEmail = $_SESSION["email"] ?? "guest";

$mainPageResult = $conn->query("SELECT *,FORMAT(_gaji, 0, 'de_DE') AS gaji FROM loker");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["form_type"])) {
        if ($_POST["form_type"] == "deleteAccount"){
            DeleteAccount($conn,$curEmail,$tipe);
            header("location: logout.php");
        }
        if ($_POST["form_type"] == "logout"){
            header("location: logout.php");
        }   
        if ($_POST["form_type"] == "login"){
            header("location: login_page.php");
        }    
    }
    if (isset($_POST["detailLowongan"])) {
        list($namaPerusahaan, $job) = explode("|", $_POST["detailLowongan"]);
        $_SESSION["namaPerusahaan"] = $namaPerusahaan;
        $_SESSION["job"] = $job;
        header("location: detail.php");
    }
    if (isset($_POST["Search"])) {
        $Nama =  $_POST["Nama"];
        $job =  $_POST["Job"];
        $jobKategori = $_POST["Kategori"];
        $Lokasi =  $_POST["Lokasi"];
        $Tipe =  $_POST["Tipe"];
        $Gaji =  $_POST["Gaji"];
        $query = mainPage($Nama,$job,$jobKategori,$Lokasi,$Tipe,$Gaji);
        $mainPageResult = $conn->query($query);
        
    }
    if (isset($_POST["buatLowongan"])) {
        list($namaPerusahaan, $job) = explode("|", $_POST["detailLowongan"]);
        $_SESSION["namaPerusahaan"] = $namaPerusahaan;
        $_SESSION["job"] = $job;
        $_SESSION["edit"] = "false";

        header("location: pengajuanPage.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/tampilan_halaman.css">
    <link rel="stylesheet" href="style/tampilan_main.css">
    <title>Document</title>
</head>

<body>
    <header>
        <span><h1 style="text-align:left"><b>LinkedOn</b></h1></span>
        <div class="dropdown">
        <button class="dropbtn"><img src="../decoration/menuHamburger.png" width="50px" alt=""></button>
        <div class="dropdown-content">
                <form action="" method="post"> 
                    <input type="hidden" name="form_type" value="Account">
                    <button type="submit" class="Account">
                        <table>
                                <td>
                                    <img src="../decoration/profile.png" width="60px" alt="">
                                </td>
                                <td>
                                    <?php echo getName($conn,$curEmail);?>
                                </td>
                        </table>
                    </button>
                </form>
                <?php 
                if ($tipe == "company"){
                    echo "
                    <form action='' method='post'>
                        <input type='hidden' name='buatLowongan' value='Lowongan'>
                        <button type='submit' class='logout-button' style='background-color:limegreen'>Buat Lowongan</button>
                    </form>";
                }
                ?>
                <?php 
                if ($tipe == "guest"){
                    echo "
                        <form action='' method='post'> 
                            <input type='hidden' name='form_type' value='login'>
                            <button type='submit' class='logout-button'>Login</button>
                        </form>";
                }else{
                    echo "
                    <form action='' method='post'> 
                        <input type='hidden' name='form_type' value='deleteAccount'>
                        <button type='submit' class='logout-button'>Delete Account</button>
                    </form>
                    <form action='' method='post'> 
                        <input type='hidden' name='form_type' value='logout'>
                        <button type='submit' class='logout-button'>Logout</button>
                    </form>";
                }
                
                ?>
            </div>
        </div> 
        <h1>Lowongan Pekerjaan</h1>
    </header>
    
    <div class="hero">
        <h2>Temukan Pekerjaan Impianmu!!</h2>
        <h4>Mulai Karirmu Sekarang</h4>
    </div>
    

    <div class="search-box">
        <form action="" method="post">
            <input type="hidden" name="Search" value="">
            <input style="width: 20%;" name="Nama" type="text" placeholder="Nama Perusahaan"> 
            <select name = "Job">
                <option value="">Job</option>
                <?php 
                    $option = $conn->query("SELECT DISTINCT _job FROM loker");
                    while ($row = $option->fetch_assoc()) {
                        if ($row["_job"] != ""){
                            echo "<option value = \"{$row['_job']}\">{$row['_job']}</option>";
                        }
                    }
                ?>
            </select>
            <select name = "Kategori">
                <option value="">Kategori</option>
                <?php 
                    $option = $conn->query("SELECT DISTINCT _jobKategori FROM loker");
                    while ($row = $option->fetch_assoc()) {
                        if ($row["_jobKategori"] != ""){
                            echo "<option value = \"{$row['_jobKategori']}\">{$row['_jobKategori']}</option>";
                        }
                    }
                ?>
            </select>
            <select name = "Lokasi">
                <option value="">Semua Lokasi</option>
                <?php
                $option = $conn->query("SELECT DISTINCT _alamat FROM loker");
                while ($row = $option->fetch_assoc()) {
                    if ($row["_alamat"] != ""){
                        echo "<option value =\"{$row['_alamat']}\">{$row['_alamat']}</option>";
                    }
                } 
                ?>
            </select>
            <select name = "Tipe">
                <option value="">Semua Jenis</option>
                <?php
                    echo"<option value='Full Time'>Full Time</option>";
                    echo"<option value='Part Time'>Part Time</option>";
                    echo"<option value='Remote'>Remote</option>";
                    echo"<option value='FreeLance'>FreeLance</option> ";
                ?>
            </select>
            <input style="width: 15%;" name = "Gaji" type="text" placeholder="gaji: 10000-300000">
            <button type="submit"><img width="15px" src="../decoration/search.png  " alt=""></button>
        </form>
    </div>

        
        <?php
       
        if ($mainPageResult->num_rows > 0) {
            $counter = 0;
            echo "<div class='job-container'>";
                $data = $lokerTable->getAllLoker($mainPageResult);
                foreach ($data as $lokerData) {
                    $deskripsi = $lokerData->getDeskripsi();
                    $kualifikasi = $lokerData->getKualifikasi();
                    $namaPerusahaan = $lokerData->getNamaPerusahaan();
                    $gaji = number_format($lokerData->getGaji(),2,",",".");
                    $gajiPer = $lokerData->getGajiPer();
                    $lokerPicture = $lokerData->getLokerPicture();
                    $deadline = $lokerData->getDeadline();
                    $alamat = $lokerData->getAlamat();
                    $tipe = $lokerData->getTipe();
                    $job = $lokerData->getJob();
                    $jobKategori = $lokerData->getJobKategori();
                    $keuntungan = $lokerData->getKeuntungan();

                    $now = new DateTime(); // Current date
                    $deadlineDate = new DateTime($deadline);
                    
                    if ($deadlineDate > $now) {
                        echo"<div class='job-item'>
                        <td><img src='$lokerPicture' alt='' width = 150px></td>
                        <h2><b>{$job}</b></h2>
                        <p>Kategori: {$jobKategori}</p>
                                <p>Perusahaan: {$namaPerusahaan}</p>
                                <p>Jenis: {$tipe}</p>
                                <p>Alamat: {$alamat}</p>
                                <p>Gaji: Rp {$gaji}/{$gajiPer}</p>
                                <form action='' method='post'> 
                                    <input type='hidden' name='detailLowongan' value='" . htmlspecialchars($namaPerusahaan . "|" . $job, ENT_QUOTES, 'UTF-8') . "'>
                                    <button type='submit' class='btn'>Lihat Detail</button>
                                    </form>
                                    </div>
                                    ";
                                }else{
                                    $expiredLoker = $lokerTable->getLoker($namaPerusahaan,$job);
                                    $lokerTable->deleteLoker($expiredLoker);   
                                }
                    }
            echo "</div>";
        } else {
            echo "No records found";
        }
        closeDB($conn);
        ?>
    <footer>
    2025 Portal Lowongan Kerja | Dibuat dengan sepenuh hati😍
    </footer>
    <!-- test -->
</body>
    </html>

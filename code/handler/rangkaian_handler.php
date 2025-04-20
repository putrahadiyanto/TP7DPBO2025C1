<?php
require_once __DIR__ . '/../class/rangkaian_kereta.php';
require_once __DIR__ . '/../class/jadwal_kereta.php';

$script_name = $_SERVER['SCRIPT_NAME']; // e.g., /TP7/view/rangkaian.php
$base_path = explode('/', $script_name);
$project_folder = $base_path[1]; // TP7
$base_url = "/" . $project_folder;

$rangkaian = new Rangkaian_kereta();
$jadwal = new Jadwal_kereta();
$data_jadwal = $jadwal->getAllJadwalKereta();


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $i = 0;
        while ($i < count($data_jadwal)) {
            if ($data_jadwal[$i]['id_jadwal'] == $id) {
                header("Location: " . $base_url. "/index.php?page=rangkaian&message=" . urlencode("Data tidak bisa dihapus, karena sudah terpakai di jadwal kereta") . "&note=negative");
                exit;
            }
            $i++;
        }
        if ($rangkaian->deleteRangkaianKereta($id)) {
            header("Location: " . $base_url. "/index.php?page=rangkaian&message=" . urlencode("Data berhasil dihapus") . "&note=positive");
        } else {
            header("Location: " . $base_url. "/index.php?page=rangkaian&message=" . urlencode("Gagal menghapus data") . "&note=negative");
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    if ($action === 'add') {
        $nama_kereta = $_POST['nama_kereta'];
        $kelas_kereta = $_POST['kelas_kereta'];
        $jumlah_gerbong = $_POST['jumlah_gerbong'];
        $kapasitas_penumpang = $_POST['kapasitas_penumpang'];

        function redirectWithMessage($base_url, $message, $note) {
            header("Location: " . $base_url . "/index.php?page=rangkaian&message=" . urlencode($message) . "&note=" . $note);
            exit;
        }

        if ($rangkaian->addRangkaianKereta($nama_kereta, $kelas_kereta, $jumlah_gerbong, $kapasitas_penumpang)) {
            redirectWithMessage($base_url, "Data berhasil ditambahkan", "positive");
        } else {
            redirectWithMessage($base_url, "Gagal menambahkan data", "negative");
        }

    } else if ($action === 'edit') {
        $id = $_POST['id'];
        $nama_kereta = $_POST['nama_kereta'];
        $kelas_kereta = $_POST['kelas_kereta'];
        $jumlah_gerbong = $_POST['jumlah_gerbong'];
        $kapasitas_penumpang = $_POST['kapasitas_penumpang'];

        if ($rangkaian->updateRangkaianKereta($id, $nama_kereta, $kelas_kereta, $jumlah_gerbong, $kapasitas_penumpang)) {
            header("Location: " . $base_url. "/index.php?page=rangkaian&message=" . urlencode("Data berhasil diubah") . "&note=positive");
        } else {
            header("Location: " . $base_url. "/index.php?page=rangkaian&message=" . urlencode("Gagal mengubah data") . "&note=negative");
        }
    }
}

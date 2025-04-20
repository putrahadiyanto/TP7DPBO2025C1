<?php
require_once __DIR__ . '/../class/jadwal_kereta.php';
require_once __DIR__ . '/../class/rangkaian_kereta.php';

$script_name = $_SERVER['SCRIPT_NAME']; // e.g., /TP7/handler/jadwal_handler.php
$base_path = explode('/', $script_name);
$project_folder = $base_path[1]; // TP7
$base_url = "/" . $project_folder;

$jadwal = new Jadwal_kereta();
$rangkaian = new Rangkaian_kereta();
$data_rangkaian = $rangkaian->getAllRangkaianKereta();

function redirectWithMessage($base_url, $page, $message, $note) {
    header("Location: " . $base_url . "/index.php?page=" . $page . "&message=" . urlencode($message) . "&note=" . $note);
    exit;
}

// HANDLE DELETE
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'] ?? null;

    if ($jadwal->deleteJadwalKereta($id)) {
        redirectWithMessage($base_url, "jadwal", "Data berhasil dihapus", "positive");
    } else {
        redirectWithMessage($base_url, "jadwal", "Gagal menghapus data", "negative");
    }
}

// HANDLE POST (ADD or EDIT)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    $id_kereta = $_POST['id_kereta'];
    $id_stasiun_keberangkatan = $_POST['id_stasiun_keberangkatan'];
    $id_stasiun_tujuan = $_POST['id_stasiun_tujuan'];
    $waktu_keberangkatan = $_POST['waktu_keberangkatan'];
    $waktu_tiba = $_POST['waktu_tiba'];

    if ($action === 'add') {
        if ($jadwal->addJadwalKereta($id_kereta, $id_stasiun_keberangkatan, $id_stasiun_tujuan, $waktu_keberangkatan, $waktu_tiba)) {
            redirectWithMessage($base_url, "jadwal", "Data berhasil ditambahkan", "positive");
        } else {
            redirectWithMessage($base_url, "jadwal", "Gagal menambahkan data", "negative");
        }

    } else if ($action === 'edit') {
        $id = $_POST['id'];
        if ($jadwal->updateJadwalKereta($id, $id_kereta, $id_stasiun_keberangkatan, $id_stasiun_tujuan, $waktu_keberangkatan, $waktu_tiba)) {
            redirectWithMessage($base_url, "jadwal", "Data berhasil diubah", "positive");
        } else {
            redirectWithMessage($base_url, "jadwal", "Gagal mengubah data", "negative");
        }
    }
}

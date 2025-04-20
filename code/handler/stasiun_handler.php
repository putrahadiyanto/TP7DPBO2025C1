<?php
require_once __DIR__ . '/../class/stasiun.php';
require_once __DIR__ . '/../class/jadwal_kereta.php';

$script_name = $_SERVER['SCRIPT_NAME'];
$base_path = explode('/', $script_name);
$project_folder = $base_path[1];
$base_url = "/" . $project_folder;

$stasiun = new Stasiun();
$jadwal = new Jadwal_kereta();
$data_jadwal = $jadwal->getAllJadwalKereta();

function redirectWithMessage($base_url, $message, $note) {
    header("Location: " . $base_url . "/index.php?page=stasiun&message=" . urlencode($message) . "&note=" . $note);
    exit;
}

// Handle GET - Delete
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];

        foreach ($data_jadwal as $jadwal_entry) {
            if ($jadwal_entry['id_stasiun_keberangkatan'] == $id || $jadwal_entry['id_stasiun_tujuan'] == $id) {
                redirectWithMessage($base_url, "Data tidak bisa dihapus, karena sudah terpakai di jadwal kereta", "negative");
            }
        }

        // Fetch existing data to get the photo path
        $existing_data = $stasiun->getStasiunById($id);
        $foto_path = $existing_data['foto'] ?? null;
        $full_path = __DIR__ . '/../' . $foto_path;

        if ($stasiun->deleteStasiun($id)) {
            // Delete image file if exists
            if ($foto_path && file_exists($full_path)) {
                unlink($full_path);
            }
            redirectWithMessage($base_url, "Data berhasil dihapus", "positive");
        } else {
            redirectWithMessage($base_url, "Gagal menghapus data", "negative");
        }
    }
}

// Handle POST - Add & Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    $nama_stasiun = $_POST['nama_stasiun'];
    $ketinggian = $_POST['ketinggian'];
    $lokasi = $_POST['lokasi'];

    // Handle image upload
    $upload_dir = 'images/';
    $foto_path = '';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_name = uniqid() . "_" . basename($_FILES['foto']['name']);
        $target_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, __DIR__ . '/../' . $target_path)) {
            $foto_path = $target_path;
        }
    }

    if ($action === 'add') {
        if ($stasiun->addStasiun($nama_stasiun, $ketinggian, $lokasi, $foto_path)) {
            redirectWithMessage($base_url, "Data berhasil ditambahkan", "positive");
        } else {
            redirectWithMessage($base_url, "Gagal menambahkan data", "negative");
        }

    } else if ($action === 'edit') {
        $id = $_POST['id'];

        // If no new image uploaded, use the old one
        $existing_data = $stasiun->getStasiunById($id);
        if (!$foto_path && $existing_data) {
            $foto_path = $existing_data['foto'];
        }

        if ($stasiun->updateStasiun($id, $nama_stasiun, $ketinggian, $lokasi, $foto_path)) {
            redirectWithMessage($base_url, "Data berhasil diubah", "positive");
        } else {
            redirectWithMessage($base_url, "Gagal mengubah data", "negative");
        }
    }
}

<?php

require_once __DIR__ . '/../config/db.php';

class Stasiun {

    private $conn;

    public function __construct() {   
        $this->conn = (new Database())->getConnection();
    }

    public function getAllStasiun() {
        $stmt = $this->conn->query("SELECT * FROM stasiun");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStasiunById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM stasiun WHERE id_stasiun = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addStasiun($nama_stasiun, $ketinggian, $lokasi, $foto) {
        $stmt = $this->conn->prepare("INSERT INTO stasiun (nama_stasiun, ketinggian, lokasi, foto) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nama_stasiun, $ketinggian, $lokasi, $foto]);
    }

    public function updateStasiun($id, $nama_stasiun, $ketinggian, $lokasi, $foto) {
        $stmt = $this->conn->prepare("UPDATE stasiun SET nama_stasiun = ?, ketinggian = ?, lokasi = ?, foto = ? WHERE id_stasiun = ?");
        return $stmt->execute([$nama_stasiun, $ketinggian, $lokasi, $foto, $id]);
    }

    public function deleteStasiun($id) {
        $stmt = $this->conn->prepare("DELETE FROM stasiun WHERE id_stasiun = ?");
        return $stmt->execute([$id]);
    }

    public function searchStasiun($keyword) {
        $stmt = $this->conn->prepare("SELECT * FROM stasiun WHERE nama_stasiun LIKE ? OR lokasi LIKE ?");
        $stmt->execute(['%' . $keyword . '%', '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

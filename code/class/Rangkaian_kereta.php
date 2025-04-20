<?php   
require_once __DIR__ . '/../config/db.php';

class Rangkaian_kereta {
    private $conn;

    public function __construct() {   
        $this->conn = (new Database())->getConnection();
    }

    public function getAllRangkaianKereta() {
        $stmt = $this->conn->query("SELECT * FROM rangkaian_kereta");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRangkaianKereta($id, $nama_kereta, $kelas_kereta, $jumlah_gerbong, $kapasitas_penumpang) {
        $stmt = $this->conn->prepare("UPDATE rangkaian_kereta SET nama_kereta = ?, kelas_kereta = ?, jumlah_gerbong = ?, kapasitas_penumpang = ? WHERE id_kereta = ?");
        return $stmt->execute([$nama_kereta, $kelas_kereta, $jumlah_gerbong, $kapasitas_penumpang, $id]);
    }

    public function deleteRangkaianKereta($id) {
        $stmt = $this->conn->prepare("DELETE FROM rangkaian_kereta WHERE id_kereta = ?");
        return $stmt->execute([$id]);
    }

    public function addRangkaianKereta($nama_kereta, $kelas_kereta, $jumlah_gerbong, $kapasitas_penumpang) {
        $stmt = $this->conn->prepare("INSERT INTO rangkaian_kereta (nama_kereta, kelas_kereta, jumlah_gerbong, kapasitas_penumpang) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nama_kereta, $kelas_kereta, $jumlah_gerbong, $kapasitas_penumpang]);
    }
    
    public function getRangkaianKeretaById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM rangkaian_kereta WHERE id_kereta = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchRangkaianKereta($keyword) {
        $stmt = $this->conn->prepare("SELECT * FROM rangkaian_kereta WHERE nama_kereta LIKE ? OR kelas_kereta LIKE ?");
        $stmt->execute(['%' . $keyword . '%', '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}   

?>
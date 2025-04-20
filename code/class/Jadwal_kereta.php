<?php

require_once __DIR__ . '/../config/db.php';

class Jadwal_kereta{

    private $conn;

    public function __construct() {   
        $this->conn = (new Database())->getConnection();
    }

    public function getAllJadwalKereta() {
        $stmt = $this->conn->query("SELECT j.*, k.nama_kereta, s1.nama_stasiun AS stasiun_keberangkatan, s2.nama_stasiun AS stasiun_tujuan 
                        FROM jadwal_kereta j 
                        JOIN rangkaian_kereta k ON j.id_kereta = k.id_kereta 
                        JOIN stasiun s1 ON j.id_stasiun_keberangkatan = s1.id_stasiun 
                        JOIN stasiun s2 ON j.id_stasiun_tujuan = s2.id_stasiun");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addJadwalKereta($id_kereta, $id_stasiun_keberangkatan, $id_stasiun_tujuan, $waktu_keberangkatan, $waktu_tiba) {
        $stmt = $this->conn->prepare("INSERT INTO jadwal_kereta (id_kereta, id_stasiun_keberangkatan, id_stasiun_tujuan, waktu_keberangkatan, waktu_tiba) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$id_kereta, $id_stasiun_keberangkatan, $id_stasiun_tujuan, $waktu_keberangkatan, $waktu_tiba]);
    }

    
    public function updateJadwalKereta($id_jadwal, $id_kereta, $id_stasiun_keberangkatan, $id_stasiun_tujuan, $waktu_keberangkatan, $waktu_tiba) {
        $stmt = $this->conn->prepare("UPDATE jadwal_kereta SET id_kereta = ?, id_stasiun_keberangkatan = ?, id_stasiun_tujuan = ?, waktu_keberangkatan = ?, waktu_tiba = ? WHERE id_jadwal = ?");
        return $stmt->execute([$id_kereta, $id_stasiun_keberangkatan, $id_stasiun_tujuan, $waktu_keberangkatan, $waktu_tiba, $id_jadwal]);
    }

    public function deleteJadwalKereta($id_jadwal) {
        $stmt = $this->conn->prepare("DELETE FROM jadwal_kereta WHERE id_jadwal = ?");
        return $stmt->execute([$id_jadwal]);
    }
    
    public function getJadwalKeretaById($id) {
        $stmt = $this->conn->prepare("SELECT j.*, k.nama_kereta, s1.nama_stasiun AS stasiun_keberangkatan, s2.nama_stasiun AS stasiun_tujuan 
                        FROM jadwal_kereta j 
                        JOIN rangkaian_kereta k ON j.id_kereta = k.id_kereta 
                        JOIN stasiun s1 ON j.id_stasiun_keberangkatan = s1.id_stasiun 
                        JOIN stasiun s2 ON j.id_stasiun_tujuan = s2.id_stasiun
                        WHERE j.id_jadwal = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchJadwalKereta($keyword) {
        $stmt = $this->conn->prepare("SELECT j.*, k.nama_kereta, s1.nama_stasiun AS stasiun_keberangkatan, s2.nama_stasiun AS stasiun_tujuan 
                        FROM jadwal_kereta j 
                        JOIN rangkaian_kereta k ON j.id_kereta = k.id_kereta 
                        JOIN stasiun s1 ON j.id_stasiun_keberangkatan = s1.id_stasiun 
                        JOIN stasiun s2 ON j.id_stasiun_tujuan = s2.id_stasiun
                        WHERE k.nama_kereta LIKE ? OR s1.nama_stasiun LIKE ? OR s2.nama_stasiun LIKE ?");
        $stmt->execute(['%' . $keyword . '%', '%' . $keyword . '%', '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>
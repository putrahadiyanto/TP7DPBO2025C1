CREATE DATABASE db_kereta;
USE db_kereta;

-- Table 1: Rangkaian Kereta
CREATE TABLE rangkaian_kereta (
    id_kereta INT NOT NULL AUTO_INCREMENT,
    nama_kereta VARCHAR(50) NOT NULL,
    kelas_kereta ENUM('Eksklusif', 'Ekonomi', 'Bisnis') NOT NULL,
    jumlah_gerbong INT NOT NULL,
    kapasitas_penumpang INT NOT NULL,
    PRIMARY KEY (id_kereta)
);

-- Table 2: Stasiun
CREATE TABLE stasiun (
    id_stasiun INT NOT NULL AUTO_INCREMENT,
    nama_stasiun VARCHAR(50) NOT NULL,
    ketinggian INT NOT NULL,
    lokasi VARCHAR(50) NOT NULL,
    foto varchar(255) DEFAULT NULL,
    PRIMARY KEY (id_stasiun)
);

-- Table 3: Jadwal Kereta
CREATE TABLE jadwal_kereta (
    id_jadwal INT NOT NULL AUTO_INCREMENT,
    id_kereta INT NOT NULL,
    id_stasiun_keberangkatan INT NOT NULL,
    id_stasiun_tujuan INT NOT NULL,
    waktu_keberangkatan DATETIME NOT NULL,
    waktu_tiba DATETIME NOT NULL,
    PRIMARY KEY (id_jadwal),
    FOREIGN KEY (id_kereta) REFERENCES rangkaian_kereta(id_kereta),
    FOREIGN KEY (id_stasiun_keberangkatan) REFERENCES stasiun(id_stasiun),
    FOREIGN KEY (id_stasiun_tujuan) REFERENCES stasiun(id_stasiun)
);

INSERT INTO rangkaian_kereta (nama_kereta, kelas_kereta, jumlah_gerbong, kapasitas_penumpang) VALUES
('Argo Bromo Anggrek', 'Eksklusif', 10, 500),
('Taksaka', 'Bisnis', 8, 400),
('Lodaya', 'Bisnis', 7, 350),
('Majapahit', 'Ekonomi', 9, 450),
('Progo', 'Ekonomi', 8, 420);

INSERT INTO stasiun (nama_stasiun, ketinggian, lokasi, foto) VALUES
('Stasiun Gambir', 15, 'Jakarta' , 'images/gambir.jpg'),
('Stasiun Pasar Senen', 10, 'Jakarta', 'images/pasarsenen.jpg'),
('Stasiun Bandung', 700, 'Bandung', 'images/bandung.jpg'),
('Stasiun Yogyakarta', 113, 'Yogyakarta', 'images/yogyakarta.jpg'),
('Stasiun Surabaya Gubeng', 5, 'Surabaya', 'images/surabaya.jpg'),
('Stasiun Malang', 444, 'Malang', 'images/malang.jpg'),
('Stasiun Solo Balapan', 93, 'Surakarta', 'images/solobalapan.jpg');

INSERT INTO jadwal_kereta (id_kereta, id_stasiun_keberangkatan, id_stasiun_tujuan, waktu_keberangkatan, waktu_tiba) VALUES
(1, 1, 5, '2025-04-15 08:00:00', '2025-04-15 16:00:00'), -- Argo Bromo Anggrek: Jakarta → Surabaya
(2, 1, 4, '2025-04-16 07:30:00', '2025-04-16 13:45:00'), -- Taksaka: Gambir → Yogyakarta
(3, 3, 7, '2025-04-15 10:00:00', '2025-04-15 14:30:00'), -- Lodaya: Bandung → Solo
(4, 2, 6, '2025-04-17 17:15:00', '2025-04-18 02:00:00'), -- Majapahit: Pasar Senen → Malang
(5, 2, 4, '2025-04-18 06:00:00', '2025-04-18 14:00:00'); -- Progo: Pasar Senen → Yogyakarta

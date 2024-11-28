use projectdb;

-- Tabel Users
CREATE TABLE users (
    id INT IDENTITY(1,1) PRIMARY KEY,
    username NVARCHAR(50) NOT NULL UNIQUE,
    password NVARCHAR(255) NOT NULL,
    role NVARCHAR(50) CHECK (role IN ('admin', 'dosen', 'mahasiswa')) NOT NULL
);

-- Tabel Tata Tertib
CREATE TABLE tata_tertib (
    id INT IDENTITY(1,1) PRIMARY KEY,
    aturan NVARCHAR(MAX) NOT NULL,
    deskripsi NVARCHAR(MAX) NOT NULL
);

-- Tabel Sanksi
CREATE TABLE sanksi (
    id INT IDENTITY(1,1) PRIMARY KEY,
    kategori NVARCHAR(50) NOT NULL,
    deskripsi NVARCHAR(MAX) NOT NULL
);

-- Tabel Pelanggaran
CREATE TABLE pelanggaran (
    id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    sanksi_id INT NOT NULL,
    tata_tertib_id INT NOT NULL,
    deskripsi NVARCHAR(MAX) NOT NULL,
    status NVARCHAR(50) DEFAULT 'belum diverifikasi' CHECK (status IN ('belum diverifikasi', 'diverifikasi')),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (sanksi_id) REFERENCES sanksi(id),
    FOREIGN KEY (tata_tertib_id) REFERENCES tata_tertib(id)
);

-- Tabel Statistik Pelanggaran
CREATE TABLE statistik (
    id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    pelanggaran_count INT DEFAULT 0,
    last_updated DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Menambahkan user dummy dengan password '123' (hash manual bisa dilakukan di aplikasi)
INSERT INTO users (username, password, role) VALUES
('admin1', '202cb962ac59075b964b07152d234b70', 'admin'), -- MD5('123')
('dosen1', '202cb962ac59075b964b07152d234b70', 'dosen'),
('mahasiswa1', '202cb962ac59075b964b07152d234b70', 'mahasiswa');
GO

-- Menambahkan data tata tertib
INSERT INTO tata_tertib (aturan, deskripsi) VALUES
('Tidak boleh merokok di area kampus', 'Merokok di area kampus akan dikenakan sanksi sesuai ketentuan.'),
('Wajib memakai kartu identitas', 'Kartu identitas harus selalu dibawa di dalam kampus.');
GO

-- Menambahkan data sanksi
INSERT INTO sanksi (kategori, deskripsi) VALUES
('Ringan', 'Teguran atau peringatan lisan.'),
('Sedang', 'Peringatan tertulis dan wajib menghadiri sesi konseling.'),
('Berat', 'Diskors selama satu semester.');
GO

-- Menambahkan laporan pelanggaran dummy
INSERT INTO pelanggaran (user_id, sanksi_id, tata_tertib_id, deskripsi, status) VALUES
(3, 1, 1, 'Melanggar aturan merokok di area kampus.', 'belum diverifikasi'),
(3, 2, 2, 'Tidak membawa kartu identitas di dalam kampus.', 'belum diverifikasi');
GO

-- Menambahkan statistik dummy
INSERT INTO statistik (user_id, pelanggaran_count) VALUES
(3, 2);
GO

CREATE TABLE kategori_sanksi (
    id_kategori INT PRIMARY KEY IDENTITY(1,1),
    nama_kategori NVARCHAR(255) NOT NULL
);

CREATE TABLE laporan_pelanggaran (
    id_laporan INT IDENTITY(1,1) PRIMARY KEY, -- Gunakan IDENTITY
    nama_pelapor NVARCHAR(100),              -- Gunakan NVARCHAR untuk mendukung Unicode
    jenis_pelanggaran NVARCHAR(100),
    status NVARCHAR(20) NOT NULL             -- SQL Server tidak mendukung ENUM secara langsung
);


<?php 
$dir = __DIR__ . "/../";
require_once $dir . "class/rangkaian_kereta.php";

$rangkaian = new Rangkaian_kereta();
$id = $_GET['id'] ?? null;
$data = $rangkaian->getRangkaianKeretaById($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rangkaian</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="font-sans bg-gray-100 pt-28">
    <?php include($dir . "view/header.php"); ?>

    <main class="max-w-3xl mx-auto px-4">
        <div class="bg-white shadow-2xl rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-6 py-4">
                <h2 class="text-2xl font-bold text-center">Edit Data Rangkaian</h2>
            </div>

            <form action="../handler/rangkaian_handler.php" method="POST" class="space-y-6 p-6">

                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?= htmlspecialchars($data['id_kereta']) ?>">

                <!-- Nama Kereta -->
                <div>
                    <label for="nama_kereta" class="block font-semibold text-gray-700 mb-1">Nama Kereta</label>
                    <input type="text" id="nama_kereta" name="nama_kereta" value="<?= htmlspecialchars($data['nama_kereta']) ?>" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- Kelas Kereta -->
                <div>
                    <label for="kelas_kereta" class="block font-semibold text-gray-700 mb-1">Kelas Kereta</label>
                    <select id="kelas_kereta" name="kelas_kereta" required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="" hidden>Pilih Kelas</option>
                        <option value="Eksklusif" <?= $data['kelas_kereta'] == 'Eksklusif' ? 'selected' : '' ?>>Eksklusif</option>
                        <option value="Ekonomi" <?= $data['kelas_kereta'] == 'Ekonomi' ? 'selected' : '' ?>>Ekonomi</option>
                        <option value="Bisnis" <?= $data['kelas_kereta'] == 'Bisnis' ? 'selected' : '' ?>>Bisnis</option>
                    </select>
                </div>

                <!-- Jumlah Gerbong -->
                <div>
                    <label for="jumlah_gerbong" class="block font-semibold text-gray-700 mb-1">Jumlah Gerbong</label>
                    <input type="number" id="jumlah_gerbong" name="jumlah_gerbong" value="<?= htmlspecialchars($data['jumlah_gerbong']) ?>" min="1" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- Kapasitas Penumpang -->
                <div>
                    <label for="kapasitas_penumpang" class="block font-semibold text-gray-700 mb-1">Kapasitas Penumpang</label>
                    <input type="number" id="kapasitas_penumpang" name="kapasitas_penumpang" value="<?= htmlspecialchars($data['kapasitas_penumpang']) ?>" min="1" required
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center gap-6 pt-4">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 hover:cursor-pointer">
                        Simpan Perubahan
                    </button>
                    <button type="button"
                            class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 hover:cursor-pointer"
                            onclick="history.back()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="pl-4 pr-4 mt-8 mb-8">
        <p class="text-center">&copy; 2024 Fake Copyright. All rights reserved.</p>
    </footer>
</body>
</html>

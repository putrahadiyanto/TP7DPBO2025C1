<?php 
$dir = __DIR__ . "/../";
require_once $dir . "class/jadwal_kereta.php";
require_once $dir . "class/rangkaian_kereta.php";
require_once $dir . "class/stasiun.php";

$jadwal = new Jadwal_kereta();
$rangkaian = new Rangkaian_kereta();
$stasiun = new Stasiun();

$id = $_GET['id'] ?? null;
$data = $jadwal->getJadwalKeretaById($id);
$keretas = $rangkaian->getAllRangkaianKereta();
$stasiuns = $stasiun->getAllStasiun();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="font-sans bg-gray-100 pt-28">
    <?php include($dir . "view/header.php"); ?>

    <main class="max-w-3xl mx-auto px-4">
        <div class="bg-white shadow-2xl rounded-lg overflow-hidden">
            <div class="bg-blue-600 text-white px-6 py-4">
                <h2 class="text-2xl font-bold text-center">Edit Jadwal Kereta</h2>
            </div>

            <form action="../handler/jadwal_handler.php" method="POST" class="space-y-6 p-6">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?= htmlspecialchars($data['id_jadwal']) ?>">

                <!-- Kereta -->
                <div>
                    <label for="id_kereta" class="block font-semibold text-gray-700 mb-1">Nama Kereta</label>
                    <select id="id_kereta" name="id_kereta" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="" hidden>Pilih Kereta</option>
                        <?php foreach ($keretas as $kereta): ?>
                            <option value="<?= $kereta['id_kereta'] ?>" <?= $kereta['id_kereta'] == $data['id_kereta'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kereta['nama_kereta']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Stasiun Keberangkatan -->
                <div>
                    <label for="id_stasiun_keberangkatan" class="block font-semibold text-gray-700 mb-1">Stasiun Keberangkatan</label>
                    <select id="id_stasiun_keberangkatan" name="id_stasiun_keberangkatan" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="" hidden>Pilih Stasiun</option>
                        <?php foreach ($stasiuns as $stasiun): ?>
                            <option value="<?= $stasiun['id_stasiun'] ?>" <?= $stasiun['id_stasiun'] == $data['id_stasiun_keberangkatan'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($stasiun['nama_stasiun']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Stasiun Tujuan -->
                <div>
                    <label for="id_stasiun_tujuan" class="block font-semibold text-gray-700 mb-1">Stasiun Tujuan</label>
                    <select id="id_stasiun_tujuan" name="id_stasiun_tujuan" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="" hidden>Pilih Stasiun</option>
                        <?php foreach ($stasiuns as $stasiun): ?>
                            <option value="<?= $stasiun['id_stasiun'] ?>" <?= $stasiun['id_stasiun'] == $data['id_stasiun_tujuan'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($stasiun['nama_stasiun']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Waktu Keberangkatan -->
                <div>
                    <label for="waktu_keberangkatan" class="block font-semibold text-gray-700 mb-1">Waktu Keberangkatan</label>
                    <input type="datetime-local" id="waktu_keberangkatan" name="waktu_keberangkatan"
                           value="<?= date('Y-m-d\TH:i', strtotime($data['waktu_keberangkatan'])) ?>" required
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- Waktu Tiba -->
                <div>
                    <label for="waktu_tiba" class="block font-semibold text-gray-700 mb-1">Waktu Tiba</label>
                    <input type="datetime-local" id="waktu_tiba" name="waktu_tiba"
                           value="<?= date('Y-m-d\TH:i', strtotime($data['waktu_tiba'])) ?>" required
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
        <p class="text-center">&copy; 2024 Jadwal Kereta. All rights reserved.</p>
    </footer>
</body>
</html>

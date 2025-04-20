<?php
$dir = __DIR__ . "/../";
require_once $dir . "class/Rangkaian_kereta.php";
require_once $dir . "class/Stasiun.php";

$rangkaian = new Rangkaian_kereta();
$stasiun = new Stasiun();

$listKereta = $rangkaian->getAllRangkaianKereta();
$listStasiun = $stasiun->getAllStasiun();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Kereta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="font-sans pt-28">
<?php include ($dir . "view/header.php"); ?>

<main class="max-w-3xl mx-auto px-4">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="bg-green-600 text-white">
            <h2 class="text-2xl text-center font-semibold pt-4 pb-4">Tambah Jadwal Kereta</h2>
        </div>
        <form action="../handler/jadwal_handler.php" method="POST" class="space-y-4 m-4">
            <input type="hidden" name="action" value="add">

            <!-- Pilih Kereta -->
            <div>
                <label for="id_kereta" class="block font-medium text-gray-700 mb-1">Nama Kereta</label>
                <select id="id_kereta" name="id_kereta" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                    <option value="" hidden>Pilih Kereta</option>
                    <?php foreach($listKereta as $kereta): ?>
                        <option value="<?= $kereta['id_kereta'] ?>"><?= $kereta['nama_kereta'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Stasiun Keberangkatan -->
            <div>
                <label for="id_stasiun_keberangkatan" class="block font-medium text-gray-700 mb-1">Stasiun Keberangkatan</label>
                <select id="id_stasiun_keberangkatan" name="id_stasiun_keberangkatan" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                    <option value="" hidden>Pilih Stasiun</option>
                    <?php foreach($listStasiun as $stasiun): ?>
                        <option value="<?= $stasiun['id_stasiun'] ?>"><?= $stasiun['nama_stasiun'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Stasiun Tujuan -->
            <div>
                <label for="id_stasiun_tujuan" class="block font-medium text-gray-700 mb-1">Stasiun Tujuan</label>
                <select id="id_stasiun_tujuan" name="id_stasiun_tujuan" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                    <option value="" hidden>Pilih Stasiun</option>
                    <?php foreach($listStasiun as $stasiun): ?>
                        <option value="<?= $stasiun['id_stasiun'] ?>"><?= $stasiun['nama_stasiun'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Waktu Keberangkatan -->
            <div>
                <label for="waktu_keberangkatan" class="block font-medium text-gray-700 mb-1">Waktu Keberangkatan</label>
                <input type="datetime-local" id="waktu_keberangkatan" name="waktu_keberangkatan" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Waktu Tiba -->
            <div>
                <label for="waktu_tiba" class="block font-medium text-gray-700 mb-1">Waktu Tiba</label>
                <input type="datetime-local" id="waktu_tiba" name="waktu_tiba" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center gap-x-4">
                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">Simpan</button>
                <button type="button" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700" onclick="history.back()">Batal</button>
            </div>
        </form>
    </div>
</main>

<footer class="pl-4 pr-4 mt-8 mb-8">
    <p class="text-center">&copy; 2024 Jadwal Kereta. All rights reserved.</p>
</footer>
</body>
</html>

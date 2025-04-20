<?php 
    $dir = __DIR__ . "/../";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rangkaian</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class = "font-sans pt-28">
    <?php include ($dir . "view/header.php"); ?>

    <main class="max-w-3xl mx-auto px-4">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class = "bg-green-500 text-white">
                <h2 class="text-2xl text-center font-semibold pt-4 pb-4">Tambah Data Rangkaian</h2>
            </div>
            <form action="../handler/rangkaian_handler.php" method="POST" class="space-y-4 m-4">

                <input type="hidden" name="action" value="add">

                <!-- Nama Kereta -->
                <div>
                    <label for="nama_kereta" class="block font-medium text-gray-700 mb-1">Nama Kereta</label>
                    <input type="text" id="nama_kereta" name="nama_kereta" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Kelas Kereta -->
                <div>
                    <label for="kelas_kereta" class="block font-medium text-gray-700 mb-1">Kelas Kereta</label>
                    <select id="kelas_kereta" name="kelas_kereta" required
                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" hidden>Pilih Kelas</option>
                        <option value="Eksklusif">Eksklusif</option>
                        <option value="Ekonomi">Ekonomi</option>
                        <option value="Bisnis">Bisnis</option>
                    </select>
                </div>

                <!-- Jumlah Gerbong -->
                <div>
                    <label for="jumlah_gerbong" class="block font-medium text-gray-700 mb-1">Jumlah Gerbong</label>
                    <input type="number" id="jumlah_gerbong" name="jumlah_gerbong" min="1" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Kapasitas Penumpang -->
                <div>
                    <label for="kapasitas_penumpang" class="block font-medium text-gray-700 mb-1">Kapasitas Penumpang</label>
                    <input type="number" id="kapasitas_penumpang" name="kapasitas_penumpang" min="1" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center gap-x-4">
                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 hover:cursor-pointer">
                        Simpan
                    </button>
                    <button type="button" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 hover:cursor-pointer"
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
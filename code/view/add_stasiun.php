<?php 
    $dir = __DIR__ . "/../";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stasiun</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="font-sans pt-28">
    <?php include ($dir . "view/header.php"); ?>

    <main class="max-w-3xl mx-auto px-4">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-green-500 text-white">
                <h2 class="text-2xl text-center font-semibold pt-4 pb-4">Tambah Data Stasiun</h2>
            </div>
            <form action="../handler/stasiun_handler.php" method="POST" enctype="multipart/form-data" class="space-y-4 m-4">

                <input type="hidden" name="action" value="add">

                <!-- Nama Stasiun -->
                <div>
                    <label for="nama_stasiun" class="block font-medium text-gray-700 mb-1">Nama Stasiun</label>
                    <input type="text" id="nama_stasiun" name="nama_stasiun" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Ketinggian -->
                <div>
                    <label for="ketinggian" class="block font-medium text-gray-700 mb-1">Ketinggian (mdpl)</label>
                    <input type="number" id="ketinggian" name="ketinggian" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Foto -->
                <div>
                    <label for="foto" class="block font-medium text-gray-700 mb-1">Foto Stasiun</label>
    
                    <div class="flex items-center gap-4">
                        <label for="foto" class="bg-blue-600 text-white py-2 px-4 rounded-md cursor-pointer hover:bg-blue-700 transition">
                            Pilih Foto
                        </label>
                        <span id="file-name" class="text-gray-600 text-sm">Tidak ada file dipilih</span>
                    </div>

                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="updateFileName(this)">
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


<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : "Tidak ada file dipilih";
        document.getElementById('file-name').textContent = fileName;
    }
</script>


<?php 
    $dir = __DIR__ . "/../";
    require_once $dir . "class/stasiun.php";

    $stasiun = new Stasiun();
    $data = null;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = $stasiun->getStasiunById($id);
    }

    if (!$data) {
        echo "Data stasiun tidak ditemukan.";
        exit;
    }

    $script_name = $_SERVER['SCRIPT_NAME']; // e.g., /TP7/view/rangkaian.php
    $base_path = explode('/', $script_name);
    $project_folder = $base_path[1]; // TP7
    $base_url = "/" . $project_folder;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stasiun</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="font-sans pt-28">
    <?php include ($dir . "view/header.php"); ?>

    <main class="max-w-3xl mx-auto px-4">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-blue-500 text-white">
                <h2 class="text-2xl text-center font-semibold pt-4 pb-4">Edit Data Stasiun</h2>
            </div>
            
            <!-- Foto Preview -->
            <div class="px-6 pt-6 mt-4">
                <div class="rounded-xl overflow-hidden shadow-md border border-gray-200 bg-gray-50">
                    <img src="<?= $base_url . '/' . $data['foto'] ?>" alt="Foto Stasiun"
                        class="w-full h-64 object-cover object-center transition duration-300 ease-in-out hover:scale-105">
                </div>
            </div>

            <form action="../handler/stasiun_handler.php" method="POST" enctype="multipart/form-data" class="space-y-4 m-4">

                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?= $data['id_stasiun'] ?>">

                <!-- Nama Stasiun -->
                <div>
                    <label for="nama_stasiun" class="block font-medium text-gray-700 mb-1">Nama Stasiun</label>
                    <input type="text" id="nama_stasiun" name="nama_stasiun" value="<?= htmlspecialchars($data['nama_stasiun']) ?>" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Ketinggian -->
                <div>
                    <label for="ketinggian" class="block font-medium text-gray-700 mb-1">Ketinggian (mdpl)</label>
                    <input type="number" id="ketinggian" name="ketinggian" value="<?= htmlspecialchars($data['ketinggian']) ?>" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Foto -->
                <div>
                    <label for="foto" class="block font-medium text-gray-700 mb-1">Foto Stasiun</label>

                    <div class="flex items-center gap-4">
                        <label for="foto" class="bg-blue-600 text-white py-2 px-4 rounded-md cursor-pointer hover:bg-blue-700 transition">
                            Ganti Foto
                        </label>
                        <span id="file-name" class="text-gray-600 text-sm">
                            <?= $data['foto'] ? basename($data['foto']) : 'Tidak ada foto' ?>
                        </span>
                    </div>

                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="updateFileName(this)">
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center gap-x-4">
                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 hover:cursor-pointer">
                        Simpan Perubahan
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

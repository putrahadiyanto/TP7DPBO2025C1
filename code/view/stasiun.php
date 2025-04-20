<?php
require_once __DIR__ . '/../class/Stasiun.php';

$script_name = $_SERVER['SCRIPT_NAME']; // e.g., /TP7/view/rangkaian.php
$base_path = explode('/', $script_name);
$project_folder = $base_path[1]; // TP7
$base_url = "/" . $project_folder;

$stasiun = new Stasiun();

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $datas = $stasiun->searchStasiun($keyword);
} else {
    $datas = $stasiun->getAllStasiun();
}

if (isset($_GET['message']) && isset($_GET['note'])) {
    $message = $_GET['message'];
    $note = $_GET['note'];
}
?>

<div class="pl-6 pr-6">
    <h2 class="text-2xl font-semibold mb-4 mt-4">Data Stasiun</h2>

    <div class="py-2 flex gap-2 justify-between mb-2">
        <a href="view/add_stasiun.php" class="bg-green-500 text-white px-3 py-2 font-semibold rounded-lg hover:bg-green-600 transition">Tambah</a>
        <form action="" method="GET" class="flex w-full sm:w-auto gap-2">
            <input type="text" class="hidden" name="page" value="stasiun">
            <input type="text" name="keyword" class="border border-gray-300 shadow-md py-2 px-3 rounded-md w-full sm:w-64" placeholder="Cari Stasiun">
            <button type="submit" class="hidden" hidden></button>
        </form>
    </div>

    <!-- Alerts -->
    <?php if (empty($datas)) { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md flex justify-center" role="alert">
            <strong class="font-bold">Data tidak ditemukan!</strong>
        </div>
    <?php } ?>

    <?php if (isset($message) && $note == 'positive') { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md flex justify-center mb-4" role="alert">
            <strong class="font-bold"><?= $message ?></strong>
        </div>
    <?php } ?>

    <?php if (isset($message) && $note == 'negative') { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md flex justify-center mb-4" role="alert">
            <strong class="font-bold"><?= $message ?></strong>
        </div>
    <?php } ?>

    <!-- Cards -->
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($datas as $data) { ?>
            <div class="rounded-lg shadow-md overflow-hidden bg-white border border-gray-200">
                <div class="bg-orange-600 px-4 py-2 text-white font-semibold text-md">
                    <?= htmlspecialchars($data['nama_stasiun']) ?>
                </div>
                
                <div class="p-4 text-gray-800 flex gap-4">
                    <img src="<?= $base_url ?>/<?= htmlspecialchars($data['foto']) ?>" alt="Gambar Stasiun" class="w-32 object-cover rounded-lg shadow-md aspect-square">
                    <p class = "w-2/3">
                        <strong>Nama Stasiun:</strong> <?= htmlspecialchars($data['nama_stasiun']) ?><br>
                        <strong>Ketinggian:</strong> <?= htmlspecialchars($data['ketinggian'])?> MDPL<br>
                        <strong>Lokasi:</strong> <?= htmlspecialchars($data['lokasi']) ?><br>
                    </p>
                </div>
                
                <div class="flex justify-end gap-2 p-4">
                    <a href="view/edit_stasiun.php?id=<?= $data['id_stasiun'] ?>" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</a>
                    <a href="handler/stasiun_handler.php?action=delete&id=<?= $data['id_stasiun'] ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                       onclick="return confirm('Apakah data benar ingin dihapus?');">Hapus</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

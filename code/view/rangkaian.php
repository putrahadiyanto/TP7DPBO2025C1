<?php
require_once __DIR__ . '/../class/Rangkaian_kereta.php';

$rangkaian = new Rangkaian_kereta();

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $datas = $rangkaian->searchRangkaianKereta($keyword);
} else {
    $datas = $rangkaian->getAllRangkaianKereta();
}

if(isset($_GET['message']) && isset($_GET['note'])) {
    $message = $_GET['message'];
    $note = $_GET['note'];
}
?>

<div class = "pl-6 pr-6">
    <h2 class="text-2xl font-semibold mb-4 mt-4">Data Rangkaian Kereta</h2>
    <div class="py-2 flex gap-2 justify-between mb-2">
        <a href="view/add_rangkaian.php" class="bg-green-500 text-white px-3 py-2 font-semibold rounded-lg">Tambah</a>
        <form action="" method="GET" class = "flex w-xs">
            <input type="text" class="hidden" name="page" value="rangkaian" hidden>
            <input type="text" name="keyword" class="border-1 border-gray-300 w-full flex-grow sm:w-auto shadow-md py-2 px-3 rounded-md overflow-hidden" placeholder="Cari Rangkaian Kereta">
            <button type="submit" class="hidden" hidden></button>
        </form>
    </div>

    <?php if(empty($datas)) {?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md flex justify-center" role="alert">
            <strong class="font-bold">Data tidak ditemukan!</strong>
        </div>
    <?php } ?>

    <?php if(isset($message) && $note == 'positive') { ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md flex justify-center mb-4" role="alert">
            <strong class="font-bold"><?= $message ?></strong>
        </div>
    <?php } ?>

    <?php if(isset($message) && $note == 'negative') { ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md flex justify-center mb-4" role="alert">
            <strong class="font-bold"><?= $message ?></strong>
        </div>
    <?php } ?>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        <?php foreach ($datas as $data) { ?>
            <div class="rounded-lg shadow-md overflow-hidden bg-white border border-gray-200 sm-w-full">
                <div class="bg-blue-500 px-4 py-2 text-white font-semibold text-md">
                    <?= $data['nama_kereta'] ?>
                </div>
                <div class="px-4 py-2 text-gray-800">
                    <p>
                        <strong>Nama Rangkaian:</strong> <?= $data['nama_kereta'] ?><br>
                        <strong>Kelas Kereta:</strong> <?= $data['kelas_kereta'] ?><br>
                        <strong>Jumlah Gerbong:</strong> <?= $data['jumlah_gerbong'] ?><br>
                        <strong>Kapasitas Penumpang:</strong> <?= $data['kapasitas_penumpang'] ?><br>
                    </p>
                    <div class="py-1 mt-2 flex gap-2 justify-end">
                        <a href="view/edit_rangkaian.php?id=<?= $data['id_kereta']?>" class=" bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</a>
                        <a href="handler/rangkaian_handler.php?action=delete&id=<?= $data['id_kereta']?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick = "return confirm('Apakah data benar ingin dihapus?');">Hapus</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
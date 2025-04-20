<?php
require_once __DIR__ . '/../class/Jadwal_kereta.php';

$jadwal = new Jadwal_kereta();

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $datas = $jadwal->searchJadwalKereta($keyword);
} else {
    $datas = $jadwal->getAllJadwalKereta();
}

if(isset($_GET['message']) && isset($_GET['note'])) {
    $message = $_GET['message'];
    $note = $_GET['note'];
}
?>

<div class="pl-6 pr-6">
    <h2 class="text-2xl font-semibold mb-4 mt-4">Jadwal Kereta</h2>
    <div class="py-2 flex gap-2 justify-between mb-2">
        <a href="view/add_jadwal.php" class="bg-green-500 text-white px-3 py-2 font-semibold rounded-lg">Tambah</a>
        <form action="" method="GET" class="flex w-xs">
            <input type="text" class="hidden" name="page" value="jadwal" hidden>
            <input type="text" name="keyword" class="border-1 border-gray-300 w-full flex-grow sm:w-auto shadow-md py-2 px-3 rounded-md overflow-hidden" placeholder="Cari Jadwal Kereta">
            <button type="submit" class="hidden" hidden></button>
        </form>
    </div>

    <?php if(empty($datas)) { ?>
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
            <div class="rounded-lg shadow-md overflow-hidden bg-white border border-gray-200">
                <div class="bg-indigo-600 px-4 py-2 text-white font-semibold text-md">
                    <?= htmlspecialchars($data['nama_kereta']) ?>
                </div>
                <div class="px-4 py-2 text-gray-800">
                    <p>
                        <strong>Keberangkatan:</strong> <?= htmlspecialchars($data['stasiun_keberangkatan']) ?><br>
                        <strong>Tujuan:</strong> <?= htmlspecialchars($data['stasiun_tujuan']) ?><br>
                        <strong>Waktu Berangkat:</strong> <?= date('d M Y, H:i', strtotime($data['waktu_keberangkatan'])) ?><br>
                        <strong>Waktu Tiba:</strong> <?= date('d M Y, H:i', strtotime($data['waktu_tiba'])) ?><br>
                    </p>
                    <div class="py-1 mt-2 flex gap-2 justify-end">
                        <a href="view/edit_jadwal.php?id=<?= $data['id_jadwal'] ?>" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</a>
                        <a href="handler/jadwal_handler.php?action=delete&id=<?= $data['id_jadwal'] ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Apakah data benar ingin dihapus?');">Hapus</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

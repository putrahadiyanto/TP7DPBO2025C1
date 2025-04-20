<?php
    $script_name = $_SERVER['SCRIPT_NAME']; // e.g., /TP7/view/rangkaian.php
    $base_path = explode('/', $script_name);
    $project_folder = $base_path[1]; // TP7
    $base_url = "/" . $project_folder;
?>


<header class = "p-4 bg-blue-600 text-white fixed top-0 w-full flex items-center gap-x-6 shadow-md">
    <div class = "rounded bg-white p-2">
        <a href="<?= $base_url ?>/index.php"><img class = "aspect-auto w-20" src="<?= $base_url ?>/images/kai.png" alt=""></a>
    </div>
    <nav>
        <ul class = "flex space-x-4 bold">
            <li><a href="<?= $base_url ?>/index.php" class = "text-white hover:opacity-80 font-semibold">Home</a></li>
            <li><a href="<?= $base_url ?>/index.php?page=rangkaian" class = "text-white hover:opacity-80 font-semibold">Rangkaian</a></li>
            <li><a href="<?= $base_url ?>/index.php?page=stasiun" class = "text-white hover:opacity-80 font-semibold">Stasiun</a></li>
            <li><a href="<?= $base_url ?>/index.php?page=jadwal" class = "text-white hover:opacity-80 font-semibold">Jadwal</a></li>
        </ul>
    </nav>
</header>
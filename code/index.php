<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Testing TP7</title>
</head>

<body class="font-sans pt-20">
    <?php include 'view/header.php'; ?>

    <main>
        <div class="bg-gray-100 shadow-sm pb-6 overflow-hidden">
            <h1 class="text-3xl font-bold text-center m-8">Manajemen Operasional KAI</h1>
                <div class="py-2 flex justify-center gap-x-4">
                    <a href="?page=rangkaian" class="bg-blue-500 text-white rounded px-4 py-2">Rangkaian</a>
                    <a href="?page=stasiun" class="bg-blue-500 text-white rounded px-4 py-2">Stasiun</a>
                    <a href="?page=jadwal" class="bg-blue-500 text-white rounded px-4 py-2 ">Jadwal</a>
                </div>
        </div>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'rangkaian') include 'view/rangkaian.php';
            elseif ($page == 'stasiun') include 'view/stasiun.php';
            elseif ($page == 'jadwal') include 'view/jadwal.php';
            else include 'view/rangkaian.php';
        } else if (!isset($_GET['page'])) {
        ?>

        <?php } ?>
    </main>

    <footer class="pl-4 pr-4 mt-8 mb-8">
        <p class="text-center">&copy; 2024 Fake Copyright. All rights reserved.</p>
    </footer>

</body>

</html>
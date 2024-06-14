<?php
include_once "../../PHP/dbConnection.php";
$direct = new Url; ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8" />
    <link rel=stylesheet href="<?php $direct->directoryGeneral("CSS/Admin", "currentMenus", "css"); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>Menu</title>

</head>

<body>

    <?php
    session_start();
    if ($_SESSION['ID']) {
    } else {
        $direct->redirect("", "index");
    }

    ?> <a href="<?php echo $direct->directory("HTML/Admin", "mainMenu"); ?>" title="Çıkış Yap">
        <img src="<?php echo $direct->directoryGeneral("images", "goBackArrow", "png"); ?>" alt="Geri Git">
    </a><br>
    <h1>Kayıtlı Menüler</h1>
    <?php
    $query = $conn->query("SELECT ID, menuName FROM menu ORDER BY timeStamp DESC", PDO::FETCH_ASSOC);

    foreach ($query as $data) {
        $menuName = $data['menuName'];
        $ID = $data['ID'];
        ?>
        <form action="<?php $direct->directory("PHP/Admin", "menuDetails"); ?>" method="POST">
            <input type="hidden" name="menuID" value="<?= htmlspecialchars($ID, ENT_QUOTES, 'UTF-8') ?>" />
            <input type="submit" value="<?= htmlspecialchars($menuName, ENT_QUOTES, 'UTF-8') ?>" />

        </form>
        <?php
    }
    ?>
      <div id="toggle-link" onclick="toggleHiddenContent()">
        <img src="<?php echo $direct->directoryGeneral('images', 'plus', 'png'); ?>" alt="Show Text Box" class="plus-image">
    </div>
    <div id="hidden-content">
        <form action="<?php $direct->directory('PHP/Admin', 'menuEdit'); ?>" method="POST">
            <input type="text" name="menuName" placeholder="Menü İsmi" required />
            <input type="submit" value="Yeni Menü Ekle" />
        </form>
    </div>

    <script>
          function toggleHiddenContent() {
        var hiddenContent = document.getElementById("hidden-content");
        var plusImage = document.querySelector("#toggle-link .plus-image");

        if (hiddenContent.style.display !== "none") {
            // Show the hidden content and hide the plus image
            hiddenContent.style.display = "block";
            plusImage.style.opacity = 0;
            plusImage.style.width = "0";
            // Make the plus background clickable
            plusImage.style.pointerEvents = "";
            // Replace the inner HTML of the hidden content
            hiddenContent.innerHTML = `
                <form action="<?php $direct->directory('PHP/Admin', 'menuEdit'); ?>" method="POST">
                    <input type="text" name="menuName" placeholder="Menü İsmi" required />
                    <input type="image" src="<?php echo $direct->directoryGeneral('images', 'plus', 'png'); ?>" alt="Yeni Menü Ekle" />
                </form>
            `;
        } else {
            // Hide the hidden content and show the plus image
            hiddenContent.style.display = "none";
            plusImage.style.opacity = 1;

            // Restore the original content of the hidden content
            hiddenContent.innerHTML = `
                <form action="<?php $direct->directory('PHP/Admin', 'menuEdit'); ?>" method="POST">
                    <input type="text" name="menuName" placeholder="Menü İsmi" required />
                    <input type="image" src="<?php echo $direct->directoryGeneral('images', 'plus', 'png'); ?>" alt="Yeni Menü Ekle" />
                </form>
            `;
        }
    }
    </script>
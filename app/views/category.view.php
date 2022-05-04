<?php 
    include "./Inc/header.php";
?>

    <h1> Category PHP </h1>

    <?php 
        echo "<pre>";
        foreach($data['cat'] as $key => $value ) {
    ?>

        <?= $value["catOne"]?> <br>
        <?= $value["catTwo"]?>

    <?php
        }
    ?>

<?php 
    include "./Inc/footer.php";
?>

<?php
/**
 * Created by PhpStorm.
 * User: Deni
 * Date: 12/4/15
 * Time: 11:20 AM
 */
?>
<?php ob_start() ?>

    <div style="width: 97%;  height:100px; background-color: lightgreen;  padding-left: 20px; padding-right: 20px;">
        Email has been sent. <br>
<?php
if (isset($response) === true and count($response) > 0) {
    ?>
        <ul>
            <?php
            for ($i = 0; $i < count($response); $i++) {
                ?>
                <li><?= $response[$i]?></li>
                <?php
            }
            ?>
        </ul>
    <?php
}
?>
    </div>
<?php $content = ob_get_clean() ?>
<?php include 'src/view.php';

<?php
/**
 * Created by PhpStorm.
 * User: Deni
 * Date: 12/4/15
 * Time: 11:20 AM
 */
?>
<?php ob_start() ?>
    <h3>List of Document</h3>
<?php
if (isset($success) === true) {
    ?>
    <div style="width: 97%; height:100px; background-color: lightgreen; padding-left: 20px; padding-right: 20px;">
        <br/>

        <p><?= $success ?></p>
    </div>
    <?php
}
?>
<?php
$lengthData = 0;
if (isset($listDocument) === true) {
    $lengthData = count($listDocument);
}
?>
<form method="POST" action="/swiftmailer/index.php/mail">
    <input type="hidden" name="lengthData" value="<?=$lengthData?>"/>
    <p>
        <a href="/swiftmailer/index.php/document/new" style="text-decoration: none;">
            <input type="button" value="New"/>
        </a>
        <?php
            if($lengthData > 0) {
                ?>
                <input type="submit" value="Share"/>
                <?php
            }
        ?>
    </p>

    <table border="1" style="width: 100%">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Type</th>
            <th>Size</th>
            <th>Show</th>
            <th>Share</th>
        </tr>
        <?php
        $no = 1;
        for ($i = 0; $i < count($listDocument); $i++) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $listDocument[$i]['name'] ?></td>
                <td><?= $listDocument[$i]['type'] ?></td>
                <td><?= $listDocument[$i]['size'] ?></td>
                <td style="text-align: center">
                    <a href="/swiftmailer/index.php/document/show?id=<?= $listDocument[$i]['id'] ?>"
                       style="text-decoration: none">Show</a>
                </td>
                <td style="text-align: center">
                    <input type="hidden" name="name-<?=$i?>" value="<?=$listDocument[$i]['name']?>"/>
                    <input type="hidden" name="id-<?=$i?>" value="<?=$listDocument[$i]['id']?>"/>
                    <input type="checkbox" name="check-<?=$i?>" value="Y"/>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </table>
</form>
<?php $content = ob_get_clean() ?>
<?php include 'src/view.php';

<?php
/**
 * Created by PhpStorm.
 * User: Deni
 * Date: 12/4/15
 * Time: 11:20 AM
 */
?>
<?php ob_start() ?>
    <h3>List of Smtp</h3>
    <?php
        if(isset($success) === true) {
            ?>
            <div style="width: 97%; height:100px; background-color: lightgreen; padding-left: 20px; padding-right: 20px;" >
                <br />
                <p><?=$success?></p>
            </div>
            <?php
        }
        if(isset($failed) === true) {
            ?>
            <div style="width: 97%;  height:100px; background-color: coral;  padding-left: 20px; padding-right: 20px;">
                <br />
                <?=$failed?>
            </div>
            <?php
        }
    ?>
    <p>
        <a href="/swiftmailer/index.php/smtp/new" style="text-decoration: none;"><button>New</button></a>
    </p>
    <table border="1" style="width: 100%">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Host</th>
            <th>Port</th>
            <th>Security</th>
            <th>Test</th>
        </tr>
        <?php
        if(isset($listSmtp) === true) {
            $no = 1;
            for ($i = 0; $i < count($listSmtp); $i++) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $listSmtp[$i]['username'] ?></td>
                    <td><?= $listSmtp[$i]['host'] ?></td>
                    <td><?= $listSmtp[$i]['port'] ?></td>
                    <td><?= $listSmtp[$i]['security'] ?></td>
                    <td style="text-align: center">
                        <a href="/swiftmailer/index.php/smtp?id=<?=$listSmtp[$i]['id']?>" style="text-decoration: none">Test</a>
                    </td>
                </tr>
                <?php
                $no++;
            }
        }
        ?>
    </table>
<?php $content = ob_get_clean() ?>
<?php include 'src/view.php';

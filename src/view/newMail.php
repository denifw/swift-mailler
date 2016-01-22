<?php
/**
 * Created by PhpStorm.
 * User: Deni
 * Date: 12/4/15
 * Time: 11:20 AM
 */
?>
<?php ob_start() ?>
    <h3>Create new Mail</h3>

<?php
if (isset($errors) === true and count($errors) > 0) {
    ?>
    <div style="width: 97%;  height:100px; background-color: coral;  padding-left: 20px; padding-right: 20px;">
        Errors : <br>
        <ul>
            <?php
            for ($i = 0; $i < count($errors); $i++) {
                ?>
                <li><?= $errors[$i]?></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}
?>

    <form method="POST" action="/swiftmailer/index.php/mail/send">
        <table style="width: 80%;">
            <tr>
                <td style="width: 10%">Subject
                </td>
                <td style="width: 60%"><input type="text" name="subject" placeholder="Subject" value="<?= $subject ?>" style="width: 500px"/></td>
            </tr>
            <tr>
                <td>From
                    <small style="color: red">*</small>
                </td>
                <td>
                    <select name="from">
                        <option value="">Select</option>
                        <?php
                            for($i=0; $i< count($listSmtp); $i++) {
                                if($from === $listSmtp[$i]['id']) {
                                    ?>
                                    <option value="<?=$listSmtp[$i]['id']?>" selected><?=$listSmtp[$i]['username']?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?=$listSmtp[$i]['id']?>"><?=$listSmtp[$i]['username']?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>To
                    <small style="color: red">*</small>
                </td>
                <td><input type="text" name="to" placeholder="User Name" value="<?= $to ?>" style="width: 500px"/></td>
            </tr>
            <tr>
                <td>CC
                </td>
                <td><input type="text" name="cc" placeholder="User Name"
                                              value="<?= $cc ?>" style="width: 500px"/></td>
            </tr>
            <tr>
                <td>BCC
                </td>
                <td><input type="text" name="bcc" placeholder="User Name"
                                              value="<?= $bcc ?>" style="width: 500px"/></td>
            </tr>
            <input type="hidden" name="lengthData" value="<?= $postPar['lengthData'] ?>"/>
            <?php
                $label = 'Attachments';
                for ($i=0; $i < $postPar['lengthData']; $i++) {
                    $keyID = 'id-'.$i;
                    $keyName = 'name-'.$i;
                    ?>
                    <tr>
                        <td><?=$label?>
                        </td>
                        <td>
                            <input type="hidden" name="<?=$keyID?>" value="<?= $postPar[$keyID] ?>"/>
                            <input type="hidden" name="<?=$keyName?>" value="<?= $postPar[$keyName] ?>"/>
                            <?=$postPar[$keyName]?>
                        </td>
                    </tr>
                    <?php
                    $label = '';
                }
            ?>
            <tr>
                <td>Message
                </td>
                <td><textarea name="message" cols="40" rows="10"><?=$message?></textarea>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <a href="/swiftmailer/index.php/document" style="text-decoration: none">
                        <input type="button" value="Cancel"/>
                    </a>&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Send"/>
                </td>
            </tr>
        </table>
    </form>
<?php $content = ob_get_clean() ?>
<?php include 'src/view.php';

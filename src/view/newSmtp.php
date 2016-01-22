<?php
/**
 * Created by PhpStorm.
 * User: Deni
 * Date: 12/4/15
 * Time: 11:20 AM
 */
?>
<?php ob_start() ?>
    <h3>Add New Mail Server</h3>

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

    <form method="POST" action="/swiftmailer/index.php/smtp/save">
        <table style="width: 40%">
            <tr>
                <td style="width: 40%">User Name
                    <small style="color: red">*</small>
                </td>
                <td>&nbsp; : &nbsp;</td>
                <td style="width: 40%"><input type="text" name="username" placeholder="User Name"
                                              value="<?= $username ?>"/></td>
            </tr>
            <tr>
                <td style="width: 40%">Password
                    <small style="color: red">*</small>
                </td>
                <td>&nbsp; : &nbsp;</td>
                <td style="width: 40%"><input type="password" name="password" placeholder="Password" value="<?= $password ?>"/></td>
            </tr>
            <tr>
                <td style="width: 40%">Host
                    <small style="color: red">*</small>
                </td>
                <td>&nbsp; : &nbsp;</td>
                <td style="width: 40%"><input type="text" name="host" placeholder="SMTP Server" value="<?= $host ?>"/>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">Port
                    <small style="color: red">*</small>
                </td>
                <td>&nbsp; : &nbsp;</td>
                <td style="width: 40%"><input type="text" name="port" placeholder="Port" value="<?= $port ?>"/></td>
            </tr>
            <tr>
                <td style="width: 40%">Security</td>
                <td>&nbsp; : &nbsp;</td>
                <td style="width: 40%"><input type="text" name="security" placeholder="Security"
                                              value="<?= $security ?>"/></td>
            </tr>
            <tr>
                <td style="width: 40%">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="width: 40%">
                    <a href="/swiftmailer/index.php/smtp" style="text-decoration: none">
                        <input type="button" value="Cancel"/>
                    </a>&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Save"/>
                </td>
            </tr>
        </table>
    </form>
<?php $content = ob_get_clean() ?>
<?php include 'src/view.php';

<?php
/**
 * Created by PhpStorm.
 * User: Deni
 * Date: 12/4/15
 * Time: 11:20 AM
 */
?>
<?php ob_start() ?>
    <h3>Add New Document</h3>
<?php
if(isset($error) === true) {
    ?>
    <div style="width: 97%;  height:100px; background-color: coral;  padding-left: 20px; padding-right: 20px;">
    <br />
        <?=$error?>
    </div>
    <?php
}
?>

    <form method="POST" action="/swiftmailer/index.php/document/save"  enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <table style="width: 40%">
            <tr>
                <td style="width: 40%">File
                    <small style="color: red">*</small>
                </td>
                <td>&nbsp; : &nbsp;</td>
                <td style="width: 40%"><input type="file" name="document" /></td>
            </tr>
            <tr>
                <td style="width: 40%">&nbsp;</td>
                <td>&nbsp;</td>
                <td style="width: 40%">
                    <a href="/swiftmailer/index.php/document" style="text-decoration: none">
                        <input type="button" value="Cancel"/>
                    </a>&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Save"/>
                </td>
            </tr>
        </table>
    </form>
<?php $content = ob_get_clean() ?>
<?php include 'src/view.php';

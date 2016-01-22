<?php

function getAllDocument()
{
    $list = [];
    try {
        # Open Database Connection.
        $conDatabase = openDatabaseConnection();
        # Get the data from database.
        $query = "select id, name, size, type from documents";
        # Create list as array variable to store the data.
        if (($result = mysqli_query($conDatabase, $query))) {
            # Fetch the result into an object.
            while ($row = mysqli_fetch_assoc($result)) {
                #Put the object in to list.
                $list[] = $row;
            }
        }
        # Close database connection.
        closeDatabaseConnection($conDatabase);
    } catch(Exception $e) {
        throw new Exception($e->getTrace());
    }
    # return value.
    return $list;
}

function getDocumentById($id)
{
    $smtp = null;
    try {
        # Open Database Connection.
        $conDatabase = openDatabaseConnection();
        # Get the data from database.
        $query = "select id, name, size, type, file from documents where id=".$id;
        # Create list as array variable to store the data.
        if (($result = mysqli_query($conDatabase, $query))) {
            # Fetch the result into an object.
            while ($row = mysqli_fetch_assoc($result)) {
                #Put the object in to list.
                $smtp = $row;
            }
        }
        # Close database connection.
        closeDatabaseConnection($conDatabase);
    } catch(Exception $e) {
        throw new Exception($e->getTrace());
    }
    # return value.
    return $smtp;
}
function doUploadFile($fileUpload) {
    $fileName = $fileUpload['name'];
    $tmpName  =$fileUpload['tmp_name'];
    $fileSize = $fileUpload['size'];
    $fileType = $fileUpload['type'];

    $fp      = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);
    $fileName = addslashes($fileName);
    # Open Database Connection.
    $conDatabase = openDatabaseConnection();
    # Get the data from database.
    $query = "insert into documents(name,type,size,file) " .
        " value('" . $fileName . "','" . $fileType . "','" . $fileSize. "','" . $content ."')";
    $result = mysqli_query($conDatabase, $query);
    $return = 'success';
    if($result === false) {
        $return = mysqli_error($conDatabase);
    }
    # Close database connection.
    closeDatabaseConnection($conDatabase);
    return $return;
}

function getAllSmtp()
{
    $list = [];
    try {
        # Open Database Connection.
        $conDatabase = openDatabaseConnection();
        # Get the data from database.
        $query = "select id, host,port,security,username,password from smtpmail";
        # Create list as array variable to store the data.
        if (($result = mysqli_query($conDatabase, $query))) {
            # Fetch the result into an object.
            while ($row = mysqli_fetch_assoc($result)) {
                #Put the object in to list.
                $list[] = $row;
            }
        }
        # Close database connection.
        closeDatabaseConnection($conDatabase);
    } catch(Exception $e) {
        throw new Exception($e->getTrace());
    }
    # return value.
    return $list;
}

function getSmtpById($id)
{
    $smtp = null;
    try {
        # Open Database Connection.
        $conDatabase = openDatabaseConnection();
        # Get the data from database.
        $query = "select id, host,port,security,username,password from smtpmail where id=".$id;
        # Create list as array variable to store the data.
        if (($result = mysqli_query($conDatabase, $query))) {
            # Fetch the result into an object.
            while ($row = mysqli_fetch_assoc($result)) {
                #Put the object in to list.
                $smtp = $row;
            }
        }
        # Close database connection.
        closeDatabaseConnection($conDatabase);
    } catch(Exception $e) {
        throw new Exception($e->getTrace());
    }
    # return value.
    return $smtp;
}


function doInsertSmtp($username, $password, $host, $port, $security) {
    # Open Database Connection.
    $conDatabase = openDatabaseConnection();
    # Get the data from database.
    $query = "insert into smtpmail(host,port,security,username,password)" .
        " value('" . $host . "'," . $port . ",'" . $security . "','" . $username . "','" . $password . "')";
    mysqli_query($conDatabase, $query);
    # Close database connection.
    closeDatabaseConnection($conDatabase);

}


/**
 * Function to open connection to mysql database.
 *
 * @return mysqli
 */
function openDatabaseConnection()
{
    # Create variable for database connection.
    $conDatabase = mysqli_connect('localhost', 'root', 'asd!jkl123');
    # Select database name.
    mysqli_select_db($conDatabase, 'swiftmailer');
    # Set connection as return value.
    return $conDatabase;
}

/**
 * Function to close connection from mysql database.
 *
 * @param $conDatabase
 * @return  void
 */
function closeDatabaseConnection($conDatabase)
{
    # Close database connection.
    mysqli_close($conDatabase);
}

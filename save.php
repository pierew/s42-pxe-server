<?php

require_once './config.php';
require_once './functions.php';
require_once './db.php';

switch ($_POST['type']) {
    case "config":
        switch ($_POST['option']) {
            case "hostname":
                shell_exec('hostnamectl set-hostname ' . $_POST['hostname']);
                echo '<meta http-equiv="refresh" content="0; URL=/?view=system&action=reboot">';
                break;
        }
        break;
    case "add":
        switch ($_POST["imagetype"]) {
            case "kernelboot":
                queryDB_RAW("INSERT INTO kernelboot (name,kernel,ramdisk,options) VALUES ('" . $_POST['name'] . "','" . basename($_FILES['kernel']['name']) . "','" . basename($_FILES['ramdisk']['name']) . "','" . $_POST['options'] . "');");
                $uploaddir = '/var/www/html/images/kernelboot/' . cleanWhitespace($_POST['name']) . '/';
                shell_exec("mkdir /var/www/html/images/kernelboot/" . cleanWhitespace($_POST['name']));
                $uploadfile = $uploaddir . basename($_FILES['kernel']['name']);
                move_uploaded_file($_FILES['kernel']['tmp_name'], $uploadfile);
                $uploadfile = $uploaddir . basename($_FILES['ramdisk']['name']);
                move_uploaded_file($_FILES['ramdisk']['tmp_name'], $uploadfile);
                break;
            case "sanboot":
                queryDB_RAW("INSERT INTO sanboot (name,file) VALUES ('" . $_POST['name'] . "','" . basename($_FILES['iso']['name']) . "');");
                $uploaddir = '/var/www/html/images/iso/';
                $uploadfile = $uploaddir . basename($_FILES['iso']['name']);
                move_uploaded_file($_FILES['iso']['tmp_name'], $uploadfile);
                break;
            case "memdiskboot":
                queryDB_RAW("INSERT INTO memdiskboot (name,file) VALUES ('" . $_POST['name'] . "','" . basename($_FILES['iso']['name']) . "');");
                $uploaddir = '/var/www/html/images/iso/';
                $uploadfile = $uploaddir . basename($_FILES['iso']['name']);
                move_uploaded_file($_FILES['iso']['tmp_name'], $uploadfile);
                break;
            case "chainload":
                queryDB_RAW("INSERT INTO chainloads (name,server,file) VALUES ('" . $_POST['name'] . "','" . $_POST['server'] . "','" . $_POST['file'] . "');");
                break;
        }
        echo '<meta http-equiv="refresh" content="0; URL=/?view=images">';
        break;
    case "edit":
        switch ($_POST["imagetype"]) {
            case "kernelboot":
                shell_exec("mv /var/www/html/images/kernelboot/" . cleanWhitespace(queryDB("SELECT name FROM kernelboot WHERE id='" . $_POST['image'] . "'")['name']) . " /var/www/html/images/kernelboot/" . cleanWhitespace($_POST['name']));
                queryDB_RAW("UPDATE kernelboot SET name='" . $_POST['name'] . "',options='" . $_POST['options'] . "' WHERE id='" . $_POST['image'] . "';");
                break;
            case "sanboot":
                queryDB_RAW("UPDATE sanboot SET name='" . $_POST['name'] . "' WHERE id='" . $_POST['image'] . "';");
                break;
            case "memdiskboot":
                queryDB_RAW("UPDATE memdiskboot SET name='" . $_POST['name'] . "' WHERE id='" . $_POST['image'] . "';");
                break;
            case "chainload":
                queryDB_RAW("UPDATE chainloads SET name='" . $_POST['name'] . "',server='" . $_POST['server'] . "',file='" . $_POST['file'] . "' WHERE id='" . $_POST['image'] . "';");
                break;
        }
        echo '<meta http-equiv="refresh" content="0; URL=/?view=images">';
        break;
}
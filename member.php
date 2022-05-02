<?php

include("conf.php");
include("includes/DB.class.php");
include("includes/Member.class.php");
include("includes/Template.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();

$dataTitleForm = "Add Member";
$dataButton = "<button type='submit' name='add' class='btn btn-primary mt-3'>Add</button>";
$dataForm = "
            <div class='form-row'>
              <div class='form-group col'>
                <label for='nim'>NIM</label>
                <input type='text' class='form-control' name='nim' required />
              </div>
            </div>

            <div class='form-row'>
              <div class='form-group col'>
                <label for='nama'>Nama</label>
                <input type='text' class='form-control' name='nama' required />
              </div>
            </div>

            <div class='form-row'>
              <div class='form-group col'>
                <label for='jurusan'>Jurusan</label>
                <input type='text' class='form-control' name='jurusan' required />
              </div>
            </div>";

// jika add button ditekan
if (isset($_POST['add'])) {
    $member->insertMember($_POST);
    header("location: member.php");
}

// jika ada id_edit
if (!empty($_GET['id_edit'])) {
    $dataTitleForm = "Edit Member";
    $member->getDetailMember($_GET['id_edit']);
    list($nim, $nama, $jurusan) = $member->getResult();
    $dataForm = "
                <input type='hidden' name='nim' value='". $nim ."'>

                <div class='form-row'>
                <div class='form-group col'>
                    <label for='nama'>Nama</label>
                    <input type='text' class='form-control' name='nama' value='". $nama ."' required />
                </div>
                </div>

                <div class='form-row'>
                <div class='form-group col'>
                    <label for='jurusan'>Jurusan</label>
                    <input type='text' class='form-control' name='jurusan' value='". $jurusan ."' required />
                </div>
                </div>";
    $dataButton = "<button type='submit' name='update' class='btn btn-primary mt-3'>Update</button>";
}

// jika update button ditekan
if (isset($_POST['update'])) {
    $member->updateMember($_POST);
    header("location: member.php");
}

// jika ada id_hapus
if (!empty($_GET['id_hapus'])) {
    $nim = $_GET['id_hapus'];
    $member->deleteMember($nim);
    header("location: member.php");
}

$member->getMember();
$data = null;
while (list($nim, $nama, $jurusan) = $member->getResult()) {
    $data .= "
        <tr>
            <td>". $nim ."</td>
            <td>". $nama ."</td>
            <td>". $jurusan ."</td>
            <td>
                <a href='member.php?id_edit=" . $nim .  "' class='btn btn-warning' '>Edit</a>
                <a href='member.php?id_hapus=" . $nim . "' class='btn btn-danger' '>Hapus</a>
            </td>
        </tr>
    ";
}

$member->close();
$tpl = new Template("templates/member.html");
$tpl->replace("DATA_TITLE_FORM", $dataTitleForm);
$tpl->replace("DATA_FORM", $dataForm);
$tpl->replace("DATA_BUTTON", $dataButton);
$tpl->replace("DATA_TABEL", $data);
$tpl->write();

?>
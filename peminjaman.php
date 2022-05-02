<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Member.class.php");
include("includes/Peminjaman.class.php");

$peminjaman = new Peminjaman($db_host, $db_user, $db_pass, $db_name);
$peminjaman->open();

$buku = new Buku($db_host, $db_user, $db_pass, $db_name);
$buku->open();

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();

// jika add button ditekan
if (isset($_POST['add'])) {
    $peminjaman->insertPeminjaman($_POST);
    header("location: peminjaman.php");
}

// jika ada id_update
if (!empty($_GET['id_update'])) {
    $peminjaman->statusPeminjaman($_GET['id_update']);
    header("location: peminjaman.php");
}

// jika ada id_hapus
if (!empty($_GET['id_hapus'])) {
    $peminjaman->deletePeminjaman($_GET['id_hapus']);
    header("location: peminjaman.php");
}

$dataOptionBuku = null;
$dataOptionMember = null;
$dataPeminjaman = null;

// membuat select option untuk buku
$buku->getBuku();
while (list($id_buku, $judul, $penerbit, $deskripsi, $status, $id_author) = $buku->getResult()) {
    $dataOptionBuku .= "<option value='". $id_buku ."'>". $judul ."</option>";
}

// membuat select option untuk member
$member->getMember();
while (list($nim, $nama, $jurusan) = $member->getResult()) {
    $dataOptionMember .= "<option value='". $nim ."'>". $nama ."</option>";
}

$peminjaman->getPeminjaman();
$no = 1;
while (list($id_peminjaman, $id_buku, $id_peminjam, $status) = $peminjaman->getResult()) {
    $buku->getDetailBuku($id_buku);
    $dataBuku = $buku->getResult();

    $member->getDetailMember($id_peminjam);
    $dataMember = $member->getResult();

    if ($status == "Dipinjam") {
        $dataPeminjaman .= "
            <tr>
                <td>". $no ."</td>
                <td>". $dataBuku['judul_buku'] ."</td>
                <td>". $dataMember['nama'] ."</td>
                <td>". $status ."</td>
                <td>
                    <a href='peminjaman.php?id_update=" . $id_peminjaman .  "' class='btn btn-warning' '>Kembalikan</a>
                    <a href='peminjaman.php?id_hapus=" . $id_peminjaman . "' class='btn btn-danger' '>Hapus</a>
                </td>
            </tr>
        ";
    }else {
        $dataPeminjaman .= "
            <tr>
                <td>". $no ."</td>
                <td>". $dataBuku['judul_buku'] ."</td>
                <td>". $dataMember['nama'] ."</td>
                <td>". $status ."</td>
                <td>
                    <a href='peminjaman.php?id_hapus=" . $id_peminjaman . "' class='btn btn-danger' '>Hapus</a>
                </td>
            </tr>
        ";
    }

    $no++;
}

$buku->close();
$member->close();
$peminjaman->close();

$tpl = new Template("templates/peminjaman.html");
$tpl->replace("DATA_OPTION_BUKU", $dataOptionBuku);
$tpl->replace("DATA_OPTION_PEMINJAM", $dataOptionMember);
$tpl->replace("DATA_TABLE", $dataPeminjaman);
$tpl->write();

?>
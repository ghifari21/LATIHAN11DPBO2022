<?php

class Buku extends DB
{
    // get all buku records
    function getBuku()
    {
        $query = "SELECT * FROM buku";
        return $this->execute($query);
    }

    // get a record from buku
    function getDetailBuku($id_buku) {
        $query = "SELECT * FROM buku WHERE id_buku='$id_buku'";
        return $this->execute($query);
    }

    // insert a record
    function add($data)
    {
        $judul = $data['tjudul'];
        $penerbit = $data['tpenerbit'];
        $deskripsi = $data['tdeskripsi'];
        $status = "-";
        $author = $data['cmbauthor'];

        $query = "insert into buku values ('', '$judul', '$penerbit', '$deskripsi', '$status', '$author')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // delete a record
    function delete($id)
    {

        $query = "delete FROM buku WHERE id_buku = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // change status of buku
    function statusBuku($id)
    {

        $status = "Best Seller";
        $query = "update buku set status = '$status' where id_buku = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}


?>
<?php

class Peminjaman extends DB {
    // get all records from peminjaman
    function getPeminjaman() {
        $query = "SELECT * FROM Peminjaman";
        return $this->execute($query);
    }

    // insert a record
    function insertPeminjaman($data) {
        $id_buku = $data['buku'];
        $id_peminjam = $data['peminjam'];
        $status = "Dipinjam";

        $query = "INSERT INTO peminjaman VALUES (null, '$id_buku', '$id_peminjam', '$status')";
        return $this->execute($query);
    }

    // change status
    function statusPeminjaman($id_peminjaman) {
        $status = "Dikembalikan";

        $query = "UPDATE peminjaman SET status='$status' WHERE id_peminjaman='$id_peminjaman'";
        return $this->execute($query);
    }

    // delete a record
    function deletePeminjaman($id_peminjaman) {
        $query = "DELETE FROM peminjaman WHERE id_peminjaman='$id_peminjaman'";
        return $this->execute($query);
    }
}

?>
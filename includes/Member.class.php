<?php

class Member extends DB {
    // get all records from member
    function getMember() {
        $query = "SELECT * FROM member";
        return $this->execute($query);        
    }

    // get a record from member
    function getDetailMember($nim) {
        $query = "SELECT * FROM member WHERE nim='$nim'";
        return $this->execute($query);  
    }

    // insert a record
    function insertMember($data) {
        $nim = $data['nim'];
        $jurusan = $data['jurusan'];
        $nama = $data['nama'];

        $query = "INSERT INTO member VALUES ('$nim', '$nama', '$jurusan')";
        return $this->execute($query);
    }

    // update a record
    function updateMember($data) {
        $nim = $data['nim'];
        $jurusan = $data['jurusan'];
        $nama = $data['nama'];

        $query = "UPDATE member SET nama='$nama', jurusan='$jurusan' WHERE nim='$nim'";
        return $this->execute($query);
    }

    // delete a record
    function deleteMember($nim) {
        $query = "DELETE FROM member WHERE nim='$nim'";
        return $this->execute($query);
    }
}

?>
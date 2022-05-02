<?php

class Author extends DB
{
    // get all author records
    function getAuthor()
    {
        $query = "SELECT * FROM author";
        return $this->execute($query);
    }

    // insert an author record
    function add($data)
    {
        $name = $data['tname'];

        $query = "insert into author values ('', '$name', 'Pendatang Baru')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // delete an author record
    function delete($id)
    {

        $query = "delete FROM author WHERE id_author = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // change status of author
    function statusAuthor($id)
    {

        $status = "Senior";
        $query = "update author set status = '$status' where id_author = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}

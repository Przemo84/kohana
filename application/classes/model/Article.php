<?php

class Article extends Model_Database
{
    public function listAll()
    {
        // Get stuff from the database:
        return $this->db->query(...);
    }
}
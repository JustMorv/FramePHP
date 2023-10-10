<?php

namespace applications\models;

use applications\core\Model;

class Main extends Model
{
    public function getNews()
    {
        $result = $this->db->row("SELECT title, descText FROM news");
        return $result;
    }

}
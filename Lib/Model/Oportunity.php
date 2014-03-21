<?php

class Oportunity extends Model {

    public function __construct($con = 0) {
        parent::__construct($con);
        $this->tableName = "oportunidade";
    }

}

?>

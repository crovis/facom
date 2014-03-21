<?php

class Configure extends Model {

    public function __construct($con = 0) {
        parent::__construct($con);
        $this->tableName = "_simple";
    }

}

?>

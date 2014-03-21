<?php

/**
 *  Classe  Model
 *  Responsável por gerenciar e criar um DAO( Data Access Object ) do banco de dados.
 */

class Model {

    private $db;
    
    protected $belongsTo;
    
    protected $tableName;

    public function __construct($con = 0) {
        $this->db = Database::singleton($con);
        $this->belongsTo = 0;
        $this->tableName = get_class($this);
    }

    /**
     * Método que busca uma tupla da tabela dado um ID.
     * 
     * @param int $id
     * @return array
     */
    public function findById($id = 0) {
        if ($id != 0 && $id != null) {
            $findId = 'SELECT * FROM ' . $this->tableName . ' WHERE id = ' . $id;
            try {
                $stm = $this->db->getConexao()->prepare($findId);
                $stm->execute();
                $result = array();
                $result = $stm->fetchAll();
                $return[$this->tableName] = $result[0];
                if($this->belongsTo)
                {
                    if(is_array($this->belongsTo))
                    {
                        
                        foreach($this->belongsTo as $key => $value):
                            $model = new $value['class']();
                            $resultm = $model->findById($result[0][$value['fkey']]);
                            $return[$key] = $resultm[get_class($model)];
                        endforeach;
                    }
                }
                return $return;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    /**
     * Método que busca todas tuplas tendo como condição o parametro $param
     * @param array $param
     * $param['condition'] condições do WHERE do SQL arranjado com conjunções AND
     * $param['order'] colunas tal que as tuplas devem ser organizadas
     * $param['orderCondition'] ASC ou DESC as tuplas devem ser organizadas
     * $param['limit'] número máximo de tuplas que deverá buscar
     * @return array 
     */
    public function find($param = 0) {
        $where = '';
        $order = '';
        $limit = '';
        $orderCondition = '';
        $select = '';
        $i = 0;

        if ($param) {
            if (array_key_exists('condition', $param)) {

                $where = '';
                $i = sizeof($param['condition']);
                foreach ($param['condition'] as $key => $value) {
                    if($value != null)
                        $where .= $key . ' = \'' . $value.'\'';
                    else
                        $where .= $key;
                    $i--;
                    if ($i != 0) {
                        $where .= ' AND ';
                    }
                }
            }

            if (array_key_exists('order', $param)) {
                $order = '';
                $i = sizeof($param['order']);
                foreach ($param['order'] as $value) {
                    $order .= $value;
                    $i--;
                    if ($i != 0) {
                        $order .= ', ';
                    }
                }
                if (array_key_exists('orderCondition', $param)) {
                    $orderCondition = ' ' . $param['orderCondition'] . ' ';
                }
                else
                    $orderCondition = ' ASC';
            }
            if (array_key_exists('limit', $param)) {
                $limit = 'LIMIT ' . $param['limit'];
            }
        }
        if ($where != '')
            $select = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $where . ' ORDER BY ' . $order . $orderCondition . ' ' . $limit;
        else
            $select = 'SELECT * FROM ' . $this->tableName . ' ORDER BY ' . $order . $orderCondition . ' ' . $limit;

        try {
            $stm = $this->db->getConexao()->prepare($select);
            $stm->execute();
            $result = array();
            $result = $stm->fetchAll();
            $return = array();
            for($i = 0; $i < sizeof($result); $i++)
            {
                $return[$i][$this->tableName] = $result[$i];
                
                if($this->belongsTo)
                {
                    if(is_array($this->belongsTo))
                    {
                        
                        foreach($this->belongsTo as $key => $value):
                            $model = new $value['class']();
                            $resultm = $model->findById($result[$i][$value['fkey']]);
                            $return[$i][$key] = $resultm[get_class($model)];
                        endforeach;
                    }
                }
            }
            return $return;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     *Método utilizado para salvar ou dar update em alguma tupla.
     * @param int $id chave da tupla que deve ser atualizada - se for zero, os dados são inseridos
     * @param array $data dados para serem salvos ou inseridos
     * @return boolean 
     */
    public function save($id = 0, $data) {
        if ($id) 
            {
            $update = '';
            $insertBD = '';
            $condition = '';
            $subject = '';
            $insertBD = 'SELECT * FROM ' . $this->tableName . ' WHERE id = ' . $id;
            $stm = $this->db->getConexao()->prepare($insertBD);
            $stm->execute();
            if ($stm->rowCount()) {

                $i = sizeof($data);
                foreach ($data as $key => $value) {
                    $condition .= $key .  " = '" . $value ."'";
                    $i--;
                    if ($i != 0) {
                        $condition .= ', ';
                    }
                }
                $update = 'UPDATE ' . $this->tableName . ' SET ' . $condition . ' WHERE id = ' . $id;
                $stm = $this->db->getConexao()->prepare($update);
                return $stm->execute();
            } 
        }
        else {
                $condition = "";
                $subject = "";
                $i = sizeof($data);
                foreach ($data as $key => $value) {
                    $condition .= $key;
                    $subject .= "'".$value."'";
                    $i--;
                    if ($i != 0) {
                        $condition .= ', ';
                        $subject .= ', ';
                    }
                }
                
                $insertBD = 'INSERT INTO ' . $this->tableName . '( ' . $condition . ') VALUES ' . '( ' . $subject . ')';
                try {
                    $stm = $this->db->getConexao()->prepare($insertBD);
                    return $stm->execute();
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
    }

    public function delete($id = 0) {
        if ($id) {
            $delete = '';
            $delete = 'DELETE FROM ' . $this->tableName . ' WHERE id = ' . $id;

            try {
               $stm = $this->db->getConexao()->prepare($delete);
               return $stm->execute();
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

}

?>

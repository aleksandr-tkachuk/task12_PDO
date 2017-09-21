<?php
class Sql extends PDO{

    protected $where;

        public function __construct($config){

            $dns = $config['driver'] .
            ':host=' . $config['host'] .
            ((!empty($config['port'])) ? (';port=' . $config['port']) : '') .
            ';dbname=' . $config['dbname'] .
            ((!empty($config['charset'])) ? (';charset=' . $config['charset']) : '');
            var_dump($dns);
            var_dump($config);
        parent::__construct($dns, $config['username'], $config['password']);
	}

    public function select($str) {
        $this->select = $str;
        return $this;
    }

    public function delete() {
        $this->delete = true;
        return $this;
    }

    public function from($str) {
        $this->from = $str;
        return $this;
    }

    public function where($where) {
        $this->where = $where;
        return $this;
    }

    public function insert($arrayFields, $arrayValues) {
        $fields = implode(',', $arrayFields);
        $values = "'" . implode("','", $arrayValues) . "'";
        $this->insert = '(' . $fields . ') values (' . $values . ')';

        return $this;
    }

    public function update($arrayFields, $arrayValues) {
        $fields = "";
        for ($i = 0; $i < count($arrayFields); $i++) {
            if (strlen($fields) != 0) {
                $fields .= ',';
            }
            $fields .= $arrayFields[$i] . " = '" . $arrayValues[$i] . "'";
        }
        $this->update = $fields;
        return $this;
    }

    public function exec() {
        if (empty($this->from)) {
            throw new Exception("not set");
        }
        if ($this->delete) {
            $this->query = "delete from {$this->from}";
            if(sizeof($this->where) != 0){
                $this->query .= " where ".$this->where[0];
                $sqlParams = array_slice($this->where, 1);
            }
            $sth = $this->prepare($this->query);
            $res = $sth->execute($sqlParams);
        } elseif (!empty($this->insert)) {
            $this->query = "insert into {$this->from} $this->insert";
            $res = parent::exec($this->query);
        } elseif (!empty($this->update)) {
            $this->query = "update  {$this->from} set $this->update";
            if(sizeof($this->where) != 0){
                $this->query .= " where ".$this->where[0];
                $sqlParams = array_slice($this->where, 1);
            }
            $sth = $this->prepare($this->query);
            $res = $sth->execute($sqlParams);
        } else {
            if (empty($this->select)) {
                throw new Exception("not select set");
            }
            $sqlParams = [];
            $this->query = "select {$this->select} from {$this->from}";
            if(sizeof($this->where) != 0){
                $this->query .= " where ".$this->where[0];
                $sqlParams = array_slice($this->where, 1);
            }
            $sth = $this->prepare($this->query);
            $sth->execute($sqlParams);
            $res = $sth->fetchAll();
        }
        return $res;
    }

    public function getQuery()
    {
        return $this->query;
    }
}


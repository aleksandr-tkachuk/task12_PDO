<?php
class Sql extends PDO{

    protected $where;

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

}


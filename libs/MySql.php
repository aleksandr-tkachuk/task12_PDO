<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 03.10.2017
 * Time: 13:31
 */

class MySql extends Sql
{

    protected function connect() {
        $this->dbh = mysql_connect(
            $this->host, $this->userName, $this->password);
        $dbConnect = mysql_select_db($this->dbName, $this->dbh);
        if (!$dbConnect) {
            throw new Exception('Failed to select base' . $this->dbName . ': ' . mysql_error());
        }
    }

    public function exec() {
        parent::exec();
        $res = mysql_query($this->query, $this->dbh);

        return (!empty($this->select)) ? mysql_fetch_array($res) : $res;
    }
}
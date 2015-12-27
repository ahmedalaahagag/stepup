<?php
/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/25/2015
 * Time: 6:14 PM
 */

if (!file_exists('config.php')) {
    throw new Exception("config file not found");
} else {
    require_once('config.php');
}

class db
{
    private $con;

    function __construct()
    {

        try {
            $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $this->con = $con;
        } catch (Exception $e) {
            echo "Message : " . $e->getMessage() . "<br>";
            echo "Code : " . $e->getCode();
        }
    }


    public function delete($where = 1, $table)
    {
        $query = "DELETE FROM `$table` WHERE $where";
        mysqli_query($this->con, $query);
        if(mysqli_affected_rows($this->con)>0)
        {
            return 1;
        }
        else
        {
            echo "Error deleting your data '" . $this->con->error . " '";
            exit;
        }
    }

    public function save($data, $table, $id = 0)
    {
        if ($table && $data) {
            if ($id == 0) {
                // Insert New
                if (is_array($data)) {
                    foreach ($data as $dataItem) {

                        $result = $this->saveItem($dataItem, $table);
                    }
                } else {
                    if (is_array($data)) {
                        $data = $data[0];
                    }
                    $this->saveItem($data, $table);
                }
            } else {
                // Update with ID
                //TODO: Implement This
                echo "Hey ! Implement This";
            }
            return 1;

        }
        echo "Error saving your data '" . $this->con->error . " '";
        exit;
    }

    public function get($where = 1, $table)
    {
        $query = "SELECT * FROM `$table` WHERE $where";
        $data = mysqli_query($this->con, $query);
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $dataArray[] = $row;
            }
            if ($dataArray) {
                return $dataArray;
            }
        } else {
            echo "Error fetching your data '" . $this->con->error . " '";
            exit;
        }

    }

    public function count ($where = 1, $table){
        $query = "SELECT * FROM `$table` WHERE $where";
        $data = mysqli_query($this->con, $query);
        return $data->num_rows;
    }

    private function saveItem($dataItem, $table)
    {

        $query = "INSERT INTO `$table` ";
        foreach ($dataItem as $key => $value) {
            $keys[] = "`" . $key . "`";
            $values[] = "'" . $value . "'";
        }
        $keys = implode(',', $keys);
        $values = implode(',', $values);
        $query .= "(" . $keys . ") VALUES (" . $values . ")";
        $success = mysqli_query($this->con, $query);
        if ($success) {
            return 1;
        } else {
            echo "Error saving your data '" . $this->con->error . " '";
            exit;
        }

    }


}
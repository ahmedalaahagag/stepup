<?php
/**
 * Created by PhpStorm.
 * User: AhmedAlaaHagag
 * Date: 12/25/2015
 * Time: 6:14 PM
 */

if (!file_exists('config.php' )){
    throw new Exception("config file not found");
}else{
    require_once('config.php');
}

class db
{
  private $con;
  function __construct()
  {

    try{
        $con =   mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
        $this->con = $con;
    }
    catch (Exception $e){
        echo "Message : " . $e->getMessage() ."<br>";
        echo "Code : " . $e->getCode();
    }
  }
    //TODO: Implement This
    public function delete($id){
        ;
    }
    public function save($data,$table,$id=0){
     if($table && $data){
        if($id==0){
            // Insert New
                if(is_array($data)){
                    foreach($data as $dataItem){
                        if(is_array($dataItem))
                        {$dataItem=$dataItem[0];}
                        $result = $this->saveItem($dataItem,$table);
                    }
                }
                else{
                        if(is_array($data))
                        {$data=$data[0];}
                        $this->saveItem($data,$table);
                }
            }
            else{
                // Update with ID //TODO: Implement This
                $this->updateItem($data,$table,$id);
            }
         return 1;

        }
    return 0;
    }

    public function get($where){
        ;
    }
    private function saveItem($dataItem,$table){
        $query = "INSERT INTO `$table` ";
        foreach($dataItem as $key => $value){
            $keys[] ="`".$key."`";
            $values[]="'".$value."'";
        }
        $keys = implode(',',$keys);
        $values = implode(',',$values);
        $query.="(".$keys.") VALUES (".$values.")";
        $success = mysqli_query($this->con,$query);
        if($success){
            return 1;
        }
        else{
            echo "Error saving your data '" . $this->con->error ." '";
            exit;
        }
    }

}
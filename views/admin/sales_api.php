<?php
include_once('../../db/connection.php');
class Sales extends Database{
    public function __construct(){
        parent::__construct();
    }
    public function viewSales(){
        try{
            $query = "SELECT * FROM `view_monthly_sales`";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get sales");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
}
if(isset($_GET)){
    
    $sales = new Sales();
    $responseData = $sales->viewSales();
    
    header('Content-Type: application/json');
    echo json_encode($responseData);

    //
}
?>

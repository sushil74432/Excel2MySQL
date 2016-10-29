<?php
include_once 'db.php';
include_once "utils.php";

//  Include PHPExcel_IOFactory
include 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

$inputFileName = 'example1.xlsx';

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
$rowDataTypes = $sheet->rangeToArray('A2:' . $highestColumn .'2',NULL,TRUE,FALSE); //is used to determine data type of column by getting data type of second row.
//  Loop through each row of the worksheet in turn
$rowCount = 0; //used to determine count of row(row number)
$columnNames = array();
$query = "CREATE TABLE IF NOT EXISTS example(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
    $size = sizeof($rowData[0]);
    for($x = 0; $x < $size; $x++) {
        if($rowCount == 0){
            $query .= ",".$rowData[0][$x]." ".phpToSqlEquivalent(gettype($rowDataTypes[0][$x]));
            array_push($columnNames,$rowData[0][$x]);

        } 
        else{
            
        }

        $flag = ($size-1);
        if ($x== $flag) {
                $rowCount++;
        }
    }
    if ($rowCount == 1) {
            $query .= ");"; 
            // echo $query;
            if ($conn->query($query) === TRUE) {
                // echo "New table created successfully";
            } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
            }
    } else{
        $sql = "INSERT INTO example(".implode(",",$columnNames).") VALUES ('".implode("','", $rowData[0])."')";
            if ($conn->query($sql) === TRUE) {
                // echo "New record created successfully";
            } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
}
// $conn->close();

?>
<?php 
/**Convert PHP data type to SQL equivalent data type and pass it wlongwith value*/
function phpToSqlEquivalent($dataType){
    switch ($dataType) {
        case 'string':
            return "varchar(100)";
            break;

        case 'double':
            return "double";
            break;
        
        default:
            return $datatype."(100)";
            break;
    }
}
?>
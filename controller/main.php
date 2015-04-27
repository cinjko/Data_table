<?php
/**
 * Created by PhpStorm.
 * User: cinjko
 * Date: 3/26/2015
 * Time: 9:05 PM
 */

class Main
{
    function __construct(){

        if(isset($_POST['submit'])) {
            $recordId = $_POST['number'];

            if(!empty($recordId)){
                $this->delSelData($recordId);
            }
        }

        if(isset($_POST['default'])  ){
            $this->copyPast();
            header("Location: index.php");
        }
    }

    public function getData()    {
        $file = fopen("data/test.csv", "r");

        while(!feof($file)){
            $dataCsv[] = fgetcsv($file);
        }

        fclose($file);
        return $dataCsv;
    }

    function delSelData($recordId){
        $dataArray = $this->getData();

        foreach($dataArray as $key=>$data){
               if(is_string($data[0])){
                   $dataArrayCsv[$data[0]] = $data;
               }
        }

        ini_set("auto_detect_line_endings", false);
        $flipRecordId = array_flip($recordId);
        $diffArrayCsv = array_diff_key($dataArrayCsv, $flipRecordId);

        $fp = fopen("data/test.csv", "w");
        if(!$fp){
            echo "Не можливо відкрити файл!!";
        }

        foreach($diffArrayCsv as $fild) {
            if($fild !== NULL)
            $putDataCsv = fputcsv($fp, $fild);
        }

        fclose($fp);
        header("Location: index.php");
    }

    function copyPast(){
        $file = fopen("data/data_file.csv", "r");

        while(!feof($file)){
            $dataCsv[] = fgetcsv($file);
        }

        fclose($file);

        $file = fopen("data/test.csv", "w");

        foreach($dataCsv as $data){
            fputcsv($file, $data);
        }

    }

}


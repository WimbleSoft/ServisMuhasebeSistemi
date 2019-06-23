<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<?php
session_start(); 
if(!isset($_SESSION["login"])){
echo '<meta http-equiv="refresh" content="0;URL=giris.php">';
} else
{
	include("kontrol/veritabani.php");
	$DB_TBLName = $_POST['tabloadi'];
	$filename = $_POST['tabloadi']; 
	$result = $connection->prepare("select * from $DB_TBLName");
	$result->execute();
	$file_ending = "xls";

	$sep = "\t";
		$csv_fields = array();
		$csv_fields[] = 'ID';
		$csv_fields[] = 'TARİH';
		$csv_fields[] = 'İŞ EMRİ';
		$csv_fields[] = 'GELİ';
		$csv_fields[] = 'IMEI';
		$csv_fields[] = 'MODEL';
		$csv_fields[] = 'M. AD';
		$csv_fields[] = 'M. SOYAD';
		$csv_fields[] = 'TELEFON';
		$csv_fields[] = 'ÜCRET';
		$csv_fields[] = 'ÖDEME';
		$csv_fields[] = 'AÇIKLAMA';
		$csv_fields[] = 'GELİRGİDER';
		
	for($i=0;$i<13;$i++)
	{
	echo $csv_fields[$i].$sep;
	}
	print "\n";
	while($row = $result->fetch(PDO::FETCH_NUM))
    {
        $schema_insert = "";
        for($j=0; $j<$result->columnCount();$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
		
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=$filename.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
} 

?>


<?
ini_set("display_errors",1);
require_once 'excel_reader.php';
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
$dbObj = new DBConnection(); // database connection
/*$db_host = 'localhost'; 
$db_user = 'epropvalue'; 
$db_pass = 'epropvalue'; 
$db_name = 'epropvalue';


$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if ($con->connect_error)
{
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}*/

$excel = new PhpExcelReader; // creates object instance of the class
$excel->read('data.xls'); // reads and stores the excel file data

// Test to see the excel data stored in $sheets property
/*echo '<pre>';
var_export($excel->sheets);
echo '</pre>';*/


echo "Total Sheets in this xls file: ".count((array)$excel->sheets)."<br /><br />";
 
$html="<table border='1'>";

for($i=0;$i<count((array)$excel->sheets);$i++) // Loop to get all sheets in a file.
{	


	if(count((array)$excel->sheets[$i][CELLS])>0) // checking sheet not empty
	{
		
		echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count((array)$excel->sheets[$i][CELLS])."<br />";
		for($j=1;$j<=count((array)$excel->sheets[$i][CELLS]);$j++) // loop used to get each row of the sheet
		{ 
			$html.="<tr>";
			for($k=1;$k<=count((array)$excel->sheets[$i][CELLS][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$excel->sheets[$i][CELLS][$j][$k];
				$html.="</td>";
			}
			$id = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]);
			$name = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][2]);
			$email = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][3]);
			$dob = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][4]);
			$mobile = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][5]);
			$query = "insert into epro_price_list(id,name,email,dob,mobile) values('".$id."','".$name."','".$email."','".$dob."','".$mobile."')";
 
			mysqli_query($dbObj->connection, $query);
			$html.="</tr>";
		}
	}
 
}
 
$html.="</table>";
echo $html;
echo "<br />Data Inserted in dababase";

?>

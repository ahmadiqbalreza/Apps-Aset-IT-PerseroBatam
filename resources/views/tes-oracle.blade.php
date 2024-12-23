<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$username = "C##ASET_IT";                  // Use your username
$password = "PB2024";             // and your password
$database = "localhost:1521/orcl";   // and the connect string to connect to your database

$query = "SELECT * FROM DATA_ASET";

$c = oci_connect($username, $password, $database);
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}

$s = oci_parse($c, $query);
if (!$s) {
    $m = oci_error($c);
    trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
}
$r = oci_execute($s);
if (!$r) {
    $m = oci_error($s);
    trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
}

echo "<table border='1'-->\n";
$ncols = oci_num_fields($s);
echo json_encode($r);
echo "<br>";
for ($i = 1; $i <= $ncols; ++$i) {
   $colname = oci_field_name($s, $i);
   echo "  <b>".htmlspecialchars($colname,ENT_QUOTES|ENT_SUBSTITUTE)."</b><br>";
}
echo "<br>";

while (($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    var_dump($row);
    echo "<br>";
	$data = array(
		'NO_INVENTARIS'=>$row['NO_INVENTARIS'],
		'TAHUN'=>$row['TAHUN'],
		'JENIS'=>$row['JENIS'],
		'MERK'=>$row['MERK'],
		'PENGGUNA'=>$row['PENGGUNA'],
		'UNIT'=>$row['UNIT'],
		'STATUS'=>$row['STATUS'],
	);
	echo json_encode($data);
    foreach ($row as $item) {
        echo "";
        echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):" ";
        echo "<br>";
    }
    echo "<br>";
}
echo "<br>";

?>
<?php
$search_param = $_POST['search'];
$search_area =$_POST["area"];
//setting parameters for connection
//append dbuser, dbname, dbpass
if(isset($_POST["search"]) && isset($_POST["area"])){
$host ="localhost";
$dbuser ="";
$dbname ="";
$dbpass = "";

$conn = new mysqli($host,$dbuser,$dbpass,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
echo "Connected successfully";

$sql = "SELECT * FROM doctors WHERE DoctorCity like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["DoctorImage"];

        $doctor_data["DocName"] =$doctorname;
        $doctor_data["DocInfo"] =$doctorinfo;
        $doctor_data["DocImage"] =$doctorimage;
        $data[$doctorid]=$doctor_data;
    }
    $data["Result"]="True";
    $data["Message"]="Doctors Fetched";

}
else{
    $data["Result"]="False";
    $data["Message"]="No Doctors Fetched";

}


}
else{
    $data["Result"]="False";
    $data["Message"]="Bad Query";

}
echo json_encode($data,JSON_UNESCAPED_SLASHES);
?>

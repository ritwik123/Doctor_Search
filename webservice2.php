<?php
$search_param = $_POST['search'];
$search_area =$_POST["area"];
//setting parameters for connection
$doctor_data="";
if(isset($_POST["search"]) && isset($_POST["area"])){
$host ="localhost";
$dbuser ="";
$dbname ="";
$dbpass = "";

$conn = new mysqli($host,$dbuser,$dbpass,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
//echo "Connected successfully";

$sql = "SELECT * FROM doctors WHERE DoctorCity like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";
$result = $conn->query($sql);
if($result->num_rows> 0){
    $data = '<div class="services-we-provide2">Doctors found in your city</div>';
    
    while($row=$result->fetch_assoc()){
        
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["DoctorImage"];

        $doctor_data = $doctor_data.'<div class="finddocs2 zoom2">
        <div style="top:280px;" class="find-the-best2">'.$doctorinfo.'</div>
        <div class="find-doctors">'.$doctorname.'</div>
        <img class="finddocs-child" alt="" src="'.$doctorimage.'" />
        </div>';

    }

}
else{
    $data='<div class="services-we-provide2">No doctors found in your area</div>';
}


}
else{
    $data='<div class="services-we-provide2">Bad query</div>';

}

$data = $data.$doctor_data;
echo $data;
?>

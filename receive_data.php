<?php
include('../config/db.php');

$patient_id = $_POST['patient_id'] ?? $_GET['patient_id'];
$heart_rate = $_POST['heart_rate'] ?? $_GET['heart_rate'];
$temp = $_POST['temperature'] ?? $_GET['temperature'];

$sql = "INSERT INTO health_info (patient_id, heart_rate, temperature)
        VALUES ('$patient_id', '$heart_rate', '$temp')";

if ($conn->query($sql)) {

    echo "Data inserted successfully";

    // ALERT CONDITION
    if ($heart_rate > 120 || $temp > 38) {

        $to = "igizenezaprince420@gmail.com";
        $subject = "Emergency Health Alert";

        $message = "
        Patient ID: $patient_id
        
        Heart Rate: $heart_rate bpm
        Temperature: $temp °C
        
        Immediate attention needed!
        ";

        mail($to, $subject, $message);

        echo "<br>Email Alert Sent!";
    }

} else {
    echo "Database Error";
}
?>
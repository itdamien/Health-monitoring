<?php
include('db.php');

$sql = "SELECT * FROM health_info ORDER BY created_at DESC LIMIT 20";
$result = $conn->query($sql);

$data = [];
$time = [];
$heart = [];

while($row = $result->fetch_assoc()) {
    $time[] = $row['created_at'];
    $heart[] = $row['heart_rate'];
}

echo json_encode([
    "time" => array_reverse($time),
    "heart_rate" => array_reverse($heart)
]);
?>

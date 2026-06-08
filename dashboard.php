<link rel="stylesheet" href="../assets/css/style.css">

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include('../config/db.php');

// Latest reading
$sql = "SELECT * FROM health_info ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<h1>Health Monitoring Dashboard</h1>

<?php
if ($data) {
?>
    <div class="card">
        <h2 class="heart">❤️ <?php echo $data['heart_rate']; ?> BPM</h2>
        <h2 class="temp">🌡 <?php echo $data['temperature']; ?> °C</h2>
    </div>

<?php
} else {
?>
    <div class="card">
        <h2>No Data Available</h2>
        <p>Waiting for sensor data...</p>
    </div>
<?php
}
?>



<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="logout-container">
    <a href="../auth/logout.php" class="logout-btn">Logout</a>
</div>
<script>
fetch('../api/get_data.php')
.then(res => res.json())
.then(data => {
    new Chart(document.getElementById('chart'), {
        type: 'line',
        data: {
            labels: data.time,
            datasets: [{
                label: 'Heart Rate',
                data: data.heart_rate
            }]
        }
    });
});
</script>
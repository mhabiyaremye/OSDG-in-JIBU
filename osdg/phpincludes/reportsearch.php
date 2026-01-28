<?php
$search_query = "";
if (isset($_POST['search'])) {
$search_query = mysqli_real_escape_string($conn, $_POST['search']);
}
$sql = "SELECT * FROM qualityrecords WHERE tester_name LIKE '%$search_query%' OR contamination_status LIKE '%$search_query%' OR compliance_status LIKE '%$search_query%' OR remarks LIKE '%$search_query%'";
$result = mysqli_query($conn, $sql);

$total_records = mysqli_num_rows($result);
$safe_count = 0;
$issue_count = 0;

while ($row = mysqli_fetch_assoc($result)) {
if ($row['pH_level'] >= 6.5 && $row['pH_level'] <= 8.5 && $row['turbidity'] <= 5 && $row['tds'] <= 500) {
$safe_count++;
} else {
$issue_count++;
}
}
$result = mysqli_query($conn, $sql);
?>
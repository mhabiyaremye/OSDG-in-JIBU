<?php
$query_latest = "SELECT * FROM qualityrecords ORDER BY test_date DESC LIMIT 1";
$result_latest = mysqli_query($conn, $query_latest);
$latest = mysqli_fetch_assoc($result_latest);

$test_date = $latest['test_date'] ?? 'N/A';
$tester = $latest['tester_name'] ?? 'N/A';
$ph_level = $latest['pH_level'] ?? 'N/A';
$turbidity = $latest['turbidity'] ?? 'N/A';
$contamination_status = $latest['contamination_status'] ?? 'N/A';
$temperature = $latest['temperature'] ?? 'N/A';
$tds = $latest['tds'] ?? 'N/A';
$chemical_composition = $latest['chemical_composition'] ?? 'N/A';
$compliance_status = $latest['compliance_status'] ?? 'N/A';
$remarks = $latest['remarks'] ?? 'N/A';
$quantity_tested = $latest['quantity_tested'] ?? 'N/A';
// Check water quality compliance
$pH_status = ($ph_level >= 6.5 && $ph_level <= 8.5) ? "Safe" : "Unsafe";
$turbidity_status = ($turbidity <= 5) ? "Safe" : "Unsafe";
$temperature_status = ($temperature < 35) ? "Normal" : "High";
$tds_status = ($tds <= 500) ? "Acceptable" : "Too High";

$query_all = "SELECT * FROM qualityrecords ORDER BY test_date DESC";
$result_all = mysqli_query($conn, $query_all);
?>
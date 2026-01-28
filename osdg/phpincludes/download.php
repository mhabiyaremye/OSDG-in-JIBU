<?php
// Include your database connection here (make sure $connection is defined)
include('connection.php');
 // Adjust the path if needed

// Set headers to indicate CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="water_quality_report.csv"');

// Open a file in PHP output stream
$output = fopen('php://output', 'w');

// Output the column headers
fputcsv($output, ['test_date','tester_name', 'pH_level', 'turbidity', 'contamination_status', 'temperature', 'tds', 'chemical_composition', 'compliance_status', 'remarks']);

// Query the database to get the data (replace 'water_quality_records' with your actual table name)
$query = "SELECT * FROM qualityrecords";  // Adjust to your actual table and fields
$result = mysqli_query($conn, $query);

// Fetch the data and write it to the CSV file
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['test_date'],
        $row['tester_name'],
        $row['pH_level'],
        $row['turbidity'],
        $row['contamination_status'],
        $row['temperature'],
        $row['tds'],
        $row['chemical_composition'],
        $row['compliance_status'],
        $row['remarks']
    ]);
}

// Close the file
fclose($output);
exit;
?>

<?php
include 'phpincludes/reportsearch.php';
?>
<section class="p-5">
<div class="text-center mb-4">
<h2>Water Quality Report</h2>
</div>
<form method="POST" class="mb-3 d-flex gap-2 hidden-print">
<input type="text" name="search" class="form-control" placeholder="Search water records..." value="<?php echo $search_query; ?>">
<button type="submit" class="btn btn-primary">Search</button>
</form>
<div class="mb-3">
<h5>Total Records: <?php echo $total_records; ?></h5>
<h5>Safe Water Reports: <?php echo $safe_count; ?></h5>
<h5>Issue Reports: <?php echo $issue_count; ?></h5>
<h5>Report for: <?php echo date('d-m-Y H:i:s'); ?></h5>
</div>
<button class="btn btn-secondary mb-3 hidden-print" onclick="printReport()">Print Report</button>
<button class="btn btn-success mb-3 hidden-print" onclick="downloadCSV()">Download Report (CSV)</button>
<table class="table table-bordered table-striped text-center">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Date</th>
<th>pH Level</th>
<th>Turbidity (NTU)</th>
<th>Contamination Status</th>
<th>Temperature (°C)</th>
<th>Total Dissolved Solids (ppm)</th>
<th>Chemical Composition</th>
<th>Compliance Status</th>
<th>Remarks</th>
<th>Quality Analysis</th>
</tr>
</thead>
<tbody>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo htmlspecialchars($row['created_at']); ?></td>
<td><?php echo $row['pH_level']; ?> <?php echo ($row['pH_level'] < 6.5 || $row['pH_level'] > 8.5) ? '<span class="text-danger">⚠️</span>' : ''; ?></td>
<td><?php echo $row['turbidity']; ?> <?php echo ($row['turbidity'] > 5) ? '<span class="text-danger">⚠️</span>' : ''; ?></td>
<td><?php echo $row['contamination_status']; ?></td>
<td><?php echo $row['temperature']; ?></td>
<td><?php echo $row['tds']; ?> <?php echo ($row['tds'] > 500) ? '<span class="text-danger">⚠️</span>' : ''; ?></td>
<td><?php echo $row['chemical_composition']; ?></td>
<td><?php echo $row['compliance_status']; ?></td>
<td><?php echo $row['remarks']; ?></td>
<td>
<?php echo ($row['pH_level'] >= 6.5 && $row['pH_level'] <= 8.5 && $row['turbidity'] <= 5 && $row['tds'] <= 500) ? '<span class="text-success">Safe ✅</span>' : '<span class="text-danger">Issue ⚠️</span>'; ?>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<?php
if (isset($_SESSION['user_id'])) 
{
?>
Printed by: <?php echo htmlspecialchars($user_name); ?>
<?php
}
?>
</section>
<script>
function printReport() {
window.print();
}
function downloadCSV() {
    // Trigger the download by submitting a form to download.php
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'phpincludes/download.php'; // Path to your PHP download handler

    // Add a hidden input to trigger the CSV download
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'download_csv';  // The name of the POST variable expected in download.php
    form.appendChild(input);

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);  // Remove the form after submitting it
}
</script>

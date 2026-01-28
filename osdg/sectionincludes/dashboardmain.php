<?php
include 'phpincludes/dashboardmain.php';
?>
<body bgcolor="red"/>
<section class="service_section layout_padding">
<div class="container">
<div class="heading_container heading_center">
<h2>Water Quality Dashboard</h2>
</div>
<div class="row">
<div class="col-md-4">
<div class="box">
<div class="img-box">
<img src="images/s1.png" alt="Basic Info" />
</div>
<div class="detail-box">
<h5>Basic Test Information</h5>
<p>Details of the latest water quality test.</p><hr>
<h6><b>Test Date: <span class="stat-value"><?php echo $test_date; ?></span></b></h6>
<h6><b>Tester Name: <span class="stat-value"><?php echo $tester; ?></span></b></h6>
<h6><b>Quantity Tested: <span class="stat-value"><?php echo $quantity_tested; ?> L</span></b></h6><br><br>
</div>
</div>
</div>

<!-- Column 2: Water Quality Data -->
<div class="col-md-4">
<div class="box">
<div class="img-box">
<img src="images/s2.png" alt="Water Quality" />
</div>
<div class="detail-box">
<h5>Water Quality Metrics</h5>
<p>Key water quality parameters measured.</p><hr>
<h6><b>pH Level: <span class="stat-value" style="color: <?php echo ($pH_status == 'Safe') ? 'green' : 'red'; ?>;"><?php echo $ph_level; ?> (<?php echo $pH_status; ?>)</span></b></h6>
<h6><b>Turbidity: <span class="stat-value" style="color: <?php echo ($turbidity_status == 'Safe') ? 'green' : 'red'; ?>;"><?php echo $turbidity; ?> NTU (<?php echo $turbidity_status; ?>)</span></b></h6>
<h6><b>Temperature: <span class="stat-value" style="color: <?php echo ($temperature_status == 'Normal') ? 'green' : 'red'; ?>;"><?php echo $temperature; ?>°C (<?php echo $temperature_status; ?>)</span></b></h6>
<h6><b>Total Dissolved Solids (TDS): <span class="stat-value" style="color: <?php echo ($tds_status == 'Acceptable') ? 'green' : 'red'; ?>;"><?php echo $tds; ?> ppm (<?php echo $tds_status; ?>)</span></b></h6>
</div>
</div>
</div>

<div class="col-md-4">
<div class="box">
<div class="img-box">
<img src="images/s3.png" alt="Compliance" />

</div>
<div class="detail-box">
<h5>Compliance & Safety</h5>
<p>Ensuring water meets safety standards.</p><hr>
<h6><b>Contamination Status: <span class="stat-value"><?php echo $contamination_status; ?></span></b></h6>
<h6><b>Chemical Composition: <span class="stat-value"><?php echo $chemical_composition; ?></span></b></h6>
<h6><b>Compliance Status: <span class="stat-value" style="color: <?php echo ($compliance_status == 'Compliant') ? 'green' : 'red'; ?>;"><?php echo $compliance_status; ?></span></b></h6>
<h6><b>Remarks: <span class="stat-value"><?php echo $remarks; ?></span></b></h6><br>
</div>
</div>
</div>
</div>
<br>
<div class="heading_container heading_center">
<h3>Water Quality Test Records</h3>
</div>

<input type="text" id="search" class="form-control" placeholder="Search by Date or Tester" onkeyup="filterTable()">
<table class="table table-bordered" id="recordsTable">
<thead>
<tr>
<th>Test Date</th>
<th>Tester</th>
<th>pH Level</th>
<th>Turbidity (NTU)</th>
<th>Temperature (°C)</th>
<th>TDS (ppm)</th>
<th>Contamination Status</th>
<th>Compliance</th>
</tr>
</thead>
<tbody>
<?php while ($row = mysqli_fetch_assoc($result_all)) { ?>
<tr>
<td><?php echo $row['test_date']; ?></td>
   <?php
$tester_id = $row['tester_name'];
$query = "SELECT lastname FROM users WHERE id = $tester_id";
$result = mysqli_query($conn, $query);
$lastname = "";
if ($result && mysqli_num_rows($result) > 0) 
{
$data = mysqli_fetch_assoc($result);
$lastname = $data['lastname'];
}
?>
<td><?php echo htmlspecialchars($lastname); ?></td>
<td><?php echo $row['pH_level']; ?></td>
<td><?php echo $row['turbidity']; ?></td>
<td><?php echo $row['temperature']; ?></td>
<td><?php echo $row['tds']; ?></td>
<td><?php echo $row['contamination_status']; ?></td>
<td style="color: <?php echo ($row['compliance_status'] == 'Compliant') ? 'green' : 'red'; ?>;">
<?php echo $row['compliance_status']; ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</section>
<script>
function filterTable() {
var input, filter, table, tr, td, i, j, txtValue;
input = document.getElementById("search");
filter = input.value.toUpperCase();
table = document.getElementById("recordsTable");
tr = table.getElementsByTagName("tr");
for (i = 1; i < tr.length; i++) {
tr[i].style.display = "none";
td = tr[i].getElementsByTagName("td");
for (j = 0; j < td.length; j++) {
if (td[j]) {
txtValue = td[j].textContent || td[j].innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
tr[i].style.display = "";
break;
}
}
}
}
}
</script>

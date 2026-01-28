<?php
include 'phpincludes/selectwaterrecord.php';

?>
<section class="p-5">
   
<div class="text-center mb-4">
<h2>Water Quality Records</h2>
<h5>Report for: <?php echo date('d-m-Y H:i:s'); ?></h5>
</div>
<form method="POST" class="mb-3 d-flex gap-2 hidden-print">
<input type="text" name="search" class="form-control" placeholder="Search water records..." value="<?php echo $search_query; ?>">
<button type="submit" class="btn btn-primary">Search</button>
</form>
<table class="table table-bordered table-striped text-center">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Date:</th>
<th>pH Level</th>
<th>Turbidity (NTU)</th>
<th>Contamination Status</th>
<th>Temperature (°C)</th>
<th>Total Dissolved Solids (ppm)</th>
<th>Chemical Composition</th>
<th>Compliance Status</th>
<th>Remarks</th>
<th>Quality Analysis</th>
<th class="hidden-print">Actions</th>
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
<td class="hidden-print">
<button type="button" class="btn btn-warning btn-sm" onclick="editRecord(<?php echo htmlspecialchars(json_encode($row)); ?>)">Update</button><hr>
<a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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
<center><button class="btn btn-secondary mb-3 hidden-print" onclick="printReport()">Print Report</button></center>
</section>



<!-- UPDATE FORM -->
<div id="updateForm" class="container d-none border hidden-print">
<h3>Update Water Quality Record</h3>
<form method="POST">
<input type="hidden" name="id" id="id">
<input type="hidden" name="tester_name" id="tester_name" class="form-control" required>

<div class="row">
<div class="mb-3 col-md-6">
<label>pH Level</label>
<input type="number" step="0.01" name="pH_level" id="pH_level" class="form-control" required>
</div>

<div class="mb-3 col-md-6">
<label>Turbidity (NTU)</label>
<input type="number" step="0.01" name="turbidity" id="turbidity" class="form-control" required>
</div>

<div class="mb-3 col-md-6">
<label>Contamination Status</label>
<input type="text" name="contamination_status" id="contamination_status" class="form-control" required>
</div>

<div class="mb-3 col-md-6">
<label>Temperature (°C)</label>
<input type="number" step="0.01" name="temperature" id="temperature" class="form-control" required>
</div>

<div class="mb-3 col-md-6">
<label>Total Dissolved Solids (ppm)</label>
<input type="number" step="0.01" name="tds" id="tds" class="form-control" required>
</div>

<div class="mb-3 col-md-6">
<label>Chemical Composition</label>
<input type="text" name="chemical_composition" id="chemical_composition" class="form-control" required>
</div>

<div class="mb-3 col-md-6">
<label>Compliance Status</label>
<input type="text" name="compliance_status" id="compliance_status" class="form-control" required>
</div>

<div class="mb-3 col-md-6">
<label>Quantity Tested (L)</label>
<input type="number" step="0.01" name="quantity_tested" id="quantity_tested" class="form-control" required>
</div>

<div class="mb-3 col-md-12">
<label>Remarks</label>
<textarea name="remarks" id="remarks" class="form-control"></textarea>
</div>
</div>

<button type="submit" name="update_record" class="btn btn-primary">Update</button>
</form>
</div>



<script>
function editRecord(record) {
Object.keys(record).forEach(key => {
let field = document.getElementById(key);
if (field) field.value = record[key];
});
document.getElementById('updateForm').classList.remove('d-none');
}

function printReport() {
window.print();
}
</script>





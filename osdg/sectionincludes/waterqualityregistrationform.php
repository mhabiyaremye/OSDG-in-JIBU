<div class="container mt-2 p-5">
<h2 class="text-center mb-4">Water Quality Testing Form</h2>

<form method="POST" class="p-4 border rounded shadow">

<div class="mb-3">
<label class="form-label">Tester Name:</label>
<?php
if (isset($_SESSION['user_id'])) 
{
?>
<input type="text" class="form-control" readonly value="<?php echo htmlspecialchars($user_name); ?>" >
<input type="hidden" name="tester_name" value="<?php echo $user_id;  ?>" class="form-control" placeholder="Enter tester's name" required>
<?php
}
else
{
?>
<input type="text" class="form-control" readonly required >
<?php
}
?>
</div>
<div class="mb-3">
<label class="form-label">Quantity of Tested Water (liters):</label>
<input type="number" step="0.01" name="quantity_tested" class="form-control" placeholder="Enter quantity in liters (e.g., 2.5)" required>
</div>
<div class="row">
<div class="col-md-6 mb-3">
<label class="form-label">pH Level:</label>
<input type="number" step="0.01" name="pH_level" class="form-control" placeholder="Enter pH level (e.g., 7.2)" required>
</div>
<div class="col-md-6 mb-3">
<label class="form-label">Turbidity (NTU):</label>
<input type="number" step="0.01" name="turbidity" class="form-control" placeholder="Enter turbidity level (e.g., 1.5)" required>
</div>
</div>

<div class="mb-3">
<label class="form-label">Contamination Status:</label>
<select name="contamination_status" class="form-control" required>
<option selected disabled></option>
<option value="Safe">Safe</option>
<option value="Contaminated">Contaminated</option>
</select>
</div>

<div class="row">
<div class="col-md-6 mb-3">
<label class="form-label">Temperature (°C):</label>
<input type="number" step="0.01" name="temperature" class="form-control" placeholder="Enter temperature (e.g., 25.5)" required>
</div>
<div class="col-md-6 mb-3">
<label class="form-label">Total Dissolved Solids (TDS) (ppm):</label>
<input type="number" step="0.01" name="tds" class="form-control" placeholder="Enter TDS value (e.g., 500)" required>
</div>
</div>

<div class="mb-3">
<label class="form-label">Chemical Composition (if any):</label>
<textarea name="chemical_composition" class="form-control" placeholder="List any chemicals present (if applicable)"></textarea>
</div>

<div class="mb-3">
<label class="form-label">Compliance Status:</label>
<select name="compliance_status" class="form-control" required>
<option selected disabled></option>
<option value="Compliant">Compliant</option>
<option value="Non-Compliant">Non-Compliant</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Remarks:</label>
<textarea name="remarks" class="form-control" placeholder="Enter any remarks or observations"></textarea>
</div>

<button type="submit" name="insertwaterquality" class="btn btn-primary w-100">Submit</button>
</form>
</div>

<?php
include 'phpincludes/insertwaterquality.php';
?>

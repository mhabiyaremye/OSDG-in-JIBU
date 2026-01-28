<?php
if (isset($_POST['insertwaterquality'])) 
{
$tester_name = mysqli_real_escape_string($conn, $_POST['tester_name']);
$pH_level = mysqli_real_escape_string($conn, $_POST['pH_level']);
$turbidity = mysqli_real_escape_string($conn, $_POST['turbidity']);
$contamination_status = mysqli_real_escape_string($conn, $_POST['contamination_status']);
$temperature = mysqli_real_escape_string($conn, $_POST['temperature']);
$tds = mysqli_real_escape_string($conn, $_POST['tds']);
$chemical_composition = mysqli_real_escape_string($conn, $_POST['chemical_composition']);
$compliance_status = mysqli_real_escape_string($conn, $_POST['compliance_status']);
$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
$quantity_tested = mysqli_real_escape_string($conn, $_POST['quantity_tested']);
mysqli_begin_transaction($conn);

try 
{
$sql = "INSERT INTO qualityrecords (tester_name, pH_level, turbidity, contamination_status, temperature, tds, chemical_composition, compliance_status, remarks, quantity_tested) 
VALUES ('$tester_name', '$pH_level', '$turbidity', '$contamination_status', '$temperature', '$tds', '$chemical_composition', '$compliance_status', '$remarks', '$quantity_tested')";
if (mysqli_query($conn, $sql)) 
{
mysqli_commit($conn);
?>
<script>
swal({
title: "Data Inserted Successfully!",
text: "Water quality record has been saved.",
icon: "success",
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
}).then(() => {
window.location = '';
});
</script>
<?php
} 
else 
{
?>
<script>
swal({
title: "Error inserting data into qualityrecords table.",
text: "Press ok.",
icon: "warning",
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
});
</script>
<?php
}
} 
catch (Exception $e) 
{
mysqli_rollback($conn);
?>
<script>
swal({
title: "Error Occurred!",
text: "<?php echo addslashes($e->getMessage()); ?>",
icon: "error",
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false
}).then(() => {
window.history.back();
});
</script>
<?php
}
}
?>


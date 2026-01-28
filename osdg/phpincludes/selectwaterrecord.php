<?php

if (isset($_GET['delete'])) {
$record_id = intval($_GET['delete']);
$delete_query = "DELETE FROM qualityrecords WHERE id = $record_id";

if (mysqli_query($conn, $delete_query)) {
?>
<script>
swal({
title: "Deleted successfully!",
text: "Press OK.",
icon: 'success',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
}).then(() => {
window.location = '';
});
</script>
<?php
} else {
?>
<script>
swal({
title: "Error deleting record.",
text: "Press OK.",
icon: 'warning',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
});
</script>
<?php
}
}

if (isset($_POST['update_record'])) {
$id = intval($_POST['id']);
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
try {
$update_query = "UPDATE qualityrecords SET tester_name='$tester_name', pH_level='$pH_level', turbidity='$turbidity', 
contamination_status='$contamination_status', temperature='$temperature', tds='$tds', 
chemical_composition='$chemical_composition', compliance_status='$compliance_status', 
remarks='$remarks', quantity_tested='$quantity_tested' WHERE id=$id";

if (mysqli_query($conn, $update_query)) {
mysqli_commit($conn);
?>
<script>
swal({
title: "Record Updated Successfully!",
text: "Press ok.",
icon: "success",
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false
}).then(() => {
window.location = '';
});
</script>
<?php
} else {
?>
<script>
swal({
title: "Error updating record.",
text: "Press ok.",
icon: "warning",
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false
}).then(() => {
window.location = '';
});
</script>
<?php
}
} catch (Exception $e) {
mysqli_rollback($conn);
?>
<script>
swal({
title: "Error Updating Record!",
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

$search_query = "";
if (isset($_POST['search'])) 
{
$search_query = mysqli_real_escape_string($conn, $_POST['search']);
}
$sql = "SELECT * FROM qualityrecords WHERE tester_name LIKE '%$search_query%' OR contamination_status LIKE '%$search_query%' OR compliance_status LIKE '%$search_query%' OR remarks LIKE '%$search_query%'";
$result = mysqli_query($conn, $sql);
?>
<?php
session_start(); // Start the session to access user data

// Assuming you have a session variable 'role' set when the user logs in
if ($_SESSION['role'] == 'admin') {
    // Admin can see and use the search form
    echo '<form method="POST">
            <input type="text" name="search" placeholder="Search records">
            <button type="submit">Search</button>
          </form>';
    
    // Handle search query
    if (isset($_POST['search'])) {
        $search_query = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM qualityrecords WHERE tester_name LIKE '%$search_query%' 
                OR contamination_status LIKE '%$search_query%' 
                OR compliance_status LIKE '%$search_query%' 
                OR remarks LIKE '%$search_query%'";
        $result = mysqli_query($conn, $sql);
    }

} else {
    // Testers will not see the search form; no action needed for them
    // Simply don't output the search form or any message
}
?>

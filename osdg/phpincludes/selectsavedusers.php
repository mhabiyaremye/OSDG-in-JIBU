<?php
if (isset($_GET['delete'])) 
{
$user_id = intval($_GET['delete']);
mysqli_begin_transaction($conn);
try 
{
$delete_profile = "DELETE FROM userprofiles WHERE user_id = $user_id";
mysqli_query($conn, $delete_profile);

$delete_user = "DELETE FROM users WHERE id = $user_id";
if (mysqli_query($conn, $delete_user)) 
{
mysqli_commit($conn);
?>
<script>
swal({
title: "Deleted successfully!",
text: "Press ok.",
icon: 'success',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
})
.then(function (isConfirm) {
if (isConfirm) {
window.location = '';
}
});
</script>
<?php

?>
<script>
swal({
title: "User deleted successfully!",
text: "Press ok.",
icon: 'success',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
});
</script>
<?php
} 
else 
{
?>
<script>
swal({
title: "Error deleting user.",
text: "Press ok.",
icon: 'warning',
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
title: "Error inserting into users table",
text: "<?php echo addslashes($e->getMessage()); ?>",
icon: "warning",
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

if (isset($_POST['update_user'])) 
{
$user_id = intval($_POST['user_id']);
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$user_level = mysqli_real_escape_string($conn, $_POST['user_level']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
$bio = mysqli_real_escape_string($conn, $_POST['bio']);

$update_user = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', title='$title', user_level='$user_level' WHERE id=$user_id";
$update_profile = "UPDATE userprofiles SET address='$address', gender='$gender', birth_date='$birth_date', bio='$bio' WHERE user_id=$user_id";

if (mysqli_query($conn, $update_user) && mysqli_query($conn, $update_profile)) 
{
?>
<script>
swal({
title: "User updated successfully!",
text: "Press ok.",
icon: 'success',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
})
.then(function (isConfirm) {
if (isConfirm) {
window.location = '';
}
});
</script>
<?php
} 
else 
{
?>
<script>
swal({
title: "Error updating user.",
text: "Press ok.",
icon: 'warning',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
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

$sql = "SELECT users.id, users.firstname, users.lastname, users.email, users.phone, 
   users.title, users.user_level, userprofiles.address, userprofiles.gender, 
   userprofiles.birth_date, userprofiles.profile_picture, userprofiles.bio
FROM users
LEFT JOIN userprofiles ON users.id = userprofiles.user_id
WHERE users.firstname LIKE '%$search_query%' 
   OR users.lastname LIKE '%$search_query%' 
   OR users.email LIKE '%$search_query%' 
   OR users.phone LIKE '%$search_query%'";
$result = mysqli_query($conn, $sql);
?>
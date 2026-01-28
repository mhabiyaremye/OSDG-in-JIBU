<?php
if (isset($_POST['update_profile'])) 
{
$user_id = $_SESSION['user_id'];
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : null;
$profile_picture = "";
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) 
{
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
$file_ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
if (in_array($file_ext, $allowed_types)) {
$target_dir = "images/uploads/";
$target_file = $target_dir . uniqid() . "." . $file_ext;
if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) 
{
$profile_picture = $target_file;
} 
else 
{
?>
<script>
swal({
title: "Profile disabled",
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
else 
{
?>
<script>
swal({
title: "Invalid file type, Only JPG, JPEG, PNG and GIF allowed",
text: "Press ok",
icon: 'warning',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
});
</script>
<?php
}
}

mysqli_begin_transaction($conn);
try 
{
$update_query = "UPDATE users SET email = ?, phone = ?";
$params = [$email, $phone];
$types = "ss";

if ($password) 
{
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$update_query .= ", password = ?";
$params[] = $password_hash;
$types .= "s";
}

$update_query .= " WHERE id = ?";
$params[] = $user_id;
$types .= "i";
$stmt = mysqli_prepare($conn, $update_query);
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
if (!empty($profile_picture)) 
{
$stmt = mysqli_prepare($conn, "UPDATE userprofiles SET profile_picture = ? WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "si", $profile_picture, $user_id);
mysqli_stmt_execute($stmt);
}
mysqli_commit($conn);
?>
<script>
swal({
title: "Info updated",
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
catch (Exception $e) 
{
mysqli_rollback($conn);
?>
<script>
swal({
title: "Error updating profile",
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
?>

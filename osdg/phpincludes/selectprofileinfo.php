<?php
$query = "SELECT u.id, u.firstname, u.lastname, u.email, u.phone, u.title, u.user_level, u.status, u.created_at, u.updated_at, 
 p.address, p.gender, p.birth_date, p.profile_picture, p.bio, p.created_at AS profile_created_at, p.updated_at AS profile_updated_at 
FROM users u 
LEFT JOIN userprofiles p ON u.id = p.user_id 
WHERE u.id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
if (!$user) 
{
?>
<script>alert('User not found.'); window.location.href='index.php';</script>
<?php
}

if (isset($_POST['update_profile'])) 
{
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
$bio = mysqli_real_escape_string($conn, $_POST['bio']);

$profile_picture = $user['profile_picture'];
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) 
{
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
$file_ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
if (in_array($file_ext, $allowed_types)) 
{
$target_dir = "images/uploads/";
$target_file = $target_dir . uniqid() . "." . $file_ext;
if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) 
{
$profile_picture = $target_file;
}
}
}

mysqli_begin_transaction($conn);
try 
{
$update_user = "UPDATE users SET firstname=?, lastname=?, email=?, phone=? WHERE id=?";
$stmt = mysqli_prepare($conn, $update_user);
mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $lastname, $email, $phone, $user_id);
mysqli_stmt_execute($stmt);

$update_profile = "INSERT INTO userprofiles (user_id, address, gender, birth_date, profile_picture, bio) 
VALUES (?, ?, ?, ?, ?, ?) 
ON DUPLICATE KEY UPDATE address=?, gender=?, birth_date=?, profile_picture=?, bio=?";
$stmt = mysqli_prepare($conn, $update_profile);
mysqli_stmt_bind_param($stmt, "issssssssss", $user_id, $address, $gender, $birth_date, $profile_picture, $bio, $address, $gender, $birth_date, $profile_picture, $bio);
mysqli_stmt_execute($stmt);

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
} catch (Exception $e) 
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
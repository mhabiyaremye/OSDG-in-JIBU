<?php
if (isset($_POST['registeruser'])) 
{
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$user_level = mysqli_real_escape_string($conn, $_POST['user_level']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password_hash=password_hash($password, PASSWORD_DEFAULT);

// Profile Info
$address = mysqli_real_escape_string($conn, $_POST['address']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
$bio = mysqli_real_escape_string($conn, $_POST['bio']);

// Profile picture upload handling
$profile_picture = "";
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
$file_ext = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));

if (in_array($file_ext, $allowed_types)) 
{
$target_dir = "images/uploads/"; // Ensure this directory exists
$target_file = $target_dir . uniqid() . "." . $file_ext;
if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
$profile_picture = $target_file; // Store image path
} 
else 
{
?>
<script>
swal({
title: "Error uploading file.",
text: "The post has been successfully disabled.",
icon: 'error',
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
title: "Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.",
text: "The post has been successfully disabled.",
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
$sql_user = "INSERT INTO users (firstname, lastname, email, phone, title, user_level, password) 
 VALUES ('$firstname', '$lastname', '$email', '$phone', '$title', '$user_level', '$password_hash')";
if (mysqli_query($conn, $sql_user)) 
{
$user_id = mysqli_insert_id($conn);
$sql_profile = "INSERT INTO userprofiles (user_id, address, gender, birth_date, profile_picture, bio)
VALUES ('$user_id', '$address', '$gender', '$birth_date', '$profile_picture', '$bio')";
if (mysqli_query($conn, $sql_profile)) 
{
mysqli_commit($conn);
?>
<script>
swal({
title: "User registered successfully!",
text: "The post has been successfully disabled.",
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
title: "Error inserting into user_profiles table.",
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
title: "Error inserting into users table",
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
catch (Exception $e) {
mysqli_rollback($conn); // Fixed function name
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
window.history.back(); // Optional: Navigate back
});
</script>
<?php
}

}
?>

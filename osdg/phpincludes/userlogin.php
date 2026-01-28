<?php
if (isset($_POST['userlogin'])) 
{
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE email = '$email' AND phone = '$phone' AND status = 'Active'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) 
{
$row = mysqli_fetch_assoc($result);
if (password_verify($password, $row['password'])) 
{
$_SESSION['user_id'] = $row['id'];
$_SESSION['user_name'] = $row['firstname'] . ' ' . $row['lastname'];
$_SESSION['user_level'] = $row['user_level'];
header("Location: dashboard.php");
} 
else 
{
?>
<script>
swal({
title: "Invalid password.",
text: "Invalid password.",
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
title: "Invalid email or phone number.",
text: "Invalid email or phone number.",
icon: 'error',
closeOnClickOutside: false,
closeOnEsc: false,
allowOutsideClick: false,
});
</script>
<?php
}
}
?>
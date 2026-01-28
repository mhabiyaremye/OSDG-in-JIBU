<?php
function generateRandomPassword($length = 5) {
$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%';
return substr(str_shuffle($characters), 0, $length);
}

if (isset($_POST['updatePassword'])) 
{
$email = mysqli_real_escape_string($conn, $_POST['recoveryEmail']);
$phone = mysqli_real_escape_string($conn, $_POST['recoveryPhone']);
$query = "SELECT * FROM users WHERE email = '$email' AND phone = '$phone'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) 
{
$user = mysqli_fetch_assoc($result);
$newPassword = generateRandomPassword(5);
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
$updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email' AND phone = '$phone'";
if (mysqli_query($conn, $updateQuery)) 
{
$to = $email;
$subject = "Your Account Credentials - OSDG";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
$headers .= "From: OSDG Support <mhabiyaremye22@gmail.com>" . "\r\n";
$body = "<h4>Hello,</h4>
<p>Your password has been successfully reset. Below are your updated credentials:</p>
<p><strong>Email:</strong> $email</p>
<p><strong>Phone:</strong> $phone</p>
<p><strong>New Password:</strong> $newPassword</p>
<p>For security, please log in and change your password immediately.</p>
<p>Best regards,<br>OSDG Support Team</p>";
if (mail($to, $subject, $body, $headers)) 
{
?>
<script>
swal({
title: "Your credentials have been sent to your email.",
text: "Check on your email.",
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
title: "Password updated, but the email could not be sent.",
text: "Failed.",
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
title: "Error updating password. Please try again.",
text: "Failed.",
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
title: "No account found with the provided email and phone number.",
text: "Failed.",
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

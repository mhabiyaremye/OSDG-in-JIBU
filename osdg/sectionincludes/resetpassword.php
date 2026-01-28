<div class="detail-box bg-white p-4 shadow-lg rounded">
<h1>Password Reset</h1>
<p class="text-center text-muted">Please enter your credentials to reset password.</p>
<form id="forgotPasswordForm" method="POST">
<div class="mb-3">
<label for="recoveryEmail" class="form-label">Email</label>
<input type="email" class="form-control" id="recoveryEmail" name="recoveryEmail" placeholder="Enter your registered email" required>
</div>
<div class="mb-3">
<label for="recoveryPhone" class="form-label">Phone Number</label>
<input type="text" class="form-control" id="recoveryPhone" name="recoveryPhone" value="+250" placeholder="Enter phone number with country code" 
pattern="^\+(\d{1,4})\s?\(?\d+\)?[\s\-]?\d+[\s\-]?\d+[\s\-]?\d+$" 
title="Please enter a valid phone number with the country code (e.g., +1 555-555-5555)" required>
</div>
<button type="submit" class="btn btn-primary" name="updatePassword">Reset Password</button>
</form>
<center><a href="index.php">Back to login</a></center>
</div>
<?php
include 'phpincludes/resetpassword.php';
?>
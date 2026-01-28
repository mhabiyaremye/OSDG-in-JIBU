
	<div class="detail-box p-4 shadow-lg rounded" style="background-color: maroon; color: white;">

<h1>Jibu Staff Login</h1>
<p class="text-center text-muted">Please enter your credentials to access the system.</p>
<form method="POST">
<div class="form-group">
<label for="email">Email Address</label>
<input type="email" class="form-control p-2" id="email" name="email" placeholder="Enter your email" required>
</div>
<div class="form-group">
<label for="phone">Phone Number</label>
<input type="text" value="+250" placeholder="Enter phone number with country code" 
pattern="^\+(\d{1,4})\s?\(?\d+\)?[\s\-]?\d+[\s\-]?\d+[\s\-]?\d+$" 
title="Please enter a valid phone number with the country code (e.g., +1 555-555-5555)" class="form-control p-2" id="phone" name="phone" required >
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control p-2" id="password" name="password" placeholder="Enter your password" required>
</div>
<div class="d-flex justify-content-between align-items-center">
<button type="submit" name="userlogin" class="btn btn-primary btn-block">Login</button>
</div>
</form>
<center><a href="resetpassword.php">Forgot Password?</a></center>
</div>
<?php
include 'phpincludes/userlogin.php';
?>

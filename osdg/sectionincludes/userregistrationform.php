<section class="service_section layout_padding">
<div class="container">
<div class="heading_container heading_center">
<h2>Register System User</h2>
</div>

<form method="POST" enctype="multipart/form-data">
<div class="row">
<!-- User Information -->
<div class="col-md-6">
<div class="card p-4 shadow-sm rounded">
<h4 class="mb-3">User Information</h4>
<div class="mb-3">
<label for="firstname" class="form-label">First Name</label>
<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your first name" required>
</div>
<div class="mb-3">
<label for="lastname" class="form-label">Last Name</label>
<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your last name" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" 
        pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" required>
    <span id="emailError" class="text-danger"></span>
</div>

<script>
document.getElementById("email").addEventListener("input", function () {
    let emailError = document.getElementById("emailError");
    if (!this.value.match(/^[a-zA-Z0-9._%+-]+@gmail\.com$/)) {
        emailError.textContent = "Error";
    } else {
        emailError.textContent = "";
    }
});
</script>

<div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="text" value="+250" placeholder="Enter phone number with country code" 
        pattern="^\+(\d{1,4})\s?\(?\d+\)?[\s\-]?\d+[\s\-]?\d+[\s\-]?\d+$" 
        name="phone" id="phone" class="form-control" required
        oninvalid="this.setCustomValidity('Cannot allow text.')"
        oninput="this.setCustomValidity('')">
    <span id="phoneError" class="text-danger"></span>
</div>

<div class="mb-3">
<label for="title" class="form-label">Job Title</label>
<input type="text" name="title" id="title" class="form-control" placeholder="Enter your job title" required>
</div>
<div class="mb-3">
<label for="user_level" class="form-label">User Level</label>
<select name="user_level" id="user_level" class="form-control" required>
<option value="" disabled selected>Select user level</option>
<option value="Admin">Admin</option>
<option value="Qualitycontrolofficer">Quality control officer</option>
<option value="Tester">Tester</option>
<option value="Regulatorycomplianceofficer">Regulatory compliance officer</option>
</select>
</div>
<div class="mb-3">
<label for="password" class="form-label">Password</label>
<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
</div>
</div>
</div>

<!-- Profile Information -->
<div class="col-md-6">
<div class="card p-4 shadow-sm rounded">
<h4 class="mb-3">Profile Information</h4>
<div class="mb-3">
<label for="address" class="form-label">Address</label>
<input type="text" name="address" id="address" class="form-control" placeholder="Enter your address">
</div>
<div class="mb-3">
<label for="gender" class="form-label">Gender</label>
<select name="gender" id="gender" class="form-control">
<option value="" disabled selected>Select gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
</div>
<div class="mb-3">
    <label for="birth_date" class="form-label">Birth Date</label>
    <input type="date" name="birth_date" id="birth_date" class="form-control" required>
    <span id="ageError" class="text-danger"></span>
</div>

<script>
document.getElementById("birth_date").addEventListener("change", function () {
    let birthDate = new Date(this.value);
    let today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    
    // Adjust age if birthday hasn't occurred yet this year
    let monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    let ageError = document.getElementById("ageError");
    if (age < 18) {
        ageError.textContent = "You are not adult.";
        this.value = ""; // Clear the input
    } else {
        ageError.textContent = "";
    }
});
</script>

<div class="mb-3">
<label for="profile_picture" class="form-label">Profile Picture</label>
<input type="file" name="profile_picture" id="profile_picture" class="form-control">
</div>
<div class="mb-3">
<label for="bio" class="form-label">Short Bio</label>
<textarea name="bio" id="bio" class="form-control" rows="3" placeholder="Write a short bio"></textarea>
</div>
</div>
<div class="text-center mt-4">
<button type="submit" name="registeruser" class="btn btn-primary px-5">Register User</button>
</div>
</div>
</div>

<!-- Submit Button -->
</form>
</div>
</section>

<?php
include 'phpincludes/insertuser.php';
?>
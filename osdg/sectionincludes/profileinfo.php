<?php
include 'phpincludes/selectprofileinfo.php';
?>
<div class="container mt-5 border p-4">
<h2>Update Profile</h2>
<form method="POST" enctype="multipart/form-data">
<div class="row">
<div class="col-md-6 mb-3">
<label for="firstname" class="form-label">First Name</label>
<input type="text" class="form-control" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
</div>

<div class="col-md-6 mb-3">
<label for="lastname" class="form-label">Last Name</label>
<input type="text" class="form-control" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
</div>

<div class="col-md-6 mb-3">
<label for="email" class="form-label">Email</label>
<input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
</div>

<div class="col-md-6 mb-3">
<label for="phone" class="form-label">Phone</label>
<input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
</div>

<div class="col-md-6 mb-3">
<label for="address" class="form-label">Address</label>
<input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
</div>

<div class="col-md-6 mb-3">
<label for="gender" class="form-label">Gender</label>
<input type="text" class="form-control" name="gender" value="<?php echo htmlspecialchars($user['gender']); ?>">
</div>

<div class="col-md-6 mb-3">
<label for="birth_date" class="form-label">Birth Date</label>
<input type="date" class="form-control" name="birth_date" value="<?php echo htmlspecialchars($user['birth_date']); ?>">
</div>

<div class="col-md-6 mb-3">
<label for="bio" class="form-label">Bio</label>
<textarea class="form-control" name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
</div>

<div class="col-md-6 mb-3">
<?php if (!empty($user['profile_picture'])): ?>
<img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" class="rounded-circle" width="100" height="100"> 
<?php endif; ?>

<label for="profile_picture" class="form-label">Profile Picture</label>
<input type="file" class="form-control" name="profile_picture" accept="image/*">
</div>
</div>

<button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
</form>
</div>

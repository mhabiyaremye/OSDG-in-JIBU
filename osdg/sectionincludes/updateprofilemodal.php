<?php
$query = "SELECT u.firstname, u.lastname, u.email, u.phone, u.title, u.user_level, p.address, p.gender, p.birth_date, p.profile_picture, p.bio 
FROM users u
LEFT JOIN userprofiles p ON u.id = p.user_id 
WHERE u.id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

<div class="mb-3">
<label for="email" class="form-label">Email</label>
<input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
</div>

<div class="mb-3">
<label for="phone" class="form-label">Phone</label>
<input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
</div>

<div class="mb-3">
<label for="password" class="form-label">New Password</label>
<input type="password" class="form-control" name="password">
</div>

<div class="mb-3">
<?php if (!empty($user['profile_picture'])): ?>
<img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" class="rounded-circle" width="100" height="100"> 
<?php endif; ?>
<label for="profile_picture" class="form-label">Profile Picture</label>
<input type="file" class="form-control" name="profile_picture" accept="image/*">
</div>

<button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
</form>
</div>
</div>
</div>
</div>
<?php
include 'phpincludes/updateprofile.php';
?>

<?php
include 'phpincludes/selectsavedusers.php';
?>
<section class="p-5">
<div class="text-center mb-4">
<h2>Saved Users</h2>
</div>
<form method="POST" class="mb-3 d-flex gap-2 hidden-print">
<input type="text" name="search" class="form-control" placeholder="Search users..." value="<?php echo $search_query; ?>">
<button type="submit" class="btn btn-primary">Search</button>
</form>
<table class="table table-bordered table-striped text-center" id="userTable">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Phone</th>
<th>Title</th>
<th>User Level</th>
<th>Address</th>
<th>Gender</th>
<th>Birth Date</th>
<th>Profile Picture</th>
<th>Bio</th>
<th class="hidden-print">Actions</th>
</tr>
</thead>
<tbody>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['firstname']; ?></td>
<td><?php echo $row['lastname']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['user_level']; ?></td>
<td><?php echo $row['address']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><?php echo $row['birth_date']; ?></td>
<td>
<?php if (!empty($row['profile_picture'])): ?>
<img src="<?php echo $row['profile_picture']; ?>" class="rounded-circle" width="50" height="50">
<?php else: ?>
No Image
<?php endif; ?>
</td>
<td class="hidden-print"><?php echo $row['bio']; ?></td>
<td class="hidden-print">
<button type="button" class="btn btn-warning btn-sm" onclick="editUser(<?php echo htmlspecialchars(json_encode($row)); ?>)">Update</button><hr>
<a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<center><button type="button" class="btn btn-success hidden-print" onclick="printReport()">Print Report</button></center>
</section>
<script>
function printReport() {
window.print();
}
</script>

<div id="updateForm" class="container d-none border">
<h3>Update User</h3>
<form method="POST">
<input type="hidden" name="user_id" id="user_id">
<div class="mb-3">
<label>First Name</label>
<input type="text" name="firstname" id="firstname" class="form-control" required>
</div>
<div class="mb-3">
<label>Last Name</label>
<input type="text" name="lastname" id="lastname" class="form-control" required>
</div>
<div class="mb-3">
<label>Email</label>
<input type="email" name="email" id="email" class="form-control" required>
</div>
<div class="mb-3">
<label>Phone</label>
<input type="text" name="phone" id="phone" class="form-control">
</div>
<div class="mb-3">
<label>Address</label>
<input type="text" name="address" id="address" class="form-control">
</div>
<div class="mb-3">
<label>Bio</label>
<textarea name="bio" id="bio" class="form-control"></textarea>
</div>
<button type="submit" name="update_user" class="btn btn-primary">Update</button>
</form>
</div>

<script>
function editUser(user) {
Object.keys(user).forEach(key => {
let field = document.getElementById(key);
if (field) field.value = user[key];
});
document.getElementById('updateForm').classList.remove('d-none');
}
</script>
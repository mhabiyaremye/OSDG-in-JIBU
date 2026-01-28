<header class="header_section hidden-print">
<div class="header_top">
<div class="container-fluid">
<div class="contact_nav">
<a href="">
<i class="fa fa-phone" aria-hidden="true"></i>
<span>
Call : +250 780 602 555
</span>
</a>
<a href="">
<i class="fa fa-envelope" aria-hidden="true"></i>
<span>
Email : mhabiyaremye22@gmail.com
</span>
</a>
</div>
</div>
</div>
<div class="header_bottom">
<div class="container-fluid">
<nav class="navbar navbar-expand-lg custom_nav-container " style="color:darkblue;">
<a class="navbar-brand" href="dashboard.php">
<span>
<h1 style="color:darkblue;">Jibu</h1>
</span>
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class=""> </span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav ">
<li class="nav-item active">
<a class="nav-link" href="dashboard.php" style="color:darkblue;">Dashboard <span class="sr-only">(current)</span></a>
</li>
<?php
if (isset($_SESSION['user_id'])) 
{
if($user_level=='Admin')
{
?>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:darkblue;">
Users
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<a class="dropdown-item" href="userregistration.php" style="color:black;">Add user</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="savedusers.php" style="color:black;">Saved user's</a>
</div>
</li>
<?php
}
}
?>


<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:darkblue;">
Data
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<?php
if (isset($_SESSION['user_id'])) 
{
if ($user_level =='Admin' || $user_level =='Tester')
{
?>
<a class="dropdown-item" href="waterqualitypage.php" style="color:black;">Add record</a>
<div class="dropdown-divider"></div>
<?php
}
}
?>

<?php
if (isset($_SESSION['user_id'])) 
{
if ($user_level =='Admin' || $user_level =='Qualitycontrolofficer')
{
?>
<a class="dropdown-item" href="watersavedrecords.php" style="color:black;">Saved record</a>
<?php
}
}
?>
</div>
</li>


<?php
if (isset($_SESSION['user_id'])) 
{
if ($user_level =='Admin' || $user_level =='Regulatorycomplianceofficer')
{
?>
<li class="nav-item">
<a class="nav-link" href="report.php" style="color:darkblue;">Report</a>
</li>
<?php
}
}
?>

</ul>

<ul class="navbar-nav ml-auto">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:darkblue;">
<i class="fa fa-user"></i> 
<?php
if (isset($_SESSION['user_id'])) 
{
?>
<?php echo htmlspecialchars($user_name); ?>
<?php
}
else
{
?>
Account
<?php
}
?>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal" style="color:black;">Update Profile</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="profileinfo.php" style="color:black;">Profile info</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="phpincludes/logout.php" style="color:black;">Logout</a>
</div>
</li>
</ul>
</div>
</nav>
</div>
</div>
</header>
<?php
include 'sectionincludes/updateprofilemodal.php';
?>
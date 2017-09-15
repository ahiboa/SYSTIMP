<html>
<body>

<?php
session_start();

if (isset($_POST['submit']))
?>

<p><p>
MENU
<p>
ACCOUNT CREATION TAB: <br>
<a href="addaccountmenu.php">Create Account</a> <br><br>
EVENTS TAB: <br>
<a href="eventslist.php">View Upcoming Events</a> <br><br>
<a href="approveevent.php">View Pending Events</a><br><br>
<a href="createevent.php">Create Event</a><br><br>
<a href="personnelscheduling.php">Personnel Scheduling</a><br><br>
PAYMENTS TAB: <br>
<a href="pendingmenu.php">Pending Payments</a> <br><br>
REPORTS TAB: <br>
<a href="reportmenu.php">View Reports</a> <br><br>
<a href="historyadmin.php">View Customer History</a><br><br>
<a href="paymentdetails.php">Payment History</a> <br><br>
<a href="logout.php">Logout</a>

</body>
</html>
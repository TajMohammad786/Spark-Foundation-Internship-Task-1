<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Gabriela&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/user.css">
</head>
<body>
<div style="font-family: 'Gabriela', serif;   font-size: 40px;text-align: center; margin: 20px;">Bank's  Customers</div>
<table>
<tr>
<th>Sr.No.</th>
<th>Name</th>
<th>Email</th>
<th>Gender</th>
<th>Balance</th>
<th>Details</th>
</tr>





<?php
// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "bank";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}


$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);

// Find the number of records returned
$num = mysqli_num_rows($result);

// Display the rows returned by the sql query
if($num> 0){
    

    // We can fetch in a better way using the while loop
    while($row = mysqli_fetch_assoc($result)){
        // echo var_dump($row);
       
        
        echo "<tr>";
    echo '<form method ="post" action = "Details.php">';
    echo "<td>" . $row["S.No."]. "</td><td>" . $row["Name"] . "</td>
    <td>" . $row["Email Id"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["Balance"] . "</td>";
    echo "<td ><a href='Details.php?user={$row["Name"]}&message=no' type='button' name='user'  id='users1' ><span>Expand</span></a></td>";
    echo "</tr>";
}
echo "</table>";
}
?>
 </section>
 <nav id="sideNav">
            <ul>
                <li><a href="main.html">Home</a></li>
                <li><a href="users.php">All Accounts</a></li>
                <li><a href="history.php">Transaction history</a></li>
                <li><a href="users.php">Transfer history</a></li>
                <li><a href="Register.php">Register</a></li>
            </ul>
        </nav>
        <div id="MyId">
        <img src="images/Menu1.png" id="menuBtn">
</div>

        <script>
           let menuBtn = document.querySelector('#MyId');
            let sideNav = document.querySelector('#sideNav')
           
            let condition = true;

           menuBtn.addEventListener('click',function(){
               if(condition){
                   sideNav.style.right = '0px';
                   condition = false;
               }else{
                sideNav.style.right = '-250px';
                condition = true;
               }
           })
        </script>
</table>
</body>
</html>
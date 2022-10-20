<!DOCTYPE html>
<html>

<head>
  <title>Table</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Gabriela&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/details.css">
</head>

<body>


  <table>
    <tr>
      <th>Account Number</th>
      <th>Name</th>
      <th>Email</th>
      <th>Gender</th>
      <th>Balance</th>

    </tr>


    <?php
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($server, $username, $password, "bank");
    if (!$conn) {
      die("Connection failed");
    }

    $_SESSION['user'] = $_GET['user'];
    $_SESSION['sender'] = $_SESSION['user'];


    ?>
    <?php
    if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];

      $sql = "SELECT * FROM users WHERE Name='$user'";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";

        echo "<td>" . $row["Acc_Number"] . "</td><td>" . $row["Name"] . "</td>
              <td>" . $row["Email Id"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["Balance"] . "</td>";

        echo "</tr>";
      }
    }
    ?>
    <div style="font-family: 'Gabriela', serif;   font-size: 40px;
    text-align: center;
    margin: 20px;
">
      <h3>Transfer Money</h3>
    </div>
    <div class="card container">
      <?php
      if ($_GET['message'] == 'success') {
        echo "<h3><p style='color:green;' class='messagehide'>Transaction was completed successfully</p></h3>";
      }
      if ($_GET['message'] == 'transactionDenied') {
        echo "<h3><p style='color:red;' class='messagehide'>Transaction Failed </p></h3>";
      }
      ?>
      <form action="transfer.php" method="POST">
        <!-- Make Transcation -->

        <b>To</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp
        <select name="reciever" id="dropdown" class="textbox" required>
          <option>Select Recipient</option>
          <?php
          $db = mysqli_connect("localhost", "root", "", "bank");
          $res = mysqli_query($db, "SELECT * FROM users WHERE name!='$user'");
          while ($row = mysqli_fetch_array($res)) {
            echo ("<option> " . "  " . $row['Name'] . "</option>");
          }
          ?>
        </select>
        <br><br>
        <b> From</b>&nbsp&nbsp&nbsp&nbsp :&nbsp&nbsp <span style="font-size:1.2em;"><input id="myinput" name="sender" class="textbox" disabled type="text" value='<?php echo "$user"; ?>'></input></span>
        <br><br>


        <b>Amount :&#8377;</b>
        <input name="amount" type="number" min="100" class="textbox" required>
        <br><br>
        <a href="transfer.php"><button id="transfer" name="transfer" ;>Transfer</button></a>
      </form>
    </div>

    <div style="font-family: 'Gabriela', serif;   font-size: 40px;
    text-align: center;
    margin: 20px;
">
      <h3>Customer Details</h3>
    </div>


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




    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script>
      let menuBtn = document.querySelector('#MyId');
      let sideNav = document.querySelector('#sideNav')

      let condition = true;

      menuBtn.addEventListener('click', function() {
        if (condition) {
          sideNav.style.right = '0px';
          condition = false;
        } else {
          sideNav.style.right = '-250px';
          condition = true;
        }
      })


      $(function() {
        setTimeout(function() {
          $('.messagehide').fadeOut('slow');
        }, 3000);
      });
    </script>
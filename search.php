<html>
<head>
<Title>Search Page</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search here!</h1>
<p>Fill in `Name` or `Email address` or `Company name` or `Date` or any combination , then click <strong>Search</strong></p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Name  <input type="text" name="name" id="name"/></br>
      Email <input type="text" name="email" id="email"/></br>
      Company name <input type="text" name="c_name" id="c_name"/></br>
      Date <input type="text" name="date" id="date"/></br>
      <input type="submit" name="Search" value="Search" />
</form>
<?php
    // Database=xosauceA6UNris7T;Data Source=eu-cdbr-azure-west-b.cloudapp.net;User Id=b2ab45a73f6565;Password=dc05f156
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b2ab45a73f6565";
    $pwd = "dc05f156";
    $db = "xosauceA6UNris7T";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Retrieve data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $c_name = $_POST["c_name"];
    $date = $_POST["date"];
   
    $sql_select = "SELECT * FROM registration_tbl WHERE ";
    if($name !='')
          $sql_select .= "name = '$name' and ";
    if($email !='')
          $sql_select .= "email = '$email' and ";
    if($c_name != '')
          $sql_select .= "company_name = '$c_name' and ";
    if($date != '')
          $sql_select .= "date = '$date' and ";
    $sql_select .= "1=1";
    echo $sql_select;
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>People who are registered who match your search:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Company Name</th>";
        echo "<th>Date</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['company_name']."</td>";
            echo "<td>".$registrant['date']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>No entries matching your search.</h3>";
    }
?>
</body>
</html>

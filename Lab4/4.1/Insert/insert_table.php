<html>
    <head><title>Insert Table</title></head>
    <body>
        <?php
            include '../CONFIG.php';
            $connect = mysqli_connect($server, $user, $pass, $mydb);

            if (!$connect) {
                die ("Cannot connect to $server using $user");
            }
            $item_desc = $_POST["item_desc"];
            $weight = $_POST["weight"];
            $cost = $_POST["cost"];
            $number = $_POST["number"];
            $SQLcmd = "INSERT INTO $table_name (ProductID, Product_desc, Cost, Weight, Numb) 
            VALUES( 0, '$item_desc', $weight, $cost, $number)";
            
            if (mysqli_query($connect, $SQLcmd)){
                print "<div>The Query is $SQLcmd</div>";
                print "<div>Insert into $table_name was succesful!</div>";
            } else {
                die ("Insert Table Failed SQLcmd=$SQLcmd");
            } 
            mysqli_close($connect);
                
        ?>
    </body>
</html>

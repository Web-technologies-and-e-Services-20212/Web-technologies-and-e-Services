<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
        }

        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 60%;
            margin: 0 auto;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        input[type=submit] , input[type=reset]{
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        input[type=submit]:hover, input[type=reset]:hover {
            background-color: #45a049;
        }

        input[type=radio] {
            font-size: 16px;
        }

        .radio__btn {
            padding: 5px 0;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            width: 40%;
            margin: 2% auto;
        }
    </style>
</head>
<body>
    <h2>Select Product We Just Sold :</h2>

    <form action="sale.php" method="POST" class="container">
        <?php
            include '../CONFIG.php';
            $connect = mysqli_connect($server, $user, $pass, $mydb);

            if (!$connect) {
                die ("Cannot connect to $server using $user");
            }

            $sql1 = "SELECT * FROM $table_name ";
            $result = mysqli_query($connect, $sql1);
            if (mysqli_num_rows($result) > 0) {
                // hiển thị dữ liệu trên trang
                while($row = mysqli_fetch_assoc($result)) {
                    echo "
                            <input type='radio' id=$row[$product] name='product' value='$row[$product]'>
                            <label for=$row[$product]>$row[$product]</label><br>
                        ";
                    }
            } else {
                echo "Product NOT FOUND !";
            }
            mysqli_close($connect);
        ?>
        <input type="submit" value="Click To Submit">
        <input type="reset" value="Reset">
    </form>

    <table>
        <tr>
            <th>Num</th>
            <th>Product</th>
            <th>Cost</th>
            <th>Weight</th>
            <th>Count</th>
        </tr>

        <?php
        include '../CONFIG.php';
        $connect = mysqli_connect($server, $user, $pass, $mydb);

        if (!$connect) {
            die ("Cannot connect to $server using $user");
        }

        $sql = "SELECT * FROM $table_name";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            // hiển thị dữ liệu trên trang
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>$row[$num]</td>
                        <td>$row[$product]</td>
                        <td>$row[$cost]</td>
                        <td>$row[$weight]</td>
                        <td>$row[$count]</td>
                    </tr>";
                }
        } else {
            echo "Product NOT FOUND !";
        }
        mysqli_close($connect);
        ?>
    </table>

</body>
</html>
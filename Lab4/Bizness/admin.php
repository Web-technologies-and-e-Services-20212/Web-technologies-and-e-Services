<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Administration</title>
    <style>
        body {
            box-sizing: border-box;
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

        input[type=text], input[type=number] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
        }

        input[type=submit] , input[type=reset]{
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }

        input[type=submit]:hover, input[type=reset]:hover {
        background-color: #45a049;
        }

    </style>
</head>
<body>
    <h2>Category Administration</h2>
    <table>
        <tr>
            <th>Category ID</th>
            <th>Title</th>
            <th>Description</th>
        </tr>
        <?php
            include '../CONFIG2.php';
            $connect = mysqli_connect($server, $user, $pass, $mydb);
    
            if (!$connect) {
                die ("Cannot connect to $server using $user");
            }

            if(isset($_POST['submit'])){
                $category_id = $_POST['cat_id'];
                $title = $_POST['cat_title'];
                $description = $_POST['cat_description'];
                $SQLcmd = "INSERT INTO $table_category (Category_ID, Title, Description)";
                $SQLcmd = $SQLcmd . " VALUES ('$category_id', '$title', '$description')";
                $result = mysqli_query($connect, $SQLcmd);
                if($result){
                    echo "<script type='text/javascript'>alert('Category created successfully !');</script>";
                }
            }
    
            $sql = "SELECT * FROM $table_category";
            $result = mysqli_query($connect, $sql);
    
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>$row[Category_ID]</td>
                            <td>$row[Title]</td>
                            <td>$row[Description]</td>
                        </tr>";
                    }
            } else {
                echo "0 results";
            }
            mysqli_close($connect);
        ?>
        <form action="admin.php" method="post">
        <tr>
            <th><input type="text" id="cat_id" name="cat_id" ></th>
            <th><input type="text" id="cat_title" name="cat_title" ></th>
            <th><input type="text" id="cat_description" name="cat_description" ></th>
        </tr>
        <tr>
            <th><input type="submit" name="submit" value="Add Category"></th>
        </tr>
        </form>
        
    </table>
</body>
</html>
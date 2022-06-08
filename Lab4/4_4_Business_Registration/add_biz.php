<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Registration</title>
    <!-- load cdn styles -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">

    <!-- Load cdn scripts-->
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/b80c217da6.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .scrollPane {
            width: 100%;
            overflow: scroll;
            height: 200px;
        }

        .scrollview {
            width: 100%;
            border: 1px solid #ccc;
        }

		.left {
			float: left;
            margin: 4vh -10vw 0 10vw;
			width: 350px;
		}

        .scrollview tr {
            border: #000 dashed 1px;
        }

        .cat_row {
            line-height: 3.6vh;
        }

		.scrollview .selected, .scrollview tbody .selected {
		    background-color: #04AA6D;
		    color: #fff;
		}
	</style>
    <script type="text/javascript">
		function toggle_select(el) {
            if(window.event.ctrlKey){
                let id = el.id.toString();
                if (el.className.indexOf("selected") >= 0) {
                    el.className = el.className.replace(" selected","");
                    el.className = el.className.replace("selected","");
                    let newValue = document.getElementById("categories").value.toString();
                    
                    newValue = newValue.replace(" " + id, "");
                    newValue = newValue.replace(id + " ", "");
                    newValue = newValue.replace(id, "");
                    document.getElementById("categories").value = newValue;
                }
                else {
                    el.className  += " selected";
                    if(document.getElementById("categories").value.length > 0){
                    document.getElementById("categories").value += " " + id;
                    }
                    else{
                        document.getElementById("categories").value = id;
                    }

                }
            }else {
                let id = el.id.toString();
                Array.from(document.getElementsByClassName("selected")).forEach(function(element) {
                    element.className = element.className.replace(" selected","");
                    element.className = element.className.replace("selected","");
                });
                if (el.className.indexOf("selected") < 0) {
                    el.className += " selected";
                }
                document.getElementById("categories").value = id;

            }
			
		}
	</script>
</head>
<body style="background-color: #535fe6;">
    <?php 
        include '../../CONFIG2.php';
        $db = mysqli_connect($server, $user, $pass, $mydb);

        if (!$db) {
            die ("Cannot connect to $server using $user");
        }
        $posted = false;
        if(isset($_POST['submit'])){
            echo "<h5 class='text-center' id='state-text' style='color: #fff;'>Created business as shown below:</h5>";
            $posted = true;
        }
        $categories = array();
        if($posted){
            
            $name = $_POST["biz_name"];
            $adress = $_POST["address"];
            $city = $_POST["city"];
            $phone = $_POST["phone"];
            $url = $_POST["url"];

            $categories = explode(" ", $_POST['categories']);
            

            $query = "INSERT INTO businesses (Name, Address, City, Telephone, URL) VALUES ('$name', '$adress', '$city', '$phone', '$url')";
            mysqli_query($db, $query);

            $query = "SELECT Business_ID FROM businesses WHERE Name = '$name' AND Address = '$adress' AND City = '$city' AND Telephone = '$phone' AND URL = '$url'";
            
            $result = mysqli_query($db, $query);

            $row = mysqli_fetch_array($result);
            $id = $row["Business_ID"];

            for($i=0; $i<sizeof($categories); $i++){
                $query = "INSERT INTO biz_categories (Business_ID, Category_ID) VALUES ('$id', '$categories[$i]')";
                mysqli_query($db, $query);
            }
            
            
        } 
    ?>
    <h2 class="text-center" style="color: #fff;" >Business Registration</h2>
    <div class="left card px-5 py-5">
        <?php
            if($posted){
                echo "<span>Categories of recently added business: </span>";
            } else {
                echo "<span>Click on one or control+click on multiple categories : <br/><br/><br/></span>";
            }
        ?>
        <div class="scrollPane">
            <table class="scrollview">
                <?php
                    
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($db, $sql);
                    if($posted){
                        while ($row = mysqli_fetch_array($result)) {
                            if(strpos($_POST["categories"], $row["Category_ID"]) !== false){
                                echo "<tr class='cat_row selected' id=$row[Category_ID]> <td> $row[Title] </td> </tr>";
                            }
                            else{
                                echo "<tr class='cat_row' id=$row[Category_ID]> <td> $row[Title] </td> </tr>";
                            }
                        }
                    }
                    else{
                        while ($row = mysqli_fetch_array($result)) {
                                echo "<tr onclick='toggle_select(this);' class='cat_row' id=$row[Category_ID]> <td> $row[Title] </td> </tr>";
                        }
                    }

                ?>
            </table>
        </div>

    </div>
    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <?php
                    if($posted){
                echo "                <div class='card px-5 py-5' >
                <h5 class='mt-3'>Currently added business information</h5>
                <form action='javascript:void(0);' method='POST'>
                    <div class='form-input'> <i class='fa-regular fa-address-card'></i> <input type='text' id ='biz_name' name='biz_name' class='form-control' placeholder='$_POST[biz_name]' disabled> </div>
                    <div class='form-input'> <i class='fa fa-map-location'></i> <input type='text' id = 'address' name='address' class='form-control' placeholder='$_POST[address]' disabled> </div>
                    <div class='form-input'> <i class='fa fa-city'></i> <input type='text' id='city' name='city' class='form-control' placeholder='$_POST[city]' disabled> </div>
                    <div class='form-input'> <i class='fa fa-phone'></i> <input type='text' id='phone' name='phone' class='form-control' placeholder='$_POST[phone]' disabled> </div>
                    <div class='form-input'> <i class='fa fa-link'></i> <input type='text' id='url' name='url' class='form-control' placeholder='$_POST[url]' disabled> </div>
                </form>
                <div class='text-center mt-4'> <span>Still have another business? </span> <a href='' class='text-decoration-none'>Add another one</a> </div>
            </div>";
                    }
                    else{
                        echo "                <div class='card px-5 py-5' >
                        <h5 class='mt-3'>Register businesses with a few actions</h5> <small class='mt-2 text-muted'>Select left box for categories before submit !</small>
                        <form action='add_biz.php' method='POST'>
                            <div class='form-input'> <i class='fa-regular fa-address-card'></i> <input type='text' id ='biz_name' name='biz_name' class='form-control' placeholder='Business Name' required> </div>
                            <div class='form-input'> <i class='fa fa-map-location'></i> <input type='text' id = 'address' name='address' class='form-control' placeholder='Address' required> </div>
                            <div class='form-input'> <i class='fa fa-city'></i> <input type='text' id='city' name='city' class='form-control' placeholder='City' required> </div>
                            <div class='form-input'> <i class='fa fa-phone'></i> <input type='text' id='phone' name='phone' class='form-control' placeholder='Telephone' required> </div>
                            <div class='form-input'> <i class='fa fa-link'></i> <input type='text' id='url' name='url' class='form-control' placeholder='URL' required> </div>
    
                            <div style='display: none;' class='form-check'> <input type='text' id='categories' name='categories'> </div> 
                            <button type='submit' name='submit'  class='btn btn-primary mt-4 signup'>Register now</button>
                        </form>
                    </div>";
                    }
                ?>
                <!-- <div class="card px-5 py-5" >
                    <h5 class="mt-3">Register businesses with a few actions</h5> <small class="mt-2 text-muted">Select left box for categories before submit !</small>
                    <form action="add_biz.php" method="POST">
                        <div class="form-input"> <i class="fa-regular fa-address-card"></i> <input type="text" id ="biz_name" name="biz_name" class="form-control" placeholder="Business Name" required> </div>
                        <div class="form-input"> <i class="fa fa-map-location"></i> <input type="text" id = "address" name="address" class="form-control" placeholder="Address" required> </div>
                        <div class="form-input"> <i class="fa fa-city"></i> <input type="text" id="city" name="city" class="form-control" placeholder="City" required> </div>
                        <div class="form-input"> <i class="fa fa-phone"></i> <input type="text" id="phone" name="phone" class="form-control" placeholder="Telephone" required> </div>
                        <div class="form-input"> <i class="fa fa-link"></i> <input type="text" id="url" name="url" class="form-control" placeholder="URL" required> </div>

                        <div style="display: none;" class="form-check"> <input type="text" id="categories" name="categories"> </div> 
                        <button type="submit" name="submit"  class="btn btn-primary mt-4 signup">Register now</button>
                    </form>
                    <div class="text-center mt-4"> <span>Still have another business? </span> <a href="/add_biz.php" class="text-decoration-none">Add another one</a> </div>
                </div> -->
            </div>
        </div>
    </div>
    <?php
        if($posted){
            $_POST = array();
        }
    ?>
</body>
</html>
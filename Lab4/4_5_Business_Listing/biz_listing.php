<?php 
	include '../../CONFIG2.php';
    $db = mysqli_connect($server, $user, $pass, $mydb);

    if (!$db) {
        die ("Cannot connect to $server using $user");
    }
    mysqli_set_charset($db, 'UTF8');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Business Listings</title>
    <!-- load cdn styles -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">

    <!-- Load cdn scripts-->
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/b80c217da6.js" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function toggle_select(el) {
		    if (el.className.indexOf('selected') >= 0) {
                el.className = el.className.replace(' selected',"");
		        el.className = el.className.replace('selected',"");
		        let id = el.id.toString();

		        let list_category = document.getElementsByClassName("categories");

		        for(let i=0; i<list_category.length; i++){
		        	let category = list_category[i];
		        	if(category.textContent.includes(id)){
		        		category.parentElement.style.display = 'none';
		        	}
		        }

		    }
		    else {
		        el.className  += ' selected';
		        let id = el.id.toString();

		        let list_category = document.getElementsByClassName("categories");

		        for(let i=0; i<list_category.length; i++){
		        	let category = list_category[i];
		        	if(category.textContent.includes(id)){
		        		category.parentElement.style.display = '';
		        	}
		        }
			}

			
		}
	</script>
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
            margin: 5vh 2vw 0 3vw;
			width: 22vw;
		}

        .scrollview tr {
            border: #000 dashed 1px;
        }

        .cat_row {
            line-height: 3.6vh;
        }
        .card{
            margin-top: 5vh;
        }
        .info_row{
            line-height: 3.6vh;
            border: #000 dashed 1px;
        }
        .info_row td{
            border: #000 dashed 1px;
            padding: 0.5vh;
        }



		.scrollview .selected, .scrollview tbody .selected {
		    background-color: #04AA6D;
		    color: #fff;
		}
	</style>
</head>
<body style="background-color: #535fe6;">
<div class="left card px-5 py-5">
<h1>Business Listings</h1> <br /><br />
	<div class="scrollPane"> 
		<table class="scrollview">
			<?php 
				$query = "select * from categories";
				
				$result = mysqli_query($db, $query);
				while($row = mysqli_fetch_array($result)){
					$name_category = $row["Title"];
					$id_category = $row["Category_ID"];

                    echo "<tr onclick='toggle_select(this);' id='$id_category' class='cat_row'> <td>$name_category</td> </tr>";
                }
					
			?>
		</table>		
	</div>
</div>
<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col">
            <div class="card px-5 py-5">
                <table>
                    <?php 
                        $query = "select * from businesses";
                        
                        $result = mysqli_query($db, $query);

                        while($row = mysqli_fetch_array($result)){
                            $id = $row["Business_ID"]; 
                            $name_biz = $row["Name"]; 
                            $adress_biz = $row["Address"];
                            $city_biz = $row["City"];
                            $telephone_biz = $row["Telephone"];
                            $url_biz = $row["URL"];
                            $query_i = "select * from biz_categories where Business_ID=" . $id;
                            $result_i = mysqli_query($db, $query_i);
                            $categories = "";
                            while($row = mysqli_fetch_array($result_i)){
                                $categories .= $row["Category_ID"] . " ";
                            }
                            echo "<tr id='$id-info' class='info_row'>
                                    <td>$name_biz</td>
                                    <td>$adress_biz</td>
                                    <td>$city_biz</td>
                                    <td>$telephone_biz</td>
                                    <td>$url_biz</td>
                                    <td class='categories'>$categories</td>
                                    </tr>";
                        }
                        
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	let list_category = document.getElementsByClassName("categories");

    for(let i=0; i<list_category.length; i++){
    	let category = list_category[i];
    	category.parentElement.style.display = 'none';
    }
</script>

</body>
</html>
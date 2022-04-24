<!DOCTYPE html>
<html>
    <head>
        <title>
            Personal Information Received
        </title>
    </head>
    <body>
        <?php 
        echo 'Hello, '.$_POST["username"];
        echo '<br>';
        echo 'You are studying at '.$_POST["class"].', '.$_POST["university"];
        echo '<br>';
        ?>
        <?php echo 'Your hobby is:'.'<br>';
        ?>
        <?php
        if(isset($_POST['hobbies'])){
            $count = 1;
            foreach($_POST['hobbies'] as $value){
                echo $count.'.&nbsp;&nbsp;&nbsp;';
                echo $value.'<br>';
                $count += 1;
            }
        }
        ?>
    </body>
</html>
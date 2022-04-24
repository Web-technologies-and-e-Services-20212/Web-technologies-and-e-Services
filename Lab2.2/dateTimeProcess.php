<!DOCTYPE html>
<html>

<head>
    <title>
        Date Time Processing
    </title>
</head>

<body>
    <form action="#" method="get">
        <?php
        if (isset($_GET["username"])) {
            $username = $_GET["username"];
            $day = $_GET["day"];
            $month = $_GET["month"];
            $year = $_GET["year"];
            $hour = $_GET["hour"];
            $minute = $_GET["minute"];
            $second = $_GET["second"];
        } else {
            $username = "";
            $day = 0;
            $month = 0;
            $year = 0;
            $hour = 0;
            $minute = 0;
            $second = 0;
        }
        ?>
        <table>
            <tr>
                <td>
                    Your name:
                </td>
                <td colspan="3">
                    <?php
                    if ($username != "") {
                        echo '<input type="text" name="username" value="' . $username . '">';
                    } else {
                        echo '<input type="text" name="username">';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    Date:
                </td>
                <td>
                    <select name="day">
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            if ($day == $i) {
                                echo '<option selected>' . $i . '</option>';
                            } else {
                                echo '<option>' . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="month">
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            if ($month == $i) {
                                echo '<option selected>' . $i . '</option>';
                            } else {
                                echo '<option>' . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="year">
                        <?php
                        for ($i = 2001; $i <= 2100; $i++) {
                            if ($year == $i) {
                                echo '<option selected>' . $i . '</option>';
                            } else {
                                echo '<option>' . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Time:
                </td>
                <td>
                    <select name="hour">
                        <?php
                        for ($i = 0; $i <= 24; $i++) {
                            if ($hour == $i) {
                                echo '<option selected>' . $i . '</option>';
                            } else {
                                echo '<option>' . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="minute">
                        <?php
                        for ($i = 0; $i <= 60; $i++) {
                            if ($minute == $i) {
                                echo '<option selected>' . $i . '</option>';
                            } else {
                                echo '<option>' . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="second">
                        <?php
                        for ($i = 0; $i <= 60; $i++) {
                            if ($second == $i) {
                                echo '<option selected>' . $i . '</option>';
                            } else {
                                echo '<option>' . $i . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    <input type="submit" value="Submit">
                </td>
                <td style="text-align: left" colspan="3">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

    <p>
        <?php
        if (!empty($_GET["username"])) {
            echo 'Hi ' . $username . '!<br>' . '<br>';
            echo 'You have choose to have an appointment on '
                . $hour . ':' . $minute . ':'
                . $second . ', ' . $day . '/'
                . $month . '/' . $year . '<br>' . '<br>';
            echo 'More information<br>' . '<br>';

            $tmp = 'AM';
            if ($hour >= 12) {
                $hour -= 12;
                $tmp = 'PM';
            }

            echo 'In 12 hours, the time and date is '
                . $hour . ':' . $minute . ':'
                . $second . ' ' . $tmp . ', ' . $day . '/'
                . $month . '/' . $year . '<br>' . '<br>';

            $numberOfDays = 0;
            switch ($month) {
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    $numberOfDays = 31;
                    break;
                case 4:
                case 6:
                case 9:
                case 11:
                    $numberOfDays = 30;
                    break;
            }
            if ($month == 2) {
                if ($year % 4 != 0) {
                    $numberOfDays = 28;
                } elseif ($year % 4 == 0 && $year % 400 != 0) {
                    $numberOfDays = 28;
                } else {
                    $numberOfDays = 29;
                }
            }

            echo 'This month has ' . $numberOfDays . ' days!';
        }
        ?>
    </p>
</body>

</html>
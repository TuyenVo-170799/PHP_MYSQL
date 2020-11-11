<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding-top: 60px;
        }
        table {
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px 20px 5px 10px;
        }
        th {
            background-color: #ffb74d;
        }
        td {
            background-color: #f8bbd0;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_POST['submit'])) {
            $mang = array();
            $tong = 0;
            if (!empty($_POST['mang'])) {
                $mang = explode(",", $_POST['mang']);
                for ($i = 0; $i < sizeof($mang); $i++) {
                    $tong += $mang[$i];
                }
            } else {
                $tong = "";
            }
        }
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <th colspan="2">NHẬP VÀ TÍNH DÃY SỐ</th>
            </tr>
            <tr>
                <td>Nhập dãy số:</td>
                <td>
                    <input type="text" name="mang" value="<?php if (isset($_POST['mang'])) echo $_POST['mang']; ?>">(*)
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tổng dãy số" name="submit"></td>
            </tr>
            <tr>
                <td>Tổng dãy số:</td>
                <td><input type="text" name="tong" readonly value="<?php if (isset($tong)) echo $tong; ?>"></td>
            </tr>
            <tr>
                <td colspan="2">(*) Các số được nhập cách nhau bằng dấu ","</td>
            </tr>   
        </table>
    </form>
</body>
</html>
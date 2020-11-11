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
            padding: 5px 20px 5px 5px;
            border: none;
        }
        th {
            background-color: #ffb74d;
        }
        td {
            background-color: #f8bbd0;
        }
        input[type=submit] {
            margin-left: 110px;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_POST['submit'])) {
            $chieuDai = $chieuRong = $dienTich = $chieuDaiErr = $chieuRongErr = "";
            $count = 0;
            if ($_POST['chieu-dai'] != "") {
                if (is_numeric($_POST['chieu-dai'])) {
                    if ($_POST['chieu-dai'] > 0) {
                        $chieuDai = $_POST['chieu-dai'];
                    } else {
                        $chieuDaiErr = "Chiều dài phải lớn hơn không";
                        $chieuDai = $_POST['chieu-dai'];
                        $count++;
                    }
                } else {
                    $chieuDaiErr = "Chiều dài phải là kiểu số";
                    $chieuDai = $_POST['chieu-dai'];
                    $count++;
                }
            } else {
                $chieuDaiErr = "Chiều dài không được rỗng";
                $chieuDai = $_POST['chieu-dai'];
                $count++;
            }

            if ($_POST['chieu-rong'] != "") {
                if (is_numeric($_POST['chieu-rong'])) {
                    if ($_POST['chieu-rong'] > 0) {
                        $chieuRong = $_POST['chieu-rong'];
                    } else {
                        $chieuRongErr = "Chiều rộng phải lớn hơn không";
                        $chieuRong = $_POST['chieu-rong'];
                        $count++;
                    }
                } else {
                    $chieuRongErr = "Chiều rộng phải là kiểu số";
                    $chieuRong = $_POST['chieu-rong'];
                    $count++;
                }
            } else {
                $chieuRongErr = "Chiều rộng không được rỗng";
                $count++;
            }

            if ($count == 0) {
                if ($chieuDai < $chieuRong) {
                    $chieuRongErr = "Chiều rộng không lớn hơn chiều dài";
                } else {
                    $dienTich = $chieuDai * $chieuRong;
                }
            } 
        }
    ?>
    <form action="" method="post">
    <table>
        <tr>
            <th colspan="2">DIỆN TÍCH HÌNH CHỮ NHẬT</th>
        </tr>
        <tr>
            <td>Chiều Dài</td>
            <td>
                <input type="text" name="chieu-dai" value="<?php if (isset($chieuDai)) echo $chieuDai; ?>">
                <?php if (isset($chieuDaiErr) && !empty($chieuDaiErr)) echo "<span>".$chieuDaiErr."</span>" ?>
            </td>
        </tr>
        <tr>
            <td>Chiều Rộng</td>
            <td>
                <input type="text" name="chieu-rong" value="<?php if (isset($chieuRong)) echo  $chieuRong; ?>">
                <?php if (isset($chieuRongErr) && !empty($chieuRongErr)) echo "<span>".$chieuRongErr."</span>" ?>
            </td>
        </tr>
        <tr>
            <td>Diện Tích</td>
            <td><input type="text" name="dien-tich" readonly value="<?php if (isset($dienTich)) echo $dienTich; ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="submit" value="Tính"></td>
        </tr>
    </table>
    </form>
</body>
</html>
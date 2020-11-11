<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2.7 Chi Tiết</title>
    <style>
        body {
            margin: 0;
            padding-top: 80px;
            text-align: center;
        }
        .content {
            width: 40%;
            margin: auto;
            display: flex;
            flex-flow: row wrap;
            border: 1px solid black;
        }
        .title {
            width: 100%;
            padding: 5px;
            font-size: 24px;
            border-bottom: 1px solid black;
            background-color: #f06292;
        }
        .left-item {
            width: 25%;
            height: 220px;
            border-bottom: 1px solid black;
        }
        .left-item img {
            width: 100%;
            height: 100%;
        }
        .right-item {
            width: calc(75% - 15px);
            text-align: left;
            border-left: 1px solid black;
            border-bottom: 1px solid black;
            padding: 5px;
            font-size: 18px;
        }
        a {
            width: 23.5%;
            padding: 5px;
            border-right: 1px solid black;
        }
        .bottom-content {
            float: right;
            bottom: 0;
        }
        strong {
            font-style: italic;
        }
    </style>
</head>
<body>
    <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "ql_bansua";
        $con = mysqli_connect($serverName, $userName, $password, $dbName);
        if (!$con) {
            die("Connect Fail: ".mysqli_connect_error());
        }
        $query = "SELECT * FROM sua WHERE Ma_sua = '".$_GET['ma_sua']."'"; 
        $result = mysqli_query($con, $query);
        $numRow = mysqli_num_rows($result);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='content'>
                    <div class='title'>
                        <strong>".$row['Ten_sua']."</strong>
                    </div>
                    <div class='left-item'>
                        <img src='Hinh_sua/".$row['Hinh']."'>
                    </div>
                    <div class='right-item'>
                        <strong>Thành phần dinh dưỡng: </strong>
                        <br>
                        <span>".$row['TP_Dinh_Duong']."</span>
                        <br>
                        <strong>Lợi ích: </strong>
                        <br>
                        <span>".$row['Loi_ich']."</span>
                        <br>
                        <span class='bottom-content'><strong>Trọng lượng: </strong>".$row['Trong_luong']." gr - <strong>Đơn giá: </strong>".number_format($row['Don_gia'], 0, '.', '.')." VND</span>
                    </div>
                    <a href='bai2.7.1.php'>Quay về</a>
                </div>";
            }
        }
    ?>
</body>
</html>
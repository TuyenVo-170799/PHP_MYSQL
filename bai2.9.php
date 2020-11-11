<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2.9</title>
    <style>
        body {
            margin: 0;
            margin-top: 20px;
            text-align: center;
        }
        .header {
            width: 60%;
            margin: auto;
        }
        .title {
            padding: 5px;
            background-color: #f48fb1;
            margin-bottom: 5px;
            font-size: 24px;
            font-weight: bold;
        }
        form {
            padding: 5px;
            background-color: #f48fb1;
        }
        form label {
            color: #b71c1c;
            font-weight: bold;
        }
        .content {
            width: 40%;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 10px;
            display: flex;
            flex-flow: column wrap;
        }
        .item {
            width: 100%;
            margin: auto;
            display: flex;
            flex-flow: row wrap;
            border: 1px solid black;
            border-bottom: none;
        }
        .item:first-of-type {
            border-bottom: none;
        }
        .item:last-of-type {
            border-bottom: 1px solid black;
        }
        .title-item {
            width: 100%;
            padding: 5px;
            font-size: 24px;
            border-bottom: 1px solid black;
            background-color: #f06292;
        }
        .left {
            width: 25%;
            height: 220px;
            border-right: 1px solid black;
        }
        .left img {
            width: 100%;
            height: 100%;
        }
        .right {
            width: calc(75% - 15px);
            text-align: left;
            padding: 5px;
            font-size: 18px;
            margin: auto;
        }
        strong {
            font-style: italic;
        }
        .red {
            color: red;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">TÌM KIẾM THÔNG TIN SỮA</div>
        <form action="" method="get">
            <label>Tên sữa: </label>
            <input type="text" name="key" value="<?php if (isset($_GET['key'])) echo $_GET['key']; ?>">
            <input type="submit" name="submit" value="Tìm Kiếm">
        </form>
    </div>

    <?php 
        if (isset($_GET['submit'])) {
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
                $serverName = "localhost";
                $userName = "root";
                $password = "";
                $dbName = "ql_bansua";
                $con = mysqli_connect($serverName, $userName, $password, $dbName);
                if (!$con) {
                    die("Connect Fail: ".mysqli_connect_error());
                }
                $rowsPerPage=2;
                if ( ! isset($_GET['page'])) {
                    $_GET['page'] = 1;
                }
                $offset =($_GET['page']-1)*$rowsPerPage;
                $query="SELECT * FROM sua WHERE Ten_sua LIKE '%$key%' LIMIT $offset, $rowsPerPage";
                $result = mysqli_query($con,$query);
                $numRows= mysqli_num_rows($result);
                $maxPage = ceil($numRows / $rowsPerPage);
                if ($numRows > 0) {
                    $count = 1;
                    $re = mysqli_query($con, "SELECT * FROM sua WHERE Ten_sua LIKE '%$key%'");
                    $numRows = mysqli_num_rows($re);
                    echo "<strong>Có ".$numRows." sản phẩm được tìm thấy</strong>";
                    echo "<div class='content'>";
                    while ($row = mysqli_fetch_array($result)) {    
                        echo "<div class='item'>
                                <div class='title-item'>
                                    <strong>".$row['Ten_sua']."</strong>
                                </div>
                                <div class='left'>
                                    <img src='Hinh_sua/".$row['Hinh']."'>
                                </div>
                                <div class='right'>
                                    <strong>Thành phần dinh dưỡng:</strong>
                                    <br>
                                    <span>".$row['TP_Dinh_Duong']."</span>
                                    <br>
                                    <strong>Lợi ích:</strong>
                                    <br>
                                    <span>".$row['Loi_ich']."</span>
                                    <br>
                                    <strong>Trọng lượng: </strong>
                                    <span class='red'>".$row['Trong_luong']." gr</span> - <strong>Đơn giá: </strong><span class='red'>".number_format($row['Don_gia'], 0, '.', '.')." VND</span>
                                </div>
                            </div>";
                        $count++;
                    }
                    echo "</div>";
                    $maxPage = round($numRows/$rowsPerPage);
                    if ($_GET['page'] > 1) {
                        echo "<a href=" .$_SERVER['PHP_SELF']."?key=".$_GET['key']."&submit=Tìm+Kiếm&page=1>	&lsaquo;&lsaquo;</a> ";
                        echo "<a href=" .$_SERVER['PHP_SELF']."?key=".$_GET['key']."&submit=Tìm+Kiếm&page=".($_GET['page']-1).">&lsaquo;</a> "; //gắn thêm nút Back
                    }
                    for ($i=1 ; $i<=$maxPage ; $i++) {
                        if ($i == $_GET['page']) {
                            echo '<b>'.$i.'</b> '; //trang hiện tại sẽ được bôi đậm
                        } else {
                            echo "<a href=" .$_SERVER['PHP_SELF']."?key=".$_GET['key']."&submit=Tìm+Kiếm&page=".$i.">".$i."</a> "; 
                        }
                    }
                    if ($_GET['page'] < $maxPage) {
                        echo "<a href=" . $_SERVER['PHP_SELF'] . "?key=".$_GET['key']."&submit=Tìm+Kiếm&page=" . ($_GET['page'] + 1) . ">&rsaquo;</a> ";  //gắn thêm nút Next
                        echo "<a href=" .$_SERVER['PHP_SELF']."?key=".$_GET['key']."&submit=Tìm+Kiếm&page=".($maxPage).">&rsaquo;&rsaquo;</a> ";
                    }
                } else {
                    echo "<strong>Không có sản phẩm nào được tìm thấy.</strong>";
                }
                mysqli_close($con);
            }
        }
    ?>
</body>
</html>
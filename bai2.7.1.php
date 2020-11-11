<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2.7 Danh Sách</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            padding-top: 80px;
        }
        .content {
            margin: auto;
            width: 60%;
            display: flex;
            flex-flow: row wrap;
            border: 0.5px solid black;
            margin-bottom: 5px;
        }
        .title {
            width: 100%;
            background-color: #f06292;
            font-size: 20px;
            padding-top: 5px;
            border: 0.5px solid black;
        }
        .item {
            width: calc(20% - 1.6px);
            border: 0.5px solid black;
        }
        .item img {
            width: 100px;
            height: 140px;
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
        $rowsPerPage=10;
        if ( ! isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        $offset =($_GET['page']-1)*$rowsPerPage;
        $query="Select * from sua LIMIT $offset, $rowsPerPage";
        $result = mysqli_query($con,$query);
        $numRows= mysqli_num_rows($result);
        $maxPage = ceil($numRows / $rowsPerPage);
        if ($numRows > 0) {
            echo "<div class='content'>
                    <div class='title'>
                        <strong>THÔNG TIN CÁC SẢN PHẨM</strong>
                    </div>";
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='item'>
                        <a href='bai2.7.2.php?ma_sua=".$row['Ma_sua']."'><strong>".$row['Ten_sua']."</strong></a><br>
                        <span>".$row['Trong_luong']." gr - ".number_format($row['Don_gia'], 0, '.', '.')." VND</span><br>
                        <img src='Hinh_sua/".$row['Hinh']."'>
                      </div>";
                $count++;
            }
            echo "</div>";
            $re = mysqli_query($con, 'select * from sua');
            $numRows = mysqli_num_rows($re);
            $maxPage = floor($numRows/$rowsPerPage) + 1;
            if ($_GET['page'] > 1) {
                echo "<a href=" .$_SERVER['PHP_SELF']."?page=1>	&lsaquo;&lsaquo;</a> ";
                echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1).">&lsaquo;</a> "; //gắn thêm nút Back
            }
            for ($i=1 ; $i<=$maxPage ; $i++) {
                if ($i == $_GET['page']) {
                    echo '<b>'.$i.'</b> '; //trang hiện tại sẽ được bôi đậm
                } else {
                    echo "<a href=" .$_SERVER['PHP_SELF']. "?page=".$i.">".$i."</a> "; 
                }
            }
            if ($_GET['page'] < $maxPage) {
                echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] + 1) . ">&rsaquo;</a> ";  //gắn thêm nút Next
                echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($maxPage).">&rsaquo;&rsaquo;</a> ";
            }
        } else {
             echo "<span>Không có bảng ghi nào.</span>";
        }
        mysqli_close($con);
    ?>
</body>
</html>
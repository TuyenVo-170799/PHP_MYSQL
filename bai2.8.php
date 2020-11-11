<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2.8</title>
    <style>
        body {
            margin: 0;
            padding-top: 40px;
            text-align: center;
        }
        .content {
            width: 40%;
            margin: auto;
            display: flex;
            flex-flow: column wrap;
            margin-bottom: 8px;
        }
        .item {
            width: 100%;
            margin: auto;
            display: flex;
            flex-flow: row wrap;
            border: 1px solid black;
        }
        .item:first-of-type {
            border-bottom: none;
        }
        .title {
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
    <h2>THÔNG TIN CHI TIẾT CÁC LOẠI SỮA</h2>
    <?php
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
        $query="Select * from sua LIMIT $offset, $rowsPerPage";
        $result = mysqli_query($con,$query);
        $numRows= mysqli_num_rows($result);
        $maxPage = ceil($numRows / $rowsPerPage);
        if ($numRows > 0) {
            $count = 1;
            echo "<div class='content'>";
            while ($row = mysqli_fetch_array($result)) {    
                echo "<div class='item'>
                        <div class='title'>
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
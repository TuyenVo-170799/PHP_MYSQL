<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2.4</title>
    <style>
        body {
            text-align: center;
        }
        table, td, th {
            border: 1px solid black;
            margin: auto;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        td, th {
            padding: 5px;
        }
        th {
            font-size: 18px;
            background-color: white; 
        }
        td {
            text-align: left;
        }
        tr:nth-child(odd) {
            background-color: #ef9a9a;
        }
        .gender {
            text-align: center;
        }
        span {
            margin-left: 400px;
            color: red;
        }
        h2 {
            color: blue;
        }
    </style>
</head>
<body>
<h2>THÔNG TIN SỮA</h2>
    <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "ql_bansua";
        $con = mysqli_connect($serverName, $userName, $password, $dbName);
        if (!$con) {
            die("Connect Fail: ".mysqli_connect_error());
        }
        $rowsPerPage=5;
        if ( ! isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        $offset =($_GET['page']-1)*$rowsPerPage;
        $query="Select * from sua LIMIT $offset, $rowsPerPage";
        $result = mysqli_query($con,$query);
        $numRows= mysqli_num_rows($result);
        $maxPage = ceil($numRows / $rowsPerPage);
        if ($numRows > 0) {
            echo "<table>
                    <tr class='title'>
                        <th>Số TT</th>
                        <th>Tên sữa</th>
                        <th>Hãng sữa</th>
                        <th>Loại sữa</th>
                        <th>Trọng lượng</th>
                        <th>Đơn giá</th>
                    <tr>";
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
                // lấy tên hãng sữa từ bảng hãng sữa
                $queryHS = "SELECT Ten_hang_sua FROM hang_sua WHERE Ma_hang_sua='".$row['Ma_hang_sua']."'";
                $tenHS = "";
                $result1 = $con->query($queryHS);
                if ($result1->num_rows > 0) {
                    while ($row1 = mysqli_fetch_array($result1)) {
                        $tenHS = $row1["Ten_hang_sua"];
                    }
                }
                // end
                // lấy tên loại sữa từ bảng loại sữa
                $queryLS = "SELECT Ten_loai FROM loai_sua WHERE Ma_loai_sua='".$row['Ma_loai_sua']."'";
                $tenLS = "";
                $result2 = $con->query($queryLS);
                if ($result2->num_rows > 0) {
                    while ($row2 = mysqli_fetch_array($result2)) {
                        $tenLS = $row2["Ten_loai"];
                    }
                }
                // end
                echo "<tr>
                        <td class='gender'>".$count."</td>
                        <td>".$row['Ten_sua']."</td>
                        <td>".$tenHS."</td>
                        <td>".$tenLS."</td>
                        <td>".$row['Trong_luong']." gram</td>
                        <td>".number_format($row['Don_gia'], 0, '.', '.')." VND</td>
                      </tr>";
                $count++;
            }
            echo "</table>";
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
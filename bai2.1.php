<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2.1</title>
    <style>
        body {
            text-align: center;
        }
        table, td, th {
            border: 1px solid black;
            margin-left: 400px;
            margin-top: 20px;
        }
        td {
            padding: 5px;
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
    <h2>THÔNG TIN HÃNG SỮA</h2>
    <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "ql_bansua";
        $con = mysqli_connect($serverName, $userName, $password, $dbName);
        if (!$con) {
            die("Connect Fail: ".mysqli_connect_error());
        }
        $sql = "SELECT * FROM hang_sua";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Mã HS</th>
                        <th>Tên hãng sữa</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                    <tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                        <td>".$row['Ma_hang_sua']."</td>
                        <td>".$row['Ten_hang_sua']."</td>
                        <td>".$row['Dia_chi']."</td>
                        <td>".$row['Dien_thoai']."</td>
                        <td>".$row['Email']."</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<span>Không có bảng ghi nào.</span>";
        }
        mysqli_close($con);
    ?>
</body>
</html>
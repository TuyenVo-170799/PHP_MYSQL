<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2.2</title>
    <style>
        body {
            text-align: center;
        }
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
            margin-left: 400px;
            margin-top: 20px;
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
    <h2>THÔNG TIN KHÁCH HÀNG</h2>
    <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "ql_bansua";
        $con = mysqli_connect($serverName, $userName, $password, $dbName);
        if (!$con) {
            die("Connect Fail: ".mysqli_connect_error());
        }
        $sql = "SELECT * FROM Khach_hang";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr class='title'>
                        <th>Mã KH</th>
                        <th>Tên khách hàng</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                    <tr>";
            while ($row = mysqli_fetch_array($result)) {
                if ($row['Phai'] == 1) {
                    $gender = "male.webp";
                } else {
                    $gender = "female.jpg";
                }
                echo "<tr>
                        <td>".$row['Ma_khach_hang']."</td>
                        <td>".$row['Ten_khach_hang']."</td>
                        <td class='gender'>".$row['Phai']."</td>
                        <td>".$row['Dia_chi']."</td>
                        <td>".$row['Dien_thoai']."</td>
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
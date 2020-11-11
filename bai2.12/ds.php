<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
        body {
            margin: 0;
            padding-top: 60px;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 5px;
        }
        th {
            background-color: #cfd8dc;
        }
    </style>
</body>
    <?php
        // Hàm connect database
        function getConnection() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test1";
            $conn = new mysqli($servername, $username, $password, $dbname);
            return $conn;
        }
    ?>
    <h2>THÔNG TIN KHÁCH HÀNG</h2>
    <table>
        <tr>
            <th>Mã KH</th>
            <th>Tên khách hàng</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        <?php
            $sql = "SELECT * FROM khach_hang";
            $result = mysqli_query(getConnection(), $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows > 0) {
                // Lấy data từng row
                while($row = mysqli_fetch_array($result)) {
                    if ($row['Phai'] == 1) {
                        $gt = "Nữ";
                    } else {
                        $gt = "Nam";
                    }
                    echo "<tr>
                            <td>".$row['Ma_khach_hang']."</td>
                            <td>".$row['Ten_khach_hang']."</td>
                            <td>".$gt."</td>
                            <td>".$row['Dia_chi']."</td>
                            <td>".$row['Dien_thoai']."</td>
                            <td>".$row['Email']."</td>
                            <td>
                                <a href='xoa.php?deleteId=".$row['Ma_khach_hang']."'>Xóa</a>
                                <a href='sua.php?editId=".$row['Ma_khach_hang']."'>Sửa</a>
                            </td>
                          </tr>";
                }
            }
            mysqli_close(getConnection());
        ?>
    </table>
</html>
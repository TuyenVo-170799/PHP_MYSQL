<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách</title>
    <style>
        body {
            margin: 0;
            padding-top: 60px;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            width: 50%;
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
</head>
<body>
    <?php
        // Hàm connect database
        function getConnection() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qlsv1";
            $conn = new mysqli($servername, $username, $password, $dbname);
            return $conn;
        }

        // Hàm lấy tên lớp dựa vào mã lớp
        function getClassName($maLop) {
            $sql = "SELECT TenLop FROM lop WHERE MaLop=$maLop";
            $result = mysqli_query(getConnection(), $sql);
            // trả về số row query được
            $numRows = mysqli_num_rows($result);
            $tenLop = "";
            if ($numRows > 0) {
                while($row = mysqli_fetch_array($result)) {
                    $tenLop = $row['TenLop'];
                }
            }
            mysqli_close(getConnection());
            return $tenLop;
        }

        // Hàm xóa sinh viên theo id sv
        function deleteStudent($maSV) {
            $thongBao = "";
            $sql = "DELETE FROM sinhvien WHERE MaSV=$maSV";
            if (mysqli_query(getConnection() ,$sql)) {
                $thongBao = "Xóa thành công!";
            } else {
                $thongBao = "Xóa không thành công.";
            }
            mysqli_close(getConnection());
            return $thongBao;
        }

        // Xử lý xóa 1 bảng ghi
        if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
            $thongBao = deleteStudent($_GET['deleteId']);
        }
    ?>
    <h2>DANH SÁCH SINH VIÊN</h2>
    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Ngày Sinh</th>
            <th>Lớp</th>
            <th>Thao Tác</th>
        </tr>
        <?php
            $sql = "SELECT MaSV, HoTen, NgaySinh, MaLop FROM sinhvien";
            $result = mysqli_query(getConnection(), $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows > 0) {
                // Lấy data từng row
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                            <td>".$row['MaSV']."</td>
                            <td>".$row['HoTen']."</td>
                            <td>".$row['NgaySinh']."</td>
                            <td>".getClassName($row['MaLop'])."</td>
                            <td>
                                <a href='danh-sach.php?deleteId=".$row['MaSV']."'>Xóa</a>
                                <a href='sua.php?editId=".$row['MaSV']."'>Sửa</a>
                            </td>
                          </tr>";
                }
            }
            mysqli_close(getConnection());
        ?>
    </table>
</body>
</html>
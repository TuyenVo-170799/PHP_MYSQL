<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới</title>
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
            padding: 10px 20px 5px 10px;
        }
        th {
            background-color: #ec407a;
        }
        td {
            background-color: #f8bbd0;
        }
        input[type=submit] {
            margin-left: 120px;
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

        // Xử lý thêm mới
        if (isset($_GET['submit'])) {
            if (isset($_GET['maSV']) && isset($_GET['hoTen']) && isset($_GET['ngaySinh']) && isset($_GET['lop'])) {
                $maSV = $_GET['maSV'];
                $hoTen = $_GET['hoTen'];
                $ngaySinh = $_GET['ngaySinh'];
                $lop = $_GET['lop'];
                $sql = "INSERT INTO sinhvien (MaSV, HoTen, NgaySinh, MaLop) VALUES ('$maSV', '$hoTen', '$ngaySinh', '$lop')";
                mysqli_query(getConnection(), $sql);
                mysqli_close(getConnection());
                header('Location: danh-sach.php');
            }
        }
    ?>
    <form action="" method="get">
        <table>
            <tr>
                <th colspan="2">THÊM SINH VIÊN</th>
            </tr>
            <tr>
                <td>Mã sinh viên:</td>
                <td><input type="text" name="maSV"></td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoTen"></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name="ngaySinh"></td>
            </tr>
            <tr>
                <td>Lớp:</td>
                <td>
                    <select name="lop">
                    <?php
                        $query="Select * from lop";
                        $result = mysqli_query(getConnection(), $query);
                        $numRows= mysqli_num_rows($result);
                        if ($numRows > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="'.$row['MaLop'].'">'.$row['TenLop'].'</option>';
                            }
                        }
                        mysqli_close(getConnection());
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Thêm mới"></td>
            </tr>
        </table>
    </form>
</body>
</html>
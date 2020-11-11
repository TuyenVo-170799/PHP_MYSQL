<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa</title>
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

        // Xử lý hiển thị sửa
        $maSV = $hoTen = $ngaySinh = $maLop = "";
        if (isset($_GET['editId']) && !empty($_GET['editId'])) {
            $sql = "SELECT * FROM sinhvien WHERE MaSV=".$_GET['editId'];
            $result = mysqli_query(getConnection(), $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $maSV = $row['MaSV'];
                    $hoTen = $row['HoTen'];
                    $ngaySinh = $row['NgaySinh'];
                    $maLop = $row['MaLop']; 
                }
            }
            mysqli_close(getConnection());
        }
        
        // Xử lý sửa bảng ghi
        if (isset($_GET['submit'])) {
            if (isset($_GET['maSV']) && isset($_GET['hoTen']) && isset($_GET['ngaySinh']) && isset($_GET['lop'])) {
                $ma = $_GET['maSV'];
                $ten = $_GET['hoTen'];
                $ns = $_GET['ngaySinh'];
                $lop = $_GET['lop'];
                $sql = "UPDATE sinhvien SET MaSV=$ma, HoTen='$ten', NgaySinh='$ns', MaLop='$lop' WHERE MaSV=".$_GET['ID'];
                if (mysqli_query(getConnection(), $sql)) {
                    header('Location: danh-sach.php');
                } else {
                    header('Location: sua.php?editId='.$_GET['ID']);
                }
            }
        }
    ?>
    <form action="" method="get">
        <input type="hidden" name="ID" value="<?php if (isset($_GET['editId'])) echo $_GET['editId']; ?>">
        <table>
            <tr>
                <th colspan="2">SỬA SINH VIÊN</th>
            </tr>
            <tr>
                <td>Mã sinh viên:</td>
                <td><input type="text" name="maSV" value="<?php if (isset($maSV)) echo $maSV; ?>"></td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoTen" value="<?php if (isset($hoTen)) echo $hoTen; ?>"></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name="ngaySinh" value="<?php if (isset($ngaySinh)) echo $ngaySinh; ?>"></td>
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
                                    if ($maLop == $row['MaLop']) {
                                        echo '<option value="'.$row['MaLop'].'" selected="selected">'.$row['TenLop'].'</option>';    
                                    } else {
                                    echo '<option value="'.$row['MaLop'].'">'.$row['TenLop'].'</option>';
                                    }
                                }
                            }
                            mysqli_close(getConnection());
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Lưu"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        .back {
            margin-left: 570px;
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
            $dbname = "test1";
            $conn = new mysqli($servername, $username, $password, $dbname);
            return $conn;
        }

        // Xử lý hiển thị sửa
        $maKH = $tenKH = $phai = $diaChi = $dienThoai = $email = "";
        if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
            $id = $_GET['deleteId'];
            $sql = "SELECT * FROM khach_hang WHERE Ma_khach_hang='$id'";
            $result = mysqli_query(getConnection(), $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $maKH = $row['Ma_khach_hang'];
                    $tenKH = $row['Ten_khach_hang'];
                    $phai = $row['Phai'];
                    $diaChi = $row['Dia_chi'];
                    $dienThoai = $row['Dien_thoai']; 
                    $email = $row['Email'];
                }
            }
            mysqli_close(getConnection());
        }
        
         // Hàm xóa id
         function delete($ma) {
            $thongBao = "";
            $sql = "DELETE FROM khach_hang WHERE Ma_khach_hang='$ma'";
            if (mysqli_query(getConnection() ,$sql)) {
                $thongBao = "Xóa thành công!";
            } else {
                $thongBao = "Xóa không thành công.";
            }
            mysqli_close(getConnection());
            return $thongBao;
        }

        // Xử lý xóa 1 bảng ghi
        if (isset($_GET['submit'])) {
            if (isset($_GET['ID']) && !empty($_GET['ID'])) {
                $thongBao = delete($_GET['ID']);
                header('Location: ds.php');
            }
        }
    ?>
    <form action="" method="get">
        <input type="hidden" name="ID" value="<?php if (isset($_GET['deleteId'])) echo $_GET['deleteId']; ?>">
        <table>
            <tr>
                <th colspan="2">CẬP NHẬT THÔNG TIN KHÁCH HÀNG</th>
            </tr>
            <tr>
                <td>Mã khách hàng:</td>
                <td><input type="text" name="maKH" value="<?php if (isset($maKH)) echo $maKH; ?>" readonly></td>
            </tr>
            <tr>
                <td>Tên khách hàng:</td>
                <td><input type="text" name="tenKH" size="30" value="<?php if (isset($tenKH)) echo $tenKH; ?>" readonly></td>
            </tr>
            <tr>
                <td>Phái:</td>
                <td>
                    <input type="radio" name="phai" value="0" <?php if (isset($phai) && $phai == 0) echo "checked"; else echo "disabled"; ?>> Nam
                    <input type="radio" name="phai" value="1" <?php if (isset($phai) && $phai == 1) echo "checked"; else echo "disabled"; ?>> Nữ
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input type="text" name="diaChi" size="30" value="<?php if (isset($diaChi)) echo $diaChi; ?>" readonly></td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td><input type="text" name="dienThoai" value="<?php if (isset($dienThoai)) echo $dienThoai; ?>" readonly></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" size="30" value="<?php if (isset($email)) echo $email; ?>" readonly></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Xóa"></td>
            </tr>
        </table>
    </form>
    <a class="back" href="ds.php">Quay về --></a>
</body>
</html>
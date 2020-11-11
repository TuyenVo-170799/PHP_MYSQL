<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding-top: 50px;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;   
            width: 50%;
        }
        td, th {
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
    <h2>DANH SÁCH SINH VIÊN</h2>
    <?php
        // Hàm connect database
        function ketNoiCSDL() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qlsv";
            $conn = new mysqli($servername, $username, $password, $dbname);
            return $conn;
        }

        // Hàm lấy tên lớp dựa vào mã lớp
        function layTenLop($maLop) {
            $sql = "SELECT TenLop FROM lop WHERE ID=$maLop";
            $result = mysqli_query(ketNoiCSDL(), $sql);
            // trả về số row query được
            $numRows = mysqli_num_rows($result);
            $tenLop = "";
            if ($numRows > 0) {
                while($row = mysqli_fetch_array($result)) {
                    $tenLop = $row['TenLop'];
                }
            }
            mysqli_close(ketNoiCSDL());
            return $tenLop;
        }

        // Hàm xóa sinh viên theo id sv
        function xoaSV($maSV) {
            $thongBao = "";
            $sql = "DELETE FROM sinhvien WHERE ID=$maSV";
            if (mysqli_query(ketNoiCSDL() ,$sql)) {
                $thongBao = "Xóa thành công!";
            } else {
                $thongBao = "Xóa không thành công.";
            }
            mysqli_close(ketNoiCSDL());
            return $thongBao;
        }

        // Xử lý xóa 1 bảng ghi
        if (isset($_GET['deleteID']) && !empty($_GET['deleteID'])) {
            $thongBao = xoaSV($_GET['deleteID']);
        }
        
        // Xử lý khi vào trang
        $sql = "SELECT ID, HoTen, NgaySinh, MaLop FROM sinhvien";
        $result = mysqli_query(ketNoiCSDL(), $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows > 0) {
            echo "<table>
                    <tr>
                        <th>Mã SV</th>
                        <th>Họ Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Lớp</th>
                        <th>Thao Tác</th>
                    </tr>";
            // Lấy data từng row
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>
                        <td>".$row['ID']."</td>
                        <td>".$row['HoTen']."</td>
                        <td>".$row['NgaySinh']."</td>
                        <td>".layTenLop($row['MaLop'])."</td>
                        <td>
                            <a href='test1.php?deleteID=".$row['ID']."'>Xóa</a>
                            <a href='edit.php?editID=".$row['ID']."'>Sửa</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
          echo "0 results";
        }
        mysqli_close(ketNoiCSDL());
    ?>   
</body>
</html>
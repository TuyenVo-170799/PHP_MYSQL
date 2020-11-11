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
        }
        form {
            margin: auto;
            width: 20%;
            border: 1px solid black;
            padding: 5px;
        }
        .form-group {
            display: flex;
            flex-flow: row wrap;
            margin-bottom: 5px;
        }
        label {
            width: 30%;
        }
        input[type=submit] {
            width: 100%;
        }
    </style>
</head>
<body>
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
        $hoTen = $ngaySinh = $maLop = "";
        
        // Xử lý hiển thị edit
        if (isset($_GET['editID']) && !empty($_GET['editID'])) {
            $sql = "SELECT * FROM sinhvien WHERE ID=".$_GET['editID'];
            $result = mysqli_query(ketNoiCSDL(), $sql);
            $numRows = mysqli_num_rows($result);
            if ($numRows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $hoTen = $row['HoTen'];
                    $ngaySinh = $row['NgaySinh'];
                    $maLop = $row['MaLop']; 
                }
            }
        }
        // Xử lý sửa bảng ghi
        if (isset($_GET['submit'])) {
            if (isset($_GET['hoTen']) && isset($_GET['ngaySinh']) && isset($_GET['lop']) && isset($_GET['ID'])) {
                $ten = $_GET['hoTen'];
                $ns = $_GET['ngaySinh'];
                $lop = $_GET['lop'];
                $sql = "UPDATE sinhvien SET HoTen='$ten', NgaySinh='$ns', MaLop='$lop' WHERE ID=".$_GET['ID'];
                if (mysqli_query(ketNoiCSDL(), $sql)) {
                    header('Location: test1.php');
                } else {
                    header('Location: edit.php?editID='.$_GET['ID']);
                }
            }
        }
    ?>
    <form action="" method="get">
        <input type="hidden" name="ID" value="<?php if (isset($_GET['editID'])) echo $_GET['editID']; ?>">
        <div class="form-group">
            <label>Họ tên: </label>
            <input type="text" name="hoTen" value="<?php if (isset($hoTen)) echo $hoTen; ?>">
        </div>
        <div class="form-group">
            <label>Ngày sinh: </label>
            <input type="date" name="ngaySinh" value="<?php if (isset($ngaySinh)) echo $ngaySinh; ?>">
        </div>
        <div class="form-group">
            <label>Lớp: </label>
            <select name="lop" id="lop">
                <?php
                    $query="Select * from lop";
                    $result = mysqli_query(ketNoiCSDL(), $query);
                    $numRows= mysqli_num_rows($result);
                    if ($numRows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            if ($maLop == $row['ID']) {
                                echo '<option value="'.$row['ID'].'" selected="selected">'.$row['TenLop'].'</option>';    
                            } else {
                                echo '<option value="'.$row['ID'].'">'.$row['TenLop'].'</option>';
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <input type="submit" name="submit" value="Lưu">
    </form>
</body>
</html>
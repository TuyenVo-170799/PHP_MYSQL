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
        if (isset($_GET['submit'])) {
            if (isset($_GET['hoTen']) && isset($_GET['ngaySinh']) && isset($_GET['lop'])) {
                $ten = $_GET['hoTen'];
                $ns = $_GET['ngaySinh'];
                $lop = $_GET['lop'];
                $sql = "INSERT INTO sinhvien (HoTen, NgaySinh, MaLop) VALUES ('$ten', '$ns', '$lop')";
                if (mysqli_query(ketNoiCSDL(), $sql)) {

                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
                mysqli_close(ketNoiCSDL());
            }
            header('Location: test1.php');
        }
    ?>
    <form action="" method="get">
        <div class="form-group">
            <label>Họ tên: </label>
            <input type="text" name="hoTen">
        </div>
        <div class="form-group">
            <label>Ngày sinh: </label>
            <input type="date" name="ngaySinh">
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
                            echo '<option value="'.$row['ID'].'">'.$row['TenLop'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <input type="submit" name="submit" value="Đăng ký">
    </form>
</body>
</html>
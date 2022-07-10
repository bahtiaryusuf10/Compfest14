<?php
session_start();
include("connectdb.php");

/* CREATE STUDENT ACCOUNT */
if (isset($_POST['name_student'])) {
    $name = $_POST['name_student'];
    $id = $_POST['id_student_reg'];
    $password = $_POST['password_reg'];
    $epassword = password_hash($password, PASSWORD_DEFAULT);

    $rem = 0;
    (int)$tempId = (int)$id / 100;
    $leftSide = 0;
    $rightSide = (int)$id % 100;

    for ($i = 0; $i < 3; $i++) {
        $rem = $tempId % 10;
        $leftSide += $rem;
        $tempId /= 10;
    }

    if ($leftSide == $rightSide) {
        $query0 = "SELECT * FROM siswa WHERE id_siswa = $id";
        $result0 = mysqli_query($conn, $query0);

        if (mysqli_num_rows($result0) < 1) {
            $query1 = "INSERT INTO siswa(id_siswa, nama_siswa, password) VALUES('$id', '$name', '$epassword')";
            $result1 = mysqli_query($conn, $query1);

            if ($result1) {
                header("location: login.php");
            }
        } else {
            echo "
                <script>
                    alert('Failed to register, ID already exists!')
                    document.location.href = 'signup.php';
                </script>
                ";
        }
    } else {
        echo "
                <script>
                    alert('Failed to register, ID is not qualified!')
                    document.location.href = 'signup.php';
                </script>
                ";
    }
}

/* LOGIN ACCOUNT */
if (isset($_POST['id_student_log'])) {
    $id = $_POST['id_student_log'];
    $password = $_POST['password_log'];

    $query = "SELECT * FROM siswa WHERE id_siswa = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    $password0 = $data['password'];

    if (password_verify($password, $password0)) {
        echo $data['id_siswa'] . $data['password'];

        $_SESSION['id'] = $data['id_siswa'];
        $_SESSION['nama'] = $data['nama_siswa'];

        setcookie("message", "", time() - 60);
        header("location: student.php");
    } else {
        setcookie("message", "Sorry, username or password is incorrect.", time() + 60);
        header("location: login.php");
    }
}

/* FOR WITHDRAW BALANCE */
if (isset($_GET['id_item_delete'])) {
    $id_item = $_GET['id_item_delete'];
    $id_student = $_SESSION['id'];

    $query1 = "SELECT harga_produk FROM toko WHERE id_produk = '$id_item' AND id_siswa = '$id_student'";
    $check1 = mysqli_query($conn, $query1);
    $data1 = mysqli_fetch_array($check1);

    $query2 = "SELECT saldo_toko FROM saldo WHERE id_saldo = 10";
    $check2 = mysqli_query($conn, $query2);
    $data2 = mysqli_fetch_array($check2);

    if ($data2['saldo_toko'] >= $data1['harga_produk']) {
        $query3 = "DELETE FROM toko WHERE id_produk = '$id_item' AND id_siswa = '$id_student'";
        $result = mysqli_query($conn, $query3);

        if ($result) {
            echo "
            <script>
            alert('Withdrawal successfull!')
                document.location.href = 'information.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Withdrawal failed!')
                document.location.href = 'information.php';
            </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Failed, withdrawal amount exceeds current balance!')
                document.location.href = 'information.php';
            </script>
            ";
    }
}

/* ADD BALANCE TO THE CANTEEN */
if (isset($_POST['add_balance'])) {
    $balance = $_POST['store_balance'];

    $query = "UPDATE saldo SET saldo_toko = saldo_toko + $balance WHERE id_saldo = 10";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "
            <script>
                alert('Balance increase!')
                document.location.href = 'student.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Failed to add!')
                document.location.href = 'student.php';
            </script>
            ";
    }
}

/* ADD ITEM */
if (isset($_POST['add_product'])) {
    $id_student = $_SESSION['id'];
    $name = $_POST['product_name'];
    $desc = $_POST['description_product'];
    $price = $_POST['product_price'];
    $tmp_file = $_FILES['fupload']['tmp_name'];
    $nm_file = $_FILES['fupload']['name'];
    $ukuran_file = $_FILES['fupload']['size'];

    $size = 10000000;

    if ($nm_file) {
        $dir = "file/$nm_file";
        move_uploaded_file($tmp_file, $dir);

        $query = "INSERT INTO toko(id_siswa, nama_produk, gambar_produk, deskripsi_produk, harga_produk, status) VALUES ('$id_student', '$name', '$nm_file', '$desc', '$price', 'dijual')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "
                <script>
                    alert('Item added successfully!');
                    document.location.href = 'student.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('Failed to add!');
                    document.location.href = 'student.php';
                </script>
                ";
        }
    }
}

/* BUY ITEM FROM THE CANTEEN */
if (isset($_GET['id_product'])) {
    $id = $_GET['id_product'];

    $query = "UPDATE toko SET status = 'dibeli' WHERE id_produk = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "
            <script>
                alert('Successfully purchased!')
                document.location.href = 'student.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Purchase failed!')
                document.location.href = 'student.php';
            </script>
            ";
    }
}

/* READ THE CANTEEN BALANCE */
function readBalance()
{
    global $conn;

    $query = "SELECT saldo_toko FROM saldo";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    return $row;
}

function readIncome()
{
    global $conn;
    $id_student = $_SESSION['id'];

    $query = "SELECT SUM(harga_produk) AS total_income FROM toko WHERE id_siswa = '$id_student' AND status = 'dibeli'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    return $row;
}

/* READ ALL ITEM IN THE CANTEEN */
function readProduct1()
{
    global $conn;

    $query = "SELECT * FROM toko WHERE status = 'dijual'";
    $result = mysqli_query($conn, $query);

    $records = [];
    while ($record = mysqli_fetch_assoc($result)) {
        $records[] = $record;
    }

    return $records;
}

/* READ ALL ITEM IN THE CANTEEN WITH SORT */
function readProduct2()
{
    global $conn;

    if ($_GET['type'] == 'an') {
        $query = "SELECT * FROM toko WHERE status = 'dijual' ORDER BY nama_produk ASC";
        $result = mysqli_query($conn, $query);
    } else if ($_GET['type'] == 'dn') {
        $query = "SELECT * FROM toko WHERE status = 'dijual' ORDER BY nama_produk DESC";
        $result = mysqli_query($conn, $query);
    } else if ($_GET['type'] == 'at') {
        $query = "SELECT * FROM toko WHERE status = 'dijual' ORDER BY waktu_produk_ditambahkan ASC";
        $result = mysqli_query($conn, $query);
    } else if ($_GET['type'] == 'dt') {
        $query = "SELECT * FROM toko WHERE status = 'dijual' ORDER BY waktu_produk_ditambahkan DESC";
        $result = mysqli_query($conn, $query);
    }

    $records = [];
    while ($record = mysqli_fetch_assoc($result)) {
        $records[] = $record;
    }

    return $records;
}

/* READ ALL ITEM IN THE CANTEEN BY USER */
function readProduct3()
{
    global $conn;
    $id_student = $_SESSION['id'];

    $query = "SELECT * FROM toko WHERE id_siswa = '$id_student' AND status = 'dijual'";
    $result = mysqli_query($conn, $query);

    $records = [];
    while ($record = mysqli_fetch_assoc($result)) {
        $records[] = $record;
    }

    return $records;
}

/* READ ALL ITEM SOLD */
function readProduct4()
{
    global $conn;
    $id_student = $_SESSION['id'];

    $query = "SELECT * FROM toko WHERE id_siswa = '$id_student' AND status = 'dibeli'";
    $result = mysqli_query($conn, $query);

    $records = [];
    while ($record = mysqli_fetch_assoc($result)) {
        $records[] = $record;
    }

    return $records;
}

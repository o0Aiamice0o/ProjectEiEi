<?php 
    session_start();
    require_once "config/db.php";


    if (isset($_POST['update'])) {

        $customername = $_POST['customername'];
        $testmachine = $_POST['testmachine'];
        $model = $_POST['model'];
        $serialnum = $_POST['serialnum'];
        $brand = $_POST['brand'];
        $nextcal = $_POST['nextcal'];
        $email = $_POST['email'];

    }

    $sql = $conn->prepare("UPDATE bbcal1 SET customername = :customername, 
                testmachine = :testmachine, 
                model = :model, 
                serialnum = :serialnum, 
                brand = :brand, 
                nextcal = :nextcal, 
                email = :email 
                WHERE id = :id");


    $sql->bindParam(":id", $id);
    $sql->bindParam(":customername", $customername);
    $sql->bindParam(":testmachine", $testmachine);
    $sql->bindParam(":model", $model);
    $sql->bindParam(":serialnum", $serialnum);
    $sql->bindParam(":brand", $brand);
    $sql->bindParam(":nextcal", $nextcal);
    $sql->bindParam(":email", $email);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been updated succesfully";
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'success',
                    text: 'ข้อมูลอัพเดตเสร็จสิ้น!',
                    icon: 'success',
                    timer: 5000,
                    showConfirmButton: false
                });
            })
        </script>";
        header("refresh:2; url=index.php");
    }else{
        $_SESSION['error'] = "Data has not been updated succesfully";
        header("location: index.php");
    }

?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
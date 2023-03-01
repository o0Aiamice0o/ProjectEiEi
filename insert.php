<?php 
    session_start();
    require_once "config/db.php";

    if (isset($_POST['submit'])) {
        $customername = $_POST['customername'];
        $testmachine = $_POST['testmachine'];
        $model = $_POST['model'];
        $serialnum = $_POST['serialnum'];
        $brand = $_POST['brand'];
        $nextcal = $_POST['nextcal'];
        $email = $_POST['email'];


        // $sql = $conn->prepare("INSERT INTO bbcal1(customername, testmachine, model, serialnum, brand, setupdate, calidate, nextcal, califreq, email) 
        //                 VALUES(:customername, :testmachine, :model, :serialnum, :brand, :setupdate, :calidate, :nextcal, :califreq, :email)");

        $sql = $conn->prepare("INSERT INTO bbcal1 (customername, testmachine, model, serialnum, brand, nextcal, datealert,  email, status)
        VALUES (:customername, :testmachine, :model, :serialnum, :brand,  :nextcal, DATE_ADD(:nextcal, INTERVAL -30 DAY),  :email, :status)");

            $sql->bindParam(":customername", $customername);
            $sql->bindParam(":testmachine", $testmachine);
            $sql->bindParam(":model", $model);
            $sql->bindParam(":serialnum", $serialnum);
            $sql->bindParam(":brand", $brand);
            $sql->bindParam(":nextcal", $nextcal);
            $sql->bindParam(":datealert", $datealert);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":status", $status);
            $status = "ยังไม่ได้ส่ง";
            $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been inserted successfully";
                echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title:'success',
                            text: 'Data inserted successfully!',
                            icon: 'success',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "Data has not been inserted successfully";
            header("location: index.php");
        }
    }
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

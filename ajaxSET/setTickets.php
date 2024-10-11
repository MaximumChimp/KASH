<?php
    require_once '../include/connection.php';
    session_start();

    if(isset($_POST['TYPE'])){
        if($_POST['TYPE'] =='setTicket'){
            $sql = "INSERT INTO
                        KASH_TICKETS_M 
                            (
                            KASH_TICKETS_M.TITLE,
                            KASH_TICKETS_M.DESCRIPTION,
                            KASH_TICKETS_M.PRIORITY,
                            KASH_TICKETS_M.CATEGORY,
                            KASH_TICKETS_M.STATUS,
                            KASH_TICKETS_M.TAGS,
                            KASH_TICKETS_M.REPORTED_BY
                            )
                            VALUES
                            (
                                ? ,
                                ? ,
                                ? ,
                                ? ,
                                ? ,
                                ? ,
                                ? 
                            )
                        ";      
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss" ,   $SUBJECT ,
                                        $COMMENT ,
                                        $PRIORITY,
                                        $CATEGORY,
                                        $STATUS,
                                        $TAGS,
                                        $REQUESTER
                                    ); 
            $SUBJECT = $_POST["SUBJECT"];
            $COMMENT = $_POST["COMMENT"];
            $PRIORITY = $_POST["PRIORITY"];
            $CATEGORY = $_POST["CATEGORY"];
            $STATUS = $_POST["STATUS"];
            $REQUESTER = $_POST["REQUESTER"];
            $TAGS = $_POST["TAGS"];
            
            if ($stmt->execute()){ 
                $stmt->close();
            } else {
                $stmt->close();
                mysqli_rollback($conn);
                mysqli_close($conn);
                http_response_code(400);
                die("Transaction Error!");
            }
        }
    }
?>
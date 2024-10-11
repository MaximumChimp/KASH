<?php
    require_once '../include/connection.php';
    session_start();

    if (isset($_GET["TODO"])) {
        if ($_GET["TODO"] === "getUser") {
            $sql = "SELECT USERS.USERID as USERNAME
                    FROM USERS
                    WHERE 
                        USERS.FLG = 1
                    ORDER BY USERS.USERID ASC";

            $stmt = $conn->prepare($sql);
            $rows = array();
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($r = $result->fetch_assoc()) {
                   
                    $rows[] = $r;
                }
            }
            mysqli_close($conn);
            echo json_encode($rows);
        }

         /*
        / ******************************************************************************
        / this is reserved for later use                      
        / ******************************************************************************
        /    else if ($_GET['TODO'] === "getYourUnsolvedTickets") {
        /    $sql = "SELECT
        /                KASH_TICKETS_M.TITLE,
        /                KASH_TICKETS_M.STATUS,
        /                KASH_TICKETS_M.REPORTED_BY,
        /                KASH_TICKETS_M.CATEGORY,
        /                KASH_TICKETS_M.PRIORITY 
        /            FROM KASH_TICKETS_M
        /                LEFT JOIN users ON KASH_TICKETS_M.ASSIGNED_TO = USERS.userid 
        /            WHERE 
        /                USERS.FLG = 1
        /                AND KASH_TICKETS_M.STATUS != '5'
        /            ORDER BY KASH_TICKETS_M.TICKET_ID";
        /
        /    $stmt = $conn->prepare($sql);
        /    $stmt->bind_param('s', $USERID);
        /    $rows = array();
        /
        /    $USERID = $_SESSION['userID'];
        /    // Acquire data
        /    if ($stmt->execute()) {
        /        $result = $stmt->get_result();
        /        while ($r = $result->fetch_assoc()) {
        /            $rows[] = $r;
        /        }
        /    }
        /    mysqli_close($conn);
        /    echo json_encode($rows);
        / }
        / *****************************************************************************
        */
        


        /*
        / *****************************************************
        / this is reserved for later use                      
        / *****************************************************
        /
        / else if ($_GET['TODO'] === "getUnassignedTickets") {
        /    $sql = "SELECT
        /                KASH_TICKETS_M.TITLE,
        /                KASH_TICKETS_M.STATUS,
        /                KASH_TICKETS_M.REPORTED_BY,
        /                KASH_TICKETS_M.CATEGORY,
        /                KASH_TICKETS_M.PRIORITY 
        /            FROM KASH_TICKETS_M
        /            WHERE
        /                KASH_TICKETS_M.ASSIGNED_TO = '-'
        /            ORDER BY KASH_TICKETS_M.TICKET_ID";
        /
        /    $stmt = $conn->prepare($sql);
        /    $rows = array();
        /    
        /    $USERID = $_SESSION['userID'];
        /    // Acquire data
        /    if ($stmt->execute()) {
        /        $result = $stmt->get_result();
        /        while ($r = $result->fetch_assoc()) {
        /            $rows[] = $r;
        /        }
        /    }
        /    mysqli_close($conn);
        /    echo json_encode($rows);
        / }
        / *****************************************************
        */
        else if ($_GET['TODO'] === "getAllUnsolvedTickets") {
            $sql = "SELECT
                        KASH_TICKETS_M.TITLE,
                        KASH_TICKETS_M.STATUS,
                        KASH_TICKETS_M.REPORTED_BY,
                        KASH_TICKETS_M.CATEGORY,
                        KASH_TICKETS_M.PRIORITY 
                    FROM KASH_TICKETS_M
                    WHERE
                        KASH_TICKETS_M.STATUS !='5'
                    ORDER BY KASH_TICKETS_M.TICKET_ID DESC
                    ";

            $stmt = $conn->prepare($sql);
            $rows = array();

            $USERID = $_SESSION['userID'];
            // Acquire data
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($r = $result->fetch_assoc()) {
                    $rows[] = $r;
                }
            }
            mysqli_close($conn);
            echo json_encode($rows);
        }
        else if ($_GET['TODO'] === "getPendingTickets") {
            $sql = "SELECT
                        KASH_TICKETS_M.TITLE,
                        KASH_TICKETS_M.STATUS,
                        KASH_TICKETS_M.REPORTED_BY,
                        KASH_TICKETS_M.CATEGORY,
                        KASH_TICKETS_M.PRIORITY 
                    FROM KASH_TICKETS_M
                    WHERE
                        KASH_TICKETS_M.STATUS ='4'
                    ORDER BY KASH_TICKETS_M.TICKET_ID
                    
                ";

            $stmt = $conn->prepare($sql);
            $rows = array();

            $USERID = $_SESSION['userID'];
            // Acquire data
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($r = $result->fetch_assoc()) {
                    $rows[] = $r;
                }
            }
            mysqli_close($conn);
            echo json_encode($rows);
        }
        else if ($_GET['TODO'] === "getTicketTags") {
            $sql = "SELECT
                        KASH_TICKETS_M.TAGS
                    FROM KASH_TICKETS_M
                    WHERE
                        KASH_TICKETS_M.TAGS != ''
                    ORDER BY KASH_TICKETS_M.TAGS ASC";

            $stmt = $conn->prepare($sql);
            $rows = array();
            // Acquire data
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($r = $result->fetch_assoc()) {
                    $rows[] = $r;
                }
            }
            mysqli_close($conn);
            echo json_encode($rows);
        }
    }
?>

<?php
    namespace Midtrans;
    
    require_once("./conn.php");
    require_once ("./midtrans/Midtrans.php");
    Config::$isProduction = false;
    Config::$serverKey = 'SB-Mid-server-qTRpnM1XKpZzUn5SR-NjGBRl';

    try {
        $notif = new Notification();
    }
    catch (\Exception $e) {
        exit($e->getMessage());
    }

    $notif->getResponse();
    $transaction = $notif->transaction_status;
    $type = $notif->payment_type;
    $order_id = $notif->order_id;
    $fraud = $notif->fraud_status;

    // $idHtrans = $_SESSION["idHtrans"];
    $idHtrans = $order_id;
    if ($transaction == 'capture') {
        // For credit card transaction, we need to check whether transaction is challenge by FDS or not
        if ($type == 'credit_card') {
            if ($fraud == 'challenge') {
                // TODO set payment status in merchant's database to 'Challenge by FDS'
                // TODO merchant should decide whether this transaction is authorized or not in MAP
                echo "Transaction order_id: " . $order_id ." is challenged by FDS";
            } else {
                // TODO set payment status in merchant's database to 'Success'
                echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
            }
        }
    } else if ($transaction == 'settlement') {
        // TODO set payment status in merchant's database to 'Settlement'
        $status = "In Process";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $status, $idHtrans);
        $stmt->execute();
        echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
    } else if ($transaction == 'pending') {
        // TODO set payment status in merchant's database to 'Pending'
        $status = "Pending";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $status, $idHtrans);
        $stmt->execute();
        echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
    } else if ($transaction == 'deny') {
        // TODO set payment status in merchant's database to 'Denied'
        $status = "Payment Denied";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $status, $idHtrans);
        $stmt->execute();
        echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
    } else if ($transaction == 'expire') {
        // TODO set payment status in merchant's database to 'expire'
        $status = "Payment Expired";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $status, $idHtrans);
        $stmt->execute();
        echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
    } else if ($transaction == 'cancel') {
        // TODO set payment status in merchant's database to 'Denied'
        $status = "Cancelled";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $status, $idHtrans);
        $stmt->execute();
        echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
    }
?>
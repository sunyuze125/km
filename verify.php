<?php
header('Content-Type: application/json');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
$cardCode = $input['cardCode'];

// 读取加密卡密文件
$encryptedCardCodes = file('encrypted_card_codes.txt', FILE_IGNORE_NEW_LINES);

$isValid = false;
foreach ($encryptedCardCodes as $encryptedCardCode) {
    if (password_verify($cardCode, $encryptedCardCode)) {
        $isValid = true;
        break;
    }
}

if ($isValid) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}
?>

<?php
// 检查是否通过POST方式提交了卡密
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newCardCode = $_POST['new_card_code']?? '';
    if (empty($newCardCode)) {
        die("请输入有效的卡密");
    }

    // 对新卡密进行加密
    $encryptedCardCode = password_hash($newCardCode, PASSWORD_DEFAULT);

    // 打开文件以追加模式写入加密后的卡密
    $file = fopen('encrypted_card_codes.txt', 'a');
    if ($file) {
        fwrite($file, $encryptedCardCode. PHP_EOL);
        fclose($file);
        echo "卡密已成功添加";
    } else {
        echo "无法打开文件以写入卡密";
    }
}
?>

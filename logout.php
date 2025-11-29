<?php
session_start();      // بدء الـ session
session_unset();      // إزالة كل المتغيرات في الـ session
session_destroy();    // تدمير الـ session بالكامل
header("Location: index.php"); // إعادة توجيه للصفحة الرئيسية
exit();
?>
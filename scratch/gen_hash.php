<?php
$password = 'crm123';
$md5 = md5($password);
$hash = password_hash(strtolower($md5), PASSWORD_DEFAULT);
echo "MD5: $md5\n";
echo "Hash correcto: $hash\n";
echo "Verificacion: " . (password_verify(strtolower($md5), $hash) ? 'OK' : 'FALLO') . "\n";

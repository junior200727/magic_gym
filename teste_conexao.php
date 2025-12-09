<?php
// Tenta incluir o arquivo de configuração
if (file_exists('db.php')) {
    require 'db.php';
    echo "<h1>✅ Sucesso!</h1>";
    echo "<p>O arquivo db.php foi encontrado e a conexão com o banco 'magic_gym' foi realizada.</p>";
} else {
    echo "<h1>❌ Erro Fatal</h1>";
    echo "<p>O arquivo db.php NÃO foi encontrado nesta pasta.</p>";
}
?>
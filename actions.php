<?php 
    require('db.php');

    $sql = $pdo->prepare("SELECT * FROM users ORDER BY name");
    $sql->execute();
    $dados = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h2>Case Calculadora</h2>
        <ul>
            <li><a href="./index.php">Cadastrar</a></li>
            <li><a href="./list.php">Listar</a></li>
            <li><a href="./actions.php">Ações</a></li>
        </ul>
    </header>
    <div class="action-container">
        <table>
            <tr>
                <th>Nome</th>
                <th>Data de nascimento</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Foto</th>
                <th>Ações</th>
            </tr>
            <?php
                if(count($dados)>0){
                    foreach($dados as $dado => $info){
                        $nome = $info["name"];
                        $data = $info["birth_date"];
                        $email = $info["email"];
                        $telefone = $info["phone"];
                        $pathFoto = $info["photo"];

                        echo "
                            <tr class='pessoa'>
                                <td>$nome</td>
                                <td>$data</td>
                                <td>$email</td>
                                <td>$telefone</td>
                                <td>$pathFoto</td>
                                <td>
                                    <button >Editar</button>
                                    <button >Remover</button>
                                </td>
                            </tr>
                        ";
                    }
                }else{
                    echo "<h1>Agenda sem cadastros</h1>";
                }
            ?>
        </table>
    </div>
</body>
</html>


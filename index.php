<?php 
    require('db.php');
    require('class/Cadastro.php');

    if(isset($_POST["nome"])&&isset($_POST["data"])&&isset($_POST["email"])&&isset($_POST["telefone"])&&isset($_POST["enviar"])){
        $nome = limparPost($_POST["nome"]);
        $data = date("d-m-Y", strtotime(limparPost($_POST["data"])));
        $email = limparPost($_POST["email"]);
        $telefone = limparPost($_POST["telefone"]);
        $fotoInfo = $_FILES["foto"];

        if(empty($nome)||empty($data)||empty($email)||empty($telefone)||empty($fotoInfo)){
            $erro_geral = "Todos os campos são obrigatórios!";
        }else{
            $cadastro = new Cadastro($nome, $data, $email, $telefone, $fotoInfo);
            $cadastro->cadastrar();
            if(!empty($cadastro->erro)){
                var_dump($cadastro->erro);
            }else{
                echo "Tudo ok";
            }
        }

        
        // echo $cadastro->nome."<br>";
        // echo $cadastro->data."<br>";
        // echo $cadastro->email."<br>";
        // echo $cadastro->telefone."<br>";
        // echo var_dump($fotoInfo)."<br>";
        // echo var_dump(($cadastro->erro));
        


        //validação imagem
        // $tamanhoMaxFoto = 2097152;
        // $extensaoPermitida = array("jpg", "png", "jpeg");
        // $extensaoFoto = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);

        // if($_FILES["foto"]["size"]>=$tamanhoMaxFoto){
        //     echo "Tamanho máximo 2mb";
        // }else{
        //     if(in_array($extensaoFoto, $extensaoPermitida)){
        //         $pastaImagens = "imagens/";
        //     }
        //     $tempNomeFoto = $_FILES["foto"]["tmp_name"];
        //     $novoNomeFoto = uniqid().".$extensaoFoto";
        //     move_uploaded_file($tempNomeFoto, $pastaImagens.$novoNomeFoto);

        // }
        // //inserir no banco de dados
        $sql = $pdo->prepare("INSERT INTO users VALUES (null, ?, ?, ?, ?, ?)");
        $sql->execute(array($nome, $data, $email, $telefone, $novoNomeFoto));

        // echo $nome, $data, $email, $telefone;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <div class="main-container">
        <form action="" method="POST" class="container" enctype="multipart/form-data">
            <h2>Cadastrar</h2>
            <div class="input-container">
                <label for="nome">Nome:</label>
                <input <?php if(isset($cadastro->erro["erro_nome"])||isset($erro_geral)){echo "class='erro-input'";} ?>
                type="text" name="nome" id="" placeholder="Nome completo" required>
                <p class="erro-msg">
                    <?php if(isset($cadastro->erro["erro_nome"])){echo $cadastro->erro["erro_nome"];}?>
                </p>
            </div>
            <div class="input-container">
                <label for="data">Data de nascimento:</label>
                <input <?php if(isset($cadastro->erro["erro_data"])||isset($erro_geral)){echo "class='erro-input'";} ?> type="date" name="data" id=""  required>
                <p class="erro-msg">
                    <?php if(isset($cadastro->erro["erro_data"])){echo $cadastro->erro["erro_data"];}?>
                </p>
            </div>
            <div class="input-container">
                <label for="email">E-mail:</label>
                <input <?php if(isset($cadastro->erro["erro_email"])||isset($erro_geral)){echo "class='erro-input'";} ?> type="email" name="email" id="" placeholder="email@email.com" required>
                <p class="erro-msg">
                    <?php if(isset($cadastro->erro["erro_email"])){echo $cadastro->erro["erro_email"];}?>
                </p>
            </div>
            <div class="input-container">
                <label for="">Telefone:</label>
                <input <?php if(isset($cadastro->erro["erro_telefone"])||isset($erro_geral)){echo "class='erro-input'";} ?> type="text" name="telefone" id="" placeholder="Apenas números (ex: 11999999999)" required maxlength="11">
                <p class="erro-msg">
                    <?php if(isset($cadastro->erro["erro_telefone"])){echo $cadastro->erro["erro_telefone"];}?>
                </p>
            </div>
            <div class="input-container">
                <label for="">Foto de perfil:</label>
                <input <?php if(isset($cadastro->erro["erro_foto"])||isset($erro_geral)){echo "class='erro-input'";} ?> type="file" name="foto" id="foto" placeholder="Tamanho máximo 2MB" required>
                <p class="erro-msg">
                    <?php if(isset($cadastro->erro["erro_foto"])){echo $cadastro->erro["erro_foto"];}?>
                </p>
            </div>
            <div class="input-container">
                <button type="submit" name="enviar" id="enviar">Cadastar</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
    class Cadastro{
        protected string $tabela = "users";
        
        function __construct(
            public string $nome, 
            public string $data, 
            public string $email, 
            public string $telefone, 
            public array $fotoInfo = [],
            public array $erro = [] ){
        }

        function cadastrar(){
            //validação nome
            if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/",$this->nome)) {
                $this->erro["erro_nome"] = "Somente permitido letras e espaços em branco!";
            }

            //validação email
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $this->erro["erro_email"] = "Formato de email inválido!";
            }

            //validação imagem
            $tamanhoMaxFoto = 2097152;
            $extensaoPermitida = array("jpg", "png", "jpeg");
            $extensaoFoto = pathinfo($this->fotoInfo["name"], PATHINFO_EXTENSION);
    
            if($this->fotoInfo["size"]>=$tamanhoMaxFoto){
                $this->erro["erro_foto"] = "Tamanho máximo 2mb";
            }else{
                if(in_array($extensaoFoto, $extensaoPermitida)){
                    $pastaImagens = "imagens/";
                    $tempNomeFoto = $_FILES["foto"]["tmp_name"];
                    $novoNomeFoto = uniqid().".$extensaoFoto";
                    move_uploaded_file($tempNomeFoto, $pastaImagens.$novoNomeFoto);
                }else{
                    $this->erro["erro_foto"] = "Tipo de arquivo inválido ($extensaoFoto), não foi possivel fazer upload.";
                }
    
            }
            
        }

    }
?>
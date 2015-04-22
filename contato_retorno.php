<?php
    require_once 'header.php';
    require_once 'conexao.php';
?>
    
<div class="span10 conteudo">
    <div class="row">

        <div class="span10 conteudo">
            <h1>Dados foram enviados com sucesso.</h1>
            <h2>Seguem abaixo os dados que voce enviou:</h2>
            <p>Nome: <?=$_POST["nome"]; ?></p>
            <p>E-mail: <?=$_POST["email"]; ?></p>
            <p>Assunto: <?=$_POST["assunto"]; ?></p>
            <p>Mensagem: <?=$_POST["mensagem"]; ?></p>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
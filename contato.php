<h1><?php echo $pagina['nome']; ?></h1>
<hr>
<p><?php echo $pagina['conteudo']; ?></p>

<!--exibe o formulário-->
<form action="contato_retorno.php" method="post" >
    <fieldset>
        <legend>Preencha o formulário a baixo.</legend>
        <label>Nome: <input type="text" name="nome"></label>
        <label>E-mail: <input type="text" name="email"></label>
        <label>Assunto: <input type="text" name="assunto"></label>
        <label>Mensagem: <textarea type="text" name="mensagem"></textarea></label>
        <input type="submit" name="submit" value="Enviar">
    </fieldset>
</form>
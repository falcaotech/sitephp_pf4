<?php
// faz as alteração nas páginas
 $idDaPagina = $_GET['id'];
 $pagina = listarId('pagina', $idDaPagina);
 ?>
    <div class="list-group-item active">
        <?php
            if(isset($_POST['alterar'])){
            atualizar();
            echo "<h3>Página alterada com sucesso!</h3>";
            $refresh = '<meta http-equiv="refresh" content="1; index.php" />';
            exit ($refresh);
            }
        ?>
        <?php echo "Página: <strong>".$pagina['uri']."</strong> | ID: <strong>".$pagina['id']."</strong>" ;?>
    </div>
    <div class=" box-table">
        <form name="form" method="post" action="">
            <input type="hidden" name="id" value="<?php echo strtolower($pagina['id']) ;?>">
            <div class="form-group">
                <label>URI</label>
                <input type="text" class="form-control" name="uri" value="<?php echo strtolower($pagina['uri']) ;?>">
            </div>
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $pagina['nome'] ;?>">
            </div>
            <div class="form-group">
                <label>Conteúdo</label>
                <textarea type="text" class="form-control" name="editor1" value="<?php echo $pagina['conteudo'] ;?>" placeholder="<?php echo $pagina['conteudo'] ;?>"></textarea>
            </div>
            <button class="btn btn-warning" type="submit" name="alterar">Alterar</button>
        </form>
    </div>

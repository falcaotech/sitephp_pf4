<?php
//lista páginas existentes
$pagina = listar('pagina');
?>
     <hr />
    <div class="box-header">
        <?php
        if(isset($_GET['id'])){
            $idDaPagina = $_GET['id'];
            deletar('pagina', $idDaPagina);
            echo "<h3>Página deletada com sucesso!</h3>";
            $refresh = '<meta http-equiv="refresh" content="1; index.php" />';
            exit ($refresh); 
        }
        ?>
    </div>
    <div class=" box-table">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>URI</th>
                    <th>NOME</th>
                    <th>CONTEÚDO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pagina as $value) {
                ?>
                <tr>
                <td><?php echo $value['id'] ;?></td>
                <td><?php echo $value['uri'] ;?></td>
                <td><?php echo $value['nome'] ;?></td>
                <td><?php echo $value['conteudo'] ;?></td>
                <td><a href="alterarPages?id=<?php echo $value['id'] ;?>"><button class="btn btn-warning" type="submit" name="alterar" >Alterar</button></a></td>
                <td><a href="index.php?id=<?php echo $value['id'] ;?>"><button class="btn btn-danger" type="submit" name="deletar">Deletar</button></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
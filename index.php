<?php
    require_once 'header.php';
?>   
    <div class="span10 conteudo">
        <div class="row">
            <?php
            
                function pegaConteudo()
                {
                    // Pegando a URL completa
                    $rota = parse_url('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

                    //caso contrario utilizo a requisição passada.
                    $pageRequest = (String)trim($rota['path'], "/");

                    // Quebrando a $pageRequest em um array
                    $parametros = explode('/', $pageRequest);

                    // guarda na variavel pagina o primeiro parametro
                    $uri = (isset($parametros[0]) && !empty($parametros[0])) ? $parametros[0] : 'home';
                    
                    // Verifica se a página é a página de busca
                    if ($uri == 'busca') {
                        //Aqui a variável $q se estiver setada e q for diferente de vazio paga o valor de q passado no formulário, senão o $q receberá vazio.
                        $q = (isset($_GET['q']) && !empty($_GET['q'])) ? $_GET['q'] : '';
                        
                        echo 'Você buscou por: ' . '<strong>' . $q . '</strong>' . '<br><br>';
                        
                        $conn = conexao();
                        $sql = "SELECT * FROM pagina WHERE (nome LIKE :q OR conteudo LIKE :q);";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindValue("q", '%'.$q.'%');
                        $stmt->execute();
                        $paginas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                        
                        if (count($paginas)) {
                            foreach ($paginas as $pagina) {
                                echo '<a href="' . $pagina['uri'] . '">' . $pagina['nome'] . '</a><br>';
                            }
                       } else {
                           echo "Não foram encontrados resultados com o termo pesquisado."."<br/>";
                           echo '<strong><a href="/home">Volte para a página principal</a></strong>';
                       }
                        
                    } else {
                    
                        $conn = conexao();
                        $sql = "SELECT * FROM pagina WHERE uri = :uri";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindValue("uri", $uri);
                        $stmt->execute();
                        $pagina = $stmt->fetch(\PDO::FETCH_ASSOC);

                        // Se encontrou a página no banco de dados exibe, senão mostra a página de erro 404
                        if ($pagina) {
                            // Se encontrou a página
                            require_once $uri.'.php';
                        } else {
                            // Se NÃO estiver permitido, inclui o arquivo de permissão negada
                            require_once '404.php';
                            // envia uma mensagem de erro do tipo 404 para o servidor
                            http_response_code(404); 

                        }
                    
                    }
                    
                }
                
                pegaConteudo();
                
            ?>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
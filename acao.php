<?php
    require_once('conf/conf.inc.php');
    require_once('pages/classes/quadro.class.php');

    $acao = "";
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
            break;
        case 'POST':
            $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
            break;
    }
    
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';

    if ($acao == 'salvar') {
        $id = isset($_POST['id']) ? $_POST['id'] : 0; 
        $quadro = new Quadro($id, $nome);
        try {  
            if ($id == 0) {
                if ($quadro->inserir()) {
                    echo "Deu certo =) <br> Criar";
                    header("Location: index.php?aviso=Cadastrado");
                    exit();
                } else {
                    echo "Deu errado =( <br> Criar";
                    header("Location: index.php?aviso=NaoCadastrado");
                    exit();
                }
            } else {
                try {
                    if ($quadro->editar()) {
                        echo "Deu certo =) <br> Editar";
                        header("Location: index.php?aviso=Editado");
                        exit();
                    } else {
                        echo "Deu errado =( <br> Editar";
                        header("Location: index.php?aviso=NaoEditado");
                        exit();
                    }
                } catch (Exception $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else if ($acao == 'excluir') {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $quadro = new Quadro($id, $nome);

        try {
            if ($quadro->excluir()) {
                echo "Deu certo =) <br> Excluir";
                header("Location: index.php?aviso=Excluido");
                exit();
            } else {
                echo "Deu errado =( <br> Excluir";
                header("Location: index.php?aviso=NaoExcluido");
                exit();
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
?>

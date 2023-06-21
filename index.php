<?php
    require_once('pages/classes/quadro.class.php'); 
    require_once('acao.php');

    $aviso = isset($_GET['aviso']) ? $_GET['aviso'] : ""; 
    switch ($aviso) {
        case 'Cadastrado':
            $msg = "Quadro Cadastrado!";
            alert($msg);
            break;
        case 'NaoCadastrado':
            $msg = "Quadro Não Cadastrado!";
            alert($msg);
            break;
        case 'Excluido':
            $msg = "Quadro Excluido!";
            alert($msg);
            break;
        case 'NaoExcluido':
            $msg = "Quadro Não Excluido!";
            alert($msg);
            break;
        case 'Editado':
            $msg = "Quadro Editado!";
            alert($msg);
            break;
        case 'NaoEditado':
            $msg = "Quadro Não Editado!";
            alert($msg);
            break;
        default:
            # code...
            break;
    }
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    function confirm($msg) {
        echo "<script type='text/javascript'>confirm('$msg');</script>";
    }
    $quadro = new Quadro(1, '#00000');

    $qeditando = null;

    $id = isset($_GET['id'])?$_GET['id']:0;
    if ($id > 0){
        $dados = $quadro->listar(1,$id);
        $qeditando = new Quadro($dados[0]['id'],$dados[0]['nome']);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Quadro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <style>
            .desenho{
                border: 1px solid black;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <a class="btn" href="pages/quadrado/index.php">Quadrado</a>
        <a class="btn" href="pages/triangulo/index.php">Triângulo</a>
        <a class="btn" href="pages/circulo/index.php">Círculo</a>
        <a class="btn" href="pages/retangulo/index.php">Retângulo</a>
        <center><h1>CRUD Quadro</h1></center>
        <div class="" style="margin:5vh;">
            <div class="col-12">
                <form action="acao.php" method="post">
                    <div class="row">    
                        <!-- <label for="id">ID</label> -->
                        <input type="hidden" name="id" id="id"  class="form-control" readonly value="<?php echo isset($qeditando)?$qeditando->getId():0 ?>">                       
                        <div class="col-10">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="<?php  if($qeditando) echo $qeditando->getNome(); ?>"> 
                        </div>
                        <div class="col-2" style="margin-top: 2.5vh;">
                            <button type="submit" class="btn btn-primary" name="acao" value="salvar"><?= ($qeditando) ? 'Editar Quadro' : 'Criar Quadro'; ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cor</th>
                            <th>Unidade</th>
                            <th>Desenho</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $lista = $quadro->listar();
                            foreach ($lista as $item) {
                                $q = new Quadro($item['id'], $item['nome']);
                                foreach ($q->getFormas() as $forma) {
                                    echo '<tr>
                                        <td>' . $q->getId() . '</td>
                                        <td>' . $q->getNome() . '</td>
                                        <td>' . $forma->getCor() . '</td>
                                        <td>' . $forma->getUn() . '</td>
                                        <td>' . $forma->desenhar() . '</td>
                                        <td>
                                            <a class="btn btn-secondary" href="index.php?acao=editar&id=' . $q->getId() . '">Editar</a>
                                            <a class="btn btn-danger" href="acao.php?acao=excluir&id=' . $q->getId() . '">Excluir</a>
                                        </td>
                                    </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>


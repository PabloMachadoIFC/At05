<?php
    require_once('../../conf/conf.inc.php');
    require_once('../classes/retangulo.class.php');
    require_once('../classes/quadro.class.php');
    require_once('acao.php');

    $aviso = isset($_GET['aviso']) ? $_GET['aviso'] : ""; 
    switch ($aviso) {
        case 'Cadastrado':
            $msg = "Retângulo Cadastrado!";
            alert($msg);
            break;
        case 'NaoCadastrado':
            $msg = "Retângulo Não Cadastrado!";
            alert($msg);
            break;
        case 'Excluido':
            $msg = "Retângulo Excluido!";
            alert($msg);
            break;
        case 'NaoExcluido':
            $msg = "Retângulo Não Excluido!";
            alert($msg);
            break;
        case 'Editado':
            $msg = "Retângulo Editado!";
            alert($msg);
            break;
        case 'NaoEditado':
            $msg = "Retângulo Não Editado!";
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

    $retangulo = new Retangulo('', 1, 2, 'x', 'px','d');

    $qeditando = null;

    $id = isset($_GET['id'])?$_GET['id']:0;
    if ($id > 0){
        $dados = $retangulo->listar(1,$id);
        $qeditando = new Retangulo($dados[0]['id'],$dados[0]['largura'],$dados[0]['altura'],$dados[0]['cor'],$dados[0]['un'],$dados[0]['id_quadro']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Retângulo</title>
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
        <a href="../../index.php" class="btn btn-danger">Voltar</a>
        <center><h1>CRUD Retângulo</h1></center>
        <div class="" style="margin:5vh;">
            <div class="col-12">
                <form action="acao.php" method="post">
                    <div class="row">                       
                            <!-- <label for="id">ID</label> -->
                            <input type="hidden" name="id" id="id"  class="form-control" readonly value="<?php echo isset($qeditando)?$qeditando->getId():0 ?>">                       
                        <div class="col-3">
                            <label for="largura">Largura</label>
                            <input type="text" name="largura" id="largura" class="form-control" value="<?php if($qeditando) echo $qeditando->getLargura(); ?>">
                        </div>
                        <div class="col-3">
                            <label for="altura">Altura</label>
                            <input type="text" name="altura" id="altura" class="form-control" value="<?php if($qeditando) echo $qeditando->getAltura(); ?>">
                        </div>
                        <div class="col-1">
                            <label for="cor">Cor</label>
                            <input type="color" name="cor" id="cor" class="form-control" value="<?php  if($qeditando) echo $qeditando->getCor(); ?>"> 
                        </div>
                        <div class="col-2">
                            <label for="un">Tamanho</label>
                            <select class="form-control" name="un" id="un">
                                <option value="cm" <?php  if($qeditando) if ($qeditando->getUn() == 'cm') echo 'selected'; ?>>CM - Centímetro</option>
                                <option value="px" <?php  if($qeditando) if ($qeditando->getUn() == 'px') echo 'selected'; ?>>PX - Píxel</option>
                                <option value="%" <?php  if($qeditando) if ($qeditando->getUn() == '%') echo 'selected'; ?>>% - Porcentagem</option>
                                <option value="vh" <?php  if($qeditando) if ($qeditando->getUn() == 'vh') echo 'selected'; ?>>VH - Viewport Height</option>
                                <option value="vw" <?php  if($qeditando) if ($qeditando->getUn() == 'vw') echo 'selected'; ?>>VW - Viewport Width</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="id_quadro">Quadro</label>
                            <select class="form-control" name="id_quadro" id="id_quadro">
                                <?php
                                $quadro = new Quadro("", "");
                                $lista = $quadro->listar();
                                foreach ($lista as $item) {
                                    $selected = '';
                                    if ($qeditando) {
                                        if ($qeditando->getQuadro() == $item['id']) {
                                            $selected = 'selected';
                                        }
                                    }
                                    echo "<option value='". $item['id'] ."' $selected>". $item['nome'] ." (". $item['id'] .")</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12" style="margin-top: 1vh;">
                            <center>
                                <button type="submit" class="btn btn-primary" name="acao" value="salvar"><?= ($qeditando) ? 'Editar Retângulo' : 'Criar Retângulo'; ?></button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Largura</th>
                            <th>Altura</th>
                            <th>Cor</th>
                            <th>Unidade</th>
                            <th>Quadro</th>
                            <th>Desenho</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $lista = $retangulo->listar();
                            foreach ($lista as $item) {
                                $q = new Retangulo($item['id'],$item['largura'],$item['altura'],$item['cor'],$item['un'],$item['id_quadro']);
                                $result = $q->calcular();

                                echo '<tr>
                                    <td>' . $q->getId() . '</td>
                                    <td>' . $q->getLargura() . '</td>
                                    <td>' . $q->getAltura() . '</td>
                                    <td>' . $q->getCor() . '</td>
                                    <td>' . $q->getUn() . '</td>
                                    <td>' . $q->getQuadro() . '</td>
                                    <td>' . $q->desenhar() . ' <br>
                                    Área: ' . $result['area'] . '<br>Perímetro: ' . $result['perimetro'] . '</td>
                                    <td>
                                        <a class="btn btn-secondary" href="index.php?acao=editar&id=' . $q->getId() . '">Editar</a>
                                        <a class="btn btn-danger" href="acao.php?acao=excluir&id=' . $q->getId() . '">Excluir</a>
                                    </td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<?php 
$categorias= ["Selecione uma categoria", "Camisa", "Tênis", "Calça", "Meias"];
?>


<?php 

function cadastrarProduto($nomeProduto, $categoriaProduto, $descProduto, $qtdeProduto, $precoProduto, $imgProduto){
    $nomeArquivo= "produtos.json";
    
    if(file_exists($nomeArquivo)){
        
        $arquivoJson= file_get_contents($nomeArquivo); 
        
        $produtos= json_decode ($arquivoJson, true);

            if($produtos==[]){

        
        $produtos[] = ["idProduto"=>1, "nome"=>$nomeProduto, "categoria"=>$categoriaProduto, "descProduto"=>$descProduto, "quantidade"=>$qtdeProduto, "preco"=>$precoProduto, "imgProduto"=>$imgProduto];

            } else {

                $ultimoIdProduto = end($produtos);
                $somandoId = $ultimoIdProduto["idProduto"] +1;

                $produtos[] = ["idProduto"=>$somandoId, "nome"=>$nomeProduto, "categoria"=>$categoriaProduto, "descProduto"=>$descProduto, "quantidade"=>$qtdeProduto, "preco"=>$precoProduto, "imgProduto"=>$imgProduto];
            }
        
        $json= json_encode($produtos);
        $deuCerto= file_put_contents($nomeArquivo, $json);
        
        if($deuCerto){
            return "Cadastro OK";
        } else {
            return "Não cadastrado";
        }
        
    }else{
        $produtos= [];
        $produtos[] = ["idProduto"=>1, "nome"=>$nomeProduto, "categoria"=>$categoriaProduto, "descProduto"=>$descProduto, "quantidade"=>$qtdeProduto, "preco"=>$precoProduto, "imgProduto"=>$imgProduto];
        
        $json= json_encode($produtos);
        
        $deuCerto= file_put_contents($nomeArquivo, $json);
        
        if($deuCerto){
            return "Cadastro OK";
        }else{
            return "Não cadastrado";
        }
    }
};

if($_POST){
    $nomeImagem= $_FILES['imgProduto']['name'];
    $localTmp= $_FILES['imgProduto']['tmp_name'];
    $caminhoImagem= "img/".$nomeImagem;
    
    $moveu= move_uploaded_file($localTmp, $caminhoImagem);
    
    echo cadastrarProduto($_POST["nomeProduto"], $_POST["categoriaProduto"], $_POST["descProduto"],$_POST["qtdeProduto"], $_POST["precoProduto"], $caminhoImagem);
    
}

$nomeArquivo = "produtos.json";
$produtos= json_decode(file_get_contents($nomeArquivo), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet"/>
    <title>Cadastro</title>
</head>

<body>
    <main class="container row">
         
        <section class= col-6>   
                <h2 class="espaco">Todos os produtos</h2>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preço</th>
                    </tr>
                </thead>
                <tbody>

                <?php if(isset($produtos)&& $produtos !=[]){ ?>
                <?php foreach ($produtos as $produto){ ?> 
                    <tr>
                        <td><a href= "produto.php?idProduto=<?php echo $produto["idProduto"]; ?>"><?php echo $produto['nome'] ?></a></td>
                        <td><?php echo $produto['categoria'] ?></td>
                        <td><?php echo $produto['preco'] ?></td>
                    </tr>
               <?php } ?>
               <?php } else { ?>
                    <h1>Não há produtos cadastrados</h1>
                <?php } ?>
                   
                </tbody>
                </table>
        </section>    

        <div class= col-6>
            
            <div class="bgfundo col-12">
                <form action="" method="post" enctype="multipart/form-data">

            <div>
                <h3 class= "espaco">Cadastrar de Produtos</h3>
            </div>

        <div class="form-group">
            <label for= "nomeProduto">Nome</label>
            <input type="text" class="form-control" name="nomeProduto" id= "nomeProduto" required/>
        </div>
        
        <div class="form-group">
            <label for= "categoriaProduto">Categoria</label>
               <?php if(isset($categorias) && $categorias != []){ ?>
            <select class="form-control" name="categoriaProduto" id= "categoriaProduto" required>
                <?php foreach($categorias as $categoria){ ?>
            <option value="<?php echo $categoria?>"> <?php echo $categoria?></option>

                <?php } ?>  
               <?php } ?>      
               
            </select>

        <div class="form-group">
            <label for="desProduto">Descrição</label>
            <input type="text" class="form-control" name="descProduto" id= "descProduto" required/>
        </div>    

        <div class="form-group">
            <label for= "qtdeProduto">Quantidade</label>
            <input type="number" class="form-control" name="qtdeProduto" id="qtdeProduto" required/>
        </div>

        <div class="form-group">
            <label for= "precoProduto">Preço</label>
            <input type="number" step="0.01" class="form-control" name="precoProduto" id="precoProduto" required/>
        </div>

        <div class="form-group">
            <label for="imgProduto">Foto do Produto</label>
            <input type="file" class="form-control" name="imgProduto" id="imgProduto" placeholder="Imagem do Produto" required/>
        </div>
        

        <button class="btn btn-success">Cadastrar Produto</button>
            </form>
        </div>
        </div>
        
        </div>

    </main>

    
</body>
</html>
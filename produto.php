<?php 
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
    <title>Produtos</title>
</head>

<body>
    <section class= "container bg-light">   

    <button class= "btn btn-light">Voltar para lista de produtos</button>

    <!--<div class="card mb-3" style="max-width: 540px;">-->
    <div class="row no-gutters">

      <?php if(isset($produtos)&& $produtos !=[]){ ?>
      <?php foreach ($produtos as $produto){ 
          if($_GET["idProduto"] == $produto["idProduto"]){
            ?>
      <div class="col-5">
      <img src="<?php echo $produto['imgProduto']; ?>" class="card-img" alt="...">
    </div>

    <div class="col-7">
      <div class="card-body">
          

        <h1 class="card-title"><?php echo $produto['nome']?></h1>

        <h6 class="card-title">Categoria</h6>
        <p class="card-text"><?php echo $produto['categoria']?></p>

        <h6 class="card-title">Descrição</h6>
        <p class="card-text"><?php echo $produto['descProduto']?></p>

        <h6 class="card-title">Quantidade</h6>
        <p class="card-text"><?php echo $produto['quantidade']?></p>

        <h6 class="card-title">Preço</h6>
        <p class="card-text"><?php echo $produto['preco']?></p>
      </div>
    </div>

      <?php } ?>
        <?php } ?>
          <?php } ?>
     
  </div>
</div>

</section>
</body>




<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../img/favicon.png" rel="icon">
        <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
        <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../lib/animate/animate.min.css" rel="stylesheet">
        <link href="../lib/venobox/venobox.css" rel="stylesheet">
        <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
<?php

  session_start();
  if(!isset($_SESSION['id_pessoa']) || is_null($_SESSION['id_pessoa']) 
  || empty($_SESSION['id_pessoa'])) {
  echo "<p>Não existe um usuário logado no sistema.</p>";
  echo "<a href='../FrmLogin.php'>Voltar</a>";
} else {
    
?>
    <body>
        <?php
        
        try{
     
            $id_comentario = $_GET ["id"];
            
            require '../conexao.php';
            
            $sql = "select * from comentario where id_comentario=$id_comentario";

            $resultado = $conn->query($sql);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
          foreach ($dados as $linha) {
            $id_comentario = $linha ['id_comentario'];
            $texto_comentario=$linha['texto_comentario'];
            $id_evento=$linha['cod_evento'];
          } 

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
          catch(Exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
          }
        
        
        ?>
      <main id="main" class="main-page" >
   

        <form action="alterar_comentario.php" method="POST">
        <div class="form-group col-md-12" style="background:#fff" >
            <div class="form-row" > 
                    
              
              <input type="hidden" name="id_evento" value="<?php  echo $cod_evento;?>" class="form-control"  >
              <input type="hidden" name="id_comentario" value="<?php  echo $id_comentario;?>" class="form-control"  >
              
              <input type="text" name="texto_comentario" class="form-control" value="<?php  echo $texto_comentario;?>"  required autofocus><br>

              
              <button type="submit" class="btn btn-outline-success" style="background: #9acfea" >Alterar</button>
              <button  type="reset" class="btn btn-outline-danger" style="background: #ce8483" >Limpar</button><br><br>
              
              </div>
            </div>
        </form> 
      
    </main>
<?php
  }
?>
    </body>
</html>

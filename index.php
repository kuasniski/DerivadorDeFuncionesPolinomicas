<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Derivar Función polinomica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>

    <div class="container my-3 col-lg-6 col-sm-12">
        <h1>Derivador de funciones polinomicas</h1>
        <div class="alert alert-warning" role="alert">
            Para ingresar una potencia utilice el simbolo "^" presinando la tecla Alt + 94<br />
            Por ejemplo: x elevado al cuadrado = X^2
        </div>
        <form action="derivar.php" method="POST" id="formulario">
            <div class="mb-3">
                <label class="form-label">Ingrese la función a derivar ƒ(x)</label>
                <input name="funcion" class="form-control" type="text" id="valor" />
            </div>
            <div class="mb-3">
                <a class="btn btn-success" id="alcuadrado">x²</a>
                <a class="btn btn-success" id="alcubo">x³</a>
                <a class="btn btn-success" id="alan">xª</a>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Derivar</button>
            </div>
        </form>
        <div id="respuesta">
            <?php session_start();?>
            <?php if(isset($_SESSION['derivada'])):?>
                <div class="alert alert-primary" role="alert">
                    <?=$_SESSION['derivada']?>
                </div>
            <?php endif;?>
            <?php if(isset($_SESSION['error'])):?>
                <div class="alert alert-danger" role="alert">
                <?=$_SESSION['error']?>
                </div>
            <?php endif; ?>
            <?php 
                unset($_SESSION['error']);
                unset($_SESSION['derivada']);
            ?>   
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
    <script src="app.js"></script>
</body>

</html>
<?php
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Conexão com o banco de dados
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'appdb';

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica se houve um erro na conexão
    if ($conn->connect_error) {
        die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
    }

    // Prepara a consulta SQL
    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";

    // Executa a consulta
    $result = $conn->query($sql);

    // Verifica se o usuário foi encontrado
    if ($result->num_rows === 1) {
        // Usuário encontrado, redireciona para a página principal
        $_SESSION['email'] = $email;
        header('Location: index.php');
        exit();
    } else {
        // Usuário não encontrado
        $erro = 'Email ou senha inválidos';
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>App-login</title>
    <style>
        .small {
            width: 200px;
        }

        .custom-container {
            max-width: 400px;
        }
    </style>
</head>

<body class="text-bg-secondary">
    <nav class="navbar navbar-expand-lg text-bg-secondary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="text-center mt-4 display-3 mt-4">Faça seu Login</h1>
    <?php if (isset($erro)) : ?>
        <p><?php echo $erro; ?></p>
    <?php endif; ?>
    <div class="container custom-container">
        <form class="d-flex flex-column justify-content-center align-items-center mt-4" method="POST" action="login.php">

            <div class="mb-3 small">

                <label for="email" class="form-label text-lg text-white pt-4">Email</label>
                <input type="text" class="form-control" placeholder="Email" name="email" id="email">
            </div>

            <div class="mb-3 small">
                <label for="pass" class="form-label  text-lg text-white">Senha</label>
                <input type="senha" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="senha" id="senha">
            </div>
            <button class="btn btn-light btn-lg" type="submit">Login</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </div>
</body>

</html>
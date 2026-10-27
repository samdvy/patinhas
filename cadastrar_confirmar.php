<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Animal - Patinhas Felizes</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>🐾 Patinhas Felizes</h1>
        <p>Cadastro de Novo Animal para Adoção</p>
    </header>

    <nav>
        <a href="index.php">Início</a>
        <a href="cadastrar.php">Cadastrar Animal</a>
        <a href="listar.php">Animais para Adoção</a>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Formulário de Cadastro</h2>
            
            <?php
            require_once "db.php";

            $mensagem = "";
            $classe = "erro";

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Captura e limpa os dados do formulário
                $nome      = trim($_POST["nome"] ?? "");
                $especie   = trim($_POST["especie"] ?? "");
                $idade     = filter_var($_POST["idade"] ?? "", FILTER_VALIDATE_INT);
                $porte     = trim($_POST["porte"] ?? "");
                $descricao = trim($_POST["descricao"] ?? "");

                $especiesValidas = ["Cachorro", "Gato"];
                $portesValidos   = ["Pequeno", "Médio", "Grande"];

                // Validação no servidor (o HTML pode ser burlado)
                if ($nome === "" || $descricao === "") {
                    $mensagem = "Preencha todos os campos obrigatórios.";
                } elseif (!in_array($especie, $especiesValidas, true) || !in_array($porte, $portesValidos, true)) {
                    $mensagem = "Espécie ou porte inválido.";
                } elseif ($idade === false || $idade < 0 || $idade > 30) {
                    $mensagem = "Informe uma idade válida entre 0 e 30 anos.";
                } else {
                    // Prepared statement: evita SQL Injection
                    $stmt = $conexao->prepare(
                        "INSERT INTO animais (nome, especie, idade, porte, descricao) VALUES (?, ?, ?, ?, ?)"
                    );
                    $stmt->bind_param("ssiss", $nome, $especie, $idade, $porte, $descricao);

                    if ($stmt->execute()) {
                        $classe = "sucesso";
                        $mensagem = "Animal cadastrado com sucesso! 🐶🐱";
                    } else {
                        $mensagem = "Erro ao cadastrar o animal. Tente novamente.";
                    }
                    $stmt->close();
                }
            } else {
                $mensagem = "Acesse esta página pelo formulário de cadastro.";
            }

            $conexao->close();
            ?>

            <div class="alert <?= $classe ?>"><?= htmlspecialchars($mensagem) ?></div>

            <div class="btn-group">
                <a href="cadastrar.php" class="btn">Cadastrar outro animal</a>
                <a href="listar.php" class="btn" style="background-color: #319795;">Ver animais</a>
            </div>

        </div>
    </div>

    <footer>
        <p>&copy; 2026 Patinhas Felizes - Programação Web 2 | Curso Técnico em Informática | IFBA Campus Ilhéus</p>
    </footer>

</body>
</html>
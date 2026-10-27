<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais para Adoção - Patinhas Felizes</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>🐾 Patinhas Felizes</h1>
        <p>Encontre seu novo melhor amigo</p>
    </header>

    <nav>
        <a href="index.php">Início</a>
        <a href="cadastrar.php">Cadastrar Animal</a>
        <a href="listar.php">Animais para Adoção</a>
    </nav>

    <div class="container">
        <h2>Animais Disponíveis para Adoção</h2>

        <div class="grid">
           <table>
  
        <tr>
            
            <th>Nome</th>
            <th>Espécie</th>
            <th>Idade</th>
            <th>Porte</th>
            <th>Descrição</th>
            
        </tr>
    

        <?php
        require_once "db.php";

        $resultado = $conexao->query("SELECT nome, especie, idade, porte, descricao FROM animais ORDER BY data_cadastro DESC");

        if ($resultado && $resultado->num_rows > 0) {
            while ($animal = $resultado->fetch_assoc()) {
                $idade = (int) $animal["idade"];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($animal["nome"]) . "</td>";
                echo "<td>" . htmlspecialchars($animal["especie"]) . "</td>";
                echo "<td>" . $idade . ($idade === 1 ? " ano" : " anos") . "</td>";
                echo "<td>" . htmlspecialchars($animal["porte"]) . "</td>";
                echo "<td>" . htmlspecialchars($animal["descricao"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><td colspan="5" class="centralizado">Nenhum animal cadastrado ainda.</td></tr>';
        }

        $conexao->close();
        ?>

</table>

        </div>
    </div>

    <footer>
        <p>&copy; 2026 Patinhas Felizes - Programação Web 2 | Curso Técnico em Informática | IFBA Campus Ilhéus</p>
    </footer>

</body>
</html>
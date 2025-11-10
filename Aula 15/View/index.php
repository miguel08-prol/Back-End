<?php
require_once __DIR__ . '/../Controller/BebidasController.php';

$controller = new BebidaController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ação de salvar (o 'criar' no form antigo)
    if ($_POST['acao'] === 'salvar') {
        $controller->criar($_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
    } elseif ($_POST['acao'] === 'deletar') {
        $controller->deletar($_POST['nome']);
    }
    // Redireciona para a própria página para limpar o POST e evitar reenvio
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Carrega a lista de bebidas
$lista = $controller->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque de Bebidas</title>
    <link rel="icon" href="icon/cerveja.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(120deg, #1f2023 0%, #2c2d30 100%);
            color: #f0f0f0;
            padding: 2rem;
            min-height: 100vh;
        }

        h1, h2 {
            font-weight: 700;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
        }
        
        h2 {
            font-size: 1.8rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 0.5rem;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 2rem auto;
            background: rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 2rem;
            
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 14px;
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #f0f0f0;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input::placeholder {
            color: #aaa;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 15px rgba(106, 17, 203, 0.5);
        }

        select option {
            background: #2c2d30;
            color: #f0f0f0;
        }

        /* --- Botão Principal (com Gradiente) --- */
        .btn-submit {
            grid-column: 1 / -1; /* Ocupa todas as colunas */
            padding: 16px;
            border: none;
            border-radius: 8px;
            background-image: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-submit:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(106, 17, 203, 0.4);
        }

        /* --- Estilo da Tabela --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        table th, table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        table th {
            background-color: rgba(0, 0, 0, 0.2);
            color: #fff;
            font-weight: 500;
        }

        table tr {
            transition: background-color 0.3s ease;
        }

        table tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* --- Botão Deletar (com Gradiente) --- */
        .btn-deletar {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            background-image: linear-gradient(to right, #ff416c 0%, #ff4b2b 100%);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-deletar:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
        }
    </style>
</head>
<body>

    <h1>Controle de Estoque de Bebidas</h1>

    <div class="container" style="animation-delay: 0.1s;">
        <h2>Cadastrar Nova Bebida</h2>
        <form method="POST">
            <input type="hidden" name="acao" value="salvar">
            
            <input type="text" name="nome" placeholder="Nome da bebida" required>
            
            <select name="categoria" required>
                <option value="">Categoria</option>
                <option value="Refrigerante">Refrigerante</option>
                <option value="Cerveja">Cerveja</option>
                <option value="Vinho">Vinho</option>
                <option value="Destilado">Destilado</option>
                <option value="Água">Água</option>
                <option value="Suco">Suco</option>
                <option value="Energético">Energético</option>
            </select>
            
            <input type="text" name="volume" placeholder="Volume (ex: 300ml)" required>
            <input type="number" name="valor" step="0.01" placeholder="Valor (R$)" required>
            <input type="number" name="qtde" placeholder="Estoque" required>
            
            <button type="submit" class="btn-submit">Salvar Bebida</button>
        </form>
    </div>

    <div class="container" style="animation-delay: 0.3s;">
        <h2>Bebidas em Estoque</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Volume</th>
                    <th>Valor</th>
                    <th>Estoque</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lista)): ?>
                    <?php foreach ($lista as $bebida): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($bebida->getNome()); ?></td>
                            <td><?php echo htmlspecialchars($bebida->getCategoria()); ?></td>
                            <td><?php echo htmlspecialchars($bebida->getVolume()); ?></td>
                            <td>R$ <?php echo number_format($bebida->getValor(), 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($bebida->getQtde()); ?></td>
                            <td>
                                <form method="POST" style="margin:0;">
                                    <input type="hidden" name="acao" value="deletar">
                                    <input type="hidden" name="nome" value="<?php echo htmlspecialchars($bebida->getNome()); ?>">
                                    <button type="submit" class="btn-deletar">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Nenhuma bebida cadastrada ainda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
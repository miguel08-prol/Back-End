<?php
require_once __DIR__ . '/../Controller/BebidasController.php';

$controller = new BebidaController();

// Variável para modo de edição
$modoEdicao = false;
$bebidaEditando = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ação de salvar (criar ou atualizar)
    if ($_POST['acao'] === 'salvar') {
        if (isset($_POST['nome_antigo']) && !empty($_POST['nome_antigo'])) {
            // Modo edição
            $controller->atualizar($_POST['nome_antigo'], $_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
        } else {
            // Modo criação
            $controller->criar($_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
        }
    } elseif ($_POST['acao'] === 'deletar') {
        $controller->deletar($_POST['nome']);
    } elseif ($_POST['acao'] === 'editar') {
        // Buscar dados da bebida para edição
        $bebidaEditando = $controller->buscar($_POST['nome']);
        $modoEdicao = true;
    }
    
    // Se não for ação de editar, redireciona para limpar POST
    if ($_POST['acao'] !== 'editar') {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
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
            max-width: 1200px;
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
            grid-column: 1 / -1;
            padding: 16px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
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

        /* --- Botão Cancelar (com Gradiente) --- */
        .btn-cancelar {
            grid-column: 1 / -1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #8e9eab 0%, #eef2f3 100%);
            color: #333;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-decoration: none;
            text-align: center;
        }

        .btn-cancelar:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(142, 158, 171, 0.4);
        }

        /* --- Estilo da Tabela --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        table th {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        table tr {
            transition: all 0.3s ease;
        }

        table tr:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* --- Container das Ações --- */
        .acoes-container {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
        }

        /* --- Botão Editar (com Gradiente) --- */
        .btn-editar {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            min-width: 70px;
        }

        .btn-editar:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
        }

        /* --- Botão Deletar (com Gradiente) --- */
        .btn-deletar {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            min-width: 70px;
        }

        .btn-deletar:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 65, 108, 0.4);
        }

        /* --- Formulários inline --- */
        .form-inline {
            display: inline;
            margin: 0;
            padding: 0;
        }

        /* --- Responsividade --- */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
            
            .acoes-container {
                flex-direction: column;
                gap: 0.3rem;
            }
            
            .btn-editar, .btn-deletar {
                min-width: 60px;
                padding: 6px 12px;
                font-size: 0.8rem;
            }
            
            form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <h1>Controle de Estoque de Bebidas</h1>

    <div class="container" style="animation-delay: 0.1s;">
        <h2><?php echo $modoEdicao ? 'Editar Bebida' : 'Cadastrar Nova Bebida'; ?></h2>
        <form method="POST">
            <input type="hidden" name="acao" value="salvar">
            <?php if ($modoEdicao): ?>
                <input type="hidden" name="nome_antigo" value="<?php echo htmlspecialchars($bebidaEditando->getNome()); ?>">
            <?php endif; ?>
            
            <input type="text" name="nome" placeholder="Nome da bebida" 
                   value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getNome()) : ''; ?>" required>
            
            <select name="categoria" required>
                <option value="">Categoria</option>
                <option value="Refrigerante" <?php echo ($modoEdicao && $bebidaEditando->getCategoria() === 'Refrigerante') ? 'selected' : ''; ?>>Refrigerante</option>
                <option value="Cerveja" <?php echo ($modoEdicao && $bebidaEditando->getCategoria() === 'Cerveja') ? 'selected' : ''; ?>>Cerveja</option>
                <option value="Vinho" <?php echo ($modoEdicao && $bebidaEditando->getCategoria() === 'Vinho') ? 'selected' : ''; ?>>Vinho</option>
                <option value="Destilado" <?php echo ($modoEdicao && $bebidaEditando->getCategoria() === 'Destilado') ? 'selected' : ''; ?>>Destilado</option>
                <option value="Água" <?php echo ($modoEdicao && $bebidaEditando->getCategoria() === 'Água') ? 'selected' : ''; ?>>Água</option>
                <option value="Suco" <?php echo ($modoEdicao && $bebidaEditando->getCategoria() === 'Suco') ? 'selected' : ''; ?>>Suco</option>
                <option value="Energético" <?php echo ($modoEdicao && $bebidaEditando->getCategoria() === 'Energético') ? 'selected' : ''; ?>>Energético</option>
            </select>
            
            <input type="text" name="volume" placeholder="Volume (ex: 300ml)" 
                   value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getVolume()) : ''; ?>" required>
            <input type="number" name="valor" step="0.01" placeholder="Valor (R$)" 
                   value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getValor()) : ''; ?>" required>
            <input type="number" name="qtde" placeholder="Estoque" 
                   value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getQtde()) : ''; ?>" required>
            
            <button type="submit" class="btn-submit">
                <?php echo $modoEdicao ? 'Atualizar Bebida' : 'Salvar Bebida'; ?>
            </button>
            
            <?php if ($modoEdicao): ?>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn-cancelar">
                    Cancelar Edição
                </a>
            <?php endif; ?>
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
                    <th>Ações</th>
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
                                <div class="acoes-container">
                                    <form method="POST" class="form-inline">
                                        <input type="hidden" name="acao" value="editar">
                                        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($bebida->getNome()); ?>">
                                        <button type="submit" class="btn-editar">Editar</button>
                                    </form>
                                    <form method="POST" class="form-inline">
                                        <input type="hidden" name="acao" value="deletar">
                                        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($bebida->getNome()); ?>">
                                        <button type="submit" class="btn-deletar" onclick="return confirm('Tem certeza que deseja deletar <?php echo htmlspecialchars($bebida->getNome()); ?>?')">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem;">
                            Nenhuma bebida cadastrada ainda.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
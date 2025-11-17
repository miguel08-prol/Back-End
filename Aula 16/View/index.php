<?php
require_once __DIR__ . '/../Controller/BebidasController.php';

$controller = new BebidaController();

$modoEdicao = false;
$bebidaEditando = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar') {
        $controller->deletar($_POST['nome']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } 
    
    elseif (isset($_POST['acao']) && $_POST['acao'] === 'editar') {
        $bebidaEditando = $controller->buscarPorNome($_POST['nome']);
        if ($bebidaEditando) {
            $modoEdicao = true;
        }
    } 
    
    elseif (isset($_POST['acao']) && $_POST['acao'] === 'salvar') {
        
        if (isset($_POST['nome_antigo']) && !empty($_POST['nome_antigo'])) {
            $controller->atualizar(
                $_POST['nome_antigo'], 
                $_POST['nome'], 
                $_POST['categoria'], 
                $_POST['volume'], 
                $_POST['valor'], 
                $_POST['qtde']
            );
        } else {
            $controller->criar(
                $_POST['nome'], 
                $_POST['categoria'], 
                $_POST['volume'], 
                $_POST['valor'], 
                $_POST['qtde']
            );
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

$bebidas = $controller->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Bebidas</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #FF6B35;
            --secondary: #004E89;
            --accent: #F7B801;
            --dark: #1A1A2E;
            --light: #FFFFFF;
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: var(--light);
            padding-bottom: 3rem;
        }

        header {
            background: rgba(26, 26, 46, 0.95);
            padding: 1rem 5%;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        .logo { 
            font-family: 'Montserrat', sans-serif; 
            font-weight: 900; 
            font-size: 1.8rem; 
            background: var(--gradient-2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }

        h1 { 
            text-align: center; 
            margin-bottom: 1.5rem; 
            font-weight: 800; 
            font-size: 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        .form-full { grid-column: 1 / -1; }

        .form-group { margin-bottom: 1rem; }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: rgba(255,255,255,0.8);
        }

        input, select {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            color: var(--light);
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
        }

        select option {
            background: var(--dark);
            color: var(--light);
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 800;
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-size: 1rem;
        }
        .btn:hover { transform: translateY(-3px); }
        
        .btn-primary {
            background: var(--gradient-2);
            color: white;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-cancel {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.7);
            margin-top: 1rem;
            width: 100%;
        }
        .btn-cancel:hover { border-color: var(--primary); color: white; }

        .table-responsive { overflow-x: auto; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 15px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        th {
            background: rgba(255, 255, 255, 0.1);
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        tr:hover { background: rgba(255,255,255,0.05); }

        .actions { display: flex; gap: 0.5rem; }
        
        .btn-small {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn-small:hover { opacity: 0.8; }
        
        .btn-edit { background: var(--accent); color: var(--dark); }
        .btn-delete { background: #ff4757; color: white; }

        @media(max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">GESTÃO DE BEBIDAS</div>
    </header>

    <div class="container">
        <h1><?php echo $modoEdicao ? 'Editar Bebida' : 'Nova Bebida'; ?></h1>

        <div class="card">
            <form method="POST">
                <input type="hidden" name="acao" value="salvar">
                
                <?php if ($modoEdicao): ?>
                    <input type="hidden" name="nome_antigo" value="<?php echo htmlspecialchars($bebidaEditando->getNome()); ?>">
                <?php endif; ?>

                <div class="form-grid">
                    <div class="form-group form-full">
                        <label>Nome:</label>
                        <input type="text" name="nome" placeholder="Ex: Coca Cola" required 
                               value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getNome()) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Categoria:</label>
                        <select name="categoria" required>
                            <option value="">Selecione...</option>
                            <option value="Refrigerante" <?php if($modoEdicao && $bebidaEditando->getCategoria() == 'Refrigerante') echo 'selected'; ?>>Refrigerante</option>
                            <option value="Suco" <?php if($modoEdicao && $bebidaEditando->getCategoria() == 'Suco') echo 'selected'; ?>>Suco</option>
                            <option value="Alcoólica" <?php if($modoEdicao && $bebidaEditando->getCategoria() == 'Alcoólica') echo 'selected'; ?>>Alcoólica</option>
                            <option value="Água" <?php if($modoEdicao && $bebidaEditando->getCategoria() == 'Água') echo 'selected'; ?>>Água</option>
                            <option value="Energético" <?php if($modoEdicao && $bebidaEditando->getCategoria() == 'Energético') echo 'selected'; ?>>Energético</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Volume:</label>
                        <input type="text" name="volume" placeholder="Ex: 350ml" required 
                               value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getVolume()) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Valor (R$):</label>
                        <input type="number" step="0.01" name="valor" placeholder="0.00" required 
                               value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getValor()) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Quantidade:</label>
                        <input type="number" name="qtde" placeholder="0" required 
                               value="<?php echo $modoEdicao ? htmlspecialchars($bebidaEditando->getQtde()) : ''; ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <?php echo $modoEdicao ? 'SALVAR ALTERAÇÕES' : 'CADASTRAR'; ?>
                </button>
                
                <?php if ($modoEdicao): ?>
                    <a href="index.php" class="btn btn-cancel">CANCELAR</a>
                <?php endif; ?>
            </form>
        </div>

        <h1>Estoque Atual</h1>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Volume</th>
                        <th>Valor</th>
                        <th>Qtde</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bebidas)): ?>
                        <?php foreach ($bebidas as $bebida): ?>
                            <tr>
                                <td style="font-weight: 600;"><?php echo htmlspecialchars($bebida->getNome()); ?></td>
                                <td><?php echo htmlspecialchars($bebida->getCategoria()); ?></td>
                                <td><?php echo htmlspecialchars($bebida->getVolume()); ?></td>
                                <td style="color: var(--primary); font-weight: bold;">R$ <?php echo number_format($bebida->getValor(), 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($bebida->getQtde()); ?></td>
                                <td>
                                    <div class="actions">
                                        <form method="POST" style="margin:0;">
                                            <input type="hidden" name="acao" value="editar">
                                            <input type="hidden" name="nome" value="<?php echo htmlspecialchars($bebida->getNome()); ?>">
                                            <button type="submit" class="btn-small btn-edit">Editar</button>
                                        </form>
                                        
                                        <form method="POST" style="margin:0;">
                                            <input type="hidden" name="acao" value="deletar">
                                            <input type="hidden" name="nome" value="<?php echo htmlspecialchars($bebida->getNome()); ?>">
                                            <button type="submit" class="btn-small btn-delete" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: rgba(255,255,255,0.5);">
                                Nenhuma bebida encontrada.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
<?php
session_start(); 
require_once __DIR__ . '/../Controller/LivroController.php';

$controller = new LivroController();

$modoEdicao = false;
$livroEditando = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar') {
        try {
            $nomeExcluido = $_POST['titulo'];
            $controller->excluirLivro($tituloExcluido);
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Livro "'.htmlspecialchars($tituloExcluido).'" excluída com sucesso!'];
        } catch (PDOException $e) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro ao excluir: ' . $e->getMessage()];
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } 
    
    elseif (isset($_POST['acao']) && $_POST['acao'] === 'editar') {
        $bebidaEditando = $controller->buscarPorTitulo($_POST['titulo']);
        if ($livroEditando) {
            $modoEdicao = true;
        }
    } 
    
    elseif (isset($_POST['acao']) && $_POST['acao'] === 'salvar') {
        
        $titulo = $_POST['titulo'];
        $tituloAntigo = $_POST['titulo_antigo'] ?? '';
        
        try {
            if (!empty($tituloAntigo)) {
                $controller->atualizarLivro(
                    $tituloAntigo, 
                    $titulo, 
                    $_POST['autor'], 
                    $_POST['ano_publicacao'], 
                    $_POST['genero_literario'], 
                    $_POST['quantidade_disponivel']
                );
                $mensagem = 'Livro "'.$titulo.'" atualizada com sucesso!';
            } else {
                $controller->criar(
                    $titulo, 
                    $_POST['autor'], 
                    $_POST['ano_publicacao'], 
                    $_POST['genero_literario'], 
                    $_POST['quantidade_disponivel']
                );
                $mensagem = 'Livro "'.$titulo.'" cadastrada com sucesso!';
            }
                        $_SESSION['message'] = ['type' => 'success', 'text' => $mensagem];

        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro: Já existe uma bebida cadastrada com o nome "'.$titulo.'"!'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro no banco de dados: ' . $e->getMessage()];
            }
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
$searchTerm = '';
if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $searchTerm = trim($_GET['q']);
    $livro = $controller->buscarPorTituloParcial($searchTerm); 
} else {
    $livro = $controller->ler();
}

$showModalStatus = false;
$modalType = '';
$modalText = '';

if (isset($_SESSION['message'])) {
    $showModalStatus = true;
    $modalType = $_SESSION['message']['type'];
    $modalText = $_SESSION['message']['text'];
    unset($_SESSION['message']); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Bebidas</title>
    <link rel="icon" href="icon/cerveja.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
</head>
<body>

    <div id="statusModal" class="modal-overlay">
        <div class="modal-content"> <div class="modal-icon"></div> <p id="modalStatusMessage" class="modal-message"></p>
            <button class="btn btn-primary" onclick="document.getElementById('statusModal').classList.remove('show');">FECHAR</button>
        </div>
    </div>
    
    <div id="confirmModal" class="modal-overlay">
        <div class="modal-content modal-confirmation">
            <div class="modal-icon">⚠️</div> 
            <p id="modalConfirmMessage" class="modal-message">Tem certeza que deseja excluir a bebida?</p>
            
            <div class="modal-buttons">
                <form id="deleteForm" method="POST" style="display: contents;">
                    <input type="hidden" name="acao" value="deletar">
                    <input type="hidden" name="nome" id="bebidaParaExcluir">
                    <button type="submit" class="btn btn-confirm">EXCLUIR</button>
                </form>
                <button type="button" class="btn btn-dismiss" onclick="document.getElementById('confirmModal').classList.remove('show');">CANCELAR</button>
            </div>
        </div>
    </div>

<header>
    <div class="logo-container">
        <img src="icon/logo.png" alt="Logo" class="logo-img">
        <span class="logo-text">GESTÃO DE BEBIDAS</span>
    </div>
</header>

    <div class="container">
        
        <div class="tabs-buttons">
            <button class="btn-tab" data-tab="form-section">Cadastro/Edição</button>
            <button class="btn-tab" data-tab="stock-section">Estoque Atual (<?php echo count($bebidas); ?>)</button>
        </div>

        <div id="form-section" class="tab-content hidden">
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
        </div>


        <div id="stock-section" class="tab-content hidden">
            <h1>Estoque Atual (<?php echo empty($searchTerm) ? count($bebidas) : count($bebidas) . ' encontrados'; ?>)</h1>
            
            <form method="GET" class="search-form">
                <input type="text" name="q" placeholder="Pesquisar por nome ou categoria..." 
                       value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit" class="btn btn-search">🔍 Buscar</button> 
                <?php if (!empty($searchTerm)): ?>
                    <a href="index.php" class="btn btn-clear-search">Limpar Busca</a>
                <?php endif; ?>
            </form>

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
                                            
                                            <button type="button" class="btn-small btn-delete" 
                                                    data-nome-bebida="<?php echo htmlspecialchars($bebida->getNome()); ?>"
                                                    onclick="openConfirmModal(this.getAttribute('data-nome-bebida'))">Excluir</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 3rem; color: rgba(255,255,255,0.5);">
                                    <?php echo empty($searchTerm) ? 'Nenhuma bebida encontrada.' : 'Nenhuma bebida corresponde à pesquisa.'; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function openConfirmModal(bebidaNome) {
            document.getElementById('bebidaParaExcluir').value = bebidaNome;
            document.getElementById('modalConfirmMessage').innerHTML = `Tem certeza que deseja excluir a bebida <b>${bebidaNome}</b>?`;
            document.getElementById('confirmModal').classList.add('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.btn-tab');
            const contents = document.querySelectorAll('.tab-content');

            function switchTab(targetId) {
                tabs.forEach(t => t.classList.remove('active'));
                const targetButton = document.querySelector(`.btn-tab[data-tab="${targetId}"]`);
                if (targetButton) targetButton.classList.add('active');

                contents.forEach(content => {
                    if (content.id === targetId) {
                        content.classList.remove('hidden');
                    } else {
                        content.classList.add('hidden');
                    }
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const targetId = tab.getAttribute('data-tab');
                    switchTab(targetId);
                });
            });
            
            // --- MODAL STATUS LOGIC ---
            const statusModal = document.getElementById('statusModal');
            const modalStatusMessageElement = document.getElementById('modalStatusMessage');
            const modalContent = document.querySelector('#statusModal .modal-content');
            const modalIcon = document.querySelector('#statusModal .modal-icon');

            const showModalStatus = <?php echo json_encode($showModalStatus); ?>;
            const modalType = <?php echo json_encode($modalType); ?>; // 'success' ou 'error'
            const modalText = <?php echo json_encode($modalText); ?>;
            
            const modoEdicao = <?php echo json_encode($modoEdicao); ?>;
            const searchTerm = <?php echo json_encode($searchTerm); ?>;

            let initialTabId = 'stock-section';
            if (modoEdicao) {
                initialTabId = 'form-section'; 
            } else if (showModalStatus || searchTerm) {
                 initialTabId = 'stock-section'; 
            }

            if (showModalStatus) {
                 modalStatusMessageElement.textContent = modalText;
                 
                 // Remove classes antigas e aplica a correta
                 modalContent.classList.remove('modal-type-success', 'modal-type-error');
                 
                 if (modalType === 'success') {
                     modalContent.classList.add('modal-type-success');
                     modalIcon.textContent = '✅';
                 } else {
                     modalContent.classList.add('modal-type-error');
                     modalIcon.textContent = '❌';
                 }
                 
                 statusModal.classList.add('show');
            }

            switchTab(initialTabId);
        });
    </script>
</body>
</html>
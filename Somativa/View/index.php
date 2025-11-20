<?php
session_start(); 
require_once __DIR__ . '/../Controller/LivroController.php';

$controller = new LivroController();

$modoEdicao = false;
$livroEditando = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao']) && $_POST['acao'] === 'deletar') {
        try {
            $tituloExcluido = $_POST['titulo']; 
            $controller->excluirLivro($tituloExcluido);
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Livro "'.htmlspecialchars($tituloExcluido).'" excluído com sucesso!'];
        } catch (PDOException $e) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro ao excluir: ' . $e->getMessage()];
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } 
    
    elseif (isset($_POST['acao']) && $_POST['acao'] === 'editar') {
        $livroEditando = $controller->buscarPorTitulo($_POST['titulo']);
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
                $mensagem = 'Livro "'.$titulo.'" atualizado com sucesso!';
            } else {
                $controller->criar(
                    $titulo, 
                    $_POST['autor'], 
                    $_POST['ano_publicacao'], 
                    $_POST['genero_literario'], 
                    $_POST['quantidade_disponivel']
                );
                $mensagem = 'Livro "'.$titulo.'" cadastrado com sucesso!';
            }
            $_SESSION['message'] = ['type' => 'success', 'text' => $mensagem];

        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erro: Já existe um livro cadastrado com o título "'.$titulo.'"!'];
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
    $livros = $controller->buscarPorTituloParcial($searchTerm); 
} else {
    $livros = $controller->ler();
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
    <title>Gestão de Biblioteca</title>
    <link rel="icon" href="icon/biblioteca.png"> 
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
</head>
<body>

    <div id="statusModal" class="modal-overlay">
        <div class="modal-content"> 
            <div class="modal-icon"></div> 
            <p id="modalStatusMessage" class="modal-message"></p>
            <button class="btn btn-primary" onclick="document.getElementById('statusModal').classList.remove('show');">FECHAR</button>
        </div>
    </div>
    
    <div id="confirmModal" class="modal-overlay">
        <div class="modal-content modal-confirmation">
            <div class="modal-icon">⚠️</div> 
            <p id="modalConfirmMessage" class="modal-message">Tem certeza que deseja excluir o livro?</p>
            
            <div class="modal-buttons">
                <form id="deleteForm" method="POST" style="display: contents;">
                    <input type="hidden" name="acao" value="deletar">
                    <input type="hidden" name="titulo" id="livroParaExcluir"> 
                    <button type="submit" class="btn btn-confirm">EXCLUIR</button>
                </form>
                <button type="button" class="btn btn-dismiss" onclick="document.getElementById('confirmModal').classList.remove('show');">CANCELAR</button>
            </div>
        </div>
    </div>

    <header>
        <div class="logo-container">
            <img src="icon/logo.png" alt="Logo" class="logo-img">
            <span class="logo-text">GESTÃO DE BIBLIOTECA</span>
        </div>
    </header>

    <div class="container">
        
        <div class="tabs-buttons">
            <button class="btn-tab" data-tab="form-section">Cadastro/Edição</button>
            <button class="btn-tab" data-tab="list-section">Acervo Atual (<?php echo count($livros); ?>)</button>
        </div>

        <div id="form-section" class="tab-content hidden">
            <h1><?php echo $modoEdicao ? 'Editar Livro' : 'Novo Livro'; ?></h1>

            <div class="card">
                <form method="POST">
                    <input type="hidden" name="acao" value="salvar">
                    
                    <?php if ($modoEdicao): ?>
                        <input type="hidden" name="titulo_antigo" value="<?php echo htmlspecialchars($livroEditando->getTitulo()); ?>">
                    <?php endif; ?>

                    <div class="form-grid">
                        <div class="form-group form-full">
                            <label>Título do Livro:</label>
                            <input type="text" name="titulo" placeholder="Ex: Dom Casmurro" required 
                                   value="<?php echo $modoEdicao ? htmlspecialchars($livroEditando->getTitulo()) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label>Autor:</label>
                            <input type="text" name="autor" placeholder="Ex: Machado de Assis" required
                                   value="<?php echo $modoEdicao ? htmlspecialchars($livroEditando->getAutor()) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label>Ano de Publicação:</label>
                            <input type="number" name="ano_publicacao" placeholder="Ex: 1899" required 
                                   value="<?php echo $modoEdicao ? htmlspecialchars($livroEditando->getAno_publicacao()) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label>Gênero Literário:</label>
                            <input type="text" name="genero_literario" placeholder="Ex: Romance Realista" required 
                                   value="<?php echo $modoEdicao ? htmlspecialchars($livroEditando->getGenero_literario()) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label>Quantidade Disponível:</label>
                            <input type="number" name="quantidade_disponivel" placeholder="0" required 
                                   value="<?php echo $modoEdicao ? htmlspecialchars($livroEditando->getQuantidade_disponivel()) : ''; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <?php echo $modoEdicao ? 'SALVAR ALTERAÇÕES' : 'CADASTRAR LIVRO'; ?>
                    </button>
                    
                    <?php if ($modoEdicao): ?>
                        <a href="index.php" class="btn btn-cancel">CANCELAR EDIÇÃO</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div id="list-section" class="tab-content hidden">
            <h1>Acervo (<?php echo empty($searchTerm) ? count($livros) : count($livros) . ' encontrados'; ?>)</h1>
            
            <form method="GET" class="search-form">
                <input type="text" name="q" placeholder="Pesquisar por título ou autor..." 
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
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Ano</th>
                            <th>Gênero</th>
                            <th>Estoque</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($livros)): ?>
                            <?php foreach ($livros as $livro): ?>
                                <tr>
                                    <td style="font-weight: 600; color: var(--light);"><?php echo htmlspecialchars($livro->getTitulo()); ?></td>
                                    <td><?php echo htmlspecialchars($livro->getAutor()); ?></td>
                                    <td><?php echo htmlspecialchars($livro->getAno_publicacao()); ?></td>
                                    <td><?php echo htmlspecialchars($livro->getGenero_literario()); ?></td>
                                    <td style="color: var(--primary); font-weight: bold;"><?php echo htmlspecialchars($livro->getQuantidade_disponivel()); ?></td>
                                    <td>
                                        <div class="actions">
                                            <form method="POST" style="margin:0;">
                                                <input type="hidden" name="acao" value="editar">
                                                <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($livro->getTitulo()); ?>">
                                                <button type="submit" class="btn-small btn-edit">Editar</button>
                                            </form>
                                            
                                            <button type="button" class="btn-small btn-delete" 
                                                    data-titulo-livro="<?php echo htmlspecialchars($livro->getTitulo()); ?>"
                                                    onclick="openConfirmModal(this.getAttribute('data-titulo-livro'))">Excluir</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 3rem; color: rgba(255,255,255,0.5);">
                                    <?php echo empty($searchTerm) ? 'Nenhum livro cadastrado.' : 'Nenhum livro corresponde à pesquisa.'; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function openConfirmModal(tituloLivro) {
            document.getElementById('livroParaExcluir').value = tituloLivro;
            document.getElementById('modalConfirmMessage').innerHTML = `Tem certeza que deseja excluir o livro <b>${tituloLivro}</b>?`;
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
            
            const statusModal = document.getElementById('statusModal');
            const modalStatusMessageElement = document.getElementById('modalStatusMessage');
            const modalContent = document.querySelector('#statusModal .modal-content');
            const modalIcon = document.querySelector('#statusModal .modal-icon');

            const showModalStatus = <?php echo json_encode($showModalStatus); ?>;
            const modalType = <?php echo json_encode($modalType); ?>; 
            const modalText = <?php echo json_encode($modalText); ?>;
            
            const modoEdicao = <?php echo json_encode($modoEdicao); ?>;
            const searchTerm = <?php echo json_encode($searchTerm); ?>;

            let initialTabId = 'list-section';
            if (modoEdicao) {
                initialTabId = 'form-section'; 
            } else if (showModalStatus || searchTerm) {
                 initialTabId = 'list-section'; 
            }

            if (showModalStatus) {
                 modalStatusMessageElement.textContent = modalText;
                 
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
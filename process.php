<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o arquivo foi enviado
    if (isset($_FILES['project']) && $_FILES['project']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['project'];
        
        // Verifica o tipo de arquivo
        $allowedTypes = ['application/pdf', 'application/zip']; // Adicione os tipos MIME permitidos
        $fileType = mime_content_type($file['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            // Processo para mover o arquivo para um diretório específico
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($file['name']);

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true); // Cria o diretório se não existir
            }

            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                echo "<p>Arquivo enviado com sucesso!</p>";
                
                // Aqui você pode implementar a lógica para processar o arquivo e calcular as medidas
                // Por exemplo, para PDFs, você pode usar bibliotecas para ler o conteúdo

                // Exemplo fictício de cálculo
                $materialNeeded = 100;  // Exemplo fictício de quantidade
                $steelLength = 200;  // Exemplo fictício de comprimento

                echo "<div id='results'>";
                echo "<p>Projeto: {$file['name']}</p>";
                echo "<p>Quantidade de aço necessária: {$materialNeeded} kg</p>";
                echo "<p>Comprimento total de aço: {$steelLength} metros</p>";
                echo "</div>";
            } else {
                echo "<p>Falha ao mover o arquivo para o diretório.</p>";
            }
        } else {
            echo "<p>Tipo de arquivo não permitido.</p>";
        }
    } else {
        echo "<p>Nenhum arquivo foi enviado ou ocorreu um erro no envio.</p>";
    }
} else {
    echo "<p>Requisição inválida.</p>";
}
?>

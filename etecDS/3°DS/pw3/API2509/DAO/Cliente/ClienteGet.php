<?php 

function pegar_clientes($conexao) {
    $sql = "SELECT * FROM Clientes";
    $res = mysqli_query($conexao, $sql) or die("Erro ao tentar consultar");

    $clientes = [];

    while ($registro = mysqli_fetch_array($res)) {
        $id = utf8_encode($registro['ID']);
        $nome = utf8_encode($registro['Nome']);
        $endereco = utf8_encode($registro['Endereco']);
        $cpf = utf8_encode($registro['CPF']);
        $telefone = utf8_encode($registro['Telefone']);
        $email = utf8_encode($registro['Email']);
        $dataNascimento = utf8_encode($registro['DataNascimento']);
        
        $novo_cliente = new Cliente($id, $nome, $endereco, $cpf, $telefone, $email, $dataNascimento);
        array_push($clientes, $novo_cliente);
    }
    
    fecharConexao($conexao);
    return $clientes;
}
?>

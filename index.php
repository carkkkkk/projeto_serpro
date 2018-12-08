<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["cnpj"])){
        $cnpjErr = "CNPJ é requerido";
    } else {
        $cnpjDigitado = $_POST["cnpj"];

        $url = "https://apigateway.serpro.gov.br/consulta-cnpj-trial/v1/cnpj/$cnpjDigitado";

        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer 4e1a1858bdd584fdc077fb7d80f39283'
        );

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        curl_close($ch);

        $result = json_decode($response);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Consulta CNPJ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link href="sticky-footer.css" rel="stylesheet">
      
    </head>
    <body>

        <main role="main" class="container">

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Consulta de CNPJ</h1>
                    <p class="lead">Faz consulta de informação para um determinado CNPJ via APIs da</p>
                    <a href="https://servicos.serpro.gov.br/api-serpro/" target="_blank">SERPRO</a>
                </div>
            </div>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group">
                    <input type="text" class="form-control" name="cnpj" placeholder="Digite o Cnpj...">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-outline-secondary" value="Consultar"/>
                    </div>
                </div>
                <small class="form-text text-muted">Digite o CNPJ sem formatação</small>
            </form>
            <br />
            <h2>Situação Cadastral</h2>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>
                        codigo
                    </td>
                    <td>
                        <?php echo $result->situacao_cadastral->codigo;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Motivo
                    </td>
                    <td>
                        <?php echo $result->situacao_cadastral->motivo;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Data
                    </td>
                    <td>
                        <?php echo $result->situacao_cadastral->data;?>
                    </td>
                </tr>
            </table>
            <h2>Dados</h2>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>
                        NI
                    </td>
                    <td>
                        <?php echo $result->ni;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Data Abertura
                    </td>
                    <td>
                        <?php echo $result->data_abertura;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nome Empresarial
                    </td>
                    <td>
                        <?php echo $result->nome_empresarial;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nome Fantasia
                    </td>
                    <td>
                        <?php echo $result->nome_fantasia;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Situação Especial
                    </td>
                    <td>
                        <?php echo $result->situacao_especial;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Orgão
                    </td>
                    <td>
                        <?php echo $result->orgao;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tipo Estabelecimento
                    </td>
                    <td>
                        <?php echo $result->tipo_estabelecimento;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Correio Eletronico
                    </td>
                    <td>
                        <?php echo $result->correio_eletronico;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Capital Social
                    </td>
                    <td>
                        <?php echo $result->capital_social;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Porte
                    </td>
                    <td>
                        <?php echo $result->porte;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nome Orgão
                    </td>
                    <td>
                        <?php echo $result->nome_orgao;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ente. Federativo
                    </td>
                    <td>
                        <?php echo $result->ente_federativo;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Data Situação Especial
                    </td>
                    <td>
                        <?php echo $result->data_situacao_especial;?>
                    </td>
                </tr>
            </table>
            <br />
            <h2>Endereço</h2>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>
                        Bairro
                    </td>
                    <td>
                        <?php echo $result->endereco->bairro;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Complemento
                    </td>
                    <td>
                        <?php echo $result->endereco->complemento;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        CEP
                    </td>
                    <td>
                        <?php echo $result->endereco->cep;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Municipio
                    </td>
                    <td>
                        <?php echo $result->endereco->municipio;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        UF
                    </td>
                    <td>
                        <?php echo $result->endereco->uf;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Logradouro
                    </td>
                    <td>
                        <?php echo $result->endereco->logradouro;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Numero
                    </td>
                    <td>
                        <?php echo $result->endereco->numero;?>
                    </td>
                </tr>
            </table>
            <br />
            <h2>CANE Principal</h2>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>
                        Código
                    </td>
                    <td>
                        <?php echo $result->cnae_principal->codigo;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Descrição
                    </td>
                    <td>
                        <?php echo $result->cnae_principal->descricao;?>
                    </td>
                </tr>
            </table>
            <br />
            <h2>Natureza Juridica</h2>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>
                        Código
                    </td>
                    <td>
                        <?php echo $result->natureza_juridica->codigo;?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Descrição
                    </td>
                    <td>
                        <?php echo $result->natureza_juridica->descricao;?>
                    </td>
                </tr>
            </table>

        </main>
        <br />
        <footer class="footer">
            <div class="container">
                <span class="text-muted">Desenvolvido por </span><a href="http://felipeptrevizan.com.br" target="_blank">Felipe Trevizan</a>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
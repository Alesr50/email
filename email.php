<?php
$destinatario = $_POST['email'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];

//Arquivos do phpMailer
require 'PHPMAILER/SRC/PHPMAILER.php';
require 'PHPMAILER/SRC/SMTP.php';
require 'PHPMAILER/SRC/POP3.php';
require 'PHPMAILER/SRC/Exception.php';

// Aqui chamamos a classe do PHPMailer : 
$mail = new \PHPMailer\PHPMailer\PHPMailer(); // true habilita exceções

$remetente_email = 'etec.alessandro@gmail.com';
$remetente_nome = 'Prof Alessandro';
$senha = 'hMXqD4kfb0vpmJVR';

// configurações do Gmail para OAuth2
//$clientId = 'seu_client_id';
//$clientSecret = 'seu_client_secret';
//$refreshToken = 'seu_refresh_token';

$mail->SMTPDebug = 0; // 0 para desativar debug
$mail->isSMTP();
//host utilizado é o Sendinblue 
$mail->Host = 'smtp-relay.sendinblue.com';
$mail->SMTPAuth = true;
//Usuario aqui é vindo do "sendinblue", que é o e-mail que tu cria a conta
$mail->Username='etec.alessandro@gmail.com';
$mail->Password='hMXqD4kfb0vpmJVR';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
//Configurando o e-mail , remetente e destinatário
$mail->setFrom($remetente_email, $remetente_nome);
$mail->addAddress($destinatario, 'Nome do destinatário');
$mail->addReplyTo($remetente_email, $remetente_nome);-
$mail->isHTML(true);
$mail->CharSet = 'UTF-8'; 
$mail->Subject = 'Assunto do e-mail';
//aqui é o conteúdo do e-mail
$mail->Body = 'Conteúdo do e-mail';
// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 
// autenticação OAuth2 para o Gmail
/*$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
    $accessToken = $mail->getOAuth()->fetchAuthToken(
    $clientId,
    $clientSecret,
    $refreshToken
);
$mail->getOAuth()->setAccessToken($accessToken);*/
// envia o e-mail

// Criando conexão para salvar os dados no formulário
include("./conexao/conexao.php");
    $pdo = conectar();

if ($mail->send()) {
    echo 'E-mail enviado com sucesso!';
 //apos o envio do e-mail , será salvo no banco os dados do formulário

$sql = "INSERT INTO tblcliente(nomecliente,cpfcliente,emailcliente) VALUES (?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $nome);
$stmt->bindParam(2, $cpf);
$stmt->bindParam(3, $destinatario);
$stmt->execute();
} else {
    echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
}
?>
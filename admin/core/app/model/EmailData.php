function aceptado()
{
$mail = new PHPMailer(true);

try {
//Server settings
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'pruebaprogra2@gmail.com';
$mail->Password = 'Sistemas.123';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

//Recipients
$mail->setFrom('pruebaprogra2@gmail.com', 'Bolsa de Trabajo');
$mail->addAddress("rgersonzs95@gmail.com");

// Content
$mail->isHTML(true);
$mail->Subject = "Bienvenido a la convocatoria";
$mail->Body = "Usted ha sido calificado como apto para entrar a la fase de entrevistas";

$mail->send();
} catch (Exception $e) {
$message = new Message();
}
}
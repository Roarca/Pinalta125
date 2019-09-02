<?php
	/*Lo primero es añadir al script la clase phpmailer desde la ubicación en que esté*/
	require './PHPMailer_5.2.4/class.phpmailer.php';
		
	$name_to_send = $_POST['name_js'];
	$email_to_send = $_POST['email_js'];
	$message_to_send = $_POST['message_js'];
	$numer_to_send = $_POST['number_js'];

	//echo $name_to_send.'|'.$email_to_send.'|'.$message_to_send.'|'.$numer_to_send;
	//Crear una instancia de PHPMailer
	$mail = new PHPMailer();
	//Definir que vamos a usar SMTP
	$mail->IsSMTP();
	//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
	// 0 = off (producción)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug  = 0;
	//Ahora definimos gmail como servidor que aloja nuestro SMTP
	$mail->Host       = 'smtp.gmail.com';
	//El puerto será el 587 ya que usamos encriptación TLS
	//$mail->Port       = 587;
	//Definmos la seguridad como TLS
	$mail->SMTPSecure = 'tls';
	//Tenemos que usar gmail autenticados, así que esto a TRUE
	$mail->SMTPAuth   = true;
	//Definimos la cuenta que vamos a usar. Dirección completa de la misma
	//$mail->Username   = "username@gmail.com";
	//Introducimos nuestra contraseña de gmail
	//$mail->Password   = "New password";
	//Definimos el remitente (dirección y, opcionalmente, nombre)
	$mail->SetFrom('username@gmail.com');
	//Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
	$mail->AddReplyTo('admin@gmail.com','Replica al admin');
	//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
	$mail->AddAddress('username@gmail.com');
	//Definimos el tema del email
	$mail->Subject = 'Correo de '.$name_to_send.' en Pinalta125';
	//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
	//$mail->MsgHTML(file_get_contents('correomaquetado.html'), dirname(ruta_al_archivo));
	$mail->Body = "<h3>Este es un correo recibido de <b style='red'>Pinalta125</b></h3><p><br><b>Correo de contacto :</b> $email_to_send <br><b>Nombre de contacto :</b> $name_to_send <br><b>Numero de contacto :</b> $numer_to_send <br> <b>Contenido del correo:</b> $message_to_send <br><br> Recuerde no responder a este mensaje , refierase al correo de contacto adjunto.</p>";
	//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
	$mail->AltBody = 'Contenido: $name_to_send / $email_to_send / $message_to_send / $numer_to_send';
	//Enviamos el correo
	if(!$mail->Send()) {
	  // echo "Error: " . $mail->ErrorInfo;
	  echo 0;
	} else {
	  echo 1;
	  // echo "Enviado!";
	}
?>

<?php
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'phpmailer/src/Exception.php';
		require 'phpmailer/src/PHPMailer.php';

		$mail = new PHPMailer(true);
		$mail->CharSet= 'UTF-8';
		$mail->setLanguage('ru','phpmailer/language/');
		$mail->IsHTML(true);

		//От кого письмо
		$mail->setFrom('info@fls.guru', 'Новая заявка');
		//Кому отправить
		$mail->addAddress('code@fls.guru');
		//Тема письма
		$mail->Subject = 'Привет! У тебя новая заявка';

		$body = '<h1>Встречайте новое письмо</h1>';

		if (trim(!empty($_POST['name']))){
			$body.='<p><strong>Сума:</strong> '.$_POST['name'].'</p>';
		}
		if (trim(!empty($_POST['email']))){
			$body.='<p><strong>Email:</strong> '.$_POST['email'].'</p>';
		}
		if (trim(!empty($_POST['tron']))){
			$body.='<p><strong>Адрес TRON:</strong> '.$_POST['tron'].'</p>';
		}

		$mail->Body = $body;

		//Отправляєм
		if (!$mail->send()) {
			$message = 'Ошибка';
		} else {
			$message = 'Данные отправлены!';
		}

		$response = ['message' => $message];

		header('Content-type: application/json');
		echo json_encode($response);
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PersonData
{
	public static $tablename = "person";

	public function PersonData()
	{
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
		$this->job_id = "";
		$this->dni = "";
	}

	public function add()
	{
		$sql = "insert into " . self::$tablename . " (name,lastname,file,phone,email,job_id,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->file\",\"$this->phone\",\"$this->email\",$this->job_id, NOW())";
		return Executor::doit($sql);
	}

	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}
	public function del()
	{
		$sql = "update " . self::$tablename . " set status=null where id=$this->id";
		Executor::doit($sql);
	}

	// partiendo de que ya tenemos creado un objecto PersonData previamente utilizamos el contexto
	public function update()
	{
		$sql = "update " . self::$tablename . " set code=\"$this->code\",name=\"$this->name\",ruc=\"$this->ruc\",phone=\"$this->phone\",email=\"$this->email\" where id=$this->id";
		Executor::doit($sql);
	}

	public function accept()
	{
		$sql = "update " . self::$tablename . " set status=1 where id=$this->id";
		Executor::doit($sql);
		$this->aceptado();
	}

	public function acceptCont()
	{
		$sql = "update " . self::$tablename . " set status=2 where id=$this->id";
		Executor::doit($sql);
		$this->contratado();
	}

	public function denied()
	{
		$sql = "update " . self::$tablename . " set status=0 where id=$this->id";
		Executor::doit($sql);
		$this->rechazado();
	}
	public function deniedEnt()
	{
		$sql = "update " . self::$tablename . " set status=3 where id=$this->id";
		Executor::doit($sql);
		$this->noApto();
	}

	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new PersonData());
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new PersonData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new PersonData());
	}

	public function contratado()
	{
		$job = JobData::getById($this->job_id);


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
			$mail->setFrom('pruebaprogra2@gmail.com', 'Bolsa de Trabajo - Conectate Bitel');
			$mail->addAddress($this->email);

			// Content
			$mail->isHTML(true);
			$mail->Subject = "FELICITACIONES!!!";
			$mail->Body = "Enhorabuena $this->name $this->lastname, con DNI N°$this->dni,usted ha sido sido CONTRATADO para el trabajo '$job->name', muchas fecilitaciones, lo esperamos en nuestro sentro de trabajo.";
			$mail->send();
		} catch (Exception $e) {
			$message = new Message();
		}
	}

	public function noApto()
	{
		$job = JobData::getById($this->job_id);


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
			$mail->setFrom('pruebaprogra2@gmail.com', 'Bolsa de Trabajo - Conectate Bitel');
			$mail->addAddress($this->email);

			// Content
			$mail->isHTML(true);
			$mail->Subject = "Lamentamos darle malas noticias";
			$mail->Body = "Hola $this->name $this->lastname, con DNI N°$this->dni,usted ha sido calificado como 'NO APTO' para pasar a la fase de entrevistas, esperamos verlo en una siguiente convocatoria.";
			$mail->send();
		} catch (Exception $e) {
			$message = new Message();
		}
	}

	public function rechazado()
	{
		$job = JobData::getById($this->job_id);


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
			$mail->setFrom('pruebaprogra2@gmail.com', 'Bolsa de Trabajo - Conectate Bitel');
			$mail->addAddress($this->email);

			// Content
			$mail->isHTML(true);
			$mail->Subject = "Lamentamos darle malas noticias";
			$mail->Body = "Hola $this->name $this->lastname, con DNI N°$this->dni,usted no ha pasado la fase de la entrevista, lamentamos comunicarlo que no podra ser contratado para el puesto de trabajo '$job->name, esperamos verlo para una próxima.";
			$mail->send();
		} catch (Exception $e) {
			$message = new Message();
		}
	}

	public function aceptado()
	{
		$job = JobData::getById($this->job_id);


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
			$mail->setFrom('pruebaprogra2@gmail.com', 'Bolsa de Trabajo - Conectate Bitel');
			$mail->addAddress($this->email);

			// Content
			$mail->isHTML(true);
			$mail->Subject = "Bienvenido a la fase de entrevistas";
			$mail->Body = "Hola $this->name $this->lastname, con DNI N°$this->dni,usted ha sido calificado como apto para entrar a la fase de entrevista en el trabajo '$job->name', estaremos en contacto con usted.";

			$mail->send();
		} catch (Exception $e) {
			$message = new Message();
		}
	}
}

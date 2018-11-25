<?php

namespace App\Mail;

class Mail
{
	public static function sendMail($mail, $message, $nom, $prenom)
	{
		$destinataire = 'mike_gil@hotmail.fr'; // Déclaration de l'adresse de destination.
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire)) // On filtre les serveurs qui rencontrent des bogues.
			{
			    $passage_ligne = "\r\n";
			}
			else
			{
			    $passage_ligne = "\n";
			}

			$message_html = '<div style="width: 100%; font-weight: bold">' .$message. '</div>';
			//==========
			 
			//=====Création de la boundary
			$boundary = "-----=".md5(rand());
			 
			 
			$expediteur = $mail;
			 
			 
			//=====Création du header de l'e-mail.
			$header = "From:" .$expediteur .$passage_ligne;
			$header.= "Reply-to:" .$expediteur .$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			//==========
			 
			//=====Création du message.

			$message.= $passage_ligne."--".$boundary.$passage_ligne;
			//=====Ajout du message au format HTML
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

			 mail($destinataire, $nom, $message, $header);
	}

	public static function sendNewDataMail($id, $mail, $key, $username, $option)
	{
		$destinataire = $mail; // Déclaration de l'adresse de destination.
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire)) // On filtre les serveurs qui rencontrent des bogues.
			{
			    $passage_ligne = "\r\n";
			}
			else
			{
			    $passage_ligne = "\n";
			}

			if ($option == 'inscription') {
				$message_html = '<div style="width: 100%; font-weight: bold">Bonjour, le blog 
							passion-php.fr vous souhaite la bienvenue, veuillez cliquer sur 
							le lien si-dessous pour vous inscrire:<br/>
							<a href="http://www.passion-php.fr/inscription/' .$id. '/token/' .$key. '">Inscription</a></div>';
			} elseif ($option == 'restart') {
				$message_html = '<div style="width: 100%; font-weight: bold">Bonjour M./Mme. ' .$username. '<br/>
							Cliquez sur le lien si-dessous pour réinitialiser votre mot de passe:<br/>
							<a href="http://www.passion-php.fr/nouveau_password/' .$id. '/token/' .$key. '">Réinitialisation Mot de Passe</a></div>';
			//==========
			}
			
			//=====Création de la boundary
			$boundary = "-----=".md5(rand());
			//==========
			 
			 
			$expediteur = 'Blog Passion-PHP';
			 
			//=====Création du header de l'e-mail.
			$header = "From:" .$expediteur .$passage_ligne;
			$header.= "Reply-to:" .$expediteur .$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			//==========
			 
			//=====Création du message.

			$message= $passage_ligne."--".$boundary.$passage_ligne;
			//=====Ajout du message au format HTML
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

			 $data = mail($destinataire, $username, $message, $header);
	}
}
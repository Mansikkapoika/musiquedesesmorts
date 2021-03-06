<?php

class controleurHelp {

	private $user;
	private $Dir;

	public function __construct()
	{
		if(file_exists(getcwd().'/../../model/model.php')) 
		{
			$this->Dir = '../../';
			require_once '../../model/user.php';
			require_once '../../class/panier.class.php';
		}
		elseif(file_exists(getcwd().'/../model/model.php')) 
		{
			$this->Dir = '../';
			require_once '../model/user.php';
			require_once '../class/panier.class.php';
		}
		elseif(file_exists(getcwd().'/model/model.php'))
		{
			$this->Dir = '/';
			require_once 'model/user.php';
			require_once 'class/panier.class.php';
		}

		$this->user = new User();

		// Il est obligatoire de faire un session start après l'include de la classe
		session_start();
	}

	public function afficheHelp() {
		$titre = 'Music Hall';
		$position = 'Aide';

		// Vérification admin (Affiche lien administration menu + permission d'accès page)
		if (isset($_SESSION['username'])) {
			$username = $this->user->echapVar($_SESSION['username']);
			$reqAdmin = $this->user->getUser($username);
			if ($reqAdmin['codeSecu'] == 3)
			{
				$access = true;
			}
			else
			{
				$access = false;
			}
		}

	if (isset($_SESSION['username']))      // Si connecté
	{
		require_once $this->Dir.'help/view_help.php';
		require_once $this->Dir.'gabarit.php';
	}
	else
	{
		require_once $this->Dir.'help/view_help.php';
		require_once $this->Dir.'gabarit.php';
	}

}

}
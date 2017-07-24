<?php
namespace app\controllers;


use monControl\Controller\Controller;
use app\models\UserTable;
use lib\Model\Model;

class indexController extends Controller {

	public function indexAction(){
		// $userTable = new UserTable();
		// $user = $userTable->findOne('login = ?', 'firstname = ?', 'lastname = ?', array('Yo', 'Ayoub', 'Chahib'));
		$this->render("index/index", array("firstname" => "Ayoub","lastname" => "Chahib"));



	}
}
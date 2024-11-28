<?php

include_once("helper/MysqlDatabase.php");
include_once("helper/MysqlObjectDatabase.php");
include_once("helper/IncludeFilePresenter.php");
include_once("helper/Router.php");
include_once("helper/MustachePresenter.php");
include_once("helper/SenderEmailPHPMailer.php");
//include_once('vendor/mustache/src/Mustache/Autoloader.php');

include_once("model/RegistroModel.php");
include_once("model/LoginModel.php");
include_once("model/UsuarioModel.php");
include_once("model/CrearPartidaModel.php");
include_once("model/PreguntasPartidaModel.php");
include_once("model/HomeModel.php");
include_once("model/CrearPreguntaModel.php");
include_once("model/AdminModel.php");

include_once("controller/UsuarioController.php");
include_once("controller/HomeController.php");
include_once("controller/PerfilController.php");
include_once("controller/InicioController.php");
include_once("controller/RegistroController.php");
include_once("controller/LoginController.php");
include_once("controller/CrearPartidaController.php");
include_once("controller/PartidaController.php");
include_once("controller/PreguntasPartidaController.php");
include_once("controller/EditorController.php");
include_once("controller/AdminController.php");


class Configuration
{
    public function __construct() {}

    public function getPresenter()
    {
        return new MustachePresenter("./view");
    }

    public function getInicioController()
    {
        return new InicioController($this->getPresenter());
    }
    public function getUsuarioController()
    {
        return new UsuarioController(new UsuarioModel($this->getDatabase()),$this->getPresenter());
    }
    public function getRegistroController()
    {
        return new RegistroController($this->getPresenter(), new RegistroModel($this->getDatabase()), new SenderEmailPHPMailer());
    }

    public function getPreguntasPartidaController()
    {
        return new PreguntasPartidaController($this->getPresenter(),new PreguntasPartidaModel($this->getDatabase()),new UsuarioModel($this->getDatabase()),new CrearPartidaModel($this->getDatabase()));
    }
    public function getCrearPartidaController()
    {
        return new CrearPartidaController($this->getPresenter(),new CrearPartidaModel($this->getDatabase()),new HomeModel($this->getDatabase()));
    }

    public function getPartidaController()
    {
        return new PartidaController($this->getPresenter(),new PreguntasPartidaModel($this->getDatabase()),new CrearPartidaModel($this->getDatabase()),new HomeModel($this->getDatabase()));
    }

    public function getLoginController()
    {
        return new LoginController($this->getPresenter(), new LoginModel($this ->getDatabase()));
    }

    public function getHomeController()
    {
        return new HomeController($this->getPresenter(),new HomeModel($this->getDatabase()) ,new CrearPartidaModel($this->getDatabase()),new CrearPreguntaModel($this->getDatabase()));
    }

    public function getPerfilController()
    {
        return new PerfilController($this->getPresenter(),new CrearPartidaModel($this->getDatabase()));
    }

    public function getAdminController()
    {
        return new AdminController($this->getPresenter(),new AdminModel($this->getDatabase()));
    }

    public function getEditorController()
    {
        return new EditorController($this->getPresenter(),new CrearPreguntaModel($this->getDatabase()));
    }
    public function getDatabase()
    {
        $config = parse_ini_file("configuration/config.ini");
        return new MysqlDatabase($config["host"], $config["port"], $config["username"], $config["password"], $config["dbname"]);
    }

    public function getRouter()
    {
        return new Router($this, "getInicioController", "inicio");
    }
}

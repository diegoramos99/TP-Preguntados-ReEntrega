<?php
require_once __DIR__ . '/../libs/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

class MustachePresenter{
    private $templateDir;

    private $mustache;
    private $partialsPathLoader;

   /* public function __construct($partialsPathLoader){
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
            'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
        ));
        $this->partialsPathLoader = $partialsPathLoader;
    }*/

    public function __construct($templateDir) {
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
                'partials_loader' => new Mustache_Loader_FilesystemLoader($templateDir)
            )
        );
        $this->templateDir = $templateDir; // Asegúrate de asignar el directorio de plantillas aquí
    }


    public function show($contentFile , $data = array() ){
        echo  $this->generateHtml(  $this->partialsPathLoader . '/' . $contentFile . "View.mustache" , $data);
    }

    public function generateHtml($contentFile, $data = array()) {
        $contentAsString = file_get_contents(  $this->partialsPathLoader .'/header.mustache');
        $contentAsString .= file_get_contents( $contentFile );
        $contentAsString .= file_get_contents($this->partialsPathLoader . '/footer.mustache');
        return $this->mustache->render($contentAsString, $data);
    }

    public function render($templateName, $data = [])
    {
        $mustache = new Mustache_Engine;
        // Cargar la plantilla desde el directorio especificado
        $templatePath = $this->templateDir . '/' . $templateName . '.mustache';

        if (!file_exists($templatePath)) {
            throw new Exception("La plantilla $templateName no existe.");
        }

        // Obtener el contenido de la plantilla
        $templateContent = file_get_contents($templatePath);
        return $mustache->render($templateContent, $data);
    }
}
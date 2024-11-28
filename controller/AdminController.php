<?php

class AdminController
{

    private $presenter;
    private  $adminModel;
    public function __construct($presenter,$adminModel)
    {
        $this->presenter = $presenter;
        $this->adminModel=$adminModel;
    }

    public function inicio()
    {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        $username = $usuario['nombre_usuario'] ?? 'Invitado';
        $id_usuario = $sesion->obtenerUsuarioID();
        $id = $usuario['id'] ?? 'Invitado';

        // Valido que el usuario tenga la sesion iniciada, sino lo mando al login
        if($username=='Invitado' || $username=='editor')
            header("Location: /app/login");

        echo $this->presenter->render('admin', [
            'nombre_usuario' => $username,
            'id' => $id
        ]);
    }


    public function obtenerEstadisticasPreguntas1() {
            $data=$this->adminModel->traerPreguntasCorrectas();

        $width = 500;
        $height = 300;

// Crear una imagen en blanco
        $image = imagecreate($width, $height);

// Colores
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $blue = imagecolorallocate($image, 100, 149, 237);

// Fondo blanco
        imagefill($image, 0, 0, $white);

// Dibujar el gráfico de barras
        $barWidth = 40;
        $barSpacing = 120;
        $baseLine = $height - 50;
        $font = 5;  // Tamaño de la fuente

// Definir etiquetas para las barras
        $labels = ['correctas '.$data[0]. "%", 'incorrectas '.$data[1]. "%"];  // Etiquetas de las barras

        $x = $barSpacing;
        foreach ($data as $index => $value) {
            $barHeight = $value * 5; // Escalar los valores, ajusta el factor si es necesario
            imagefilledrectangle($image, $x, $baseLine - $barHeight, $x + $barWidth, $baseLine, $blue);
            imagestring($image, $font, $x, $baseLine + 20, $labels[$index], $black); // Etiqueta debajo de la barra
            $x += $barWidth + $barSpacing;
        }

// Guardar la imagen como archivo
        $filePath = __DIR__ . '/../chart.png';
        imagepng($image, $filePath);
        imagedestroy($image);

        header('location:/app/descargar_pdf.php');

}
    public function obtenerUsuarioPorEdad() {
        $data = $this->adminModel->clasificarUsuariosPorEdad(); // Ejemplo: ['Niños (0-12)' => 5, 'Adultos Jóvenes (18-35)' => 15]


        $width = 1000;
        $height = 500;

// Crear una imagen en blanco
        $image = imagecreate($width, $height);

// Colores
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $blue = imagecolorallocate($image, 100, 149, 237);

// Fondo blanco
        imagefill($image, 0, 0, $white);

// Dibujar el gráfico de barras
        $barWidth = 40;
        $barSpacing = 120;
        $baseLine = $height - 50;
        $font = 5;  // Tamaño de la fuente

// Definir etiquetas para las barras
        $labels = ['niños'.$data[0].'%','adolecntes'.$data[1].'%','adultos'.$data[2].'%','ancianos'.$data[3].'%'];  // Etiquetas de las barras

        $x = $barSpacing;
        foreach ($data as $index => $value) {
            $barHeight = $value * 5; // Escalar los valores, ajusta el factor si es necesario
            imagefilledrectangle($image, $x, $baseLine - $barHeight, $x + $barWidth, $baseLine, $blue);
            imagestring($image, $font, $x, $baseLine + 20, $labels[$index], $black); // Etiqueta debajo de la barra
            $x += $barWidth + $barSpacing;
        }

// Guardar la imagen como archivo
        $filePath = __DIR__ . '/../chart.png';
        imagepng($image, $filePath);
        imagedestroy($image);

        header('location:/app/descargar_pdf.php');
exit();
    }





}
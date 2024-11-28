<?php

class EditorController
{

    private $presenter;
    private $crearPreguntaModel;

    public function __construct($presenter, $crearPreguntaModel)
    {
        $this->presenter = $presenter;
        $this->crearPreguntaModel = $crearPreguntaModel;

    }

    public function inicio()
    {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        $id_usuario = $sesion->obtenerUsuarioID();
        $id = $usuario['id'] ?? 'Invitado';
        $username = $usuario['nombre_usuario'] ?? 'Invitado';
        $pais = $usuario['pais'] ?? 'Invitado';
        $ciudad = $usuario['ciudad'] ?? 'Invitado';
        $fotoIMG = $usuario['fotoIMG'] ?? 'Invitado';
        $pregutasSugeridas = $this->crearPreguntaModel->obtenerPreguntasSugeridas();
        $reportes = $this->crearPreguntaModel-> obtenerReportes();

        $usuarios=$this->crearPreguntaModel->ObtenerTodosLosUsuarios();
        foreach ($reportes as &$reporte) {
            foreach ($usuarios as $usuario) {
                if ($reporte['Usuario_id'] === $usuario['id']) {
                    $reporte['nombre_usuario'] = $usuario['nombre'];
                    break;
                }
            }
        }
        // Valido que el usuario tenga la sesion iniciada, sino lo mando al login
        if($username=='Invitado' || $username=="admin")
            header("Location: /app/login");

        echo $this->presenter->render('editor', [
            'pais' => $pais,
            'ciudad' => $ciudad,
            'fotoIMG' => $fotoIMG,
            'preguntasSugeridas' => $pregutasSugeridas,
            'ID' => $id,
            'reportes' => $reportes
        ]);
    }

    public function eliminarPregunta()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID'])) {
            // Obtener el ID de la pregunta a eliminar
            $id = $_POST['ID'];
              print_r($id); // Asegúrate de que muestra un valor correcto

            // Llamada al modelo para eliminar la pregunta
            $this->crearPreguntaModel->eliminarPregunta($id);
        }
        // Redirigir al editor después de eliminar la pregunta
        header("Location: /app/editor");
        exit();
    }

    public function agregarPregunta()
    {
        // Comprobamos que sea una solicitud POST y que se haya enviado un ID
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID'])) {

            // Obtener el ID de la pregunta a eliminar

            $id = $_POST['ID'];

            $pregunta=isset($_POST['Pregunta'])?$_POST['Pregunta']:null;

            $OpcionA=isset($_POST['OpcionA'])?$_POST['OpcionA']:null;

            $OpcionB=isset($_POST['OpcionB'])?$_POST['OpcionB']:null;

            $OpcionC=isset($_POST['OpcionC'])?$_POST['OpcionC']:null;

            $OpcionD=isset($_POST['OpcionD'])?$_POST['OpcionD']:null;

            $OpcionCorrecta=isset($_POST['OpcionCorrecta'])?$_POST['OpcionCorrecta']:null;

            $Categoria=isset($_POST['Categoria'])?$_POST['Categoria']:null;
            // Asegúrate de que los parámetros necesarios estén presentes
            if ($pregunta !=null && $OpcionA !=null  && $OpcionB !=null&& $OpcionC !=null&& $OpcionD !=null&& $OpcionCorrecta !=null && $Categoria!=null) {
                // Llamar al modelo para agregar la pregunta y sus respuestas
                try {

                    $this->crearPreguntaModel->agregarPregunta($pregunta,$OpcionA,$OpcionB,$OpcionC,$OpcionD,$OpcionCorrecta,$Categoria);
                    // Llamar al método para eliminar la pregunta en la tabla sugerencia usando el ID
                    $this->crearPreguntaModel->eliminarPregunta($id);

                    // Redirigir después de agregar y eliminar la pregunta de sugerencia
                    header("Location: /app/editor");
                    exit();

                    exit();
                } catch (Exception $e) {
                    // Manejar error si ocurre
                    echo "Error al agregar la pregunta: " . $e->getMessage() ;
                }
            } else {
                // Si faltan parámetros, mostrar un mensaje de error
                echo "Faltan parámetros para agregar la pregunta.";
            }
        } else {
            echo "No se proporcionó un ID para eliminar.";
        }
    }
    public function modificarPregunta() {
        // Extraer los datos

        $Usuario_id = isset($_POST['Usuario_id'])?$_POST['Usuario_id']:null;

        $Pregunta=isset($_POST['Pregunta'])?$_POST['Pregunta']:null;

        $OpcionA=isset($_POST['OpcionA'])?$_POST['OpcionA']:null;

        $OpcionB=isset($_POST['OpcionB'])?$_POST['OpcionB']:null;

        $OpcionC=isset($_POST['OpcionC'])?$_POST['OpcionC']:null;

        $OpcionD=isset($_POST['OpcionD'])?$_POST['OpcionD']:null;

        $OpcionCorrecta=isset($_POST['OpcionCorrecta'])?$_POST['OpcionCorrecta']:null;

        $Categoria=isset($_POST['Categoria'])?$_POST['Categoria']:null;

        $ID=isset($_POST['ID'])?$_POST['ID']:null;

        $resultado = $this->crearPreguntaModel->modificarPreguntaSugerida($Pregunta, $OpcionA, $OpcionB, $OpcionC, $OpcionD, $OpcionCorrecta, $Categoria,$Usuario_id,$ID);

        if ($resultado['affected_rows'] > 0) {
            $this->inicio();
        } else {
            echo "Advertencia: No se actualizó ninguna fila. Verifica que el ID existe y los datos han cambiado.";
        }
    }

    public function rechazarReporte() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID'])) {
            // Obtener el ID de la pregunta a eliminar
            $idReporte = $_POST['ID'];

            $this->crearPreguntaModel->eliminarReporte($idReporte);
        }
        header("Location: /app/editor");
        exit();
    }

    public function aprobarReporte() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID']) && isset($_POST['Pregunta_id'])) {
            // Obtener el ID de la pregunta a eliminar
            $idReporte = $_POST['ID'];
            $idPregunta = $_POST['Pregunta_id'];

            $this->crearPreguntaModel->eliminarRespuestas($idPregunta);
            $this->crearPreguntaModel->eliminarReporteRelacionado($idPregunta);

            $this->crearPreguntaModel->eliminarPreguntaRe($idPregunta);
            $this->crearPreguntaModel->eliminarReporte($idReporte);

        }
        header("Location: /app/editor");
        exit();
    }



}




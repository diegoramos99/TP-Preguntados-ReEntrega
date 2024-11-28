CREATE TABLE Rol (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Rol VARCHAR(50) NOT NULL
);

CREATE TABLE Status (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Estado VARCHAR(50) NOT NULL
);

CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasenia VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    pais  VARCHAR(255) NOT NULL,
    sexo  VARCHAR(255) NOT NULL,
    ciudad  VARCHAR(255) NOT NULL,
    email  VARCHAR(255) NOT NULL  ,
    Path_img_perfil VARCHAR(255),
    activo BOOLEAN DEFAULT FALSE,
    token INT,
    latitudMapa INT,
    longitudMapa INT,
    rol INT DEFAULT 1,
    total_respuestas INT DEFAULT 1,
    total_respuestas_correctas INT DEFAULT 0,
    FOREIGN KEY (rol) REFERENCES Rol(ID)
);

CREATE TABLE Categoria (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Categoria VARCHAR(50) NOT NULL,
    Color VARCHAR(50)
);

CREATE TABLE Pregunta (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Pregunta TEXT NOT NULL,
    Dificultad INT DEFAULT 1,
    Categoria_id INT,
    mostrada INT DEFAULT 1,
    acertada INT DEFAULT 1,
    FOREIGN KEY (Categoria_id) REFERENCES Categoria(ID)
);

CREATE TABLE Respuesta (
ID INT PRIMARY KEY AUTO_INCREMENT,
Texto_respuesta TEXT NOT NULL,
Es_correcta BOOLEAN DEFAULT FALSE, -- Solo una respuesta tendrá TRUE para cada pregunta
Pregunta_id INT,
FOREIGN KEY (Pregunta_id) REFERENCES Pregunta(ID)
);
CREATE TABLE Partida (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Status_id INT,
    Descripcion TEXT NOT NULL ,
    Puntuacion INT NOT NULL,
    Puntuacion_porcentaje DECIMAL(5, 2) NOT NULL,
    Usuario_id INT,
    Fecha_creada DATETIME DEFAULT CURRENT_TIMESTAMP,
    Fecha_finalizada DATETIME,
    FOREIGN KEY (Status_id) REFERENCES Status(ID),
    FOREIGN KEY (Usuario_id) REFERENCES Usuario(id)
);

CREATE TABLE Pregunta_vista (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Usuario_id INT,
    Pregunta_id INT,
    FOREIGN KEY (Usuario_id) REFERENCES Usuario(id),
    FOREIGN KEY (Pregunta_id) REFERENCES Pregunta(ID)
);

CREATE TABLE Reporte (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Pregunta_id INT,
    Descripcion TEXT NOT NULL,
    Usuario_id INT,
    FOREIGN KEY (Pregunta_id) REFERENCES Pregunta(ID),
    FOREIGN KEY (Usuario_id) REFERENCES Usuario(id)
);
ALTER TABLE Reporte ADD COLUMN nombre_usuario VARCHAR(255);
CREATE TABLE Sugerencia (
                            ID INT PRIMARY KEY AUTO_INCREMENT,
                            Pregunta TEXT NOT NULL,
                            OpcionA VARCHAR(255) NOT NULL,
                            OpcionB VARCHAR(255) NOT NULL,
                            OpcionC VARCHAR(255) NOT NULL,
                            OpcionD VARCHAR(255) NOT NULL,
                            OpcionCorrecta CHAR(1) NOT NULL, -- para almacenar la letra de la opción correcta
                            Categoria VARCHAR(50),
                            Usuario_id INT,
                            FOREIGN KEY (Usuario_id) REFERENCES Usuario(id)
);
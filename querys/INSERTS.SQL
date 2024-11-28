-- Arrancan los inserts
INSERT INTO Categoria (Categoria, Color) VALUES ('Arte', 'Azul');
INSERT INTO Categoria (Categoria, Color) VALUES ('Cine', 'Rojo');
INSERT INTO Categoria (Categoria, Color) VALUES ('Deportes', 'Verde');
INSERT INTO Categoria (Categoria, Color) VALUES ('Historia', 'Amarillo');
INSERT INTO Categoria (Categoria, Color) VALUES ('Ciencia', 'Morado');
INSERT INTO Categoria (Categoria, Color) VALUES ('Geografía', 'Naranja');


UPDATE Pregunta
SET Dificultad =2
WHERE ID=3;
UPDATE Pregunta
SET Dificultad =3
WHERE ID=4;

UPDATE Pregunta
SET Dificultad =3
WHERE ID=7;
UPDATE Pregunta
SET Dificultad =2
WHERE ID=6;

UPDATE Pregunta
SET Dificultad =3
WHERE ID=14;
UPDATE Pregunta
SET Dificultad =2
WHERE ID=15;

UPDATE Pregunta
SET Dificultad =3
WHERE ID=18;
UPDATE Pregunta
SET Dificultad =2
WHERE ID=17;

UPDATE Pregunta
SET Dificultad =3
WHERE ID=21;
UPDATE Pregunta
SET Dificultad =2
WHERE ID=22;

UPDATE Pregunta
SET Dificultad =3
WHERE ID=27;
UPDATE Pregunta
SET Dificultad =2
WHERE ID=30;


-- Insertando preguntas de la categoría Arte (ID = 1)
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
    ('¿Quién pintó la Mona Lisa?', 1, 1),
    ('¿Cuál es el nombre del escultor del David?', 1, 1),
    ('¿En qué museo se encuentra la obra "La noche estrellada"?', 1, 1),
    ('¿Qué artista es conocido por el uso del cubismo?', 1, 1),
    ('¿Cuál es el movimiento artístico liderado por Salvador Dalí?', 2, 1),
    ('¿En qué país nació Vincent van Gogh?', 2, 1),
    ('¿Qué artista pintó "El grito"?', 3, 1),
    ('¿Qué técnica popularizó Georges Seurat?', 3, 1),
    ('¿Quién diseñó la cúpula de la Basílica de San Pedro?', 1, 1),
    ('¿Qué pintor es conocido por su obra "Las Meninas"?', 1, 1);


-- Respuestas para "¿Quién pintó la Mona Lisa?" (ID = 1)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Leonardo da Vinci', TRUE, 1),
    ('Pablo Picasso', FALSE, 1),
    ('Claude Monet', FALSE, 1),
    ('Vincent van Gogh', FALSE, 1);

-- Respuestas para "¿Cuál es el nombre del escultor del David?" (ID = 2)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Miguel Ángel', TRUE, 2),
    ('Donatello', FALSE, 2),
    ('Bernini', FALSE, 2),
    ('Leonardo da Vinci', FALSE, 2);

-- Respuestas para "¿En qué museo se encuentra la obra 'La noche estrellada'?" (ID = 3)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Museo de Arte Moderno (MoMA)', TRUE, 3),
    ('Museo del Louvre', FALSE, 3),
    ('Museo del Prado', FALSE, 3),
    ('Museo de Orsay', FALSE, 3);

-- Respuestas para "¿Qué artista es conocido por el uso del cubismo?" (ID = 4)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Pablo Picasso', TRUE, 4),
    ('Paul Cézanne', FALSE, 4),
    ('Henri Matisse', FALSE, 4),
    ('Joan Miró', FALSE, 4);

-- Respuestas para "¿Cuál es el movimiento artístico liderado por Salvador Dalí?" (ID = 5)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Surrealismo', TRUE, 5),
    ('Cubismo', FALSE, 5),
    ('Expresionismo', FALSE, 5),
    ('Impresionismo', FALSE, 5);

-- Respuestas para "¿En qué país nació Vincent van Gogh?" (ID = 6)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Países Bajos', TRUE, 6),
    ('Francia', FALSE, 6),
    ('Bélgica', FALSE, 6),
    ('Alemania', FALSE, 6);

-- Respuestas para "¿Qué artista pintó 'El grito'?" (ID = 7)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Edvard Munch', TRUE, 7),
    ('Gustav Klimt', FALSE, 7),
    ('Paul Gauguin', FALSE, 7),
    ('Claude Monet', FALSE, 7);

-- Respuestas para "¿Qué técnica popularizó Georges Seurat?" (ID = 8)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Puntillismo', TRUE, 8),
    ('Cubismo', FALSE, 8),
    ('Futurismo', FALSE, 8),
    ('Surrealismo', FALSE, 8);

-- Respuestas para "¿Quién diseñó la cúpula de la Basílica de San Pedro?" (ID = 9)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Miguel Ángel', TRUE, 9),
    ('Bernini', FALSE, 9),
    ('Leon Battista Alberti', FALSE, 9),
    ('Filippo Brunelleschi', FALSE, 9);

-- Respuestas para "¿Qué pintor es conocido por su obra 'Las Meninas'?" (ID = 10)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Diego Velázquez', TRUE, 10),
    ('Francisco de Goya', FALSE, 10),
    ('El Greco', FALSE, 10),
    ('Bartolomé Esteban Murillo', FALSE, 10);

-- Insertando preguntas de la categoría Cine (ID = 2)
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
    ('¿Quién dirigió la película "Titanic"?', 1, 2),
    ('¿En qué año se estrenó la película "El Padrino"?', 1, 2),
    ('¿Cuál es el nombre del actor que interpretó a Harry Potter?', 1, 2),
    ('¿En qué película de Alfred Hitchcock se desarrolla el concepto de suspenso con una llamada telefónica?', 1, 2),
    ('¿Qué película ganó el Oscar a Mejor Película en 1994?', 2, 2),
    ('¿Quién ganó el Oscar a Mejor Actor en 2020?', 2, 2),
    ('¿En qué película de ciencia ficción se presenta el concepto de la "Matrix"?', 3, 2),
    ('¿Qué película de Quentin Tarantino tiene una famosa escena de "La Masacre de los 7" en un restaurante?', 3, 2),
    ('¿En qué película de Disney aparece la canción "Let It Go"?', 1, 2),
    ('¿Quién interpretó al Joker en la película "El Caballero Oscuro"?', 1, 2);


-- Respuestas para "¿Quién dirigió la película 'Titanic'?" (ID Pregunta = 11)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('James Cameron', TRUE, 11),
    ('Steven Spielberg', FALSE, 11),
    ('Christopher Nolan', FALSE, 11),
    ('Ridley Scott', FALSE, 11);

-- Respuestas para "¿En qué año se estrenó la película 'El Padrino'?" (ID Pregunta = 12)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('1972', TRUE, 12),
    ('1974', FALSE, 12),
    ('1969', FALSE, 12),
    ('1980', FALSE, 12);

-- Respuestas para "¿Cuál es el nombre del actor que interpretó a Harry Potter?" (ID Pregunta = 13)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Daniel Radcliffe', TRUE, 13),
    ('Rupert Grint', FALSE, 13),
    ('Elijah Wood', FALSE, 13),
    ('Tom Felton', FALSE, 13);

-- Respuestas para "¿En qué película de Alfred Hitchcock se desarrolla el concepto de suspenso con una llamada telefónica?" (ID Pregunta = 14)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('La ventana indiscreta', TRUE, 14),
    ('Psicosis', FALSE, 14),
    ('Vértigo', FALSE, 14),
    ('Los pájaros', FALSE, 14);

-- Respuestas para "¿Qué película ganó el Oscar a Mejor Película en 1994?" (ID Pregunta = 15)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Forrest Gump', TRUE, 15),
    ('Pulp Fiction', FALSE, 15),
    ('El Rey León', FALSE, 15),
    ('Cadena perpetua', FALSE, 15);

-- Respuestas para "¿Quién ganó el Oscar a Mejor Actor en 2020?" (ID Pregunta = 16)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Joaquin Phoenix', TRUE, 16),
    ('Leonardo DiCaprio', FALSE, 16),
    ('Brad Pitt', FALSE, 16),
    ('Adam Driver', FALSE, 16);

-- Respuestas para "¿En qué película de ciencia ficción se presenta el concepto de la 'Matrix'?" (ID Pregunta = 17)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('The Matrix', TRUE, 17),
    ('Blade Runner', FALSE, 17),
    ('Minority Report', FALSE, 17),
    ('Tron', FALSE, 17);

-- Respuestas para "¿Qué película de Quentin Tarantino tiene una famosa escena de 'La Masacre de los 7' en un restaurante?" (ID Pregunta = 18)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Reservoir Dogs', TRUE, 18),
    ('Pulp Fiction', FALSE, 18),
    ('Kill Bill', FALSE, 18),
    ('Bastardos sin gloria', FALSE, 18);

-- Respuestas para "¿En qué película de Disney aparece la canción 'Let It Go'?" (ID Pregunta = 19)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Frozen', TRUE, 19),
    ('Encanto', FALSE, 19),
    ('Moana', FALSE, 19),
    ('Valiente', FALSE, 19);

-- Respuestas para "¿Quién interpretó al Joker en la película 'El Caballero Oscuro'?" (ID Pregunta = 20)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Heath Ledger', TRUE, 20),
    ('Joaquin Phoenix', FALSE, 20),
    ('Jack Nicholson', FALSE, 20),
    ('Jared Leto', FALSE, 20);

-- Preguntas para Deportes
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id, mostrada, acertada)
VALUES
    ('¿En qué país se originaron los Juegos Olímpicos?', 1, 3, 1, 1), -- ID 21
    ('¿Quién tiene el récord de más goles en la historia del fútbol?', 1, 3, 1, 1), -- ID 22
    ('¿En qué deporte es famoso Usain Bolt?', 1, 3, 1, 1), -- ID 23
    ('¿Cuántos jugadores conforman un equipo de rugby?', 2, 3, 1, 1), -- ID 24
    ('¿Qué país ha ganado más Copas del Mundo de fútbol?', 2, 3, 1, 1), -- ID 25
    ('¿Qué jugador de baloncesto es conocido como "His Airness"?', 1, 3, 1, 1), -- ID 26
    ('¿Cuántos sets debe ganar un jugador para ganar un partido de tenis en Grand Slam?', 3, 3, 1, 1), -- ID 27
    ('¿En qué ciudad se celebraron los Juegos Olímpicos de 2008?', 3, 3, 1, 1), -- ID 28
    ('¿Qué disciplina combina esquí de fondo y tiro al blanco?', 1, 3, 1, 1), -- ID 29
    ('¿Quién es el máximo goleador en la historia de la NBA?', 1, 3, 1, 1); -- ID 30

-- Respuestas para Deportes

-- Respuestas para "¿En qué país se originaron los Juegos Olímpicos?" (ID Pregunta = 21)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Grecia', TRUE, 21),
    ('Italia', FALSE, 21),
    ('Francia', FALSE, 21),
    ('España', FALSE, 21);

-- Respuestas para "¿Quién tiene el récord de más goles en la historia del fútbol?" (ID Pregunta = 22)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Cristiano Ronaldo', TRUE, 22),
    ('Lionel Messi', FALSE, 22),
    ('Pelé', FALSE, 22),
    ('Diego Maradona', FALSE, 22);

-- Respuestas para "¿En qué deporte es famoso Usain Bolt?" (ID Pregunta = 23)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Atletismo', TRUE, 23),
    ('Fútbol', FALSE, 23),
    ('Ciclismo', FALSE, 23),
    ('Natación', FALSE, 23);

-- Respuestas para "¿Cuántos jugadores conforman un equipo de rugby?" (ID Pregunta = 24)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('15', TRUE, 24),
    ('11', FALSE, 24),
    ('9', FALSE, 24),
    ('13', FALSE, 24);

-- Respuestas para "¿Qué país ha ganado más Copas del Mundo de fútbol?" (ID Pregunta = 25)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Brasil', TRUE, 25),
    ('Alemania', FALSE, 25),
    ('Argentina', FALSE, 25),
    ('Italia', FALSE, 25);

-- Respuestas para "¿Qué jugador de baloncesto es conocido como 'His Airness'?" (ID Pregunta = 26)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
    ('Michael Jordan', TRUE, 26),
    ('LeBron James', FALSE, 26),
    ('Kobe Bryant', FALSE, 26),
    ('Shaquille O\Neal', FALSE, 26);

-- Respuestas para "¿Cuántos sets debe ganar un jugador para ganar un partido de tenis en Grand Slam?" (ID Pregunta = 27)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('3', TRUE, 27),
('2', FALSE, 27),
('5', FALSE, 27),
('4', FALSE, 27);

-- Respuestas para "¿En qué ciudad se celebraron los Juegos Olímpicos de 2008?" (ID Pregunta = 28)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Beijing', TRUE, 28),
('Londres', FALSE, 28),
('Atenas', FALSE, 28),
('Sídney', FALSE, 28);

-- Respuestas para "¿Qué disciplina combina esquí de fondo y tiro al blanco?" (ID Pregunta = 29)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Biathlon', TRUE, 29),
('Decathlon', FALSE, 29),
('Esquí Alpino', FALSE, 29),
('Cross Country', FALSE, 29);

-- Respuestas para "¿Quién es el máximo goleador en la historia de la NBA?" (ID Pregunta = 30)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Kareem Abdul-Jabbar', TRUE, 30),
('Michael Jordan', FALSE, 30),
('LeBron James', FALSE, 30),
('Kobe Bryant', FALSE, 30);

-- Preguntas para Historia
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id, mostrada, acertada)
VALUES
('¿Quién descubrió América?', 1, 4, 1, 1), -- ID 31
('¿En qué año cayó el Imperio Romano de Occidente?', 1, 4, 1, 1), -- ID 32
('¿Qué revolución inició en Francia en 1789?', 1, 4, 1, 1), -- ID 33
('¿Qué país fue gobernado por Napoleón Bonaparte?', 2, 4, 1, 1), -- ID 34
('¿Quién fue el primer presidente de los Estados Unidos?', 2, 4, 1, 1), -- ID 35
('¿En qué año comenzó la Segunda Guerra Mundial?', 1, 4, 1, 1), -- ID 36
('¿Quién fue apodado "El Libertador" de América del Sur?', 3, 4, 1, 1), -- ID 37
('¿Cuál fue la primera civilización en usar escritura?', 3, 4, 1, 1), -- ID 38
('¿Qué faraón ordenó construir la Gran Pirámide de Giza?', 1, 4, 1, 1), -- ID 39
('¿Qué muro separó Berlín durante la Guerra Fría?', 1, 4, 1, 1); -- ID 40

-- Respuestas para Historia

-- Respuestas para "¿Quién descubrió América?" (ID Pregunta = 31)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Cristóbal Colón', TRUE, 31),
('Américo Vespucio', FALSE, 31),
('Hernán Cortés', FALSE, 31),
('Fernando de Magallanes', FALSE, 31);

-- Respuestas para "¿En qué año cayó el Imperio Romano de Occidente?" (ID Pregunta = 32)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('476', TRUE, 32),
('1492', FALSE, 32),
('1453', FALSE, 32),
('410', FALSE, 32);

-- Respuestas para "¿Qué revolución inició en Francia en 1789?" (ID Pregunta = 33)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('La Revolución Francesa', TRUE, 33),
('La Revolución Industrial', FALSE, 33),
('La Revolución Americana', FALSE, 33),
('La Revolución Rusa', FALSE, 33);

-- Respuestas para "¿Qué país fue gobernado por Napoleón Bonaparte?" (ID Pregunta = 34)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Francia', TRUE, 34),
('España', FALSE, 34),
('Italia', FALSE, 34),
('Alemania', FALSE, 34);

-- Respuestas para "¿Quién fue el primer presidente de los Estados Unidos?" (ID Pregunta = 35)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('George Washington', TRUE, 35),
('Thomas Jefferson', FALSE, 35),
('Abraham Lincoln', FALSE, 35),
('John Adams', FALSE, 35);

-- Respuestas para "¿En qué año comenzó la Segunda Guerra Mundial?" (ID Pregunta = 36)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('1939', TRUE, 36),
('1945', FALSE, 36),
('1914', FALSE, 36),
('1941', FALSE, 36);

-- Respuestas para "¿Quién fue apodado 'El Libertador' de América del Sur?" (ID Pregunta = 37)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Simón Bolívar', TRUE, 37),
('José de San Martín', FALSE, 37),
('Antonio José de Sucre', FALSE, 37),
('Francisco de Miranda', FALSE, 37);

-- Respuestas para "¿Cuál fue la primera civilización en usar escritura?" (ID Pregunta = 38)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Los sumerios', TRUE, 38),
('Los egipcios', FALSE, 38),
('Los mayas', FALSE, 38),
('Los griegos', FALSE, 38);

-- Respuestas para "¿Qué faraón ordenó construir la Gran Pirámide de Giza?" (ID Pregunta = 39)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Keops', TRUE, 39),
('Tutankamón', FALSE, 39),
('Ramsés II', FALSE, 39),
('Cleopatra', FALSE, 39);

-- Respuestas para "¿Qué muro separó Berlín durante la Guerra Fría?" (ID Pregunta = 40)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('El Muro de Berlín', TRUE, 40),
('El Muro de los Lamentos', FALSE, 40),
('La Cortina de Hierro', FALSE, 40),
('El Muro de la Paz', FALSE, 40);

-- Pregunta 41: ¿Cuál es el planeta más cercano al Sol?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Cuál es el planeta más cercano al Sol?', 1, 5);

-- Respuestas para "¿Cuál es el planeta más cercano al Sol?" (ID Pregunta = 41)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Mercurio', TRUE, 41),
('Venus', FALSE, 41),
('Marte', FALSE, 41),
('Tierra', FALSE, 41);

-- Pregunta 42: ¿Qué compuesto es conocido como el gas de efecto invernadero?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Qué compuesto es conocido como el gas de efecto invernadero?', 1, 5);

-- Respuestas para "¿Qué compuesto es conocido como el gas de efecto invernadero?" (ID Pregunta = 42)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Dióxido de carbono', TRUE, 42),
('Oxígeno', FALSE, 42),
('Nitrógeno', FALSE, 42),
('Helio', FALSE, 42);

-- Pregunta 43: ¿Qué tipo de energía se obtiene a partir del sol?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Qué tipo de energía se obtiene a partir del sol?', 1, 5);

-- Respuestas para "¿Qué tipo de energía se obtiene a partir del sol?" (ID Pregunta = 43)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Energía solar', TRUE, 43),
('Energía hidráulica', FALSE, 43),
('Energía nuclear', FALSE, 43),
('Energía eólica', FALSE, 43);

-- Pregunta 44: ¿Quién desarrolló la teoría de la relatividad?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Quién desarrolló la teoría de la relatividad?', 1, 5);

-- Respuestas para "¿Quién desarrolló la teoría de la relatividad?" (ID Pregunta = 44)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Albert Einstein', TRUE, 44),
('Isaac Newton', FALSE, 44),
('Marie Curie', FALSE, 44),
('Nikola Tesla', FALSE, 44);

-- Pregunta 45: ¿De qué está hecha la materia?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿De qué está hecha la materia?', 1, 5);

-- Respuestas para "¿De qué está hecha la materia?" (ID Pregunta = 45)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Átomos', TRUE, 45),
('Moléculas', FALSE, 45),
('Electrones', FALSE, 45),
('Neutrones', FALSE, 45);

-- Pregunta 46: ¿Qué elemento químico tiene el símbolo H?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Qué elemento químico tiene el símbolo H?', 1, 5);

-- Respuestas para "¿Qué elemento químico tiene el símbolo H?" (ID Pregunta = 46)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Hidrógeno', TRUE, 46),
('Helio', FALSE, 46),
('Oxígeno', FALSE, 46),
('Carbono', FALSE, 46);

-- Pregunta 47: ¿Quién formuló la ley de la gravedad?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Quién formuló la ley de la gravedad?', 1, 5);

-- Respuestas para "¿Quién formuló la ley de la gravedad?" (ID Pregunta = 47)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Isaac Newton', TRUE, 47),
('Albert Einstein', FALSE, 47),
('Nicolas Copérnico', FALSE, 47),
('Galileo Galilei', FALSE, 47);

-- Pregunta 48: ¿Qué es la fotosíntesis?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Qué es la fotosíntesis?', 1, 5);

-- Respuestas para "¿Qué es la fotosíntesis?" (ID Pregunta = 48)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('El proceso por el cual las plantas convierten la luz en energía', TRUE, 48),
('El proceso por el cual las plantas producen semillas', FALSE, 48),
('El proceso de crecimiento de las plantas', FALSE, 48),
('La forma en que las plantas eliminan el dióxido de carbono', FALSE, 48);

-- Pregunta 49: ¿Quién propuso la teoría de la evolución por selección natural?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Quién propuso la teoría de la evolución por selección natural?', 2, 5);

-- Respuestas para "¿Quién propuso la teoría de la evolución por selección natural?" (ID Pregunta = 49)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Charles Darwin', TRUE, 49),
('Jean-Baptiste Lamarck', FALSE, 49),
('Gregor Mendel', FALSE, 49),
('Louis Pasteur', FALSE, 49);

-- Pregunta 50: ¿Qué es un átomo?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Qué es un átomo?', 3, 5);

-- Respuestas para "¿Qué es un átomo?" (ID Pregunta = 50)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('La unidad básica de la materia', TRUE, 50),
('Una molécula de oxígeno', FALSE, 50),
('Un tipo de energía', FALSE, 50),
('Una partícula subatómica', FALSE, 50);

-- Geografia

-- Pregunta 51: ¿Cuál es el continente más grande del mundo?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Cuál es el continente más grande del mundo?', 1, 6);

-- Respuestas para "¿Cuál es el continente más grande del mundo?" (ID Pregunta = 51)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Asia', TRUE, 51),
('África', FALSE, 51),
('América', FALSE, 51),
('Europa', FALSE, 51);

-- Pregunta 52: ¿Cuál es el río más largo del mundo?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Cuál es el río más largo del mundo?', 1, 6);

-- Respuestas para "¿Cuál es el río más largo del mundo?" (ID Pregunta = 52)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Amazonas', TRUE, 52),
('Nilo', FALSE, 52),
('Yangtsé', FALSE, 52),
('Misisipi', FALSE, 52);

-- Pregunta 53: ¿Qué país tiene más habitantes en el mundo?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Qué país tiene más habitantes en el mundo?', 1, 6);

-- Respuestas para "¿Qué país tiene más habitantes en el mundo?" (ID Pregunta = 53)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('China', TRUE, 53),
('India', FALSE, 53),
('Estados Unidos', FALSE, 53),
('Brasil', FALSE, 53);

-- Pregunta 54: ¿En qué continente se encuentra el desierto del Sahara?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿En qué continente se encuentra el desierto del Sahara?', 1, 6);

-- Respuestas para "¿En qué continente se encuentra el desierto del Sahara?" (ID Pregunta = 54)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('África', TRUE, 54),
('Asia', FALSE, 54),
('América', FALSE, 54),
('Oceanía', FALSE, 54);

-- Pregunta 55: ¿Cuál es la capital de Japón?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Cuál es la capital de Japón?', 1, 6);

-- Respuestas para "¿Cuál es la capital de Japón?" (ID Pregunta = 55)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Tokio', TRUE, 55),
('Osaka', FALSE, 55),
('Kioto', FALSE, 55),
('Hiroshima', FALSE, 55);

-- Pregunta 56: ¿Cuántos continentes existen en el mundo?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Cuántos continentes existen en el mundo?', 1, 6);

-- Respuestas para "¿Cuántos continentes existen en el mundo?" (ID Pregunta = 56)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('7', TRUE, 56),
('6', FALSE, 56),
('5', FALSE, 56),
('8', FALSE, 56);

-- Pregunta 57: ¿En qué océano se encuentra la isla de Madagascar?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿En qué océano se encuentra la isla de Madagascar?', 1, 6);

-- Respuestas para "¿En qué océano se encuentra la isla de Madagascar?" (ID Pregunta = 57)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Océano Índico', TRUE, 57),
('Océano Pacífico', FALSE, 57),
('Océano Atlántico', FALSE, 57),
('Océano Ártico', FALSE, 57);

-- Pregunta 58: ¿Cuál es el país más grande del mundo por superficie?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Cuál es el país más grande del mundo por superficie?', 1, 6);

-- Respuestas para "¿Cuál es el país más grande del mundo por superficie?" (ID Pregunta = 58)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Rusia', TRUE, 58),
('Canadá', FALSE, 58),
('Estados Unidos', FALSE, 58),
('China', FALSE, 58);

-- Pregunta 59: ¿En qué país se encuentra la Torre Eiffel?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿En qué país se encuentra la Torre Eiffel?', 2, 6);

-- Respuestas para "¿En qué país se encuentra la Torre Eiffel?" (ID Pregunta = 59)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Francia', TRUE, 59),
('Italia', FALSE, 59),
('España', FALSE, 59),
('Alemania', FALSE, 59);

-- Pregunta 60: ¿Cuál es el océano más grande del mundo?
INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id)
VALUES
('¿Cuál es el océano más grande del mundo?', 3, 6);

-- Respuestas para "¿Cuál es el océano más grande del mundo?" (ID Pregunta = 60)
INSERT INTO Respuesta (Texto_respuesta, Es_correcta, Pregunta_id)
VALUES
('Océano Pacífico', TRUE, 60),
('Océano Atlántico', FALSE, 60),
('Océano Índico', FALSE, 60),
('Océano Ártico', FALSE, 60);


INSERT INTO Status (Estado) VALUES ('En curso');
INSERT INTO Status (Estado) VALUES ('Finalizado');

INSERT INTO Rol (Rol) VALUES ('Normal');
INSERT INTO Rol (Rol) VALUES ('Editor');
INSERT INTO Rol (Rol) VALUES ('Administrador');


INSERT INTO Usuario (nombre,
                     nombre_usuario,
                     contrasenia,
                     fecha_nacimiento,
                     pais,
                     sexo,
                     ciudad,
                     email,
                     Path_img_perfil,
                     activo,
                     token,
                     latitudMapa,
                     longitudMapa,
                     rol)
VALUES				('admin', 
                     'admin',
                     '$2y$10$SarjfMTLpHKo3qAOOdn4Q.WlXRI5uXZSGw5OuF2YMg6FbEqtTI0f2', 
                     '1968-08-12', 
                     'Argentina', 
                     'masculino', 
                     'Buenos Aires',
                     'estevezgaston01@gmail.com',
                     NULL, 
                     1, 
                     NULL,
                     NULL,
                     NULL,
                     3);

INSERT INTO Usuario (nombre,
                     nombre_usuario,
                     contrasenia,
                     fecha_nacimiento,
                     pais,
                     sexo,
                     ciudad,
                     email,
                     Path_img_perfil,
                     activo,
                     token,
                     latitudMapa,
                     longitudMapa,
                     rol)
VALUES                   ('editor',
                    'editor', 
                    '$2y$10$Yl8F0Hz6XESgaRqFiwzHX.fH2V.d5JU8VkL8/plaPlFSKFcDIcBE2', 
                    '1970-04-22', 
                    'Argentina',
                     'femenino',
                      'Buenos Aires', 
                      'estevezgaston01@gmail.com', NULL, 1, NULL, NULL, NULL, 2);
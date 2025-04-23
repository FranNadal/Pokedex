
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    es_admin BOOLEAN DEFAULT FALSE
);

-- Usuario de prueba (admin)
INSERT INTO usuarios (nombre_usuario, contraseña, es_admin)
VALUES ('admin', 'admin123', TRUE);


INSERT INTO usuarios (nombre_usuario, contraseña, es_admin)
VALUES ('admindos', 'admin123', TRUE);
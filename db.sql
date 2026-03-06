-- Script de création de la base de données pour MIA-Cameroun
CREATE DATABASE IF NOT EXISTS exo_mia_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE exo_mia_db;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') DEFAULT 'student',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table des programmes (Formations, Ateliers, Événements)
CREATE TABLE IF NOT EXISTS programmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    type ENUM('Formation', 'Atelier', 'Événement') NOT NULL,
    categorie VARCHAR(100), -- ex: Débutant, Intermédiaire, Avancé
    duree VARCHAR(100),     -- ex: 8 semaines
    format VARCHAR(100),    -- ex: Hybride, Présentiel, En ligne
    image_url VARCHAR(255),
    tags VARCHAR(255),      -- ex: Python, Deep Learning, etc.
    date_pub DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table des inscriptions (Suivi des formations)
CREATE TABLE IF NOT EXISTS inscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    programme_id INT NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (programme_id) REFERENCES programmes(id) ON DELETE CASCADE,
    UNIQUE KEY (user_id, programme_id)
) ENGINE=InnoDB;

-- Insertion de l'admin par défaut (password: admin123)
-- Note: Dans un vrai projet, utilisez password_hash()
INSERT INTO users (username, password, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insertion de quelques programmes exemples
INSERT INTO programmes (titre, description, type, categorie, duree, format) VALUES 
('Introduction à l\'IA', 'Découvrez les fondamentaux de l\'IA et du Machine Learning.', 'Formation', 'Débutant', '8 semaines', 'Hybride'),
('Deep Learning', 'Maîtrisez les architectures de réseaux de neurones.', 'Formation', 'Intermédiaire', '12 semaines', 'Présentiel'),
('Atelier Data Science', 'Sessions intensives de nettoyage et analyse de données.', 'Atelier', 'Pratique', '2 jours', 'Présentiel');

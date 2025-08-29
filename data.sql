-- INSERT INTO aliment (nom, qtt, prix) VALUES
-- ('Pomme', 1.5, 2.0),
-- ('Banane', 2.0, 1.8),
-- ('Riz', 5.0, 3.5),
-- ('Poulet', 1.0, 8.0),
-- ('Tomate', 3.0, 2.5),
-- ('Lait', 2.0, 1.2),
-- ('Pain', 1.0, 1.5),
-- ('Fromage', 0.5, 4.0),
-- ('Oeuf', 12.0, 3.0),
-- ('Carotte', 2.5, 2.2);

INSERT INTO nutriment (nom) VALUES 
('Protéines'),
('Glucides'),
('Lipides'),
('Fibres'),
('Vitamines'),
('Minéraux');

INSERT INTO Contenir (aliment_id, nutriment_id, qtt) VALUES
-- Pomme
(1, 2, 14.0),   -- Glucides
(1, 4, 2.4),    -- Fibres
(1, 5, 0.02),   -- Vitamines
(1, 6, 0.01),   -- Minéraux

-- Banane
(2, 2, 23.0),
(2, 4, 2.6),
(2, 5, 0.03),
(2, 6, 0.01),

-- Riz
(3, 2, 28.0),
(3, 1, 2.7),
(3, 4, 0.4),
(3, 6, 0.01),

-- Poulet
(4, 1, 31.0),
(4, 3, 3.6),
(4, 6, 0.02),

-- Tomate
(5, 2, 3.9),
(5, 4, 1.2),
(5, 5, 0.01),
(5, 6, 0.01),

-- Lait
(6, 1, 3.4),
(6, 2, 5.0),
(6, 3, 1.0),
(6, 5, 0.01),
(6, 6, 0.01),

-- Pain
(7, 2, 49.0),
(7, 1, 9.0),
(7, 4, 2.7),
(7, 6, 0.02),

-- Fromage
(8, 1, 25.0),
(8, 3, 33.0),
(8, 6, 0.02),

-- Oeuf
(9, 1, 13.0),
(9, 3, 11.0),
(9, 5, 0.05),
(9, 6, 0.01),

-- Carotte
(10, 2, 10.0),
(10, 4, 2.8),
(10, 5, 0.07),
(10, 6, 0.01);


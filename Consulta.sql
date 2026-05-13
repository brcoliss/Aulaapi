CREATE TABLE pizzas (
    idPizza INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    ingredientes VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);
INSERT INTO pizzas (nome, ingredientes, valor) VALUES
('Calabresa', 'Mussarela, calabresa fatiada e cebola', 45.50),
('Mussarela', 'Mussarela e molho de tomate', 40.00),
('Frango com Catupiry', 'Frango desfiado, catupiry e mussarela', 52.90),
('Portuguesa', 'Mussarela, presunto, ovo, ervilha, cebola e calabresa', 62.90),
('Moda do Juca', 'Mussarela, peito de peru, palmito, alho poró e alcaparras', 72.50);
SELECT * FROM pizzas


CREATE TABLE bebidas (
    idBebida INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
    categorias VARCHAR(255) NOT NULL
    ativo BOOLEAN NOT NULL
);
INSERT INTO bebidas (nome, valor, categorias, ativo) VALUES
('Coca-Cola', 8.00, 'Refrigerante', TRUE),
('Guaraná Antarctica', 7.50, 'Refrigerante', TRUE),
('Fanta Laranja', 7.00, 'Refrigerante', TRUE),
('Água Mineral', 5.00, 'Água', TRUE),
('Suco de Laranja', 10.00, 'Suco Natural', TRUE);




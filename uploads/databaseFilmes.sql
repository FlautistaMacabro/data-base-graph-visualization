DROP DATABASE IF EXISTS catalogo;
CREATE DATABASE IF NOT EXISTS catalogo;
USE catalogo;

CREATE TABLE IF NOT EXISTS diretor (
  id_diretor int not null unique auto_increment,
  nome varchar(100) not null unique,
  primary key (id_diretor)
);

CREATE TABLE IF NOT EXISTS filme (
  id_filme int not null unique auto_increment,
  nome varchar(100) not null unique,
  dataLancamento date not null,
  classificacao int not null,
  orcamento float not null,
  id_diretor int not null,
  primary key (id_filme),
  foreign key (id_diretor) references diretor(id_diretor)
);

CREATE TABLE IF NOT EXISTS genero (
  id_genero int not null unique auto_increment,
  nome varchar(100) not null unique,
  primary key (id_genero)
);

CREATE TABLE IF NOT EXISTS filme_genero (
  id_filme int not null,
  id_genero int not null,
  primary key (id_filme, id_genero),
  foreign key (id_filme) references filme(id_filme),
  foreign key (id_genero) references genero(id_genero)
);

INSERT IGNORE INTO diretor (nome)
                  VALUES ('James_Cameron'),
                         ('Diretor2'),
                         ('Diretor3');

INSERT IGNORE INTO filme (nome, dataLancamento, classificacao, orcamento, id_diretor)
                  VALUES ('Filme1', '1999-03-04', 0, 984.77, 1),
                         ('Filme2', '1998-03-04', 12, 754.00, 2),
                         ('Filme3', '1999-05-04', 18, 6675.50, 2),
                         ('Filme4', '2008-06-04', 18, 66467, 1),
                         ('Filme5', '2008-07-08', 16, 88888, 3);

INSERT IGNORE INTO genero (nome)
                  VALUES ('Terror'),
                         ('Aventura'),
                         ('Drama');

INSERT IGNORE INTO filme_genero (id_filme, id_genero)
                        VALUES (1,1),
                               (1,2),
                               (2,2),
                               (3,3),
                               (4,3),
                               (5,3);

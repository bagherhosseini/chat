--databas för meddelande

CREATE TABLE `meddelande` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `inkommande_msg_id` int(255) NOT NULL,
  `utgaende_msg_id` int(255) NOT NULL,
  `msg` varchar(10000) NOT NULL,
  `user_pic` varchar(1000) NOT NULL,
  `user_namn` varchar(255) NOT NULL,
  `tid` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`)
)


--databas för användare

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unik_id` int(255) NOT NULL,
  `f_och_enamn` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
)

--databas för klasser

CREATE TABLE `klass` (
  `klass_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `skapare_id` int(255) NOT NULL,
  `Kategori` varchar(255) NOT NULL DEFAULT 1,
  `img` varchar(10000) NOT NULL,
  PRIMARY KEY (`klass_id`)
)

--databas för användares klasser

CREATE TABLE `klass_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_unik_id` int(11) NOT NULL,
  `users_klass_id` int(11) NOT NULL,
  `Kategori` varchar(255) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
)

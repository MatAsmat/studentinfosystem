-- ขั้นตอนที่ 8
CREATE TABLE IF NOT EXISTS students ( 
    id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    studentno int(10) NOT NULL,
    firstname varchar(50) NOT NULL,
    lastname varchar(50) NOT NULL,
    course varchar(50) NOT NULL,
    yrlevel varchar(10) NOT NULL,
    date_joined date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- creación de la base de datos
create database puellacounterdb;
use puellacounterdb;


-- creación de las tablas
create table tbl_rol( -- tabla para almacenar los roles
	id_rol int primary key auto_increment,
	rol_name varchar(50) not null,
	rol_info varchar(255) not null
);

create table tbl_user( -- tabla para almacenar los usuarios
	id_user int primary key auto_increment,
	user_name varchar(50) not null,
	user_email varchar(50) not null,
	user_login_name varchar(50) not null,
	user_password varchar(50) not null,
	id_rol int not null,
	constraint fk_user_rol foreign key(id_rol) references tbl_rol(id_rol)
);

create table tbl_company( -- tabla para almacenar las empresas
	id_company int primary key auto_increment,
	company_name varchar(50) not null,
	company_type varchar(50) not null,
	company_address varchar(50) not null,
	company_phone varchar(50) not null,
	company_email varchar(50) not null
);

create table tbl_buy_recipt( -- tabla para almacenar los recibos de compra
	id_buy_recipt int primary key auto_increment,
	buy_type varchar(50) not null,
	buy_number varchar(50) not null unique,
	buy_date date not null,
	buy_amount decimal(10,2) not null,
	buy_provider varchar(50) not null,
	buy_file blob,
	id_company int not null,
	constraint fk_buy_company foreign key(id_company) references tbl_company(id_company)
);

create table tbl_sell_recipt( -- tabla para almacenar los recibos de venta
	id_sell_recipt int primary key auto_increment,
	sell_type varchar(50) not null,
	sell_number varchar(50) not null unique,
	sell_date date not null,
	sell_amount decimal(10,2) not null,
	sell_client varchar(50) not null,
	sell_file blob,
	id_company int not null,
	constraint fk_sell_company foreign key(id_company) references tbl_company(id_company)
);





-- procesos almacenados: tabla roles
-- Insertar un nuevo rol
delimiter //
create procedure sp_insert_rol(
    p_rol_name varchar(50), 
    p_rol_info varchar(255))
begin
    insert into tbl_rol(rol_name, rol_info) 
    values (p_rol_name, p_rol_info);
end//
delimiter ;

-- Actualizar un rol existente
delimiter //
create procedure sp_update_rol(
    p_id_rol int,
    p_rol_name varchar(50), 
    p_rol_info varchar(255))
begin
    update tbl_rol set 
        rol_name = p_rol_name, 
        rol_info = p_rol_info
    where id_rol = p_id_rol;
end//
delimiter ;

-- Eliminar un rol por su ID
delimiter //
create procedure sp_delete_rol(p_id_rol int)
begin
    delete from tbl_rol where id_rol = p_id_rol;
end//
delimiter ;

-- Obtener un rol por su ID
delimiter //
create procedure sp_get_rol_by_id(p_id_rol int)
begin
    select * from tbl_rol where id_rol = p_id_rol;
end//
delimiter ;

-- Obtener todos los roles
delimiter //
create procedure sp_get_all_roles()
begin
    select * from tbl_rol;
end//
delimiter ;







-- procesos almacenados: tabla usuarios
delimiter //
create procedure sp_insert_user(
    p_user_name varchar(50), 
    p_user_email varchar(50), 
    p_user_login_name varchar(50), 
    p_user_password varchar(50), 
    p_id_rol int)
begin
    insert into tbl_user(user_name, user_email, user_login_name, user_password, id_rol) 
    values (p_user_name, p_user_email, p_user_login_name, p_user_password, p_id_rol);
end//
delimiter ;

delimiter //
create procedure sp_update_user(
    p_id_user int,
    p_user_name varchar(50), 
    p_user_email varchar(50), 
    p_user_login_name varchar(50), 
    p_user_password varchar(50), 
    p_id_rol int)
begin
    update tbl_user set 
        user_name = p_user_name, 
        user_email = p_user_email, 
        user_login_name = p_user_login_name, 
        user_password = p_user_password, 
        id_rol = p_id_rol
    where id_user = p_id_user;
end//
delimiter ;

delimiter //
create procedure sp_delete_user(p_id_user int)
begin
    delete from tbl_user where id_user = p_id_user;
end//
delimiter ;

delimiter //

create procedure sp_get_user_by_id(
    in p_id_user int
)
begin
    SELECT * FROM tbl_user WHERE id_user = p_id_user;
end //

delimiter ;

delimiter //
create procedure sp_get_all_users()
begin
    SELECT u.id_user, u.user_name, u.user_email, u.user_login_name, u.user_password, r.rol_name
	FROM tbl_user u
	JOIN tbl_rol r ON u.id_rol = r.id_rol;
end//
delimiter ;








-- procesos almacenados: tabla empresas
-- Insertar una nueva empresa
DELIMITER //
CREATE PROCEDURE sp_insert_company(
    p_company_name VARCHAR(50),
    p_company_type VARCHAR(50),
    p_company_address VARCHAR(50),
    p_company_phone VARCHAR(50),
    p_company_email VARCHAR(50)
)
BEGIN
    INSERT INTO tbl_company (company_name, company_type, company_address, company_phone, company_email)
    VALUES (p_company_name, p_company_type, p_company_address, p_company_phone, p_company_email);
END //
DELIMITER ;

-- Actualizar una empresa existente
DELIMITER //
CREATE PROCEDURE sp_update_company(
    p_id_company INT,
    p_company_name VARCHAR(50),
    p_company_type VARCHAR(50),
    p_company_address VARCHAR(50),
    p_company_phone VARCHAR(50),
    p_company_email VARCHAR(50)
)
BEGIN
    UPDATE tbl_company
    SET company_name = p_company_name,
        company_type = p_company_type,
        company_address = p_company_address,
        company_phone = p_company_phone,
        company_email = p_company_email
    WHERE id_company = p_id_company;
END //
DELIMITER ;

-- Eliminar una empresa por su ID
DELIMITER //
CREATE PROCEDURE sp_delete_company(p_id_company INT)
BEGIN
    DELETE FROM tbl_company WHERE id_company = p_id_company;
END //
DELIMITER ;

-- Obtener una empresa por su ID
DELIMITER //
CREATE PROCEDURE sp_get_company_by_id(p_id_company INT)
BEGIN
    SELECT * FROM tbl_company WHERE id_company = p_id_company;
END //
DELIMITER ;

-- Obtener todas las empresas
DELIMITER //
CREATE PROCEDURE sp_get_all_companies()
BEGIN
    SELECT * FROM tbl_company;
END //
DELIMITER ;









-- procesos almacenados: tabla recibos de compra
delimiter //
create procedure sp_insert_buy_recipt(
    p_buy_type varchar(50),
    p_buy_date date,
    p_buy_amount decimal(10,2),
    p_buy_provider varchar(50),
    p_buy_file blob,
    p_id_company int)
begin
    declare v_buy_number varchar(50);
    declare v_exists int;
    
    -- generar un número único de comprobante
    repeat
        set v_buy_number = concat('N° ', lpad(floor(rand() * 1000000), 6, '0'));
        select count(*) into v_exists from tbl_buy_recipt where buy_number = v_buy_number;
    until v_exists = 0
    end repeat;

    insert into tbl_buy_recipt(buy_type, buy_number, buy_date, buy_amount, buy_provider, buy_file, id_company)
    values (p_buy_type, v_buy_number, p_buy_date, p_buy_amount, p_buy_provider, p_buy_file, p_id_company);
end//
delimiter ;

create procedure sp_get_buy_recipt_by_id(
    in p_id_buy_recipt int
)
begin
    select *
    from tbl_buy_recipt
    where id_buy_recipt = p_id_buy_recipt;
end //

delimiter ;

-- procesos almacenados: tabla recibos de venta
delimiter //
create procedure sp_insert_sell_recipt(
    p_sell_type varchar(50),
    p_sell_date date,
    p_sell_amount decimal(10,2),
    p_sell_client varchar(50),
    p_sell_file blob,
    p_id_company int)
begin
    declare v_sell_number varchar(50);
    declare v_exists int;
    
    repeat
        set v_sell_number = concat('N° ', lpad(floor(rand() * 1000000), 6, '0'));
        select count(*) into v_exists from tbl_sell_recipt where sell_number = v_sell_number;
    until v_exists = 0
    end repeat;

    insert into tbl_sell_recipt(sell_type, sell_number, sell_date, sell_amount, sell_client, sell_file, id_company)
    values (p_sell_type, v_sell_number, p_sell_date, p_sell_amount, p_sell_client, p_sell_file, p_id_company);
end//
delimiter ;

delimiter //

create procedure sp_get_sell_recipt_by_id(
    in p_id_sell_recipt int
)
begin
    select *
    from tbl_sell_recipt
    where id_sell_recipt = p_id_sell_recipt;
end //

delimiter ;


--registros de prueba para cada tabla
insert into tbl_rol (rol_name, rol_info) values 
('admin', 'administrador del sistema'),
('manager', 'gestor de operaciones'),
('user', 'usuario básico'),
('analyst', 'analista de datos'),
('guest', 'invitado temporal');


insert into tbl_user (user_name, user_email, user_login_name, user_password, id_rol) values 
('juan pérez', 'juan@mail.com', 'juanp', '202cb962ac59075b964b07152d234b70', 1),
('ana lópez', 'ana@mail.com', 'anal', 'pass456', 2),
('carlos ruiz', 'carlos@mail.com', 'carlr', 'pass789', 3),
('maría gómez', 'maria@mail.com', 'mariag', 'pass123', 4),
('luis torres', 'luis@mail.com', 'luist', 'pass456', 5);

insert into tbl_company (company_name, company_type, company_address, company_phone, company_email) values 
('tech solutions', 'tecnología', 'calle 1', '1234-5678', 'info@tech.com'),
('food services', 'alimentos', 'calle 2', '2345-6789', 'info@food.com'),
('build corp', 'construcción', 'calle 3', '3456-7890', 'info@build.com'),
('health plus', 'salud', 'calle 4', '4567-8901', 'info@health.com'),
('eco green', 'energía', 'calle 5', '5678-9012', 'info@eco.com');

insert into tbl_buy_recipt (buy_type, buy_number, buy_date, buy_amount, buy_provider, buy_file, id_company) values
('factura', 'N° 000001', '2024-11-01', 2500.50, 'proveedor tech', null, 1),
('boleta', 'N° 000002', '2024-11-05', 1500.00, 'proveedor alimentos', null, 2),
('nota de compra', 'N° 000003', '2024-11-08', 3250.75, 'proveedor construcción', null, 3),
('factura', 'N° 000004', '2024-11-10', 875.00, 'proveedor salud', null, 4),
('boleta', 'N° 000005', '2024-11-12', 1900.20, 'proveedor energía', null, 5);


insert into tbl_sell_recipt (sell_type, sell_number, sell_date, sell_amount, sell_client, sell_file, id_company) values
('factura', 'N° 100001', '2024-11-02', 3000.00, 'cliente tech solutions', null, 1),
('boleta', 'N° 100002', '2024-11-06', 1750.50, 'cliente food services', null, 2),
('nota de venta', 'N° 100003', '2024-11-09', 4200.30, 'cliente build corp', null, 3),
('factura', 'N° 100004', '2024-11-11', 950.00, 'cliente health plus', null, 4),
('boleta', 'N° 100005', '2024-11-13', 2100.75, 'cliente eco green', null, 5);





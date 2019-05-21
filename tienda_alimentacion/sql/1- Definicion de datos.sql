DROP TABLE OFERTA;
DROP TABLE ASIGNACIONPRODUCTO;
DROP TABLE PEDIDO;
DROP TABLE EMPLEADO;
DROP TABLE CLIENTE;
DROP TABLE PRODUCTO;


CREATE TABLE PRODUCTO(
  nombre_pro varchar2(50) NOT NULL,
  descripcion varchar2(50),
  stock integer CHECK (stock > 19) NOT NULL,
  precio_pro number(5,2) NOT NULL,
  categoria varchar2(20) CHECK (categoria IN ('bebida','alcohol','congelado','confiteria','golosina')) NOT NULL,
  OID_pro integer NOT NULL,
  
  PRIMARY KEY(OID_pro) 
);
/
CREATE TABLE CLIENTE(
  nombre_cli varchar2(50) NOT NULL, 
  apellidos_cli varchar2(50) NOT NULL,
  dni_cli varchar2(9) NOT NULL UNIQUE,
  fecha_nacimiento_cli DATE,
  email_cli varchar2(50) NOT NULL UNIQUE,
  sexo_cli varchar2(50) CHECK (sexo_cli IN ('Femenino','Masculino','Sin especificar')),
  telefono_cli varchar2(50),
  direccion_cli varchar2(200),
  pass_cli varchar2(256) NOT NULL,
  OID_cli integer NOT NULL,
  
  PRIMARY KEY(OID_cli)
);
/
CREATE TABLE EMPLEADO(
  nombre_emp varchar2(50) NOT NULL,
  apellidos_emp varchar2(50)NOT NULL,
  dni_emp varchar2(9) NOT NULL,
  fecha_nacimiento_emp DATE,
  salario number(6,2) NOT NULL,
  email_emp varchar2(50) NOT NULL,
  telefono_emp varchar2(50)NOT NULL,
  pass_emp varchar2(256) NOT NULL,
  OID_emp integer NOT NULL,
  
  PRIMARY KEY(OID_emp)
);
/
CREATE TABLE PEDIDO(
  fecha_ped DATE NOT NULL,
  forma_pago varchar2(10) CHECK (forma_pago IN ('tarjeta','efectivo')) NOT NULL,
  precio_total number(5,2) NOT NULL,
  OID_cli integer NOT NULL,
  OID_emp integer NOT NULL,
  OID_ped integer NOT NULL,
  
  FOREIGN KEY(OID_emp) REFERENCES EMPLEADO,
  FOREIGN KEY(OID_cli) REFERENCES CLIENTE,
  PRIMARY KEY(OID_ped)
);
/
CREATE TABLE ASIGNACIONPRODUCTO(
  cantidad integer NOT NULL,
  OID_pro integer NOT NULL,
  OID_ped integer NOT NULL,
  OID_asig integer NOT NULL,
  
  FOREIGN KEY(OID_pro) REFERENCES PRODUCTO,
  FOREIGN KEY(OID_ped) REFERENCES PEDIDO,
  PRIMARY KEY(OID_asig)
);
/
CREATE TABLE OFERTA(
  descuento integer NOT NULL,
  fecha_inicio date NOT NULL,
  fecha_fin date NOT NULL,
  OID_pro integer NOT NULL,
  OID_ofe integer NOT NULL,
  
  FOREIGN KEY(OID_pro) REFERENCES PRODUCTO,
  PRIMARY KEY(OID_ofe)
);
------------------------------------------------------------------SECUENCIAS------------------------------------------

DROP SEQUENCE sec_OID_PED;
DROP SEQUENCE sec_OID_PRO;
DROP SEQUENCE sec_OID_EMP;
DROP SEQUENCE sec_OID_CLI;
DROP SEQUENCE sec_OID_ASIG;
DROP SEQUENCE sec_OID_OFE;

CREATE SEQUENCE sec_OID_OFE
START WITH 1 INCREMENT BY 1 NOMAXVALUE;

CREATE SEQUENCE sec_OID_ASIG
START WITH 1 INCREMENT BY 1 NOMAXVALUE;

CREATE SEQUENCE sec_OID_CLI MINVALUE 0 INCREMENT BY 1 START WITH 0;


CREATE SEQUENCE sec_OID_EMP
START WITH 1 INCREMENT BY 1 NOMAXVALUE;

CREATE SEQUENCE sec_OID_PRO
START WITH 1 INCREMENT BY 1 NOMAXVALUE;

CREATE SEQUENCE sec_OID_PED
START WITH 1 INCREMENT BY 1 NOMAXVALUE;
/

---------------------------------------OID_CLIENTE--------------------------------------------

CREATE OR REPLACE TRIGGER INSERTAR_CLIENTE_OID
BEFORE INSERT ON CLIENTE
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
  SELECT sec_OID_CLI.NEXTVAL INTO :NEW.OID_cli FROM DUAL;
END;
/

-----------------------------------------------------------------PROCEDIMIENTO-----------------------------------------------
CREATE OR REPLACE PROCEDURE INSERTAR_OFERTA
  (descuento_oferta IN OFERTA.descuento%TYPE,
  fecha_inicio_oferta IN OFERTA.fecha_inicio%TYPE,
  fecha_fin_oferta IN OFERTA.fecha_fin%TYPE,
  FK_OID_producto IN PRODUCTO.OID_pro%TYPE) IS
BEGIN
  INSERT INTO OFERTA(descuento, fecha_inicio, fecha_fin, OID_pro, OID_ofe)
  VALUES(descuento_oferta, fecha_inicio_oferta, fecha_fin_oferta,FK_OID_producto, sec_OID_OFE.NEXTVAL);
END INSERTAR_OFERTA;
/
CREATE OR REPLACE PROCEDURE ELIMINAR_OFERTA
  (OID_oferta IN OFERTA.OID_ofe%TYPE) IS
BEGIN
  DELETE FROM OFERTA WHERE OID_ofe = OID_oferta;
  COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE INSERTAR_ASIGNACIONPRODUCTO
  (cantidad_producto IN ASIGNACIONPRODUCTO.cantidad%TYPE,
  FK_OID_producto IN PRODUCTO.OID_pro%TYPE,
  FK_OID_pedido IN PEDIDO.OID_ped%TYPE) IS
BEGIN
  INSERT INTO ASIGNACIONPRODUCTO(cantidad, OID_pro, OID_ped, OID_asig)
  VALUES(cantidad_producto, FK_OID_producto, FK_OID_pedido, sec_OID_ASIG.NEXTVAL);
END INSERTAR_ASIGNACIONPRODUCTO;
/
CREATE OR REPLACE PROCEDURE ELIMINAR_ASIGNACIONPRODUCTO
  (OID_asignacion IN ASIGNACIONPRODUCTO.OID_asig%TYPE)IS
BEGIN 
  DELETE FROM ASIGNACIONPRODUCTO WHERE OID_asig = OID_asignacion;
  COMMIT;
END;
/


CREATE OR REPLACE PROCEDURE INSERTAR_CLIENTE
  (nombre_cliente IN CLIENTE.nombre_cli%TYPE,
   apellidos_cliente IN CLIENTE.apellidos_cli%TYPE,
   dni_cliente IN CLIENTE.dni_cli%TYPE,
   fecha_nacimiento_cliente IN CLIENTE.fecha_nacimiento_cli%TYPE,
   email_cliente IN CLIENTE.email_cli%TYPE,
   sexo_cliente IN CLIENTE.sexo_cli%TYPE,
   telefono_cliente IN CLIENTE.telefono_cli%TYPE,
   direccion_cliente IN CLIENTE.direccion_cli%TYPE,
   pass_cliente IN CLIENTE.pass_cli%TYPE) IS
BEGIN
  INSERT INTO CLIENTE VALUES (nombre_cliente, apellidos_cliente, dni_cliente, fecha_nacimiento_cliente, email_cliente, sexo_cliente, telefono_cliente, direccion_cliente, pass_cliente, sec_OID_CLI.NEXTVAL);
COMMIT WORK;
END INSERTAR_CLIENTE;
/



CREATE OR REPLACE PROCEDURE ELIMINAR_CLIENTE
  (OID_cliente IN CLIENTE.OID_cli%TYPE)IS
BEGIN 
  DELETE FROM CLIENTE WHERE OID_cli = OID_cliente;
  COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE INSERTAR_EMPLEADO
  (nombre_empleado IN EMPLEADO.nombre_emp%TYPE,
   apellidos_empleado IN EMPLEADO.apellidos_emp%TYPE,
   dni_empleado IN EMPLEADO.dni_emp%TYPE,
   fecha_nacimiento_empleado IN EMPLEADO.fecha_nacimiento_emp%TYPE,
   salario_empleado IN EMPLEADO.salario%TYPE,
   email_empleado IN EMPLEADO.email_emp%TYPE,
   telefono_empleado IN EMPLEADO.telefono_emp%TYPE,
   pass_empleado IN EMPLEADO.pass_emp%TYPE) IS
BEGIN
  INSERT INTO EMPLEADO(nombre_emp, apellidos_emp, dni_emp, fecha_nacimiento_emp, salario, email_emp, telefono_emp,pass_emp,OID_emp) 
  VALUES (nombre_empleado, apellidos_empleado, dni_empleado, fecha_nacimiento_empleado, salario_empleado, email_empleado, telefono_empleado, pass_empleado,sec_OID_EMP.NEXTVAL);
END INSERTAR_EMPLEADO;
/
CREATE OR REPLACE PROCEDURE ELIMINAR_EMPLEADO
  (OID_empleado IN EMPLEADO.OID_emp%TYPE) IS
BEGIN
  DELETE FROM EMPLEADO WHERE OID_emp = OID_empleado;
  COMMIT;
END; 
/
CREATE OR REPLACE PROCEDURE INSERTAR_PEDIDO
  (fecha_pedido IN PEDIDO.fecha_ped%TYPE, 
  forma_pago_pedido iN PEDIDO.forma_pago%TYPE,
  precio_total_pedido IN PEDIDO.precio_total%TYPE,
  FK_OID_cliente IN CLIENTE.OID_cli%TYPE,
  FK_OID_empleado IN EMPLEADO.OID_emp%TYPE) IS
BEGIN
  INSERT INTO PEDIDO(fecha_ped, forma_pago, precio_total,OID_cli, OID_emp, OID_ped)
  VALUES(fecha_pedido, forma_pago_pedido, precio_total_pedido, FK_OID_cliente, FK_OID_empleado, sec_OID_PED.NEXTVAL);
END INSERTAR_PEDIDO;
/
CREATE OR REPLACE PROCEDURE ELIMINAR_PEDIDO
  (OID_pedido IN PEDIDO.OID_ped%TYPE)IS
BEGIN 
  DELETE FROM PEDIDO WHERE OID_ped = OID_pedido;
  COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE INSERTAR_PRODUCTO
  (nombre_producto IN PRODUCTO.nombre_pro%TYPE,
   descripcion_producto IN PRODUCTO.descripcion%TYPE,
   stock_producto IN PRODUCTO.stock%TYPE,
   precio_producto IN PRODUCTO.precio_pro%TYPE,
   categoria_producto IN PRODUCTO.categoria%TYPE) IS
BEGIN
  INSERT INTO PRODUCTO(nombre_pro, descripcion, stock, precio_pro,categoria, OID_pro) 
  VALUES (nombre_producto,descripcion_producto,stock_producto, precio_producto,categoria_producto, sec_OID_PRO.NEXTVAL);
END INSERTAR_PRODUCTO;
/
CREATE OR REPLACE PROCEDURE ELIMINAR_PRODUCTO
  (OID_producto IN PRODUCTO.OID_pro%TYPE)IS
BEGIN 
  DELETE FROM PRODUCTO WHERE OID_pro = OID_producto;
  COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_SALARIO_EMP
  (OID_empleado IN EMPLEADO.OID_emp%TYPE,
  salario_empleado IN EMPLEADO.salario%TYPE)
IS
BEGIN
	UPDATE EMPLEADO SET salario = salario_empleado WHERE OID_emp = OID_empleado;
	COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_PRECIO_PRO
  (OID_producto IN PRODUCTO.OID_pro%TYPE,
  precio_producto IN PRODUCTO.precio_pro%TYPE)
IS
BEGIN
	UPDATE PRODUCTO SET precio_pro = precio_producto WHERE OID_pro = OID_producto;
	COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_DESCUENTO_OFE
  (OID_oferta IN OFERTA.OID_ofe%TYPE,
  descuento_oferta IN OFERTA.descuento%TYPE)
IS
BEGIN
	UPDATE OFERTA SET descuento = descuento_oferta WHERE OID_ofe = OID_oferta;
	COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_CLIENTE
  (nombre_cliente IN CLIENTE.nombre_cli%TYPE,
  apellidos_cliente IN CLIENTE.apellidos_cli%TYPE,
  dni_cliente IN CLIENTE.dni_cli%TYPE,
  fecha_nacimiento IN CLIENTE.fecha_nacimiento_cli%TYPE,
  email_cliente IN CLIENTE.email_cli%TYPE,
  sexo_cliente IN CLIENTE.sexo_cli%TYPE,
  telefono_cliente IN CLIENTE.telefono_cli%TYPE,
  direccion_cliente IN CLIENTE.direccion_cli%TYPE,
  pass_cliente IN CLIENTE.pass_cli%TYPE,
  OID_cliente IN CLIENTE.OID_cli%TYPE)
IS
BEGIN
	UPDATE CLIENTE SET nombre_cli = nombre_cliente WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET apellidos_cli = apellidos_cliente WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET dni_cli = dni_cliente WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET fecha_nacimiento_cli = fecha_nacimiento WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET email_cli = email_cliente WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET sexo_cli = sexo_cliente WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET telefono_cli = telefono_cliente WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET direccion_cli = direccion_cliente WHERE OID_cli = OID_cliente;
  UPDATE CLIENTE SET pass_cli = pass_cliente WHERE OID_cli = OID_cliente;
	COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_EMPLEADO
  (nombre_empleado IN EMPLEADO.nombre_emp%TYPE,
  apellidos_empleado IN EMPLEADO.apellidos_emp%TYPE,
  dni_empleado IN EMPLEADO.dni_emp%TYPE,
  fecha_nacimiento IN EMPLEADO.fecha_nacimiento_emp%TYPE,
  salario_empleado IN EMPLEADO.salario%TYPE,
  email_empleado IN EMPLEADO.email_emp%TYPE,
  telefono_empleado IN EMPLEADO.telefono_emp%TYPE,
  pass_empleado IN EMPLEADO.pass_emp%TYPE,
  OID_empleado IN EMPLEADO.OID_emp%TYPE)
IS
BEGIN
  UPDATE EMPLEADO SET nombre_emp = nombre_empleado WHERE OID_emp = OID_empleado;
  UPDATE EMPLEADO SET apellidos_emp = apellidos_empleado WHERE OID_emp = OID_empleado;
  UPDATE EMPLEADO SET dni_emp = dni_empleado WHERE OID_emp = OID_empleado;
  UPDATE EMPLEADO SET fecha_nacimiento_emp = fecha_nacimiento WHERE OID_emp = OID_empleado;
  UPDATE EMPLEADO SET salario = salario_empleado WHERE OID_emp = OID_empleado;
  UPDATE EMPLEADO SET email_emp = email_empleado WHERE OID_emp = OID_empleado;
  UPDATE EMPLEADO SET telefono_emp = telefono_empleado WHERE OID_emp = OID_empleado;
  UPDATE EMPLEADO SET pass_emp = pass_empleado WHERE OID_emp = OID_empleado;
	COMMIT;
END;
/
CREATE OR REPLACE PROCEDURE MODIFICAR_EMP_PEDIDO
  (OID_empleado IN PEDIDO.OID_emp%TYPE,
  OID_pedido IN PEDIDO.OID_ped%TYPE)
IS
BEGIN
	UPDATE PEDIDO SET OID_emp = OID_empleado WHERE OID_ped = OID_pedido;
	COMMIT;
END;
/
------------------------------------------------------------------TRIGGER--------------------------------------------------------

CREATE OR REPLACE TRIGGER PAGOTARJETA 
BEFORE
INSERT ON PEDIDO
FOR EACH ROW
BEGIN
  IF (:NEW.precio_total < 10.00 and :NEW.forma_pago != 'efectivo')
  THEN raise_application_error(-20603, :NEW.forma_pago ||'No se puede pagar con tarjeta siendo el precio total menor a 10 euros');
  END IF;
END;
/
CREATE OR REPLACE TRIGGER DNICLIENTE
BEFORE
INSERT OR UPDATE OF dni_cli ON CLIENTE
FOR EACH ROW
BEGIN
  IF(not(length(:NEW.dni_cli))=9)
  THEN raise_application_error(-20601, :NEW.dni_cli ||'La longitud del DNI debe ser 9');
  END IF;
END; 
/
CREATE OR REPLACE TRIGGER DNIEMPLEADO
BEFORE
INSERT ON EMPLEADO
FOR EACH ROW
BEGIN
  IF(not(length(:NEW.dni_emp))=9)
  THEN raise_application_error(-20604, :NEW.dni_emp ||'La longitud del DNI debe ser 9');
  END IF;
END;
/
CREATE OR REPLACE TRIGGER DURACIONOFERTA
BEFORE
INSERT ON OFERTA
FOR EACH ROW
DECLARE
	Duracion NUMBER;
BEGIN
	SELECT MONTHS_BETWEEN(TO_DATE(:NEW.fecha_fin, 'DD/MM/YYYY'), TO_DATE(:NEW.fecha_inicio, 'DD/MM/YYYY')) INTO Duracion FROM DUAL;
	IF Duracion < 1 
  THEN raise_application_error(-20605, :NEW.fecha_fin || 'La duración de una oferta debe ser como mínimo de 1 mes.');
	END IF;
END;
/
<?PHP
$conn=ibase_connect("localhost:C:\MICROSIP DATOS\AGUILA2.FDB", "SYSDBA", "masterkey");
$QueryClienteInfo = "CREATE PROCEDURE mail_label (cust_no INTEGER)
RETURNS (line1 CHAR(40), line2 CHAR(40), line3 CHAR(40),
         line4 CHAR(40), line5 CHAR(40), line6 CHAR(40))
AS
  DECLARE VARIABLE customer VARCHAR(25);
  DECLARE VARIABLE first_name VARCHAR(15);
  DECLARE VARIABLE last_name VARCHAR(20);
  DECLARE VARIABLE addr1 VARCHAR(30);
  DECLARE VARIABLE addr2 VARCHAR(30);
  DECLARE VARIABLE city VARCHAR(25);
  DECLARE VARIABLE state VARCHAR(15);
  DECLARE VARIABLE country VARCHAR(15);
  DECLARE VARIABLE postcode VARCHAR(12);
  DECLARE VARIABLE cnt INTEGER;
BEGIN
	line1 = '';
	line2 = '';
	line3 = '';
	line4 = '';
	line5 = '';
	line6 = '';

	SELECT customer, contact_first, contact_last, address_line1,
		address_line2, city, state_province, country, postal_code
	FROM CUSTOMER
	WHERE cust_no = :cust_no
	INTO :customer, :first_name, :last_name, :addr1, :addr2,
		:city, :state, :country, :postcode;

	IF (customer IS NOT NULL) THEN
		line1 = customer;
	IF (first_name IS NOT NULL) THEN
		line2 = first_name || ' ' || last_name;
	ELSE
		line2 = last_name;
	IF (addr1 IS NOT NULL) THEN
		line3 = addr1;
	IF (addr2 IS NOT NULL) THEN
		line4 = addr2;

	IF (country = 'USA') THEN
	BEGIN
		IF (city IS NOT NULL) THEN
			line5 = city || ', ' || state || '  ' || postcode;
		ELSE
			line5 = state || '  ' || postcode;
	END
	ELSE
	BEGIN
		IF (city IS NOT NULL) THEN
			line5 = city || ', ' || state;
		ELSE
			line5 = state;
		line6 = country || '    ' || postcode;
	END

	SUSPEND; 
END";
$Vencidos = ibase_query($conn, $QueryClienteInfo);
print_r($Vencidos);
$conn=ibase_connect("localhost:C:\MICROSIP DATOS\AGUILA2.FDB", "SYSDBA", "masterkey");
$QueryClienteInfo = "create table RECUPERACION2(
RECUPERACION_ID int not null primary key,
VALOR NUMERIC(15, 2) default 0,
FECHA timestamp default current_timestamp, 
BD VARCHAR(70) default 'SN'
);";
$Vencidos = ibase_query($conn, $QueryClienteInfo);
print_r($Vencidos);
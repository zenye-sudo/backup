//SHOW DATABASES
//SHOW TABLES
//SHOW COLUMNS FROM TABLE NAME




//SELECT name FROM personal
//SELECT address FROM coder;
//SELECT id,name FROM coder;
//SELECT*FROM coder;
//SELECT DISTINCT address FROM coder;DISTINCT keyword is primary key.
//SELECT id,name FROM coder LIMIT 1;//limit yu chin
//SELECT id,name FROM coder LIMIT 3,5  //start and number
//SELECT coder.id FROM coder ;//
//SELECT name FROM coder ORDER BY name,ORDER BY ID,
//SELECT address,name FROM coder ORDER BY address,name;//First Check address alphabet and if the same address ...check the name;
//SELECT age FROM coder ORDER BY AGE DESC;
//SELECT name,age FROM coder WHERE name="aung aung";
//SELECT name,age FROM coder WHERE name!="aung aung";
//SELECT name,age FROM coder WHERE id>=3;
//SELECT name,age FROM coder WHERE id BETWEEN 3 AND 5;
//SELECT id,name FROM coder WHERE state='CA';




//SELECT id,name FROM customers WHERE city="Boston" AND state="MA";//Get Both Same
//SELECT id,name FROM customers WHERE city="Boston" OR state="AR";
//SELECT id,name FROM customers WHERE id=1 OR id=2 AND city="Raliegh";
//SELECT id,name FROM customers WHERE (id=1 OR id=2) AND city="Raliegh";


//SELECT id,state FROM customers WHERE state IN('CA','NC','NY');
//SELECT id,state FROM customers WHERE state NOT IN('CA','NC','NY');

//How work search Engine
//SELECT name FROM items WHERE name('new%');//% is similar to black or anything.
//SELECT name FROM items WHERE name('%computer%');//% is similar to black or anything.
//SELECT city FROM customers WHERE city('h%d');//% is similar to black or anything.
//SELECT name FROM items WHERE name LIKE('_boxes of frogs');//_sign is represent one character.


//Regular Expression
//SELECT name FROM items WHERE name REGEX'new';New par thaw sar kyone tie ko result pay tal.
//SELECT name FROM items WHERE name REGEX'.boxes of frogs';//.sign is the anything single character.
//SELECT name FROM items WHERE name REGEX'gold|car';//|sign is to the same to or sign.Get both two results.
//SELECT name FROM items WHERE name REGEX'[12345] boxes of frogs';
//SELECT name FROM items WHERE name REGEX'[^12345] boxes of frogs';reverse to the upper command.
//SELECT name FROM items WHERE name REGEX'[1-5] boxes of frogs';//This command is same to the 47 line.


****Creating Custom COLUMN*****
SELECT CONCAT(city,' ,',state) AS city and state FROM customers;
SELECT name,cost,cost-1 AS sale_price FROM items;


******FUNCTION*******
SELECT name,UPPER(name) FROM items;
SELECT cost,SQRT(cost) FROM items;
SELECT AVG(cost) FROM items;
SELECT SUM(bids) FROM items;


*******Aggregate Function*****
SELECT COUNT(*) AS items_count,
MAX(cost) AS max,
AVG(cost) AS avg,
FROM items WHERE seller_id=12;

********GROUP BY**********
-SELECT seller_id,COUNT(*) AS items_count FROM items GROUP BY seller_id;
-SELECT seller_id,COUNT(*) AS items_count FROM items GROUP BY seller_id HAVING COUNT(*)>=3 ORDER BY items_count DESC;


********SUB_QUERIES******
-SELECT AVG(cost) FROM items;
-SELECT name,cost FROM items WHERE cost>(
SELECT AVG(cost) FROM items;
) ORDER BY cost DESC;

**********Another Sub_queries*****
-SELECT seller_id FROM items WHERE name LIKE '%boxes of frogs';
-SELECT MIN(cost) FROM items WHERE name LIKE '%boxes of frogs' AND seller_id IN (
SELECT seller_id FROM items where name LIKE '%boxes of frogs'
);


**********How to join Tables******
-SELECT customers.name,items.name FROM customers,items WHERE customers.id=items.seller_id ORDER BY customers.name;
-SELECT c.name,i.name FROM customers AS c,items AS i WHERE c.id=i.seller_id;


************inner join(command answer),left outer jonin,right outer join and full outer join************
-SELECT c.name,i.name FROM customers as c INNER JOIN items as i ON c.id=i.seller_id where c.id=12 ORDER BY c.name;
-SELECT c.name,i.name FROM customers as c LEFT OUTER JOIN items as i ON c.id=i.seller_id ORDER BY c.name;
-SELECT c.name,i.name FROM customers as c RIGHT OUTER JOIN itmes as i ON c.id=i.seller_id ORDER BY c.name;
-SELECT c.name,i.name FROM customers as c FULL OUTER JOIN items as i ON c.id=i.seller_id ORDER BY c.name;

*********UNION AND UNION ALL***********
SELECT name,cost,bids FROM items WHERE bids>190
UNION ALL
SELECT name,cost,bids FROM items WHERE cost>1000



*********FULL TEXT SEARCHING********
SELECT name,cost FROM items WHERE MATCH(name) Against('+baby -coat' IN BOOLEAN MODE);





**********INSERT INTO*******
INSERT INTO items(id,name,cost,seller_id,bids) VALUES(1,'zenye','109',1,23);

***********INSERT MULITLE****
INSERT INTO items(id,name,cost,seller_id,bids) VALUES
(1000,'ZAW ZAW','199',1,2),
(1001,'MG MG','199',1,2),
(1002,'AUNG AUNG','199',1,2);

***********UPDATE AND DELETE********
UPDATE name="zanye" age='17' WHERE id=1;
DELETE FROM items WHERE id=1;

************Create Table*****
CREATE TABLE IF NOT EXISTS users(
id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
username VARCHAR(225) NOT NULL,
password VARCHAR(225) NOT NULL
);

**********ALTER,DROP AND RENAME******
ALTER TABLE bacon ADD samplecolumn VARCHAR(225);
ALTER TABLE bacon DROP COLUMN samplecolumn;

DROP TABLE bacon;
RENAME TABLE customers TO users;



***************CREATE VIEW************(Temporarri table)
-CREATE VIEW zenye AS
SELECT name,cost FROM items ORDER BY cost DESC LIMIT 10;
-CREATE VIEW yezen AS
SELECT CONCAT(city,' ,',state) FROM customers;


DROP SCHEMA IF EXISTS product;
CREATE SCHEMA product;
USE product;

CREATE TABLE `user` (
  userID INT AUTO_INCREMENT PRIMARY KEY, 
  userFirstName VARCHAR(80) NOT NULL,
  userLastName VARCHAR(80) NOT NULL,
  userEmail VARCHAR(150) NOT NULL,
  userPassHash VARCHAR(32) NOT NULL
);

INSERT INTO user (userFirstName, userLastName, userEmail, userPassHash)
VALUES ('Lily', 'R-M', 'lily@email.ca', MD5('Password01')),
       ('sassy', 'cass', 'sassycass@email.ca', MD5('Password01')),
       ('Silly', 'Kirk', 'sKirk@email.ca', MD5('Password01'));

CREATE TABLE `products` (
	productsID INT AUTO_INCREMENT PRIMARY KEY,
    productsName VARCHAR(140),
    productsDesc VARCHAR(300),
    productsCost DECIMAL(7,2),
    productsInv INT,
    productsDateAdded DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (productsName, productsDesc, productsCost, productsInv, productsDateAdded)
VALUES ('Product A', 'Product Description: This is text', 10.99, 200, 2017-01-28),
       ('Product B', 'Product Description: This is text', 11.99, 300, 2016-01-15),
       ('Product C', 'Product Description: This is text', 12.99, 400, 2015-01-14);

CREATE TABLE `orders` (
	ordersID INT AUTO_INCREMENT PRIMARY KEY,
    ordersDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    userID INT,
    productsID INT
    
);


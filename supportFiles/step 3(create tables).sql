
CREATE TABLE `user` (
  userID INT AUTO_INCREMENT PRIMARY KEY, 
  userFirstName VARCHAR(80) NOT NULL,
  userLastName VARCHAR(80) NOT NULL,
  userEmail VARCHAR(150) NOT NULL,
  userPhone VARCHAR(15) NOT NULL,
  userAddress VARCHAR(150) NOT NULL,
  userCity VARCHAR(150) NOT NULL,
  userPostalCode VARCHAR(7) NOT NULL,
  userPassHash VARCHAR(32) NOT NULL,
  userAdmin BOOLEAN NOT NULL
);

CREATE TABLE `orders` (
	ordersID INT AUTO_INCREMENT PRIMARY KEY,
    ordersDate DATE,
    userID INT,
    productsID INT    
);


CREATE TABLE `products` (
	productsID INT AUTO_INCREMENT PRIMARY KEY,
    productsName VARCHAR(140),
    productsDesc VARCHAR(500),
    productsCost DECIMAL(7,2),
    productsInv INT
);

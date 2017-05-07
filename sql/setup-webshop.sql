-- ------------------------------------------------------------------------
--
-- Webshop anaxlite
--
-- CREATE DATABASE peto16;
-- GRANT ALL ON peto16.* TO user@localhost IDENTIFIED BY "pass";
USE peto16;
SET NAMES utf8;



-- ------------------------------------------------------------------------
--
-- Setup tables
--
DROP TABLE IF EXISTS `anaxlite_Prod2Cat`;
DROP TABLE IF EXISTS `anaxlite_ProdCategory`;
DROP TABLE IF EXISTS `anaxlite_Inventory`;
DROP TABLE IF EXISTS `anaxlite_InvenShelf`;
DROP TABLE IF EXISTS `anaxlite_InventoryLow`;
DROP TABLE IF EXISTS `anaxlite_ShoppingCartRow`;
DROP TABLE IF EXISTS `anaxlite_OrderRow`;
DROP TABLE IF EXISTS `anaxlite_Order`;
DROP TABLE IF EXISTS `anaxlite_Product`;
DROP TABLE IF EXISTS `anaxlite_ShoppingCart`;
DROP TABLE IF EXISTS `anaxlite_Customer`;



-- ------------------------------------------------------------------------
--
-- anaxlite_Product and product category
--
CREATE TABLE `anaxlite_ProdCategory` (
    `id` INT AUTO_INCREMENT,
    `category` CHAR(20),

    PRIMARY KEY (`id`),
);

CREATE TABLE `anaxlite_Product` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(20),
    `description` VARCHAR(400),
    `image` VARCHAR(20),
    `price` DECIMAL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT NULL,
    `deleted` DATETIME DEFAULT NULL,

    PRIMARY KEY (`id`),
    KEY `index_name` (`name`),
    KEY `index_price` (`price`)

);

CREATE TABLE `anaxlite_Prod2Cat` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `cat_id` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `anaxlite_Product` (`id`),
    FOREIGN KEY (`cat_id`) REFERENCES `anaxlite_ProdCategory` (`id`)
);



-- ------------------------------------------------------------------------
--
-- anaxlite_Inventory and shelfs
--
CREATE TABLE `anaxlite_InvenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

    PRIMARY KEY (`shelf`)
);

CREATE TABLE `anaxlite_Inventory` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `shelf_id` CHAR(6),
    `items` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `anaxlite_Product` (`id`),
    FOREIGN KEY (`shelf_id`) REFERENCES `anaxlite_InvenShelf` (`shelf`)
);

CREATE TABLE `anaxlite_InventoryLow` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `items` INT,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `anaxlite_Product` (`id`)
);



-- ------------------------------------------------------------------------
--
-- anaxlite_Customer
--
CREATE TABLE `anaxlite_Customer` (
    `id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),

    PRIMARY KEY (`id`)
);



-- ------------------------------------------------------------------------
--
-- anaxlite_Order
--
CREATE TABLE `anaxlite_Order` (
    `id` INT AUTO_INCREMENT,
    `customer` INT,
    `created` DATETIME DEFAULT NULL,
    `updated` DATETIME DEFAULT NULL,
    `deleted` DATETIME DEFAULT NULL,
    `delivery` DATETIME DEFAULT NULL,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`customer`) REFERENCES `anaxlite_Customer` (`id`)
);

CREATE TABLE `anaxlite_OrderRow` (
    `id` INT AUTO_INCREMENT,
    `order` INT,
    `product` INT,
    `items` INT,
    `price` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`order`) REFERENCES `anaxlite_Order` (`id`),
    FOREIGN KEY (`product`) REFERENCES `anaxlite_Product` (`id`)
);



-- ------------------------------------------------------------------------
--
-- Shopping cart.
--

CREATE TABLE `anaxlite_ShoppingCart` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT,

    FOREIGN KEY (`customer_id`) REFERENCES `anaxlite_Customer` (`id`)
);

CREATE TABLE `anaxlite_ShoppingCartRow` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `cart_id` INT NOT NULL,
    `prod_id` INT NOT NULL,
    `amount` INT NOT NULL,

    FOREIGN KEY (`cart_id`) REFERENCES `anaxlite_ShoppingCart` (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `anaxlite_Product` (`id`)
);



-- ------------------------------------------------------------------------
--
-- Test data
--
-- ------------------------------------------------------------------------
--
-- Start with the product catalogue
--
INSERT INTO `anaxlite_ProdCategory` (`category`) VALUES
("Tennis"), ("Fotboll"), ("Ishockey"), ("Bollar")
;

INSERT INTO `anaxlite_Product` (`name`, `description`, `image`, `price`) VALUES
("Tennisboll", "Tennisbollar av högsta kvalitet.", "prod_1.jpg", 199),
("Tennisracket", "Racket av högsta kvalitet.", "prod_2.jpg", 1999),
("Fotboll", "Fotboll av högsta kvalitet. Officella VM-bollen.", "prod_3.jpg", 799),
("Fotbollsskor", "Fotbollsskor av högsta kvalitet.", "prod_4.jpg", 2499),
("Ishockeyklubba", "Populäraste klubban.", "prod_5.jpg", 1299)
;

INSERT INTO `anaxlite_Prod2Cat` (`prod_id`, `cat_id`) VALUES
(1, 1), (1, 4),
(2, 1),
(3, 2), (3, 4),
(4, 2),
(5,3)
;

INSERT INTO `anaxlite_InvenShelf` (`shelf`, `description`) VALUES
("AA101", "Lager A, gång A, hylla 101"),
("AA102", "Lager A, gång A, hylla 102"),
("AB101", "Lager A, gång B, hylla 101")
;

INSERT INTO `anaxlite_Inventory` (`prod_id`, `shelf_id`, `items`) VALUES
(1, "AA101", 100), (2, "AA102", 99),
(3, "AA101", 98), (4, "AA102", 97),
(5, "AA101", 96)
;



-- ------------------------------------------------------------------------
--
-- The customers are arriving
--
INSERT INTO `anaxlite_Customer` (`firstName`, `lastName`) VALUES
("Kalle", "Anka"),
("Kajsa", "Anka"),
("Musse", "Pigg")
;



-- ------------------------------------------------------------------------
--
-- Views
-- ------------------------------------------------------------------------

-- -------------------------
-- Product
-- -------------------------

-- Product info
DROP VIEW IF EXISTS VProducts;
CREATE VIEW VProducts AS
SELECT
    P.id,
    P.name,
    P.description,
    P.image,
    P.price,
    GROUP_CONCAT(category) AS category,
    I.items AS inventory
FROM anaxlite_Product AS P
    INNER JOIN anaxlite_Prod2Cat AS P2C
ON P.id = P2C.prod_id
    INNER JOIN anaxlite_ProdCategory AS PC
        ON PC.id = P2C.cat_id
    LEFT JOIN anaxlite_Inventory AS I
        ON P.id = I.prod_id
WHERE P.deleted IS NULL
GROUP BY P.id
ORDER BY P.id
;



-- -------------------------
-- Inventory
-- -------------------------

-- Inventory
DROP VIEW IF EXISTS VInventory;
CREATE VIEW VInventory AS
SELECT
    S.shelf,
    S.description AS location,
    I.items,
    P.description
FROM anaxlite_Inventory AS I
    INNER JOIN anaxlite_InvenShelf AS S
        ON I.shelf_id = S.shelf
    INNER JOIN anaxlite_Product AS P
        ON P.id = I.prod_id
ORDER BY S.shelf
;



-- Inv products
DROP VIEW IF EXISTS VInvProducts;
CREATE VIEW VInvProducts AS
SELECT
    S.shelf,
    S.description AS location,
    I.items,
    P.id,
    P.name
FROM anaxlite_Product AS P
    LEFT JOIN anaxlite_Inventory as I
        ON P.id = I.prod_id
    LEFT JOIN anaxlite_InvenShelf AS S
        ON I.shelf_id = S.shelf
ORDER BY S.shelf
;



-- -------------------------
-- ShoppingCart
-- -------------------------

-- anaxlite_Order details
DROP VIEW IF EXISTS VShoppingCartDetails;
CREATE VIEW VShoppingCartDetails AS
SELECT
    SC.id AS CartId,
    SC.customer_id AS CustomerId,
    SCR.prod_id AS ProdId,
    P.name AS ProdName,
    P.description AS Description,
    P.price AS Price,
    SCR.amount AS Amount
FROM `anaxlite_ShoppingCart` AS SC
    INNER JOIN anaxlite_ShoppingCartRow AS SCR
        ON SC.id = SCR.cart_id
    INNER JOIN anaxlite_Product AS P
        ON SCR.prod_id = P.id
ORDER BY SC.id
;



-- -------------------------
-- Orders
-- -------------------------

-- anaxlite_Order details
DROP VIEW IF EXISTS VOrderDetails;
CREATE VIEW VOrderDetails AS
SELECT
    O.id AS OrderNumber,
    R.id AS anaxlite_OrderRow,
    P.description AS Description,
    R.items AS Items,
    R.price AS Price
FROM `anaxlite_Order` AS O
    INNER JOIN anaxlite_OrderRow AS R
        ON O.id = R.order
    INNER JOIN anaxlite_Product AS P
        ON R.product = P.id
ORDER BY anaxlite_OrderRow
;



-- -------------------------
-- InvLog
-- -------------------------

-- anaxlite_Order details
DROP VIEW IF EXISTS VInventoryLow;
CREATE VIEW VInventoryLow AS
SELECT
    ILL.id AS id,
    ILL.prod_id AS prod_id,
    P.name AS Name,
    ILL.items AS Items,
    ILL.date AS Occured
FROM `anaxlite_InventoryLow` AS ILL
    INNER JOIN anaxlite_Product AS P
        ON ILL.prod_id = P.id
ORDER BY ILL.id
;
-- ------------------------------------------------------------------------
--
-- Procedures
-- ------------------------------------------------------------------------

-- -------------------------
--
-- Product
-- -------------------------

-- Create a product
DROP PROCEDURE IF EXISTS `createProduct`;

DELIMITER //

CREATE PROCEDURE createProduct(
    `name` VARCHAR(20),
    `description` VARCHAR(400),
    `image` VARCHAR(20),
    `price` DECIMAL
)
BEGIN
    INSERT INTO `anaxlite_Product` (`name`, `description`, `image`, `price`) VALUES
    (name, description, image, price);
END
//
DELIMITER ;



-- Add product to Category
DROP PROCEDURE IF EXISTS `addProd2Cat`;

DELIMITER //

CREATE PROCEDURE addProd2Cat(
    `prod_id` INT,
    `cat_id` INT
)
BEGIN
    INSERT INTO `anaxlite_Prod2Cat` (`prod_id`, `cat_id`) VALUES
    (prod_id, cat_id);
END
//
DELIMITER ;



-- Update product
DROP PROCEDURE IF EXISTS `updateProduct`;

DELIMITER //

CREATE PROCEDURE updateProduct(
    `newName` VARCHAR(20),
    `newDescription` VARCHAR(400),
    `newImage` VARCHAR(20),
    `newPrice` DECIMAL,
    `prod_id` INT
)
BEGIN
    UPDATE `anaxlite_Product` SET `name` = newName, `description` = newDescription, `image` = newImage, `price` = newPrice WHERE `id` = prod_id;
END
//
DELIMITER ;



-- Delete product
DROP PROCEDURE IF EXISTS `deleteProduct`;

DELIMITER //

CREATE PROCEDURE deleteProduct(
    `prod_id` INT
)
BEGIN
    UPDATE `anaxlite_Product` SET `deleted` = NOW() WHERE `id` = prod_id;
END
//
DELIMITER ;



-- Update product inventory
DROP PROCEDURE IF EXISTS `updateInvProduct`;

DELIMITER //

CREATE PROCEDURE updateInvProduct(
    `new_ShelfId` CHAR(6),
    `new_Items` INT,
    `new_ProdId` INT
)
BEGIN
    UPDATE `anaxlite_Inventory` SET `shelf_id` = new_ShelfId, `items` = new_Items WHERE `prod_id` = new_ProdId;
END
//
DELIMITER ;



-- -------------------------
--
-- Shoppingcart
-- -------------------------

-- Create shoppingcart
DROP PROCEDURE IF EXISTS `createCart`;

DELIMITER //

CREATE PROCEDURE createCart(
    `in_customer_id` INT
)
BEGIN
    START TRANSACTION;
    INSERT INTO `anaxlite_ShoppingCart` (`customer_id`) VALUES
    (in_customer_id);
    COMMIT;
END
//
DELIMITER ;



-- Add product to shoppingcart
DROP PROCEDURE IF EXISTS `addProd2Cart`;

DELIMITER //

CREATE PROCEDURE addProd2Cart(
    `in_cart_id` INT,
    `in_prod_id` INT,
    `in_amount` INT
)
BEGIN

    START TRANSACTION;
    IF enoughStock(in_amount, in_prod_id) THEN
        INSERT INTO `anaxlite_ShoppingCartRow` (`cart_id`, `prod_id`, `amount`) VALUES
        (in_cart_id, in_prod_id, in_amount);
        COMMIT;
    ELSE
        ROLLBACK;
        SELECT "Inte tillräckligt i lager.";
    END IF;

END
//
DELIMITER ;



-- Remove product from shoppingcart
DROP PROCEDURE IF EXISTS `removeProdFromCart`;

DELIMITER //

CREATE PROCEDURE removeProdFromCart(
    `in_cart_id` INT,
    `in_prod_id` INT,
    `in_amount` INT
)
BEGIN
    DECLARE `currentInvProdCart` INT;
    DECLARE `currentInvProd` INT;

    START TRANSACTION;

    SET `currentInvProdCart` = (SELECT `amount` FROM `anaxlite_ShoppingCartRow` WHERE `prod_id` = in_prod_id);
    SET `currentInvProd` = (SELECT `items` FROM `anaxlite_Inventory` WHERE `prod_id` = in_prod_id);


    IF `currentInvProdCart` - in_amount > 0 THEN
        UPDATE `anaxlite_ShoppingCartRow` SET `amount` = currentInvProdCart - in_amount WHERE `cart_id` = in_cart_id AND `prod_id` = in_prod_id;
        COMMIT;
    ELSE
        IF `currentInvProdCart` - in_amount < 0 THEN
            ROLLBACK;
            SELECT "För mycket tas från varukorgen";
        ELSE IF currentInvProdCart - in_amount = 0 OR `currentInvProdCart` = 0 THEN
            DELETE FROM `anaxlite_ShoppingCartRow` WHERE `cart_id` = in_cart_id AND `prod_id` = in_prod_id;
        COMMIT;
        END IF;
        END IF;
    END IF;
END
//
DELIMITER ;



-- -------------------------
--
-- Order management
-- -------------------------

-- Create order

DROP PROCEDURE IF EXISTS `createOrder`;

DELIMITER //

CREATE PROCEDURE createOrder(
    `in_cart_id` INT,
    `in_customer_id` INT
)
BEGIN
    DECLARE `currentStock` INT;
    DECLARE `order_id` INT;
    DECLARE `counter` INT;
    DECLARE `nr_rows` INT;
    DECLARE `temp_prod_id` INT;
    DECLARE `temp_amount` INT;
    DECLARE `temp_price` DECIMAL;

    START TRANSACTION;
    INSERT INTO `anaxlite_Order` (`customer`, `created`) VALUES
    (in_customer_id, NOW());

    SET `order_id` = LAST_INSERT_ID();
    SET `counter` = 0;
    SET `nr_rows` = (SELECT COUNT(*) FROM anaxlite_ShoppingCartRow WHERE `cart_id` = in_cart_id);

    WHILE `counter` < `nr_rows` DO
        SET `temp_prod_id` = (SELECT `prod_id` FROM anaxlite_ShoppingCartRow WHERE `cart_id` = in_cart_id LIMIT counter, 1);
        SET `temp_amount` = (SELECT `amount` FROM anaxlite_ShoppingCartRow WHERE `cart_id` = in_cart_id AND `prod_id` = temp_prod_id);
        SET `temp_price` = (SELECT `price` FROM anaxlite_Product WHERE `id` = temp_prod_id);
        SET `currentStock` = (SELECT `items` FROM `anaxlite_Inventory` WHERE `prod_id` = temp_prod_id);
        INSERT INTO `anaxlite_OrderRow` (`order`, `product`, `items`, `price`) VALUES
        (order_id, temp_prod_id, temp_amount, temp_price);

        IF enoughStock(temp_amount, temp_prod_id) THEN
            UPDATE `anaxlite_Inventory` SET `items` = currentStock - temp_amount WHERE `prod_id` = temp_prod_id;
        ELSE
            ROLLBACK;
            SELECT "Inte tillräckligt i lager.";
        END IF;

        SET `counter` = counter + 1;
    END WHILE;
    DELETE FROM `anaxlite_ShoppingCartRow` WHERE `cart_id` = in_cart_id;
    DELETE FROM `anaxlite_ShoppingCart` WHERE `customer_id` = in_customer_id;

    COMMIT;
END
//
DELIMITER ;



-- remove Order
DROP PROCEDURE IF EXISTS `deleteOrder`;

DELIMITER //

CREATE PROCEDURE deleteOrder(
    `in_order_id` INT
)
BEGIN
    DECLARE `counter` INT;
    DECLARE `nr_rows` INT;
    DECLARE `move_prod_id` INT;
    DECLARE `move_amount` INT;

    START TRANSACTION;

    UPDATE `anaxlite_Order` SET `deleted` = NOW() WHERE `id` = in_order_id;

    SET `counter` = 0;
    SET `nr_rows` = (SELECT COUNT(*) FROM anaxlite_OrderRow WHERE `order` = in_order_id);

    WHILE `counter` < `nr_rows` DO
        SET `move_prod_id` = (SELECT `product` FROM `anaxlite_OrderRow` WHERE `order` = in_order_id LIMIT counter, 1);
        SET `move_amount` = (SELECT `items` FROM `anaxlite_OrderRow` WHERE `order` = in_order_id LIMIT counter, 1);

        UPDATE `anaxlite_Inventory` SET `items` = (items + move_amount) WHERE `prod_id` = move_prod_id;

        SET `counter` = counter + 1;
    END WHILE;
    COMMIT;
END
//
DELIMITER ;



-- ------------------------------------------------------------------------
-- Functions
-- ------------------------------------------------------------------------

-- Check if enough in stock
DELIMITER //

DROP FUNCTION IF EXISTS enoughStock //
CREATE FUNCTION enoughStock(
    in_amount INT,
    in_prod_id INT
)
RETURNS BOOLEAN
BEGIN
    DECLARE currentStock INT;
    SET currentStock = (SELECT `items` FROM `anaxlite_Inventory` WHERE `prod_id` = in_prod_id);
    IF currentStock >= in_amount THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
-- Triggers
-- ------------------------------------------------------------------------

-- Trigger log output for low stock, less than 5

DROP TRIGGER IF EXISTS LogLowInventory;

DELIMITER //
CREATE TRIGGER LogLowInventory
AFTER UPDATE
ON `anaxlite_Inventory` FOR EACH ROW
BEGIN
    IF NEW.items < 5 AND OLD.items >= 5 THEN
        INSERT INTO `anaxlite_InventoryLow` (`prod_id`, `items`) VALUES
        (NEW.prod_id, NEW.items);
    END IF;
END
//

DELIMITER ;



-- ------------------------------------------------------------------------
-- Test
-- ------------------------------------------------------------------------

SELECT * FROM VProducts;

SELECT * FROM anaxlite_InvenShelf;

SELECT * FROM anaxlite_Product;

SELECT * FROM anaxlite_Prod2Cat;

SELECT * FROM VInventory;

SELECT * FROM VOrderDetails;

CALL createCart(1);
SELECT * FROM anaxlite_ShoppingCart;

CALL addProd2Cart(1, 1, 98);
CALL addProd2Cart(1, 2, 3);
SELECT * FROM anaxlite_ShoppingCartRow;

SELECT * FROM VShoppingCartDetails;
CALL removeProdFromCart(1, 1, 1);
SELECT * FROM VShoppingCartDetails;

SELECT * FROM anaxlite_ShoppingCart;

CALL createOrder(1, 1);
SELECT * FROM anaxlite_Order;
SELECT * FROM anaxlite_OrderRow;
SELECT * FROM anaxlite_ShoppingCartRow;

CALL deleteOrder(1);

SELECT * FROM VInventoryLow;

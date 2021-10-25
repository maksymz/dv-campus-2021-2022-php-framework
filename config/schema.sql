DROP TABLE IF EXISTS `category_product`;
#---
DROP TABLE IF EXISTS `order_item`;
#---
DROP TABLE IF EXISTS `order`;
#---
DROP TABLE IF EXISTS `category`;
#---
DROP TABLE IF EXISTS `product`;
#---
CREATE TABLE `product` (
    `product_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Product ID',
    `sku` varchar(63) NOT NULL COMMENT 'SKU',
    `name` varchar(127) NOT NULL COMMENT 'Name',
    `url` varchar(127) NOT NULL COMMENT 'URL',
    `description` varchar(4095) DEFAULT NULL COMMENT 'Description',
    `qty` smallint DEFAULT NULL COMMENT 'Quantity',
    `price` decimal(10,2) NOT NULL COMMENT 'Price',
    PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Product Entity';
#---
CREATE TABLE `category` (
   `category_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Category ID',
   `name` varchar(127) NOT NULL COMMENT 'Name',
   `url` varchar(127) NOT NULL COMMENT 'URL',
   PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Category Entity';
#---
CREATE TABLE `order` (
    `order_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Order ID',
    `firstname` varchar(127) DEFAULT NULL COMMENT 'First Name',
    `lastname` varchar(127) DEFAULT NULL COMMENT 'Last Name',
    `total` decimal(10,2) NOT NULL COMMENT 'Total',
    `shipping_method` varchar(31) DEFAULT NULL COMMENT 'Shipping Method',
    `shipping_info` varchar(255) DEFAULT NULL COMMENT 'Shipping Information',
    PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Order Entity';
#---
CREATE TABLE `order_item` (
    `order_item_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Product ID',
    `order_id` int unsigned NOT NULL COMMENT 'Order ID',
    `product_id` int unsigned DEFAULT NULL COMMENT 'Product ID',
    `sku` varchar(63) NOT NULL COMMENT 'SKU',
    `name` varchar(127) NOT NULL COMMENT 'Name',
    `qty` smallint DEFAULT NULL COMMENT 'Quantity',
    `item_price` decimal(10,4) NOT NULL COMMENT 'Item Price',
    `total` decimal(10,4) NOT NULL COMMENT 'Total',
    PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Order Item Entity';
#---
INSERT INTO `product` (`sku`, `name`, `url`, `description`, `qty`, `price`)
VALUES ('sku-1', 'Product 1', 'product-1', 'Lorem ipsum dolor sit amet', 1, 10.99),
       ('sku-2', 'Product 2', 'product-2', 'Lorem ipsum dolor sit amet', 10, 20.99),
       ('sku-3', 'Product 3', 'product-3', 'Lorem ipsum dolor sit amet', 20, 30.99),
       ('sku-4', 'Product 4', 'product-4', 'Lorem ipsum dolor sit amet', 30, 15.50),
       ('sku-5', 'Product 5', 'product-5', 'Lorem ipsum dolor sit amet', 15, 65.25),
       ('sku-6', 'Product 6', 'product-6', 'Lorem ipsum dolor sit amet', 12, 41.30),
       ('sku-7', 'Product 7', 'product-7', 'Lorem ipsum dolor sit amet', 99, 37.80);
#---
INSERT INTO `category` (`name`, `url`)
VALUES ('Apple', 'Apple'),
       ('Samsung', 'samsung'),
       ('Xiaomi', 'xiaomi'),
       ('Google', 'google'),
       ('LG', 'lg');
#---
INSERT INTO `order` (`firstname`, `lastname`, `total`, `shipping_method`, `shipping_info`)
VALUES ('Юрій', 'Коваленко', 650.00, NULL, NULL),
       ('Юрій', 'Коваленко', 199.99, 'Нова пошта', 'м. Черкаси, відділення №14 (бульвар Шевченка, 385), Юрій Коваленко'),
       ('Галина', 'Нікітіч', 300.00, NULL, NULL),
       ('Соломія', 'Федорів', 199.99, 'Нова пошта', 'м. Київ, відділення №46 (бульвар Дружби Народів, 14), Захар Петрів');

#---
INSERT INTO `order_item` (`order_id`, `product_id`, `sku`, `name`, `qty`, `item_price`, `total`)
VALUES (1, 1, 'sku-1', 'Product 1', 10, 10.99, 100.99),
       (1, 3, 'sku-3', 'Product 3', 10, 30.99, 300.99),
       (1, 5, 'sku-5', 'Product 5', 4, 70.00, 280.00),
       (2, 5, 'sku-6', 'Product 6', 5, 41.30, 206.50),
       (3, 5, 'sku-4', 'Product 4', 4, 15.00, 60.00),
       (3, 5, 'sku-5', 'Product 7', 6, 40.00, 240.00),
       (4, 6, 'sku-6', 'Product 6', 5, 41.30, 206.50);
#---
ALTER TABLE `product`
    ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        COMMENT 'Created At' AFTER `price`,
    ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
        COMMENT 'Updated At' AFTER `created_at`;
#---
ALTER TABLE `order`
    ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        COMMENT 'Created At' AFTER `shipping_info`,
    ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
        COMMENT 'Updated At' AFTER `created_at`;
#---
CREATE TABLE `category_product` (
    `category_product_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `product_id` int unsigned NOT NULL COMMENT 'Product ID',
    `category_id` int unsigned NOT NULL COMMENT 'Category ID',
    PRIMARY KEY (`category_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Category Product';
#---
ALTER TABLE `category_product`
    ADD CONSTRAINT `FK_CATEGORY_ID` FOREIGN KEY (`category_id`)
        REFERENCES `category` (`category_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_PRODUCT_ID` FOREIGN KEY (`product_id`)
        REFERENCES `product` (`product_id`) ON DELETE CASCADE;
#---
INSERT INTO `category_product` (`category_id`, `product_id`)
VALUES (1, 1), (1, 2), (1, 3), (1, 4),
       (2, 2), (2, 3), (2, 4), (2, 5),
       (3, 3), (3, 4), (3, 5), (3, 6),
       (4, 1), (4, 3), (4, 5),
       (5, 2), (5, 4), (5, 6);
#---
ALTER TABLE `order_item`
    ADD CONSTRAINT `FK_ORDER_ITEM_ORDER_ID` FOREIGN KEY (`order_id`)
        REFERENCES `order` (`order_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_ORDER_ITEM_PRODUCT_ID` FOREIGN KEY (`product_id`)
        REFERENCES `product` (`product_id`) ON DELETE SET NULL;
DROP TABLE IF EXISTS `category_product`;
#---
DROP TABLE IF EXISTS `orders`;
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
    `qty` smallint DEFAULT NULL COMMENT 'SKU',
    `price` decimal(10,4) NOT NULL COMMENT 'Price',
    PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Product Entity';
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
ALTER TABLE `product`
    ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        COMMENT 'Created At' AFTER `price`,
    ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
        COMMENT 'Updated At' AFTER `created_at`;
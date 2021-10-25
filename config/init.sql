DROP DATABASE IF EXISTS dv_campus_shop;

DROP USER IF EXISTS 'dv_campus_shop_user'@'%';

CREATE DATABASE dv_campus_shop;

CREATE USER 'dv_campus_shop_user'@'%' IDENTIFIED BY '45Ya!$""sT&P*C%RNSEhr';

GRANT ALL ON dv_campus_shop.* TO 'dv_campus_shop_user'@'%';

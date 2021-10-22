DROP DATABASE IF EXISTS dv_campus_blog;

DROP USER IF EXISTS 'dv_campus_blog_user'@'%';

CREATE DATABASE dv_campus_blog;

CREATE USER 'dv_campus_blog_user'@'%' IDENTIFIED BY '45Ya!$""sT&P*C%RNSEhr';

GRANT ALL ON dv_campus_blog.* TO 'dv_campus_blog_user'@'%';

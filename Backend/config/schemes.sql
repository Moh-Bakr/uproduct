CREATE DATABASE Products;

CREATE TABLE IF NOT EXISTS `Product` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(256) NOT NULL,
    `name` varchar(256),
    `price` float(11) NOT NULL,
    `type` varchar(255) NOT NULL,
    `value` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



/* To Make SKU UNIQUE Field*/
ALTER TABLE Product ADD UNIQUE (sku);
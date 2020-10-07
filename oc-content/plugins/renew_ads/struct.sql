CREATE TABLE IF NOT EXISTS `/*TABLE_PREFIX*/t_item_renew_ads` (
  `fk_i_item_id` int(10) unsigned NOT NULL,
   `d_renewed` int(20) NOT NULL,
	`published` DATETIME,
	`last_renewed` timestamp,
  PRIMARY KEY (`fk_i_item_id`),
  FOREIGN KEY (fk_i_item_id) REFERENCES /*TABLE_PREFIX*/t_item (pk_i_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `/*TABLE_PREFIX*/t_item_deleted_expired_ads` (
  `fk_i_item_id` int(10) unsigned NOT NULL,
	`status` varchar(28) NOT NULL,
	`user_id` int(10) NOT NULL,
	`item_title` varchar(240) NOT NULL,
   	`deleted` varchar(140) NOT NULL,
	`deleted_date` timestamp,

  PRIMARY KEY (`fk_i_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

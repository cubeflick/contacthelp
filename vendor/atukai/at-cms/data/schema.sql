CREATE TABLE IF NOT EXISTS `cms_page` (
  `page_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Page ID',
  `title` varchar(255) DEFAULT NULL COMMENT 'Page Title',
  `identifier` varchar(255) NOT NULL COMMENT 'Page String Identifier',
  `meta_keywords` varchar(255) DEFAULT NULL COMMENT 'Page Meta Keywords',
  `meta_description` varchar(255) DEFAULT NULL COMMENT 'Page Meta Description',
  `content` text COMMENT 'Page Content',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Page Creation Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Page Modification Time',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Is Page Active',
  `sort_order` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT 'Page Sort Order',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='CMS Page Table';

CREATE TABLE IF NOT EXISTS `cms_page_block` (
  `block_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Block ID',
  `title` varchar(255) DEFAULT NULL COMMENT 'Block Title',
  `identifier` varchar(255) NOT NULL COMMENT 'Block String Identifier',
  `content` text COMMENT 'Block Content',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Block Creation Time',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Block Modification Time',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Is Block Active',
  PRIMARY KEY (`block_id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='CMS Block Table';
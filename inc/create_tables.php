<?php
function create_table($sql) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


//add_action('after_switch_theme', 'mytheme_setup_options');

function mytheme_setup_options () {
    global $wpdb;
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

    $sql_comments = "CREATE TABLE `{$wpdb->prefix}bl_order_comments` (
	id  int(9) unsigned NOT NULL auto_increment,
	parent_id int(11) NOT NULL default 0,
	order_id int(11) NOT NULL,
	user_id int(11) NOT NULL,
	comments text NOT NULL default '',	
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_comments);

    $sql_documents = "CREATE TABLE `{$wpdb->prefix}bl_order_comments` (
	`id`  int(9) unsigned NOT NULL auto_increment,
	`title` varchar(500) NOT NULL,
	`description` text NOT NULL default '',	
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_documents);

    $sql_employment = "CREATE TABLE `{$wpdb->prefix}bl_employment` (
	`id`  int(9) unsigned NOT NULL auto_increment,
	`date` date NOT NULL,
	`cost` float(12,2) NOT NULL,	
	`avail` int(1) DEFAULT NULL,	
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_employment);

    $sql_friends = "CREATE TABLE `{$wpdb->prefix}bl_friends` (
	`id`  int(9) unsigned NOT NULL auto_increment,
	`user_id` int(9) NOT NULL,
	`email` varchar(255) NOT NULL,	
	`is_exist` int(9) NOT NULL DEFAULT '0',	
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_friends);

   $sql_notifications = "CREATE TABLE `{$wpdb->prefix}bl_notifications` (
	`id`  int(9) unsigned NOT NULL auto_increment,
	`user_id` int(9) NOT NULL,
	`order_id` int(9) NOT NULL,
	`description` varchar(500) NOT NULL,	
	`is_view` int(1) NOT NULL DEFAULT CURRENT_TIMESTAMP,	
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_notifications);

   $sql_order = "CREATE TABLE `{$wpdb->prefix}bl_orders` (
	`id`  int(9) unsigned NOT NULL auto_increment,
  `out_id` int(9) DEFAULT '0',
  `user_id` int(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `area` float(9,2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `price` float(9,2) DEFAULT NULL,
  `region` varchar(255) NOT NULL,
  `settlement` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house` varchar(7) NOT NULL,
  `location` varchar(255) NOT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `rang` float NOT NULL DEFAULT '0',
  `document` varchar(500) NOT NULL,
  `mark` int(2) NOT NULL DEFAULT '1',
  `type` int(2) NOT NULL DEFAULT '1',
  `date_end` date DEFAULT NULL,
  `date_change` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_order);

   $sql_performers = "CREATE TABLE `{$wpdb->prefix}bl_performers` (
	`id`  int(9) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text NOT NULL
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_performers);

   $sql_reminder = "CREATE TABLE `{$wpdb->prefix}bl_reminder` (
	`id`  int(9) unsigned NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `remind_time` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `is_view` int(1) NOT NULL DEFAULT '0'
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_reminder);

  $sql_services = "CREATE TABLE `{$wpdb->prefix}bl_services` (
	`id`  int(9) unsigned NOT NULL auto_increment,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_services);

$sql_services_relationship = "CREATE TABLE `{$wpdb->prefix}bl_services_relationship` (
	`service_id` int(7) NOT NULL,
  `document_id` int(7) NOT NULL
	)
	{$charset_collate};";
    create_table($sql_services_relationship);

$sql_region_statistics = "CREATE TABLE `{$wpdb->prefix}bl_region_statistics` (
	`region` varchar(250) NOT NULL,
  `ip_user` varchar(20) DEFAULT NULL,
  `user_id` int(7) NOT NULL,
  `http_user_agent` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY  (id)
	)
	{$charset_collate};";
    create_table($sql_region_statistics);
}
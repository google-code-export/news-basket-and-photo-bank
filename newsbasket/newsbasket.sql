/*
Created		7/9/2012
Modified		7/10/2012
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


drop table IF EXISTS article_category;
drop table IF EXISTS category;
drop table IF EXISTS users_article;
drop table IF EXISTS author_article;
drop table IF EXISTS article_version;
drop table IF EXISTS article;
drop table IF EXISTS users;
drop table IF EXISTS source;
drop table IF EXISTS author;


Create table author (
	id_author Varchar(50) NOT NULL,
	id_source Int NOT NULL,
	name Varchar(255),
	email Varchar(255),
	phone Varchar(255),
 Primary Key (id_author)) ENGINE = MyISAM;

Create table source (
	id_source Int NOT NULL,
	source_name Varchar(255),
	source_type Enum('wires', 'publisher'),
 Primary Key (id_source)) ENGINE = MyISAM;

Create table users (
	id_user Varchar(50) NOT NULL,
	id_source Int NOT NULL,
	password Varchar(10) NOT NULL,
	name Varchar(255),
	phone Varchar(255),
	email Varchar(255),
	user_level Enum('viewer', 'editor', 'publisher', 'administrator'),
 Primary Key (id_user)) ENGINE = MyISAM;

Create table article (
	id_article Int NOT NULL,
	id_source Int NOT NULL,
	author Varchar(255),
	create_on Date,
	last_edited_by Varchar(255),
	last_edited_on Date,
	published_by Varchar(255),
	published_on Date,
	headline Varchar(200),
	slug Varchar(255),
	lead_article Text,
	body_article Text,
	tag Varchar(255),
	flag Enum('row_article', 'edited', 'published', 'deleted'),
	locked Enum('yes','no'),
 Primary Key (id_article)) ENGINE = MyISAM;

Create table article_version (
	id_article_version Int NOT NULL,
	id_article Int NOT NULL,
	edited_by Varchar(255),
	edited_on Datetime,
	headline Varchar(200),
	lead_article Text,
	body_article Text,
 Primary Key (id_article_version)) ENGINE = MyISAM;

Create table author_article (
	id_author_article Int NOT NULL AUTO_INCREMENT,
	id_author Varchar(50) NOT NULL,
	id_article Int NOT NULL,
	process_date Datetime,
 Primary Key (id_author_article,id_author,id_article)) ENGINE = MyISAM;

Create table users_article (
	id_users_article Int NOT NULL AUTO_INCREMENT,
	id_user Varchar(50) NOT NULL,
	id_article Int NOT NULL,
	flag Enum('row_article', 'edited', 'published', 'deleted'),
	process_date Datetime,
 Primary Key (id_users_article,id_user,id_article)) ENGINE = MyISAM;

Create table category (
	id_category Varchar(5) NOT NULL,
	category_name Varchar(255),
 Primary Key (id_category)) ENGINE = MyISAM;

Create table article_category (
	id_article_category Int NOT NULL AUTO_INCREMENT,
	id_category Varchar(5) NOT NULL,
	id_article Int NOT NULL,
 Primary Key (id_article_category,id_category,id_article)) ENGINE = MyISAM;


Alter table author_article add Foreign Key (id_author) references author (id_author) on delete  cascade on update  cascade;
Alter table author add Foreign Key (id_source) references source (id_source) on delete  cascade on update  cascade;
Alter table users add Foreign Key (id_source) references source (id_source) on delete  cascade on update  cascade;
Alter table article add Foreign Key (id_source) references source (id_source) on delete  cascade on update  cascade;
Alter table users_article add Foreign Key (id_user) references users (id_user) on delete  cascade on update  cascade;
Alter table article_version add Foreign Key (id_article) references article (id_article) on delete  cascade on update  cascade;
Alter table author_article add Foreign Key (id_article) references article (id_article) on delete  cascade on update  cascade;
Alter table users_article add Foreign Key (id_article) references article (id_article) on delete  cascade on update  cascade;
Alter table article_category add Foreign Key (id_article) references article (id_article) on delete  cascade on update  cascade;
Alter table article_category add Foreign Key (id_category) references category (id_category) on delete  cascade on update  cascade;


/* Users permissions */



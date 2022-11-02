CREATE TABLE tx_baaraftonbladet_domain_model_nyheter (
	title varchar(255) NOT NULL DEFAULT '',
	text text NOT NULL DEFAULT '',
	author varchar(255) NOT NULL DEFAULT '',
	date varchar(255) NOT NULL DEFAULT '',
	tags int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_baaraftonbladet_domain_model_tag (
	nyheter int(11) unsigned DEFAULT '0' NOT NULL,
	text varchar(255) NOT NULL DEFAULT ''
);

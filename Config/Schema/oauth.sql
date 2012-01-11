SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `oauth2_auth_codes` (
  `code` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `redirect_uri` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL,
  `scope` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `oauth2_clients` (
  `client_id` varchar(32) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `redirect_uri` varchar(255) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `oauth2_access_tokens` (
  `oauth_token` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL,
  `scope` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`oauth_token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `oauth2_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL,
  `scope` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

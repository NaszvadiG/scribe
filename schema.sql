--
-- Table structure for table `sc_comments`
--

CREATE TABLE IF NOT EXISTS `sc_comments` (
  `id` int(9) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `url` varchar(200) default NULL,
  `body` longtext NOT NULL,
  `date` datetime NOT NULL,
  `is_approved`	bool NOT NULL default 0,
  `ip` varchar(100),
  `post_id` int(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sc_posts`
--

CREATE TABLE IF NOT EXISTS `sc_posts` (
  `id` int(9) NOT NULL auto_increment,
  `title` text default NULL,
  `body` longtext NOT NULL,
  `date` datetime NOT NULL,
  `author` varchar(200) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `post_status` enum('draft','publish') NOT NULL default 'draft',
  `post_type` enum('post','page') NOT NULL default 'post',
  `comment_status` enum('on','off') NOT NULL default 'off',
  `comment_count` int(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sc_users`
--

CREATE TABLE IF NOT EXISTS `sc_users` (
  `id` int(9) NOT NULL auto_increment,
  `username` varchar(200) NOT NULL,
  `lastname` varchar(250),
  `firstname` varchar(250),
  `password` varchar(250) NOT NULL,
  `email` varchar(200) default NULL,
  `role` enum('administrator','writer') NOT NULL default 'writer',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sc_tags`
--

CREATE TABLE IF NOT EXISTS `sc_tags` (
  `id` int(9) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sc_post2tag`
--

CREATE TABLE IF NOT EXISTS `sc_post2tag` (
  `postid` int(9) NOT NULL,
  `tagid` int(9) NOT NULL,
  PRIMARY KEY  (`postid`,`tagid`),
  KEY `postid` (`postid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
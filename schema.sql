--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(9) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `url` varchar(200) default NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `post_id` int(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(9) NOT NULL auto_increment,
  `title` varchar(250) default NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `author` varchar(200) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `is_live` ENUM('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(9) NOT NULL auto_increment,
  `username` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(9) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post2tag`
--

CREATE TABLE IF NOT EXISTS `post2tag` (
  `postid` int(9) NOT NULL,
  `tagid` int(9) NOT NULL,
  PRIMARY KEY  (`postid`,`tagid`),
  KEY `postid` (`postid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
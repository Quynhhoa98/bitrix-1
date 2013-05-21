CREATE TABLE IF NOT EXISTS `b_cs_property_types` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `SECTION_ID` int(10) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `SORT` int(10) NOT NULL,
  `ACTIVE` varchar(255) NOT NULL,
  `PARAM` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `b_cs_properties` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `PROPERTY_TYPE` int(10) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `SORT` int(10) NOT NULL,
  `ACTIVE` varchar(255) NOT NULL,
  `PARAM` varchar(255) NOT NULL,
  `ELEMENT_ID` int(10) NOT NULL,
  `GROUP_ID` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `b_cs_property_values` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ELEMENT_ID` int(10) NOT NULL,
  `PROPERTY_ID` int(10) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM ;
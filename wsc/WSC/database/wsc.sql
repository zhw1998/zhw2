/*
Navicat MySQL Data Transfer

Source Server         : 1
Source Server Version : 50610
Source Host           : 127.0.0.1:3306
Source Database       : wsc

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2019-07-25 18:35:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atc_author` varchar(255) NOT NULL,
  `atc_title` varchar(255) NOT NULL,
  `atc_time` datetime NOT NULL,
  `atc_content` text NOT NULL,
  `atc_read` int(11) DEFAULT '0',
  `atc_zan` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `atc_author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('16', '张三', 'sdfg', '2019-06-05 10:36:56', '<p>啥地方噶大概分</p>', '48', '40', '1', '2');
INSERT INTO `article` VALUES ('25', '张三', '是打发时光和', '2019-06-06 10:41:47', '<p>ad放四个鼎折覆餗</p>', '0', '0', '0', '2');
INSERT INTO `article` VALUES ('26', '邹鸿威', '面试技巧', '2019-06-08 09:28:01', '<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">对于很多应聘者来说，成功找到一份心仪的工作，无疑是给个人职业生涯增添不少光辉。成功的人，都是有所准备的人，其实所谓的捷径，只不过是人家比你准备得更充分。下面，我收集一些有用的面试技巧，希望对大家有所帮助。</span></p><p><img class=\"normal\" width=\"500px\" src=\"https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=3073517359,2904824308&fm=173&app=25&f=JPEG?w=500&h=607&s=EA82FE0B7E937FF91AE57DC7010010B2\"/><span class=\"bjh-image-caption\" style=\"font-size: 13px; color: rgb(153, 153, 153); display: block; margin-top: 11px; text-align: center;\">男性面试穿着</span></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">1.你是不是具备这份工作所必须的技能？做好这份工作你是不是具备必要的思维方式和职业动机？你是不是与所面试的单位有吻合的企业文化？这是大多数面试官都比较关心的问题，所以面试前必须先要问问自己这三个问题。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\"></span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\"></span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\"></span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\"></span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">2.你想给面试官留下什么样的印象？</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">3.尽可能清楚和了解所面试单位的一切，尽量用对方的用词风格，来为自己量身定做一套面试答案，包括公司的、客户的以及自己想要应聘的岗位。</span></p><p><img class=\"normal\" width=\"363px\" src=\"https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=1463940571,2107677099&fm=173&app=25&f=JPEG?w=363&h=219&s=0A82ED0240C9F6B81A39C9D6030050B2\"/><span class=\"bjh-image-caption\" style=\"font-size: 13px; color: rgb(153, 153, 153); display: block; margin-top: 11px; text-align: center;\">面试穿着打扮</span></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">4.面试前，先尝试对所要被问到的问题和答案进行一次预演，做到心底有数，有助于缓解心理压力。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">5.要知道怎么回答棘手的问题，这是观察你在有所压力情况下的个人表现，应付这种问题最好就是做好准备，冷静梳理好思路并尽量从容应答。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">6.面试前要检查手机是不是已经关机，以确保自己在面试时专心一致，不至于分心。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">7.面试临近时，要练习如何放松自己，比如放慢语速，深呼吸保持冷静，因为越放松就会觉得越舒适自然，也会表现得更有自信。</span></p><p><img class=\"normal\" width=\"450px\" src=\"https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=2447184251,4274062578&fm=173&app=25&f=JPEG?w=450&h=300&s=B528C1B14A2318847BB528B103004093\"/></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">8.为了表现自己做事正规周全细致，面前时要多准备几份简历，因为面临考官可能不只是一个人。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">9.握手有力、面带微笑，有助于迅速建立良好的形象。<span class=\"bjh-br\"></span></span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">10.开始面试时，认真聆听而且让考官知道你在听他直接或间接提供的信息，这是一个不错的交流技巧。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">11.留心你自己的身体语言，尽量表现得有活力，对面试官全神贯注，用眼神交流，在无声的交流中，你会展现出对对方的兴趣。</span></p><p><img class=\"normal\" width=\"300px\" src=\"https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=1470412389,1792912793&fm=173&app=25&f=JPEG?w=300&h=300&s=0F20F90260E8F3BD539509DA0300B0B1\"/><span class=\"bjh-image-caption\" style=\"font-size: 13px; color: rgb(153, 153, 153); display: block; margin-top: 11px; text-align: center;\">面试穿着打扮</span></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">12.最初印象和最终印象。最初和最后的五分钟是面试中最关键的，这段时间决定了你的最初印象和临别印象以及主考人员是不是欣赏你，最初五分钟应当主动交流，离开时，要确定你已经被记住了。<span class=\"bjh-br\"></span></span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">13.完整地填写好公司的表格，即使你带了简历，很多公司都会要求你填写一张表，你愿意并且有始有终的填写完这张表，会传达出你做事正规，善始善终的信息。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">14.谨记每次面试的目标都是获聘，你必须突出地表现出自己的性格和专业能力以获得聘请，面试接近尾声时，要确保你知道下一步怎么办，以及面试单位什么时候会做决定。</span></p><p><img class=\"normal\" width=\"537px\" src=\"https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=1182135249,3327458075&fm=173&app=25&f=JPEG?w=537&h=300&s=F592433BA4E06F1507A0F8D70100C0A3\"/><span class=\"bjh-image-caption\" style=\"font-size: 13px; color: rgb(153, 153, 153); display: block; margin-top: 11px; text-align: center;\">面试技巧</span></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">15.清楚面试单位的需求，表现自己对公司的价值，展示你对适应环境的能力。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">16.要让人产生好感，富于热情。因为公司都喜欢平易近人性格的人，要正规稳重，表现出自己的精力和兴趣。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">17.要确保你有适当的技能，知道你的优势。你怎么用自己的学历经验，受过的培训和薪酬和别人比较。谈一些你知道怎么做得出色的事情，那是你找一份工作的关键。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">18.展示你勤奋工作追求团队目标的能力，很多主考官都希望公司能找到一位有创造力，性格良好，能够融入公司团队之中的人。</span></p><p><img class=\"normal\" width=\"439px\" src=\"https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=154561713,1797706823&fm=173&app=25&f=JPEG?w=439&h=300&s=17387984038F06F4D8C8F1060300C0C2\"/><span class=\"bjh-image-caption\" style=\"font-size: 13px; color: rgb(153, 153, 153); display: block; margin-top: 11px; text-align: center;\">面试站姿</span></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">19.将你所有的优势推销出去，营销自己十分重要，包括你的技术资格，一般能力和性格优势。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">20.面试时不要抢话、插话、争辩。<span class=\"bjh-br\"></span></span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">21.不要太自大。要在面试中取胜，态度举足轻重。自信、专业和谦虚，三者要保持平衡和协调。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">22.与其描述自己是一个全能型人才，不如凸显自己在某一方面的特长和突出能力。</span></p><p><img class=\"normal\" width=\"377px\" src=\"https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=1760450323,176427637&fm=173&app=25&f=JPEG?w=377&h=300&s=741E703352A176B817A064D70100C0E3\"/><span class=\"bjh-image-caption\" style=\"font-size: 13px; color: rgb(153, 153, 153); display: block; margin-top: 11px; text-align: center;\">面试着装礼仪</span></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">23.不要太套近乎。面试是正规的职业交谈，亲疏关系取决于面试官的态度，面试中回答和询问问题时，有精力和热情没错，但要记住，你现在是在找工作。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">24.给出有针对性的回答和具体的结果。说出自己的业绩时，不要忘记举出更有说服力的例子来证明。告诉对方当时的实际情况，你所用的方法以及实施后产生的结果，一定要有针对性。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">25.不要害怕承认过去的错误。但要坚持主动强调你的长处，以及如何将不足变为优势。</span></p><p><img class=\"normal\" width=\"526px\" src=\"https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=4169821291,1436476442&fm=173&app=25&f=JPEG?w=526&h=300&s=6280DD0854E8FAB0188D81C60300A0B1\"/></p><p style=\"margin-top: 26px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">26.可以说说你过去与业绩相关的故事，过去的业绩是你将来业绩最好的简述。要准备好将个人独特之处和特点推销出去。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">27.不要在面试过程中掩盖和伪装自己，一旦让面试官知道你是一位不诚实的人，你所获得的这份工作的可能性将会瞬间失去。</span></p><p style=\"margin-top: 22px; margin-bottom: 0px; padding: 0px; line-height: 24px; color: rgb(51, 51, 51); text-align: justify; font-family: arial; white-space: normal; background-color: rgb(255, 255, 255);\"><span class=\"bjh-p\">28.最重要的提醒，不要准备到达，一定要提前早到。尽可能提早到达面临地点。包括预先给可能发生的意外留足时间。</span></p><p><img class=\"normal\" width=\"376px\" src=\"https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=2175324472,1876162722&fm=173&app=25&f=JPEG?w=376&h=291&s=3034C33146676F1D529D18C70300E0B2\"/></p><p><br/></p>', '50', '4', '1', '11');
INSERT INTO `article` VALUES ('27', '小乔', '大', '2019-06-10 11:38:56', '<p>发达</p>', '0', '0', '1', '18');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `cm_content` text NOT NULL,
  `cm_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('5', '2', '16', '<p>大萨达</p>', '2019-06-07 11:42:15');
INSERT INTO `comments` VALUES ('6', '2', '16', '<p>鼎折覆餗</p>', '2019-06-07 11:42:21');
INSERT INTO `comments` VALUES ('7', '2', '16', '<p>三大师傅滚动</p>', '2019-06-07 11:43:49');
INSERT INTO `comments` VALUES ('8', '2', '16', '<p>是打发时光</p>', '2019-06-08 01:39:01');
INSERT INTO `comments` VALUES ('9', '2', '16', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0002.gif\"/></p>', '2019-06-08 01:39:20');
INSERT INTO `comments` VALUES ('11', '2', '16', '<p>发的</p>', '2019-06-08 01:41:22');
INSERT INTO `comments` VALUES ('12', '2', '16', '<p>是打发时光是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个是打发时光的ad放四个的ad放四个</p>', '2019-06-08 01:42:14');
INSERT INTO `comments` VALUES ('13', '11', '16', '<p>666<img src=\"http://img.baidu.com/hi/jx2/j_0010.gif\"/></p>', '2019-06-08 09:16:17');
INSERT INTO `comments` VALUES ('14', '11', '26', '<p>666<img src=\"http://img.baidu.com/hi/jx2/j_0003.gif\"/></p>', '2019-06-08 09:37:23');

-- ----------------------------
-- Table structure for focus
-- ----------------------------
DROP TABLE IF EXISTS `focus`;
CREATE TABLE `focus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '被关注',
  `focus_id` int(11) NOT NULL COMMENT '关注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of focus
-- ----------------------------
INSERT INTO `focus` VALUES ('12', '11', '2');
INSERT INTO `focus` VALUES ('13', '11', '12');
INSERT INTO `focus` VALUES ('14', '2', '11');

-- ----------------------------
-- Table structure for forwork
-- ----------------------------
DROP TABLE IF EXISTS `forwork`;
CREATE TABLE `forwork` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forwork
-- ----------------------------
INSERT INTO `forwork` VALUES ('1', '11', '4', '2019-06-10');
INSERT INTO `forwork` VALUES ('2', '11', '6', '2019-06-10');
INSERT INTO `forwork` VALUES ('3', '2', '6', '2019-06-10');

-- ----------------------------
-- Table structure for leaveword
-- ----------------------------
DROP TABLE IF EXISTS `leaveword`;
CREATE TABLE `leaveword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '被流言用户',
  `lw_id` int(11) NOT NULL COMMENT '留言用户',
  `content` text,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of leaveword
-- ----------------------------
INSERT INTO `leaveword` VALUES ('2', '2', '2', 'sdasdfg ', '2019-06-09 01:36:28');
INSERT INTO `leaveword` VALUES ('3', '2', '11', '<p>可还好<img src=\"http://img.baidu.com/hi/jx2/j_0002.gif\"/></p>', '2019-06-09 09:25:47');
INSERT INTO `leaveword` VALUES ('5', '11', '11', '<p>最近过的好吗</p>', '2019-06-09 09:50:38');

-- ----------------------------
-- Table structure for study
-- ----------------------------
DROP TABLE IF EXISTS `study`;
CREATE TABLE `study` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `school` varchar(255) NOT NULL,
  `starttime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of study
-- ----------------------------
INSERT INTO `study` VALUES ('3', '11', '华东交通大学理工学院', '2016', '2020', '本科', '软件工程');
INSERT INTO `study` VALUES ('4', '12', '华东交通大学理工学院', '2016', '2020', '本科', '软件工程');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `usercode` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1-在校  2-在职  3-其他',
  `headimg` varchar(255) DEFAULT '/assets/images/user.jpg',
  `about` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', '张三', '123456789', 'd41d8cd98f00b204e9800998ecf8427e', '0', '/assets/images/user.jpg', null, null, null);
INSERT INTO `users` VALUES ('11', '邹鸿威', '1562813192', '5ed5d492b9fcac1bfbad77aabd854b8f', '2', '/assets/uploads/usershead/11/30e20c2d923958b865b6f8894f05e3c2.jpg', '好好做人啊', ' 江西南昌     ', '18397945250 ');
INSERT INTO `users` VALUES ('12', '小胖', '18397945250', '5ed5d492b9fcac1bfbad77aabd854b8f', '1', '/assets/uploads/usershead/12/70206b80a78ee16a04d0721222b9217b.jpg', '好好学习，天天向上', ' 江西南昌  ', ' 18397945250  ');
INSERT INTO `users` VALUES ('18', '小乔', '1562813193', '5ed5d492b9fcac1bfbad77aabd854b8f', '2', '/assets/images/user.jpg', null, null, null);

-- ----------------------------
-- Table structure for work
-- ----------------------------
DROP TABLE IF EXISTS `work`;
CREATE TABLE `work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workname` varchar(255) NOT NULL,
  `workprice` varchar(50) NOT NULL,
  `workadress` varchar(255) NOT NULL,
  `workcontent` varchar(255) NOT NULL,
  `workask` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `workphone` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work
-- ----------------------------
INSERT INTO `work` VALUES ('5', 'java工程师', '8k', '江西南昌', '好好工作', '无', '2019-06-10', '18397945250', '11');
INSERT INTO `work` VALUES ('6', 'python工程师', '10k', '江西南昌', '无', '无', '2019-06-10', '18397945250', '11');
INSERT INTO `work` VALUES ('7', '第三方的收到f', '发达', '方方达', '发到付', '发达', '2019-06-10', '打发', '11');
INSERT INTO `work` VALUES ('8', '大', '是', '的s', '但是', '但是', '2019-06-10', ' 但是', '11');
INSERT INTO `work` VALUES ('9', '第三方的', '讽德诵功', '梵蒂冈', '但是', ' 但是', '2019-06-10', ' 但是', '11');
INSERT INTO `work` VALUES ('10', '第三方的', '讽德诵功', '梵蒂冈', '是d', '订单', '2019-06-10', '但是', '11');

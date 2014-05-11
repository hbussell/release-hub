-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: releases
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Author`
--

DROP TABLE IF EXISTS `Author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Author`
--

LOCK TABLES `Author` WRITE;
/*!40000 ALTER TABLE `Author` DISABLE KEYS */;
/*!40000 ALTER TABLE `Author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Branch`
--

DROP TABLE IF EXISTS `Branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `release_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `published` datetime DEFAULT NULL,
  `revision` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vcsUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ticketUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BC2A1E29166D1F9C` (`project_id`),
  KEY `IDX_BC2A1E29B12A727D` (`release_id`),
  CONSTRAINT `FK_BC2A1E29166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`),
  CONSTRAINT `FK_BC2A1E29B12A727D` FOREIGN KEY (`release_id`) REFERENCES `ReleaseVersion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Branch`
--

LOCK TABLES `Branch` WRITE;
/*!40000 ALTER TABLE `Branch` DISABLE KEYS */;
/*!40000 ALTER TABLE `Branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BranchAuthors`
--

DROP TABLE IF EXISTS `BranchAuthors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BranchAuthors` (
  `branch_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`branch_id`,`author_id`),
  KEY `IDX_FE9DCAEEDCD6CC49` (`branch_id`),
  KEY `IDX_FE9DCAEEF675F31B` (`author_id`),
  CONSTRAINT `FK_FE9DCAEEDCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `Branch` (`id`),
  CONSTRAINT `FK_FE9DCAEEF675F31B` FOREIGN KEY (`author_id`) REFERENCES `Author` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BranchAuthors`
--

LOCK TABLES `BranchAuthors` WRITE;
/*!40000 ALTER TABLE `BranchAuthors` DISABLE KEYS */;
/*!40000 ALTER TABLE `BranchAuthors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BranchTransitions`
--

DROP TABLE IF EXISTS `BranchTransitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BranchTransitions` (
  `branch_id` int(11) NOT NULL,
  `transition_id` int(11) NOT NULL,
  PRIMARY KEY (`branch_id`,`transition_id`),
  KEY `IDX_44EB264DDCD6CC49` (`branch_id`),
  KEY `IDX_44EB264D8BF1A064` (`transition_id`),
  CONSTRAINT `FK_44EB264D8BF1A064` FOREIGN KEY (`transition_id`) REFERENCES `WorkflowTransition` (`id`),
  CONSTRAINT `FK_44EB264DDCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `Branch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BranchTransitions`
--

LOCK TABLES `BranchTransitions` WRITE;
/*!40000 ALTER TABLE `BranchTransitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `BranchTransitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CommandResult`
--

DROP TABLE IF EXISTS `CommandResult`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CommandResult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `release_id` int(11) NOT NULL,
  `output` longtext COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BE28367F8D93D649` (`user`),
  CONSTRAINT `FK_BE28367F8D93D649` FOREIGN KEY (`user`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CommandResult`
--

LOCK TABLES `CommandResult` WRITE;
/*!40000 ALTER TABLE `CommandResult` DISABLE KEYS */;
INSERT INTO `CommandResult` VALUES (1,1,'test feature branches ','check',1,NULL,'STATUS_APPROVED','2014-05-11 13:43:51'),(2,1,'check ticket status ','check',1,NULL,'STATUS_APPROVED','2014-05-11 13:43:51'),(3,1,'extra something ','check',1,NULL,'STATUS_APPROVED','2014-05-11 13:43:51'),(8,1,'/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}','check',1,'Permission denied (publickey).\nfatal: Could not read from remote repository.\n\nPlease make sure you have the correct access rights\nand the repository exists.\nExists on remote::\nBranch does not exist on remote: test\nExists on Local:: * test\nAlready on \'test\'','STATUS_SUCCESSFUL','2014-05-11 13:59:00'),(10,1,'/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}','check',1,'Permission denied (publickey).\nfatal: Could not read from remote repository.\n\nPlease make sure you have the correct access rights\nand the repository exists.\nExists on remote::\nBranch does not exist on remote: test\nExists on Local:: * test\nAlready on \'test\'','STATUS_SUCCESSFUL','2014-05-11 14:01:10'),(12,1,'test feature branches ','check',2,NULL,'STATUS_APPROVED','2014-05-11 17:40:23'),(13,1,'check ticket status ','check',2,NULL,'STATUS_APPROVED','2014-05-11 17:40:23'),(14,1,'/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}','check',1,'Exists on remote::\nBranch does not exist on remote: test\nExists on Local:: * test\nAlready on \'test\'','STATUS_SUCCESSFUL','2014-05-11 17:40:58'),(16,1,'/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}','check',1,'ssh: connect to host github.com port 22: Connection timed out\nfatal: Could not read from remote repository.\n\nPlease make sure you have the correct access rights\nand the repository exists.\nExists on remote::\nBranch does not exist on remote: test\nExists on Local::   test\nSwitched to branch \'test\'','STATUS_SUCCESSFUL','2014-05-11 17:45:11'),(17,1,'/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry','check',1,'Run source: deployments-2.0\nssh: connect to host github.com port 22: Connection timed out\nfatal: Could not read from remote repository.\n\nPlease make sure you have the correct access rights\nand the repository exists.\nExists on remote::   origin/deployments-2.0\nExists on Local::   deployments-2.0\nChecking out source branch ...\nSwitched to branch \'deployments-2.0\'\nYour branch is ahead of \'origin/deployments-2.0\' by 4 commits.\n  (use \"git push\" to publish your local commits)\nchecking out to dest branch : test\nSwitched to branch \'test\'\nmerging source : deployments-2.0\nUpdating 5acec98..e3fea7c\nFast-forward\n test.md | 3 ++-\n 1 file changed, 2 insertions(+), 1 deletion(-)','STATUS_SUCCESSFUL','2014-05-11 17:47:18'),(18,1,'/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}','check',1,'Exists on remote::\nBranch does not exist on remote: test\nExists on Local:: * test\nAlready on \'test\'','STATUS_SUCCESSFUL','2014-05-11 17:47:22'),(19,1,'/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry','check',1,'Run source: deployments-2.0\nExists on remote::   origin/deployments-2.0\nExists on Local::   deployments-2.0\nChecking out source branch ...\nSwitched to branch \'deployments-2.0\'\nYour branch is ahead of \'origin/deployments-2.0\' by 4 commits.\n  (use \"git push\" to publish your local commits)\nchecking out to dest branch : test\nSwitched to branch \'test\'\nmerging source : deployments-2.0\nUpdating 5acec98..e3fea7c\nFast-forward\n test.md | 3 ++-\n 1 file changed, 2 insertions(+), 1 deletion(-)','STATUS_SUCCESSFUL','2014-05-11 17:47:25');
/*!40000 ALTER TABLE `CommandResult` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Project`
--

DROP TABLE IF EXISTS `Project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actions` longtext COLLATE utf8_unicode_ci NOT NULL,
  `gitUrl` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `options` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project`
--

LOCK TABLES `Project` WRITE;
/*!40000 ALTER TABLE `Project` DISABLE KEYS */;
INSERT INTO `Project` VALUES (1,'Alfred','check:\r\n - test feature branches\r\n - check ticket status\r\nrelease:\r\n - create release branch\r\n - merge feature branches\r\n - deploy release branch to test\r\n - sync dbs and files from prod to test\r\n - notifications\r\nregression:\r\n - regression test release  \r\npublish:','git@github.com:fclimited/alfred.git','gitUrl: git@github.com:fclimited/alfred.git\r\nremote: origin\r\nreleaseBranch: \"{{ release }}\"');
/*!40000 ALTER TABLE `Project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReleaseBuild`
--

DROP TABLE IF EXISTS `ReleaseBuild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReleaseBuild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `output` longtext COLLATE utf8_unicode_ci,
  `actions` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `created` datetime NOT NULL,
  `finished` datetime DEFAULT NULL,
  `user` int(11) NOT NULL,
  `releaseVersion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7482C62B47707731` (`releaseVersion`),
  CONSTRAINT `FK_7482C62B47707731` FOREIGN KEY (`releaseVersion`) REFERENCES `ReleaseVersion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReleaseBuild`
--

LOCK TABLES `ReleaseBuild` WRITE;
/*!40000 ALTER TABLE `ReleaseBuild` DISABLE KEYS */;
INSERT INTO `ReleaseBuild` VALUES (1,'STATUS_BUILT','check',NULL,'a:2:{i:0;s:92:\"/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}\";i:1;s:104:\"/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry\";}','2014-05-11 13:44:14','2014-05-11 13:46:04',1,1),(2,'STATUS_BUILT','check',NULL,'a:2:{i:0;s:92:\"/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}\";i:1;s:104:\"/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry\";}','2014-05-11 13:53:08','2014-05-11 13:54:23',1,1),(3,'STATUS_BUILT','check',NULL,'a:2:{i:0;s:92:\"/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}\";i:1;s:104:\"/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry\";}','2014-05-11 13:58:16','2014-05-11 13:59:35',1,1),(4,'STATUS_BUILT','check',NULL,'a:2:{i:0;s:92:\"/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}\";i:1;s:104:\"/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry\";}','2014-05-11 14:00:29','2014-05-11 14:01:45',1,1),(5,'STATUS_BUILT','check',NULL,'a:2:{i:0;s:92:\"/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}\";i:1;s:104:\"/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry\";}','2014-05-11 17:40:41','2014-05-11 17:41:02',1,1),(6,'STATUS_BUILT','check',NULL,'a:2:{i:0;s:92:\"/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}\";i:1;s:104:\"/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry\";}','2014-05-11 17:42:41','2014-05-11 17:47:18',1,1),(7,'STATUS_BUILT','check',NULL,'a:2:{i:0;s:92:\"/var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }}\";i:1;s:104:\"/var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry\";}','2014-05-11 17:42:51','2014-05-11 17:47:25',1,1);
/*!40000 ALTER TABLE `ReleaseBuild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReleaseVersion`
--

DROP TABLE IF EXISTS `ReleaseVersion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ReleaseVersion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `approver_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `published` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dueDate` datetime DEFAULT NULL,
  `branchNames` longtext COLLATE utf8_unicode_ci NOT NULL,
  `actions` longtext COLLATE utf8_unicode_ci NOT NULL,
  `stage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `options` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_8A140FE9BB23766C` (`approver_id`),
  KEY `IDX_8A140FE9166D1F9C` (`project_id`),
  CONSTRAINT `FK_8A140FE9166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`),
  CONSTRAINT `FK_8A140FE9BB23766C` FOREIGN KEY (`approver_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReleaseVersion`
--

LOCK TABLES `ReleaseVersion` WRITE;
/*!40000 ALTER TABLE `ReleaseVersion` DISABLE KEYS */;
INSERT INTO `ReleaseVersion` VALUES (1,1,1,'test','2014-05-04 17:38:33',NULL,'STATUS_PENDING',NULL,'deployments-2.0','check:\r\n - /var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }} \r\n - /var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry:\r\n   - each branch\r\n - test feature branches\r\n - check ticket status\r\n - extra something\r\nrelease:\r\n - create release branch\r\n - merge feature branches\r\n - deploy release branch to test\r\n - sync dbs and files from prod to test\r\n - notifications\r\nregression:\r\n - regression test release  \r\npublish:','','gitUrl: git@github.com:fclimited/alfred.git\r\nremote: origin\r\nreleaseBranch: \"{{ release }}\"'),(2,1,1,'test2','2014-05-04 17:39:13',NULL,'STATUS_PENDING','2014-07-05 02:03:00','drupal-core/feature/DRU-187-locking \ndrupal-core/feature/DRU-1582-window-boards','check:\n - test feature branches\n - check ticket status\nrelease:\n - create release branch\n - merge feature branches\n - deploy release branch to test\n - sync dbs and files from prod to test\n - notifications\nregression:\n - regression test release  \npublish:','','gitUrl: git@github.com:fclimited/alfred.git\r\nremote: origin\r\nreleaseBranch: \"{{ release }}\"');
/*!40000 ALTER TABLE `ReleaseVersion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usernameCanonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailCanonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'tester','tester','tester@gmail.com','','ZZ4BxvRbyWqMhDsHvH469BtT5vO9osrDWKiChMjFZTXNQgSL5HzCsOpfcCvRmMDiPKCmToKL29NDDZTeFwYFYQ==','g1o3zjx9fmokwco0s4co4kcgo04ssok');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserProjects`
--

DROP TABLE IF EXISTS `UserProjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserProjects` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`project_id`),
  KEY `IDX_9191F57DA76ED395` (`user_id`),
  KEY `IDX_9191F57D166D1F9C` (`project_id`),
  CONSTRAINT `FK_9191F57D166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `User` (`id`),
  CONSTRAINT `FK_9191F57DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `Project` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserProjects`
--

LOCK TABLES `UserProjects` WRITE;
/*!40000 ALTER TABLE `UserProjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserProjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WorkflowState`
--

DROP TABLE IF EXISTS `WorkflowState`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WorkflowState` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C996D62A166D1F9C` (`project_id`),
  CONSTRAINT `FK_C996D62A166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WorkflowState`
--

LOCK TABLES `WorkflowState` WRITE;
/*!40000 ALTER TABLE `WorkflowState` DISABLE KEYS */;
/*!40000 ALTER TABLE `WorkflowState` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WorkflowTransition`
--

DROP TABLE IF EXISTS `WorkflowTransition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WorkflowTransition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `toState_id` int(11) DEFAULT NULL,
  `fromState_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_553B272267E821F` (`toState_id`),
  KEY `IDX_553B2722EB85C45` (`fromState_id`),
  KEY `IDX_553B272261220EA6` (`creator_id`),
  KEY `IDX_553B2722DCD6CC49` (`branch_id`),
  CONSTRAINT `FK_553B272261220EA6` FOREIGN KEY (`creator_id`) REFERENCES `User` (`id`),
  CONSTRAINT `FK_553B272267E821F` FOREIGN KEY (`toState_id`) REFERENCES `WorkflowState` (`id`),
  CONSTRAINT `FK_553B2722DCD6CC49` FOREIGN KEY (`branch_id`) REFERENCES `Branch` (`id`),
  CONSTRAINT `FK_553B2722EB85C45` FOREIGN KEY (`fromState_id`) REFERENCES `WorkflowState` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WorkflowTransition`
--

LOCK TABLES `WorkflowTransition` WRITE;
/*!40000 ALTER TABLE `WorkflowTransition` DISABLE KEYS */;
/*!40000 ALTER TABLE `WorkflowTransition` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-11 18:20:05

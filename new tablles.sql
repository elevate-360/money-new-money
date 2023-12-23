CREATE TABLE tblUser (
    userId int primary key AUTO_INCREMENT,
    userFirstName varchar(128) not null,
    userLastName varchar(128) not null,
    userEmail varchar(512) not null,
    userLogin varchar(32) not null,
    userPassword char(128) not null
);
CREATE TABLE tblUserLoginLog (
    logId int primary key AUTO_INCREMENT,
    userId int not null,
    loginTime datetime default CURRENT_TIMESTAMP,
    loginCount int not null default 1,
    ipAddress char(46) not null,
    browserInfo varchar(255) not null,
    operatingSystem varchar(128) not null,
    deviceType varchar(16) not null
);
-- Create the BEFORE INSERT trigger
DELIMITER // CREATE TRIGGER before_user_login BEFORE
INSERT ON tblUserLoginLog FOR EACH ROW BEGIN
DECLARE today DATE;
SET today = DATE(NEW.loginTime);
-- Check if a record already exists for the user on the same day
IF EXISTS (
    SELECT 1
    FROM tblUserLoginLog
    WHERE userId = NEW.userId
        AND DATE(loginTime) = today
) THEN -- If yes, update the loginCount and prevent insertion of a new row
UPDATE tblUserLoginLog
SET loginCount = loginCount + 1,
    loginTime = CURRENT_TIMESTAMP
WHERE userId = NEW.userId
    AND DATE(loginTime) = today;
-- Set NEW to NULL to prevent insertion of a new row
SET NEW = NULL;
END IF;
END;
// DELIMITER;
CREATE TRIGGER `before_user_login` BEFORE
INSERT ON `tblUserLoginLog` FOR EACH ROW
DECLARE today DATE;
SET today = DATE(NEW.loginTime);
IF EXISTS (
    SELECT 1
    FROM tblUserLoginLog
    WHERE userId = NEW.userId
        AND DATE(loginTime) = today
) THEN
UPDATE tblUserLoginLog
SET loginCount = loginCount + 1,
    loginTime = CURRENT_TIMESTAMP
WHERE userId = NEW.userId
    AND DATE(loginTime) = today;
SET NEW = NULL;
END IF
CREATE TABLE tblUser (
    userId int primary key AUTO_INCREMENT,
    userFirstName varchar(128) not null,
    userLastName varchar(128) not null,
    userEmail varchar(512) not null,
    userContactNumber char(10) not null,
    userLogin varchar(32) not null,
    userPassword char(128) not null,
    userProfile varchar(128) not null
);
INSERT INTO tblUser (
        userFirstName,
        userLastName,
        userEmail,
        userContactNumber,
        userLogin,
        userPassword,
        userProfile
    )
VALUES (
        'Jay',
        'Chauhan',
        'jay.chauhan3042@gmail.com',
        '9313440532',
        'Admin@Elevate360',
        '4cd7d90fc9b0b0fd84d681990c06418b8d8d3ad642c45637e5978e9573a48ca47ca4537c280a52c15a1b1088df7fd46a0215f034117db12d69b9e4c0b4cfa0cb',
        'profile-pic.png'
    );
INSERT INTO tblUser (
        userFirstName,
        userLastName,
        userEmail,
        userContactNumber,
        userLogin,
        userPassword,
        userProfile
    )
VALUES (
        'Harshil',
        'Limbachiya',
        'harshillimbachiy3@gmail.com',
        '7043106017',
        'Harshil@Elevate360',
        'd6cf591f5e2053a7d526a9beb48569c9105f4100b682bde42739c5a78577cb3c995ea0034eb1b4f0eb66f5ab83cf81fd0e7eb7a0d5a14454f4a6d38849dfc4ef',
        'user3-128x128.png'
    );
CREATE TABLE tblTransection (
    traId int primary key AUTO_INCREMENT,
    traTitle varchar(128) not null,
    traEntity varchar(128) not null,
    traAmount decimal(12, 2) not null,
    traType char(1) not null,
    traMethod char(1) not null,
    traUserId int not null,
    traDate datetime not null default CURRENT_TIMESTAMP,
    FOREIGN KEY (traUserId) REFERENCES tblUser(userId)
);
INSERT INTO tblTransection (
        traTitle,
        traEntity,
        traAmount,
        traType,
        traMethod,
        traUserId,
        traDate
    )
VALUES (
        'Balance Added For Initial Expances',
        'UPI Account',
        '7687.82',
        '1',
        '1',
        1,
        '2023-12-03 00:00:00'
    );
INSERT INTO tblTransection (
        traTitle,
        traEntity,
        traAmount,
        traType,
        traMethod,
        traUserId,
        traDate
    )
VALUES (
        'Domain Purchase "elevate360.in"',
        'Godaddy',
        '1650.82',
        '0',
        '1',
        1,
        '2023-12-03 12:30:00'
    );
INSERT INTO tblTransection (
        traTitle,
        traEntity,
        traAmount,
        traType,
        traMethod,
        traUserId,
        traDate
    )
VALUES (
        'React Template Purchase',
        'Mentis MUI Store',
        '6037.00',
        '0',
        '1',
        1,
        '2023-12-03 17:23:00'
    );
CREATE TABLE tblUserLoginLog (
    logId int primary key AUTO_INCREMENT,
    userId int not null,
    loginTime datetime default CURRENT_TIMESTAMP,
    loginCount int not null default 1,
    ipAddress char(46) not null,
    browserInfo varchar(255) not null,
    operatingSystem varchar(128) not null,
    deviceType varchar(16) not null,
    FOREIGN KEY (userId) REFERENCES tblUser(userId)
);
-- -- Create the BEFORE INSERT trigger
-- DELIMITER // CREATE TRIGGER before_user_login BEFORE
-- INSERT ON tblUserLoginLog FOR EACH ROW BEGIN
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
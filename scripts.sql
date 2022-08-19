CREATE TABLE Applies
(
	AppID INT NOT NULL PRIMARY KEY, 
    UserEmail NVARCHAR(50) NOT NULL, 
    ApplicationJobID INT NOT NULL, 
    CONSTRAINT FK_Applies_ToTable FOREIGN KEY (UserEmail) REFERENCES UserInfo(Email), 
    CONSTRAINT AppliesToJob FOREIGN KEY (ApplicationJobID) REFERENCES JobPost(JobID), 
    CONSTRAINT ApplyToAppID FOREIGN KEY (AppID) REFERENCES AppInfo(AppID) 
);

CREATE TABLE Benefits
(
	BenefitID INT NOT NULL PRIMARY KEY, 
    Title NVARCHAR(50) NULL, 
    TimeStamp NCHAR(10) NULL
);

CREATE TABLE Employer
(
	CompanyID INT NOT NULL PRIMARY KEY, 
    Company_Name NVARCHAR(50) NULL, 
    Company_Address NVARCHAR(50) NULL, 
    Company_PNum NVARCHAR(50) NULL, 
    Company_Email NVARCHAR(50) NULL 
);

CREATE TABLE EmployerPost
(
	EPostID INT NOT NULL PRIMARY KEY, 
    ContactDetail NCHAR(10) NULL, 
    TimeStamp TIMESTAMP NULL
);

CREATE TABLE JobBenefits
(
	JobID INT NOT NULL PRIMARY KEY, 
    BenefitID INT NULL, 
    CONSTRAINT FK_JobBenefits_ToJobPost FOREIGN KEY (JobID) REFERENCES JobPost(JobID), 
    CONSTRAINT FK_JobBenefits_ToBenefits FOREIGN KEY (BenefitID) REFERENCES Benefits(BenefitID)
);

CREATE TABLE JobPost
(
	JobID INT NOT NULL PRIMARY KEY, 
    Job_Type NVARCHAR(50) NULL, 
    Title NVARCHAR(50) NOT NULL, 
    Date_Posted DATE NULL, 
    Deadline DATE NULL, 
    Qualifications NVARCHAR(5000) NULL, 
    Responsibilities NVARCHAR(5000) NULL, 
    SalaryRangeID INT NULL 
);

CREATE TABLE JobRequirements
(
    JobID INT NOT NULL PRIMARY KEY,
    ReqID INT NULL,
    CONSTRAINT FK_JobRequirements_ToJobPost FOREIGN KEY (JobID) REFERENCES JobPost(JobID),
    CONSTRAINT FK_JobRequirements_ToRequirements FOREIGN KEY (ReqID) REFERENCES Requirements(ReqID)
);

CREATE TABLE Address
(
	AddressID INT NOT NULL PRIMARY KEY, 
    ZipCode INT NULL, 
    CompanyID INT NULL, 
    CONSTRAINT ZipC FOREIGN KEY (ZipCode) REFERENCES ZipCode(ZipCode), 
    CONSTRAINT CompanyAddress FOREIGN KEY (CompanyID) REFERENCES Employer(CompanyID)
);

CREATE TABLE AppInfo
(
	AppID INT NOT NULL PRIMARY KEY, 
    TimeStamp TIMESTAMP NULL, 
    Status NVARCHAR(50) NULL, 
    CONSTRAINT FK_Application_ToTable FOREIGN KEY (AppID) REFERENCES Applies(AppID)
);

CREATE TABLE Salary
(
	SalaryRangeID INT NOT NULL PRIMARY KEY, 
    Range NVARCHAR(50) NOT NULL, 
    TimeStamp TIMESTAMP NULL, 
    CONSTRAINT FK_Salary_ToTable FOREIGN KEY (SalaryRangeID) REFERENCES JobPost(SalaryRangeID) 
);

CREATE TABLE UserInfo
(
	Email NVARCHAR(50) NOT NULL PRIMARY KEY, 
    FName NVARCHAR(50) NULL, 
    LName NVARCHAR(50) NULL, 
    Pnum INT NULL, 
    LoginPassword NVARCHAR(50) NOT NULL
);

CREATE TABLE UserEmployer
(
	UserEmail NVARCHAR(50) NOT NULL PRIMARY KEY, 
    CompanyID INT NOT NULL, 
    RoleID INT NOT NULL, 
    CONSTRAINT UserIsEmployer FOREIGN KEY (UserEmail) REFERENCES UserInfo(Email), 
    CONSTRAINT UserToRole FOREIGN KEY (RoleID) REFERENCES Role(RoleID), 
    CONSTRAINT CompanyEmployer FOREIGN KEY (CompanyID) REFERENCES Employer(CompanyID)
);

CREATE TABLE ZipCode
(
	ZipCode INT NOT NULL PRIMARY KEY, 
    City NVARCHAR(50) NOT NULL, 
    State NVARCHAR(50) NOT NULL, 
    TimeStamp NVARCHAR(50) NOT NULL, 
    Street NVARCHAR(50) NOT NULL
);

CREATE TABLE Posts
(
	CompanyID INT NOT NULL PRIMARY KEY, 
    EPostID INT NOT NULL, 
    JobID INT NULL, 
    CONSTRAINT FK_Posts_ToJobPost FOREIGN KEY (JobID) REFERENCES JobPost(JobID), 
    CONSTRAINT FK_Posts_ToEmployerPost FOREIGN KEY (EPostID) REFERENCES EmployerPost(EPostID), 
    CONSTRAINT FK_Posts_ToEmployer FOREIGN KEY (CompanyID) REFERENCES Employer(CompanyID) 
);

CREATE TABLE Requirements
(
	ReqID INT NOT NULL PRIMARY KEY
);

CREATE TABLE Role
(
	RoleID INT NOT NULL PRIMARY KEY, 
    Title NVARCHAR(50) NULL, 
    TimeStamp TIMESTAMP NULL
);

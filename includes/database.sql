DROP TABLE IF EXISTS user, student, faculty, course_catalog, enrollment, applicant, application, recommendation, form1, alumni;
-- User Roles: 0-systadmin, 1-instructor, 2-reviewer, 3-advisor, 4-gradsec, 5-student, 6-alumni, 7-applicant, 8-CAC --
  -- Are listed in descending permission levels --

CREATE TABLE user (
  username TINYTEXT,
  pwd TINYTEXT,
  user_role INT,
  user_id INT(8) ZEROFILL,
  PRIMARY KEY (user_id)
);

CREATE TABLE student (
  user_id INT(8) ZEROFILL,
  program INT(1),
  thesis INT(1),
  app_to_grad INT(1),
  form1 INT,
  adv_id INT(8) ZEROFILL,
  fname TINYTEXT,
  lname TINYTEXT,
  email TINYTEXT,
  street TINYTEXT,
  city TINYTEXT,
  state TINYTEXT,
  country TINYTEXT,
  ssn TINYTEXT,
  adv_form INT(1),
  reg_hold INT(1),
  PRIMARY KEY (user_id)
);

CREATE TABLE faculty (
  user_id INT(8) ZEROFILL,
  primary_role INT,
  secondary_role INT,
  third_role INT,
  fname TINYTEXT,
  lname TINYTEXT,
  email TINYTEXT,
  street TINYTEXT,
  city TINYTEXT,
  state TINYTEXT,
  country TINYTEXT,

  PRIMARY KEY (user_id)
);

CREATE TABLE alumni (
  user_id int(8) ZEROFILL,
  program int,
  grad_year int(4),
  fname TINYTEXT,
  lname TINYTEXT,
  email TINYTEXT,
  street TINYTEXT,
  city TINYTEXT,
  state TINYTEXT,
  country TINYTEXT,

  primary key(user_id)
);

CREATE TABLE applicant (
  first_name varchar(15) not null,
  last_name varchar(15) not null,
  user_id int,
  app_status varchar(25) not null,
  transcript_received varchar(15) not null default "No",
  rec_received1 varchar(15) not null default "No",
  rec_received2 varchar(15) not null default "No",
  rec_received3 varchar(15) not null default "No",
  decision int default 0,
  app_rec int,
  app_rec_advisor varchar(40),
  app_rec_comment varchar(40),
  app_deficiency_courses varchar(40),
  reason_for_reject varchar(1),
  accept INT(1) default 0,
  primary key(user_id)
);

CREATE TABLE course_catalog (
    courseID int(3) not null,
    course_dept  varchar(20) not null,
    course_num     int(4) not null,
    course_name varchar(50) not null,
    day TINYTEXT,
    startTime     int(4) not null,
    endTime     int(4) not null,
    semester TINYTEXT,
    course_credits     int(1) not null,
    sectionNum	 int(1) not null,
    instructor TINYTEXT,
    instructor_id INT(8) ZEROFILL,
    preq1Dept     varchar(20),
    preq1Num     varchar(20),
    preq2Dept     varchar(20),
    preq2Num     varchar(20)
);

CREATE TABLE enrollment (
  user_id INT(8) ZEROFILL,
  course_num     int(4) not null,
  courseID     int(3) not null,
  course_dept TINYTEXT,
  course_name TINYTEXT,
  startTime     INT(4),
  endTime     INT(4),
  day   TINYTEXT,
  semester TINYTEXT,
  course_credits    INT(4),
  year	   INT(4),
  grade	  TINYTEXT,
  gpa  decimal(3,2)
);

CREATE TABLE application (
  uid int,
  ssn varchar(15),
  street varchar(20),
  city varchar(15),
  state varchar(15),
  zip int,
  email varchar(25),
  app_term varchar(10),
  GRE_verbal int,
  GRE_quantitative int,
  exam_year int,
  GRE_score int,
  GRE_subject varchar(10),
  TOEFL_score int,
  TOEFL_year int,
  bachelor_school varchar(25),
  bachelor_degree varchar(25),
  bachelor_major varchar(25),
  bachelor_year int,
  bachelor_gpa double,
  masters_school varchar(25),
  masters_degree varchar(25),
  masters_major varchar(25),
  masters_year int,
  masters_gpa double,
  area_of_interest varchar(25),
  degree_seeking varchar(25),
  date_received date,
  PRIMARY KEY(uid)
);

CREATE TABLE recommendation (
  rid int auto_increment,
  rec_fname varchar(25),
  rec_lname varchar(25),
  rec_title varchar(25),
  rec_letter varchar(4096),
  rec_rating int,
  rec_generic varchar(1),
  rec_credible varchar(1),
  uid int,
  PRIMARY KEY(rid)
);

CREATE TABLE form1 (
  user_id INT(8) ZEROFILL,
  course_dept TINYTEXT,
  course_id INT(4)
);

DELETE FROM user;
DELETE FROM student;
DELETE FROM faculty;
DELETE FROM course_catalog;
DELETE FROM enrollment;
DELETE FROM applicant;
DELETE FROM application;
DELETE FROM recommendation;
DELETE FROM form1;
DELETE FROM alumni;

INSERT INTO user VALUES ("pmccartney", "go_beatles1", 5, 55555555);
INSERT INTO user VALUES ("gharrison", "password1!", 5, 66666666);
INSERT INTO user VALUES ("bholiday", "password3#", 5, 88888888);
INSERT INTO user VALUES ("dkrall", "password2@", 5, 99999999);
INSERT INTO user VALUES ("efitzgerald", "password4$", 5, 23456789);
INSERT INTO user VALUES ("snicks", "password5%", 5, 12345678);
INSERT INTO user VALUES ("ecassidy", "password6^", 5, 87654321);
INSERT INTO user VALUES ("jhendrix", "password7&", 5, 45678901);
INSERT INTO user VALUES ("bnarahari", "i_l0v3_db", 1, 98765432);
INSERT INTO user VALUES ("hchoi", "choi222", 1, 23442136);
INSERT INTO user VALUES ("aturing", "aturing111", 2, 12344321);
INSERT INTO user VALUES ("twood", "wood222", 2, 19191919);
INSERT INTO user VALUES ("rheller", "heller222", 2, 28282828);
INSERT INTO user VALUES ("gparmer", "gabe_boi", 3, 13371337);
INSERT INTO user VALUES ("jmatthews", "admin123", 0, 00000000);
INSERT INTO user VALUES ("tclancy", "clancy442", 0, 42284007);
INSERT INTO user VALUES ("mshende", "shende122", 4, 34426892);
INSERT INTO user VALUES ("rhendrickson", "jmarine1", 4, 19451945);
INSERT INTO user VALUES ("chair","chair123", 8, 13131313);
INSERT INTO user VALUES ("eclapton", "clapman9", 6, 77777777);
INSERT INTO user VALUES ("akapoor", "tke_man", 6, 34567890);
INSERT INTO user VALUES ("jlennon", "beatles1", 7, 55551111);
INSERT INTO user VALUES ("rstarr", "beatles2", 7, 66661111);
INSERT INTO user VALUES ("larmstrong", "beatles3", 7, 00001234);
INSERT INTO user VALUES ("afranklin", "beatles4", 7, 00001235);
INSERT INTO user VALUES ("csantana", "beatles5", 7, 00001236);


INSERT INTO student(user_id, program, form1, app_to_grad, adv_id, fname, lname, email, street, city, state, country) VALUES (55555555, 1, 1, 0, 98765432, "Paul", "McCartney", "let_it_be@gmail.com", "23 Abbey Road", "London", "England", "UK");
INSERT INTO student(user_id, program, adv_id, fname, lname, email, street, city, state, country) VALUES (66666666, 1, 13371337, "George", "Harrison", "g.harrison@aol.com", "42 Wallaby Way", "Sydney", "Austrailia", "AUS");
INSERT INTO student(user_id, program, form1, adv_id, fname, lname, email, street, city, state, country) VALUES (88888888, 1, 0, 98765432, "Billie", "Holiday", "bholiday@gwu.edu", "42 Wallaby Way", "Sydney", "Austrailia", "AUS");
INSERT INTO student(user_id, program, adv_id, fname, lname, email, street, city, state, country, reg_hold) VALUES (99999999, 1, 13371337, "Diana", "Krall", "dkrall@gwu.edu", "42 Wallaby Way", "Sydney", "Austrailia", "AUS", 1);
INSERT INTO student(user_id, program, adv_id, fname, lname, email, street, city, state, country, reg_hold) VALUES (23456789, 2, 13371337, "Ella", "Fitzgerald", "efitzgerald@gwu.edu", "42 Wallaby Way", "Sydney", "Austrailia", "AUS", 1);
INSERT INTO student(user_id, program, form1, thesis, adv_id, fname, lname, email, street, city, state, country) VALUES (12345678, 2, 1, 0, 98765432, "Stevie", "Nicks", "snicks@gwu.edu", "42 Wallaby Way", "Sydney", "Austrailia", "AUS");
INSERT INTO student(user_id, program, form1, app_to_grad, adv_id, fname, lname, email, street, city, state, country) VALUES (87654321, 1, 1, 0, 13371337, "Eva", "Cassidy", "ecassidy@gwu.edu", "42 Wallaby Way", "Sydney", "Austrailia", "AUS");
INSERT INTO student(user_id, program, form1, app_to_grad, adv_id, fname, lname, email, street, city, state, country) VALUES (45678901, 1, 1, 0, 98765432, "Jimi", "Hendrix", "jhendrix@gwu.edu", "42 Wallaby Way", "Sydney", "Austrailia", "AUS");

INSERT INTO faculty(user_id, primary_role, secondary_role, third_role, fname, lname, email, street, city, state, country) VALUES (98765432, 1, 2, 3, "Bhagi", "Narahari", "narahari@gwu.edu", "1 22nd Street", "Washington", "District of Columbia", "USA");
INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES (23442136, 1, "Hyeong-Ah", "Choi", "hchoi@gwu.edu", "3 21st Street", "Washington", "District of Columbia", "USA");
INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES (12344321, 2, "Alan", "Turing", "aturing@gwu.edu", "12 L St", "Washington", "District of Columbia", "USA");
INSERT INTO faculty(user_id, primary_role, secondary_role, fname, lname, email, street, city, state, country) VALUES (19191919, 2, 1, "Timothy", "Wood", "twood@gwu.edu", "4 21st Street", "Washington", "District of Columbia", "USA");
INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES (28282828, 2, "Rachelle", "Heller", "rheller@gwu.edu", "5 21st Street", "Washington", "District of Columbia", "USA");
INSERT INTO faculty(user_id, primary_role, secondary_role, fname, lname, email, street, city, state, country) VALUES (13371337, 3, 1, "Gabe", "Parmer", "g_parmer@gwu.edu", "2223 H Street", "Washington", "District of Columbia", "USA");

INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES (00000000, 0, "Jake", "Matthews", "jdog2017@aol.com", "7865 5th Avenue", "Washington", "District of Columbia", "USA");
INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES (42284007, 0, "Tom", "Clancy", "tclancy@gwu.edu", "2400 Penn Avenue", "Washington", "District of Columbia", "USA");

INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES (19451945, 4, "Ronald", "Hendrickson", "rhendrickson@gmail.com", "54 Constitution Ave", "Washington", "District of Columbia", "USA");
INSERT INTO faculty(user_id, primary_role, fname, lname, email, street, city, state, country) VALUES (34426892, 4, "Maya", "Shende", "mshende@gwu.edu", "2424 Penn Avenue", "Washington", "District of Columbia", "USA");

INSERT INTO faculty (user_id, primary_role, fname, lname) VALUES (13131313, 8, "Chair", "Committee");

INSERT INTO alumni(user_id, program, grad_year, fname, lname, email, street, city, state, country) VALUES (77777777, 1, 2014, "Eric","Clapton","eric.clapton@gmail.com","1 Retired Street","Jacksonville","Florida","USA");
INSERT INTO alumni(user_id, program, grad_year, fname, lname, email, street, city, state, country) VALUES (34567890, 1, 2000, "Amit","Kapoor","amit@gmail.com","27 F Street SW","Washington","District of Columbia","USA");

INSERT INTO applicant VALUES ("John","Lennon",55551111,"completed","Yes","Yes", "No", "No", 0, NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO applicant VALUES ("Armstrong","Louis",00001234,"completed","Yes","Yes","No","No",3,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO applicant VALUES ("Athena","Franklin",00001235,"completed","Yes","Yes","No","No",2,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO applicant VALUES ("Carlos","Santana",00001236,"completed","Yes","Yes","No","No",1,NULL,NULL,NULL,NULL,NULL,NULL);


INSERT INTO course_catalog VALUES (1, "CSCI", 6221, "SW Paradigms", "M", 1500, 1730, "Spring", 3, 1, "Choi", 23442136, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (2, "CSCI", 6461, "Computer Architecture", "T", 1500, 1730, "Spring", 3, 1, "Narahari", 98765432, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (3, "CSCI", 6212, "Algorithms", "W", 1500, 1730, "Spring", 3, 1, "Choi", 23442136, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (4, "CSCI", 6232, "Networks 1", "M", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (5, "CSCI", 6233, "Networks 2", "T", 1800, 2030, "Spring", 3, 1, "Wood", 19191919, "CSCI", "6232", "None", "None");
INSERT INTO course_catalog VALUES (6, "CSCI", 6241, "Database 1", "W", 1800, 2030, "Spring", 3, 1, "Narahari", 98765432, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (7, "CSCI", 6242, "Database 2", "R", 1800, 2030, "Spring", 3, 1, "Wood", 19191919, "CSCI", "6241", "None", "None");
INSERT INTO course_catalog VALUES (8, "CSCI", 6246, "Compilers", "T", 1500, 1730, "Spring", 3, 1, "Choi", 23442136, "CSCI", "6461", "CSCI", "6212");
INSERT INTO course_catalog VALUES (9, "CSCI", 6251, "Cloud Computing", "M", 1800, 2030, "Spring", 3, 1, "Narahari", 98765432, "CSCI", "6461", "None", "None");
INSERT INTO course_catalog VALUES (10, "CSCI", 6254, "SW Engineering", "M", 1530, 1800, "Spring", 3, 1, "Narahari", 98765432, "CSCI", "6221", "None", "None");
INSERT INTO course_catalog VALUES (11, "CSCI", 6260, "Multimedia", "R", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (12, "CSCI", 6262, "Graphics 1", "W", 1800, 2030, "Spring", 3, 1, "Wood", 19191919, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (13, "CSCI", 6283, "Security 1", "T", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "CSCI", "6212", "None", "None");
INSERT INTO course_catalog VALUES (14, "CSCI", 6284, "Cryptography", "M", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "CSCI", "6212", "None", "None");
INSERT INTO course_catalog VALUES (15, "CSCI", 6286, "Network Security", "W", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "CSCI", "6283", "CSCI", "6232");
INSERT INTO course_catalog VALUES (16, "CSCI", 6384, "Cryptography 2", "W", 1500, 1730, "Spring", 3, 1, "Choi", 23442136, "CSCI", "6284", "None", "None");
INSERT INTO course_catalog VALUES (17, "ECE", 6241, "Comunication Theory", "M", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (18, "ECE", 6242, "Information Theory", "T", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (19, "MATH", 6210, "Logic", "W", 1800, 2030, "Spring", 3, 1, "Choi", 23442136, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (20, "CSCI", 6339, "Embedded Systems", "R", 1600, 1830, "Spring", 3, 1, "Choi", 23442136, "CSCI", "6461", "CSCI", "6212");
INSERT INTO course_catalog VALUES (21, "CSCI", 6220, "Machine Learning", "R", 1600, 1830, "Spring", 3, 1, "Parmer", 13371337, "None", "None", "None", "None");
INSERT INTO course_catalog VALUES (22, "CSCI", 6325, "Algorithms 2", "W", 1800, 2030, "Spring", 3, 1, "Parmer", 13371337, "CSCI", "6212", "None", "None");


INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (88888888, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2019, "IP", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (88888888, 6212, 3, "CSCI", "Algorithms", "Spring", 1500, 1730, "W", 2019, "IP", 3);

INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6221, 1, "CSCI", "SW Paradigms", "Fall", 1500, 1730, "M", 2018, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6212, 3, "CSCI", "Algorithms", "Fall", 1500, 1730, "W", 2018, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2019, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6232, 4, "CSCI", "Networks 1", "Spring", 1800, 2030, "M", 2018, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6233, 5, "CSCI", "Networks 2", "Fall", 1800, 2030, "T", 2019, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6241, 6, "CSCI", "Database 1", "Fall", 1800, 2030, "W", 2017, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6246, 8, "CSCI", "Compilers", "Spring", 1500, 1730, "T", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6262, 12, "CSCI", "Graphics 1", "Spring", 1800, 2030, "W", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6283, 13, "CSCI", "Security 1", "Fall", 1800, 2030, "T", 2017, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (55555555, 6242, 7, "CSCI", "Database 2", "Spring", 1800, 2030, "R", 2018, "B", 3);

INSERT INTO form1 VALUES (55555555, "CSCI", 6221);
INSERT INTO form1 VALUES (55555555, "CSCI", 6461);
INSERT INTO form1 VALUES (55555555, "CSCI", 6212);
INSERT INTO form1 VALUES (55555555, "CSCI", 6232);
INSERT INTO form1 VALUES (55555555, "CSCI", 6233);
INSERT INTO form1 VALUES (55555555, "CSCI", 6241);
INSERT INTO form1 VALUES (55555555, "CSCI", 6242);
INSERT INTO form1 VALUES (55555555, "CSCI", 6246);
INSERT INTO form1 VALUES (55555555, "CSCI", 6262);
INSERT INTO form1 VALUES (55555555, "CSCI", 6283);

INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6242, 18, "ECE", "Information Theory", "Fall", 1800, 2030, "T", 2017, "C", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6221, 1, "CSCI", "SW Paradigms", "Fall", 1500, 1730, "M", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6212, 3, "CSCI", "Algorithms", "Fall", 1500, 1730, "W", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6232, 4, "CSCI", "Networks 1", "Spring", 1800, 2030, "M", 2017, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6233, 5, "CSCI", "Networks 2", "Spring", 1800, 2030, "T", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6241, 6, "CSCI", "Database 1", "Spring", 1800, 2030, "W", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6242, 7, "CSCI", "Database 2", "Spring", 1800, 2030, "R", 2018, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6283, 13, "CSCI", "Security 1", "Fall", 1800, 2030, "T", 2017, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (66666666, 6284, 14, "CSCI", "Cryptography 2", "Spring", 1800, 2030, "M", 2018, "B", 3);

INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6221, 1, "CSCI", "SW Paradigms", "Fall", 1500, 1730, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6212, 3, "CSCI", "Algorithms", "Fall", 1500, 1730, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6232, 4, "CSCI", "Networks 1", "Spring", 1800, 2030, "M", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6233, 5, "CSCI", "Networks 2", "Spring", 1800, 2030, "T", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6284, 14, "CSCI", "Cryptography 2", "Spring", 1800, 2030, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6286, 15, "CSCI", "Network Security", "Fall", 1800, 2030, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6241, 6, "CSCI", "Database 1", "Spring", 1800, 2030, "W", 2013, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6246, 8, "CSCI", "Compilers", "Spring", 1500, 1730, "T", 2013, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (87654321, 6262, 12, "CSCI", "Graphics 1", "Spring", 1800, 2030, "W", 2013, "B", 3);

INSERT INTO form1 VALUES (87654321, "CSCI", 6221);
INSERT INTO form1 VALUES (87654321, "CSCI", 6461);
INSERT INTO form1 VALUES (87654321, "CSCI", 6212);
INSERT INTO form1 VALUES (87654321, "CSCI", 6232);
INSERT INTO form1 VALUES (87654321, "CSCI", 6233);
INSERT INTO form1 VALUES (87654321, "CSCI", 6241);
INSERT INTO form1 VALUES (87654321, "CSCI", 6246);
INSERT INTO form1 VALUES (87654321, "CSCI", 6262);
INSERT INTO form1 VALUES (87654321, "CSCI", 6284);
INSERT INTO form1 VALUES (87654321, "CSCI", 6286);

INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6221, 1, "CSCI", "SW Paradigms", "Fall", 1500, 1730, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6212, 3, "CSCI", "Algorithms", "Fall", 1500, 1730, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6232, 4, "CSCI", "Networks 1", "Spring", 1800, 2030, "M", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6233, 5, "CSCI", "Networks 2", "Spring", 1800, 2030, "T", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6241, 6, "CSCI", "Database 1", "Spring", 1800, 2030, "W", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6284, 14, "CSCI", "Cryptography 2", "Spring", 1800, 2030, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6286, 15, "CSCI", "Network Security", "Fall", 1800, 2030, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6241, 17, "ECE", "Communication Theory", "Fall", 1800, 2030, "M", 2017, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6242, 18, "ECE", "Information Theory", "Fall", 1800, 2030, "T", 2017, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (45678901, 6210, 19, "MATH", "Logic", "Spring", 1800, 2030, "T", 2017, "B", 3);

INSERT INTO form1 VALUES (45678901, "CSCI", 6221);
INSERT INTO form1 VALUES (45678901, "CSCI", 6461);
INSERT INTO form1 VALUES (45678901, "CSCI", 6212);
INSERT INTO form1 VALUES (45678901, "CSCI", 6232);
INSERT INTO form1 VALUES (45678901, "CSCI", 6233);
INSERT INTO form1 VALUES (45678901, "CSCI", 6241);
INSERT INTO form1 VALUES (45678901, "CSCI", 6284);
INSERT INTO form1 VALUES (45678901, "CSCI", 6286);
INSERT INTO form1 VALUES (45678901, "CSCI", 6241);
INSERT INTO form1 VALUES (45678901, "CSCI", 6242);
INSERT INTO form1 VALUES (45678901, "CSCI", 6210);

INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6221, 1, "CSCI", "SW Paradigms", "Fall", 1500, 1730, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6212, 3, "CSCI", "Algorithms", "Fall", 1500, 1730, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6232, 4, "CSCI", "Networks 1", "Spring", 1800, 2030, "M", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6233, 5, "CSCI", "Networks 2", "Spring", 1800, 2030, "T", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6284, 14, "CSCI", "Cryptography 2", "Spring", 1800, 2030, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6286, 15, "CSCI", "Network Security", "Fall", 1800, 2030, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6241, 6, "CSCI", "Database 1", "Spring", 1800, 2030, "W", 2013, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6246, 8, "CSCI", "Compilers", "Spring", 1500, 1730, "T", 2013, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6262, 12, "CSCI", "Graphics 1", "Spring", 1800, 2030, "W", 2013, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6283, 13, "CSCI", "Security 1", "Fall", 1800, 2030, "T", 2017, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (12345678, 6242, 7, "CSCI", "Database 2", "Spring", 1800, 2030, "R", 2018, "B", 3);

INSERT INTO form1 VALUES (12345678, "CSCI", 6221);
INSERT INTO form1 VALUES (12345678, "CSCI", 6461);
INSERT INTO form1 VALUES (12345678, "CSCI", 6212);
INSERT INTO form1 VALUES (12345678, "CSCI", 6232);
INSERT INTO form1 VALUES (12345678, "CSCI", 6233);
INSERT INTO form1 VALUES (12345678, "CSCI", 6241);
INSERT INTO form1 VALUES (12345678, "CSCI", 6242);
INSERT INTO form1 VALUES (12345678, "CSCI", 6246);
INSERT INTO form1 VALUES (12345678, "CSCI", 6262);
INSERT INTO form1 VALUES (12345678, "CSCI", 6283);
INSERT INTO form1 VALUES (12345678, "CSCI", 6284);
INSERT INTO form1 VALUES (12345678, "CSCI", 6286);

INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6221, 1, "CSCI", "SW Paradigms", "Fall", 1500, 1730, "M", 2012, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6212, 3, "CSCI", "Algorithms", "Fall", 1500, 1730, "W", 2012, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2014, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6232, 4, "CSCI", "Networks 1", "Spring", 1800, 2030, "M", 2015, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6233, 5, "CSCI", "Networks 2", "Spring", 1800, 2030, "T", 2013, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6241, 6, "CSCI", "Database 1", "Spring", 1800, 2030, "W", 2013, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6242, 7, "CSCI", "Database 2", "Spring", 1800, 2030, "R", 2015, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6283, 13, "CSCI", "Security 1", "Fall", 1800, 2030, "T", 2014, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6284, 14, "CSCI", "Cryptography 2", "Spring", 1800, 2030, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (77777777, 6286, 15, "CSCI", "Network Security", "Fall", 1800, 2030, "W", 2012, "A", 3);


INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6221, 1, "CSCI", "SW Paradigms", "Fall", 1500, 1730, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6212, 3, "CSCI", "Algorithms", "Fall", 1500, 1730, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6461, 2, "CSCI", "Computer Architecture", "Spring", 1500, 1730, "T", 2014, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6232, 4, "CSCI", "Networks 1", "Spring", 1800, 2030, "M", 2015, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6233, 5, "CSCI", "Networks 2", "Spring", 1800, 2030, "T", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6241, 6, "CSCI", "Database 1", "Spring", 1800, 2030, "W", 2013, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6283, 13, "CSCI", "Security 1", "Fall", 1800, 2030, "T", 2014, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6284, 14, "CSCI", "Cryptography 2", "Spring", 1800, 2030, "M", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6286, 15, "CSCI", "Network Security", "Fall", 1800, 2030, "W", 2012, "A", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6242, 7, "CSCI", "Database 2", "Spring", 1800, 2030, "R", 2015, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6251, 9, "CSCI", "Cloud Computing", "Spring", 1800, 2030, "M", 2016, "B", 3);
INSERT INTO enrollment(user_id, course_num, courseID, course_dept, course_name, semester, startTime, endTime, day, year, grade, course_credits) VALUES (34567890, 6254, 10, "CSCI", "SW Engineering", "Spring", 1530, 1800, "M", 2016, "B", 3);


INSERT INTO application VALUES (55551111,"111111111","123 spring st","new york","NY",10002,"abcde@abcde.com","FALL",180,180,2017,200,"physics",100,2018,"GWU","BS","CS",2019,3.0,NULL,NULL,NULL,NULL,NULL,"CS","MS", NOW());
INSERT INTO application VALUES (00001234,"555111111","123 spring st","new york","NY",10002,"abcde@abcde.com","FALL",180,180,2017,200,"physics",100,2018,"GWU","BS","CS",2019,3.0,NULL,NULL,NULL,NULL,NULL,"CS","MS", '2017-01-01');
INSERT INTO application VALUES (00001235,"666111111","123 spring st","new york","NY",10002,"abcde@abcde.com","FALL",180,180,2017,200,"physics",100,2018,"GWU","BS","CS",2019,3.0,NULL,NULL,NULL,NULL,NULL,"CS","MS", '2017-01-01');
INSERT INTO application VALUES (00001236,"777111111","123 spring st","new york","NY",10002,"abcde@abcde.com","FALL",180,180,2017,200,"physics",100,2018,"GWU","BS","CS",2019,3.0,NULL,NULL,NULL,NULL,NULL,"CS","PHD", '2017-01-01');

INSERT INTO recommendation VALUES (12345,"Tim","Wood","professor","John is a great student",0,NULL,NULL,55551111);

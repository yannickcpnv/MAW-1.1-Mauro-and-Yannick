-- Run this script before using tests

CREATE OR REPLACE USER 'tester_admin'@'localhost' IDENTIFIED BY 'tester_pass';
GRANT EXECUTE, SELECT, INSERT, UPDATE, DELETE, CREATE, ALTER, DROP ON *.* TO 'tester_admin'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

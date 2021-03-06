# MJM-Tax-Services
Senior Project: An application for securely uploading and viewing tax documents for authenticated users.

Current progress: No UI has been implemented beyond basic HTML, as we are focusing on functionality first. Branch 121 is the current branch we are developing, and there is a lot of work that needs done regarding the directory structure (which includes implementing htaccess files and organizing directories for file types (js, css, etc.).

The live server is currently only available on Indiana Wesleyan's campus due to restrictions on port forwarding.

Description: Once completed this application will allow for an admin user to send a registration key, via email, to a specified client. Only the specified client will be able to use the registration key for registration with MJM Tax Services. They registration key can only be used once for registration. As specified in the requirements, a client is only sent a registration key by email from the admin user upon contact with MJM Tax Services. Upon registration, client will be able to upload their tax documents after a secure login. Only other functionality given client is the ability to reset their password. Admin will be able to see every client registered with MJM Tax Services. Each client will have their seperate folder with all tax documents from every year they have been registered. Admin will be able to delete client and edit or delete client files. Both admin and client will be able to view documents that have been uploaded. Admin will be able to view all documents, client will only be able to view their specified document they have uploaded.

Requirements: 
PHP 7.2
MySQL 5.7
Apache2 2.4.29

Setup: The php.ini file needs editing to allow for the desired maximum file upload size. The database schema can be imported to a MySQL server using the schema.sql file in the root. This file should be removed before rolling into production. The root web directory should also be set up to allow htaccess overrides (in the apache2.conf file). 

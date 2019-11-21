This repository contains all of the php and html files required for the Sunlord Microwave internal part number database.

Location:
The Sunlord Microwave database and related files are stored on an internal computer on the Sunlord server, ip address = 10.8.51.46

This virtual computer can be accessed using the VPN and then opening the Windows command prompt and entering 'mstsc'. 

This computer has an xampp stackup installed in c:/xampp.

Part Numbers:
Part numbers consist of 3 parts:

		TYPE-SIZE-NUMBER

		TYPE: Is the pat type using 2 - 4 leeters. Examples "FR" = Ferrite, "MC" = Magnet, Ceramic, "PROJ" = Project.
		SIZE: A 1-2 digit interger related to the general size of the part, for example, "7" = 7mm, "25" = 25mm. This is optional for some TYPEs.
		NUMBER: The next sequenial number available in the database.

MySQL Database:
The mySQL database can be accessed at https://locaclhost/phpmyadmin.

All tables are in database "Sunlord". Tables are organized by part TYPE.

Files: php and html:
All files are located in c:/xampp/htdocs/MyFiles.

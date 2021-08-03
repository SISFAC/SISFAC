@echo off 

if "%OS%" == "Windows_NT" goto WinNT 

:Win9X 
echo Don't be stupid! Win9x don't know Services 
echo Please use mysql_start.bat instead 
goto exit 

:WinNT 
echo Installing Apache2.4 as an Service
C:\xampp\apache\bin\httpd -k install
echo Now we Start Apache2.4 :)
net start Apache2.4
if exist %windir%\my.ini GOTO CopyINI 
if exist c:\my.cnf GOTO CopyCNF 
if not exist %windir%\my.ini GOTO MainNT 
if not exist c:\my.cnf GOTO MainNT 

:CopyINI 
echo Safe the %windir%\my.ini as %windir%\my.ini.old! 
copy %windir%\my.ini /-y %windir%\my.ini.old 
del %windir%\my.ini 
GOTO WinNT 

:CopyCNF 
echo Safe the c:\my.cnf as c:\my.cnf.old! 
copy c:\my.cnf /-y c:\my.cnf.old 
del c:\my.cnf 
GOTO WinNT 

:MainNT 
echo Installing MySQL as an Service 
copy "C:\xampp\mysql\bin\my.ini" /-y %windir%\my.ini
C:\xampp\mysql\bin\mysqld --install mysql --defaults-file="C:\xampp\mysql\bin\my.ini"
echo Try to start the MySQL deamon as service ... 
net start MySQL 

:exit 

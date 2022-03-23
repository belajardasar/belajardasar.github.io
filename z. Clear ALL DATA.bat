@echo OFF
cls
set real_path=%~DP0
:start
set choice=
set /p choice="Clear data? [y/n] : "
if not '%choice%'=='y' exit
php %real_path%index.php googlebase delete_data
pause
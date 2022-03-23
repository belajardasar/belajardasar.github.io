@echo OFF
cls
set real_path=%~DP0
:start
set choice=
set /p choice="Clear Export? [y/n] : "
if not '%choice%'=='y' exit
php %real_path%index.php export delete_export
pause
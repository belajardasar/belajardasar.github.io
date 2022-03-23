@echo OFF
cls
set real_path=%~DP0
:start
type "%real_path%gudang\note\convert.txt"
set choice=
set /p choice="Start Converting? [y/n] : "
if not '%choice%'=='y' exit
php %real_path%index.php import start
pause
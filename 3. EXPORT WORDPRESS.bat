@echo OFF
cls
set real_path=%~DP0
:start
php %real_path%index.php export start wordpress
pause
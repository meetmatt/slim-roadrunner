/bin/sh

/var/www/app/vendor/bin/zen build /var/www/app/src/Container/Container.php "MeetMatt\\SlimRoadRunner\\Container\\CompilerConfig"
/usr/bin/rr serve -dv -c /etc/roadrunner/.rr.yaml
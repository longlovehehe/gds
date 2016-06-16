

#!/bin/sh

gdsScript="gds"
gdsInstall="install"
gdsUninstall="uninstall"

if [ "$1" == "$gdsInstall" ]
then
        if /bin/grep -q "$gdsScript" /etc/crontab
        then
            :
        else
            echo "0 1 * * * root /usr/local/gds/bin/gds -c" >> /etc/crontab
            service crond restart >/dev/null 2>&1
        fi

elif [ "$1" == "$gdsUninstall" ]
then
        if /bin/grep -q "$gdsScript" /etc/crontab
        then
            sed -i '/'"$gdsScript"'/d' /etc/crontab
            service crond restart >/dev/null 2>&1
        fi
fi

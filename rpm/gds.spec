Summary:Data management layer
Name:gds
Version:0.0.0
Release:8
Vendor:JSR server group
License:JSR Inc 2003-2014
Group:Applications/GDS
BuildRoot:/tmp/BUILD/GDS
%description
The gds program manage all kinds of access data

%pre
gdsDIR=/usr/local/gds
gdsBIN=${gdsDIR}/bin
if [ "$1" = "1" ]
then
    #create gds dir
    if [ -d ${gdsDIR} ]
    then
        /bin/rm -rf ${gdsDIR}
        /bin/rm -rf ${gdsBIN}
        /bin/mkdir ${gdsDIR}
        /bin/mkdir ${gdsBIN}
    else
        /bin/mkdir ${gdsDIR}
        /bin/mkdir ${gdsBIN}
    fi

    if [ ! -d /usr/local/asg/www/html ];then
        /bin/mkdir -p  /usr/local/asg/www/html
    fi

elif [ "$1" = "2" ]
then
    #backup gds configs
    if [ -e /usr/local/gds/conf/gds.conf ]; then 
        /bin/cp /usr/local/gds/conf/gds.conf /tmp/gds_bak.conf 
    fi 

    if [ -e $gdsDIR/html/private/config/db.json ]; then
        /bin/cp $gdsDIR/html/private/config/db.json /tmp/db.json_bak
    fi

    if [ -e $gdsDIR/html/private/config/config.ini ]; then
        /bin/cp $gdsDIR/html/private/config/config.ini /tmp/config.ini_bak
    fi

    if [ -e $gdsDIR/html/private/config/system.ini ]; then
        /bin/cp $gdsDIR/html/private/config/system.ini /tmp/system.ini_bak
    fi

    if [ -e $gdsDIR/html/private/config/language.ini ]; then
        /bin/cp $gdsDIR/html/private/config/language.ini /tmp/language.ini_bak
    fi


    #stop gds program
    gdsSta=`ps -e | grep -w gds | grep -v grep`
    if [ -n "$gdsSta" ]
    then
        killall -9 gds >/dev/null 2>&1
    fi

else
    exit 1
fi


%post
gdsDIR=/usr/local/gds
gdsBIN=${gdsDIR}/bin
gdsPATH=${gdsDIR}/db
gdsCONFIGS=${gdsDIR}/conf

pgpassfile="/root/.pgpass"

PSQL1="/usr/bin/psql"
CREATEDB1="/usr/bin/createdb"

PSQL2="/usr/local/pgsql/bin/psql"
CREATEDB2="/usr/local/pgsql/bin/createdb"

if [ -f $PSQL1 ]
then
    PSQL=$PSQL1
    CREATEDB=$CREATEDB1
elif [ -f $PSQL2 ]
then
    PSQL=$PSQL2
    CREATEDB=$CREATEDB2
fi

curMajorVersion=1
curMinorVersion=1

if [ "$1" = "1" ]
then
    # cp pgpass to home dir
    if [ -f /usr/local/gds/conf/.pgpass ]
    then
        /bin/cp /usr/local/gds/conf/.pgpass /root
        /bin/chmod 0600 /root/.pgpass
    fi

    if [ -f ${gdsCONFIGS}/gds.conf ]
    then
        /bin/chown apache:apache ${gdsCONFIGS}/gds.conf 
        /bin/chmod 0600 ${gdsCONFIGS}/gds.conf
    fi

    #create GDSDB
    if [ -x "$PSQL" ] && [ -x "$CREATEDB" ]
    then
        $PSQL -U postgres -c "CREATE USER gdsuser WITH PASSWORD 'gdspasswd';" >/dev/null 2>&1
        $CREATEDB -U postgres -O gdsuser GDSDB >/dev/null 2>&1

        $PSQL -U gdsuser -d GDSDB -q -f $gdsPATH/gds.sql >/dev/null 2>&1
        minorVersion=0
        while [ $minorVersion -lt $curMinorVersion ]
        do
            minorVersion=$((minorVersion+1))
            $PSQL -q -U gdsuser -d GDSDB -f $gdsPATH/gds_1.$minorVersion.sql >/dev/null 2>&1
        done

    fi


    #specified USER:GROUP to apache
    if [ -d /usr/local/gds/html ] 
    then
        chown apache.apache -R /usr/local/gds/html
    fi

    #create soft link /usr/local/asg/www/html/gds->/usr/local/gds/html/www
    if [ ! -d /usr/local/asg/www/html/gds ]
    then
        ln -s /usr/local/gds/html/www /usr/local/asg/www/html/gds
    else
        if [ ! -h /usr/local/asg/www/html/gds ]
        then
            ln -s /usr/local/gds/html/www /usr/local/asg/www/html/gds
        fi  
    fi 

    # delete pgpass
    if [ -f $pgpassfile ]
    then
        /bin/rm -f $pgpassfile
    fi

    # add gds timer task in crontab
    if [ -f "/usr/local/gds/bin/gdsCron.sh" ]
    then
        /bin/sh /usr/local/gds/bin/gdsCron.sh "install"
    fi

elif [ "$1" = "2" ]
then
    # cp pgpass to home dir
    if [ -f /usr/local/gds/conf/.pgpass ]
    then
        /bin/cp /usr/local/gds/conf/.pgpass /root
        /bin/chmod 0600 /root/.pgpass
    fi

    if [ -e /tmp/gds_bak.conf ]
    then
        /bin/mv /tmp/gds_bak.conf ${gdsCONFIGS}/gds.conf
        #/bin/chown apache:apache ${gdsCONFIGS}/gds.conf 
        /bin/chmod 0755 ${gdsCONFIGS}/gds.conf
    fi

    if [ -e /tmp/db.json_bak ]
    then
        /bin/mv /tmp/db.json_bak ${gdsDIR}/html/private/config/db.json      
        /bin/chmod 0755 ${gdsDIR}/html/private/config/db.json
    fi

    if [ -e /tmp/db.json_bak ]
    then
        /bin/mv /tmp/config.ini_bak ${gdsDIR}/html/private/config/config.ini
        /bin/chmod 0755 ${gdsDIR}/html/private/config/config.ini
    fi

    if [ -e /tmp/system.ini_bak ]
    then
        /bin/mv /tmp/system.ini_bak ${gdsDIR}/html/private/config/system.ini
        /bin/chmod 0755 ${gdsDIR}/html/private/config/system.ini
    fi

    if [ -e /tmp/language.ini_bak ]
    then
        /bin/mv /tmp/language.ini_bak ${gdsDIR}/html/private/config/language.ini
        /bin/chmod 0755 ${gdsDIR}/html/private/config/language.ini
    fi

    #create GDSDB
    if [ -x "$PSQL" ]  && [ -x "$CREATEDB" ]
    then 
        #close current connection
        $PSQL -U postgres -t -c "select pg_terminate_backend(pid) from pg_stat_activity where state='<idle>';" >/dev/null 2>&1
        dbrole=`$PSQL -U postgres -t -c "select rolname from pg_roles" | /bin/grep 'gdsuser'`
        if [ -z "$dbrole" ]
        then 
            $PSQL -U postgres -c "CREATE USER gdsuser WITH PASSWORD 'gdspasswd';" >/dev/null 2>&1
        fi
        dbname=`$PSQL -U postgres -l -t | /bin/awk '{print $1}' | /bin/grep 'GDSDB'`
        if [ -z "$dbname" ]
        then
            $CREATEDB -U postgres -O gdsuser GDSDB >/dev/null 2>&1
            $PSQL -U gdsuser -d GDSDB -q -f $gdsPATH/gds.sql >/dev/null 2>&1
        else
            opmdt=`$PSQL -U postgres -d GDSDB -t -c "\d" | /bin/cut -d '|' -f2 | /bin/grep 'T_*'`
            if [ -z "$opmdt" ]
            then 
                $PSQL -U gdsuser -d GDSDB -q -f $gdsPATH/gds.sql >/dev/null 2>&1
            fi
            fullVersion=`$PSQL -t -q -U gdsuser -d GDSDB -c "select v_version from \"T_Version\" where v_id=0;" 2>&1`
            if [ -n "$fullVersion" ]; then
                majorVersion=`echo $fullVersion|cut -d. -f1`
                minorVersion=`echo $fullVersion|cut -d. -f2`
                while [ $minorVersion -lt $curMinorVersion ]
                do
                    minorVersion=$((minorVersion+1))
                    $PSQL -q -U gdsuser -d GDSDB -f $gdsPATH/dbm_1.$minorVersion.sql >/dev/null 2>&1
                done
            fi
        fi
    fi

    #specified USER:GROUP to apache
    if [ -d /usr/local/gds/html ] 
    then
        chown apache.apache -R /usr/local/gds/html
    fi

    #create soft link /usr/local/asg/www/html/gds->/usr/local/gds/html/www
    if [ ! -d /usr/local/asg/www/html/gds ]
    then
        ln -s /usr/local/gds/html/www /usr/local/asg/www/html/gds
    else
        if [ ! -h /usr/local/asg/www/html/gds ]
        then
            ln -s /usr/local/gds/html/www /usr/local/asg/www/html/gds
        fi  
    fi 

    # delete pgpass
    if [ -f $pgpassfile ]
    then
        /bin/rm -f $pgpassfile
    fi
    
    # add gds timer task in crontab
    if [ -f "/usr/local/gds/bin/gdsCron.sh" ]
    then
        /bin/sh /usr/local/gds/bin/gdsCron.sh "install"
    fi

    echo "upgrade successful"
else
    exit 1
fi

%preun
gdsDIR=/usr/local/dbm
gdsBIN=${gdsDIR}/bin
if  [ "$1" = "0" ]
then
    #stop gds program
    gdsSta=`ps -e | grep -w gds | grep -v grep`
    if [ -n "$gdsSta" ]
    then
        killall -9 gds >/dev/null 2>&1
    fi

    # delete gds timer task in crontab
    if [ -f "/usr/local/gds/bin/gdsCron.sh" ]
    then
        /bin/sh /usr/local/gds/bin/gdsCron.sh "uninstall"
    fi

elif [ "$1" = "1" ]
then
    :
else
    exit 1
fi

%postun
gdsDIR=/usr/local/gds

PSQL1="/usr/bin/psql"
DROPDB1="/usr/bin/dropdb"
DROPUSER1="/usr/bin/dropuser"

PSQL2="/usr/local/pgsql/bin/psql"
DROPDB2="/usr/local/pgsql/bin/dropdb"
DROPUSER2="/usr/local/pgsql/bin/dropuser"

if [ -f $PSQL1 ]
then 
    PSQL=$PSQL1 
    DROPDB=$DROPDB1
    DROPUSER=$DROPUSER1
elif [ -f $PSQL2 ]
then
    PSQL=$PSQL2 
    DROPDB=$DROPDB2
    DROPUSER=$DROPUSER2
fi

if [ "$1" = "0" ]
then

    # delete install dir
    /bin/rm -rf ${gdsDIR}
   
    #delete log file
    rm -f /var/log/gds.log

    #close current connection
    $PSQL -U postgres -t -c "select pg_terminate_backend(pid) from pg_stat_activity where pid <> pg_backend_pid();" >/dev/null 2>&1
    
    # delete gds database and user
    if [ -x "$PSQL" ] && [ -x "$DROPDB" ]
    then
        dbname=`$PSQL -U postgres -l -t | /bin/awk '{print $1}' | /bin/grep 'GDSDB'`
        if [ ! -z $dbname ]
        then 
            $DROPDB -U postgres "GDSDB"
        fi
    fi

    if [ -x "$PSQL" ] && [ -x "$DROPUSER" ]
    then
        dbusername=`$PSQL -U postgres -t -c '\du' | /bin/awk '{print $1}' | /bin/grep 'gdsuser'`
        if [ ! -z $dbusername ]
        then
            $DROPUSER -U postgres gdsuser
        fi
    fi


elif [ "$1" = "1" ]
then
    :
else
    exit 1
fi


%files
%defattr (-,root,root)
/usr/local/gds/bin/
/usr/local/gds/conf/gds.conf
/usr/local/gds/conf/.pgpass
/usr/local/gds/db/
/usr/local/gds/html/
/usr/local/gds/modules

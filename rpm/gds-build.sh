#!/bin/sh

packageDir="/tmp/BUILD/GDS"
rootDir="/root"

gdsBase="/usr/local/gds"

binPath="$gdsBase/bin"
dbPath="$gdsBase/db"
confPath="$gdsBase/conf"
webPath="$gdsBase/html"
modulesPath="$gdsBase/modules"

#
# prepare install path
#
function prepare_dir()
{
    #clean up
    rm -rf $packageDir &>/dev/null 

    #create directory ready for package
    mkdir -p $packageDir
    mkdir -p $packageDir$gdsBase
    mkdir -p $packageDir$binPath
    mkdir -p $packageDir$dbPath
    mkdir -p $packageDir$confPath
    mkdir -p $packageDir$webPath
    mkdir -p $packageDir$modulesPath
}

#
# prepare application program
#
function pack_binary()
{
    #prepare binDir
    binDir="$packageDir$binPath" 

    cp src/gds $binDir
    cp src/gdsCron.sh $binDir
}

#
# prepare database
#
function pack_db()
{
    #prepare dbDir
    dbDir="$packageDir$dbPath"

    cp db/*.sql $dbDir
}

#
# prepare configure file
#
function pack_configs()
{
    #prepare configure dir
    confDir="$packageDir$confPath"

    cp -pr conf/gds.conf $confDir
    cp -pr conf/.pgpass $confDir
}

#
# prepare web file
#
function pack_web()
{
    #prepare web dir
    webDir="$packageDir$webPath"
    cp -pr html/* $webDir
}

#
# prepare modules file
#
function pack_modules()
{
    #prepare modules dir
    modulesDir="$packageDir$modulesPath"

    cp -pr modules/*.so $modulesDir
}
#
# modify rpm directory
#
function rpm_dir_modify()
{
    #modify rpm directory
    sed -i "s#^%_topdir.*#%_topdir\t\t%{_usrsrc}/redhat#" /usr/lib/rpm/macros
    sed -i "s#^%buildroot.*#%buildroot\t\t${packageDir}#" /usr/lib/rpm/macros
}

#
# start pack gds 
#
function pack_gds()
{
    prepare_dir
    pack_binary
    pack_db
    pack_configs
    pack_web
    pack_modules
    rpm_dir_modify
}


#
# main
#
if [ $# -gt 1 ]
then
    echo "Invalid Parameter"
    echo "package"
    exit 1
else
    pack_gds
fi




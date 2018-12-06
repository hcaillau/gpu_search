#!/bin/bash
set -e

ACTION=${1:-run}

#-------------------------------------------------------------------------------
# clear cache
#-------------------------------------------------------------------------------
rm -rf var/cache/*/

run(){
   
    #---------------------------------------------------------------------------
    # fix permissions
    #---------------------------------------------------------------------------
    echo "fix apache permissions..."
    chown -R www-data:www-data /application/var

    #---------------------------------------------------------------------------
    # init sample documents
    #---------------------------------------------------------------------------
    su -m - www-data -c 'bin/console ign_gpu_search:bulk:document tests/DATA/sample-bulk-document-full.jsonl'

    #---------------------------------------------------------------------------
    # start apache as www-data
    #---------------------------------------------------------------------------
    /usr/sbin/apachectl -D FOREGROUND
}

test(){
    ulimit -n 10000
    # TODO : Exécuter en tant que www-data
    # Voir https://github.com/docker/compose/issues/3270#issuecomment-363478501 pour éviter
    # des problèmes de permissions sur /application/output
    time make test
}

if [ $ACTION = "run" ]; then
    run;
elif [ $ACTION = "test" ]; then
    test;
    exit 0;
else
    echo "undefined action $ACTION"
fi

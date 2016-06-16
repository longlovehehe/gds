#ifndef _OUTPUT_DB_H
#define _OUTPUT_DB_H

#include <netinet/in.h>
#include <arpa/inet.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netdb.h>
#include <dbi/dbi.h>
#include <pthread.h>

#include "define.h"

typedef enum {
    OMPDB = 1,
    GDSDB,
    SSDB
}eDBtype;

typedef struct db_conn {
    dbi_conn conn;
    int status;
    int flag;
}tDBConn;


/*
 * output data to db
 */
int output_db();
tDBConn *attach_conn(eDBtype db_type, const char *dev_ip, const char *dev_port);
void detach_conn(tDBConn *pconn);
long long dbi_query_long(dbi_conn conn, const char *field, const char *format, ...);
char *dbi_query_string(dbi_conn conn, char *queryresult, size_t len, const char *field, const char *format, ...);

#endif

#include "gds.h"

#define PRE_RECORD_FILE		"/tmp/.gds.tmp"

tDBConn *attach_conn(eDBtype db_type, const char *dev_ip, const char *dev_port)
{
    tDBConn *ptmp = NULL;

    if (NULL == dev_ip || NULL == dev_port) {

        logRecord(LOG_ERR, "%s(%d): dev_ip or dev_port is NULL!", __FUNCTION__, __LINE__);
        return NULL;
    }

    if ((ptmp = (tDBConn *)malloc(sizeof(tDBConn))) == NULL) {
        logRecord(LOG_ERR, "%s(%d): db_conn_new malloc error \n", __FUNCTION__, __LINE__);
        return NULL;
    }

    ptmp->flag = db_type;
    ptmp->conn= NULL;
    ptmp->status = 0;

    if ((ptmp->conn = dbi_conn_new("pgsql")) == NULL) {
        logRecord(LOG_ERR, "%s(%d): conn_new error\n", __FUNCTION__, __LINE__);
        if (ptmp) {
            free(ptmp);
            ptmp = NULL;
        }

        return NULL;
    }

    dbi_conn_set_option(ptmp->conn, "host", dev_ip);
    dbi_conn_set_option(ptmp->conn, "port", dev_port);
    dbi_conn_set_option(ptmp->conn, "encoding", "UTF-8");
    dbi_conn_set_option(ptmp->conn, "connect_timeout", "9");
    switch (db_type) {
        case OMPDB:
            dbi_conn_set_option(ptmp->conn, "dbname", "OMPDB");
            dbi_conn_set_option(ptmp->conn, "username", "ompuser");
            dbi_conn_set_option(ptmp->conn, "password", "omppasswd");
            break;
        case SSDB:
            dbi_conn_set_option(ptmp->conn, "dbname", "SSDB");
            dbi_conn_set_option(ptmp->conn, "username", "ssuser");
            dbi_conn_set_option(ptmp->conn, "password", "sspasswd");
            break;
        case GDSDB:
            dbi_conn_set_option(ptmp->conn, "dbname", "GDSDB");
            dbi_conn_set_option(ptmp->conn, "username", "gdsuser");
            dbi_conn_set_option(ptmp->conn, "password", "gdspasswd");
            break;
        default:
            break;
    }

    if (dbi_conn_connect(ptmp->conn) < 0) {
        logRecord(LOG_ERR, "%s(%d): connect db error!!!\n", __FUNCTION__, __LINE__);
        dbi_conn_close(ptmp->conn);
        if (ptmp) {
            free(ptmp);
            ptmp = NULL;
        }
    }

    return ptmp;
}


void detach_conn(tDBConn *pconn)
{
    if (pconn) {
        dbi_conn_close(pconn->conn);
        free(pconn);
        pconn = NULL;
    }
}

long long dbi_query_long(dbi_conn conn, const char *field, const char *format, ...)
{
    dbi_result result;
    long long rcd = 0;
    char sql[LEN_2048];
    va_list ap;

    memset(sql, '\0', LEN_2048);
    va_start(ap, format);
    vsprintf(sql, format, ap);
    va_end(ap);

//    logRecord(LOG_ERR, "%s(%d): sql:%s\n", __FUNCTION__, __LINE__, sql);

    result = dbi_conn_query(conn, sql);
    if (result) {
        while (dbi_result_next_row(result)) {
            rcd = dbi_result_get_longlong(result, field);
        }
        dbi_result_free(result);
    }

    return rcd;
}

char *dbi_query_string(dbi_conn conn, 
                        char *queryresult, size_t len, 
                        const char *field, const char *format, ...)
{
    dbi_result  result;
    char        *qResult = queryresult;
    char        sql[LEN_1024] = { '\0' };

    va_list     ap;

    memset( sql, '\0', sizeof(sql) );
    va_start( ap, format );
    vsprintf( sql, format, ap );
    va_end( ap );

    result = dbi_conn_query( conn, sql );
    if ( result )
    {
        while ( dbi_result_next_row(result) )
        {
            strncpy( queryresult, dbi_result_get_string(result, field), len - 1 );
        }
        
        dbi_result_free( result );
    }
    
    return qResult;
}


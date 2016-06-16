/******************************************************************************

                        版权所有 (C), 2005-2015, ZED-3

 ******************************************************************************
  文 件 名   : mod_ucs.c
  版 本 号   : 初稿
  作    者   : andy
  生成日期   : 2016年3月30日
  最近修改   :
  功能描述   :  T_UserCycle_Statistics_EMP
                T_UserCycle_Statistics_AMP
                企业数据，AMP数据周期表
  函数列表   :
              calc_amp_ucs_stats
              calc_emp_ucs_stats
              calc_ucs_record
              calc_ucs_stats
              log_ucs_stats
              mod_register
              set_ucs_record
  修改历史   :
  1.日    期   : 2016年3月30日
    作    者   : guanfeng.wang
    修改内容   : 创建文件

******************************************************************************/


#include "gds.h"

/*
 * Structure for test infomation.
 */
typedef struct stats_ucs {
    U_64 sdr_id;
    char sdr_amp_id[LEN_32];
    char sdr_record_time[LEN_32];
    char sdr_time[LEN_32];
    U_64 sdr_cyc_type;
    U_64 sdr_add_user;
    U_64 sdr_del_user;
    U_64 sdr_grow_user;
    U_64 sdr_terminal_add_user;
    U_64 sdr_terminal_add_user_test;
    U_64 sdr_terminal_add_user_commercial;
    U_64 sdr_gprs_add_user;
    U_64 sdr_gprs_add_user_test;
    U_64 sdr_gprs_add_user_commercial;
}ST_UCS;

static struct mod_table ucs_table[] = {
    {0, "T_UserCycle_Statistics_EMP"},
    {1, "T_UserCycle_Statistics_AMP"}
};

static struct mod_info ucs_info[] = {
    {"sdr_id", U64_BIT,  0,  STATS_NULL},
    {"sdr_amp_id", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_record_time", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_time", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_cyc_type", U64_BIT,  0,  STATS_NULL},
    {"sdr_add_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_del_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_grow_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_terminal_add_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_terminal_add_user_test", U64_BIT,  0,  STATS_NULL},
    {"sdr_terminal_add_user_commercial", U64_BIT,  0,  STATS_NULL},
    {"sdr_gprs_add_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_gprs_add_user_test", U64_BIT,  0,  STATS_NULL},
    {"sdr_gprs_add_user_commercial", U64_BIT,  0,  STATS_NULL},
};

#define STATS_UCS_SIZE (sizeof(struct stats_ucs))

static char gds_ip[LEN_32] = {0};
static char gds_port[LEN_32] = {0};

static char *ucs_usage = "    --ucs               UserCycle Statistics";

static void log_ucs_stats(ST_UCS *pe, long long mod_record)
{
    int ct;

    logRecord(LOG_INFO, "%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s\n", ucs_info[0].hdr, ucs_info[1].hdr,
            ucs_info[2].hdr, ucs_info[3].hdr, ucs_info[4].hdr, ucs_info[5].hdr, ucs_info[6].hdr,
            ucs_info[7].hdr, ucs_info[8].hdr, ucs_info[9].hdr, ucs_info[10].hdr, ucs_info[11].hdr,
            ucs_info[12].hdr, ucs_info[13].hdr);

    for (ct = 0 ; ct < mod_record; ct++) {
        logRecord(LOG_INFO, "%ld|%s|%s|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld\n",
                pe[ct].sdr_id, pe[ct].sdr_record_time, pe[ct].sdr_time, pe[ct].sdr_cyc_type,
                pe[ct].sdr_add_user, pe[ct].sdr_del_user, pe[ct].sdr_grow_user,
                pe[ct].sdr_terminal_add_user, pe[ct].sdr_terminal_add_user_test,
                pe[ct].sdr_terminal_add_user_commercial, pe[ct].sdr_gprs_add_user,
                pe[ct].sdr_gprs_add_user_test, pe[ct].sdr_gprs_add_user_commercial);
    }
}

static void calc_emp_ucs_stats(struct module *mod, dbi_conn conn)
{
    int ct = 0;
    dbi_result result = 0;
    ST_UCS *pe = NULL;

    char    yesterday_date[32] = { '\0' };

    pe = (ST_UCS *)mod->emp_array;

    /* acquire every enterprise id */
    result = dbi_conn_queryf(conn, "select e_id from \"T_Enterprise\" order by e_id");
    if (result) {
        while(dbi_result_next_row(result)) {
            pe[ct].sdr_id = dbi_result_get_longlong(result, "e_id");
            convert_time_to_string(statis.cur_time, pe[ct].sdr_record_time, 0);
            convert_time_to_string(statis.cur_time - 24*60*60, pe[ct].sdr_time, 1);
            pe[ct].sdr_cyc_type = 0;
            ct++;
        }
        dbi_result_free(result);
    }

    /* get yesterday, today date, format: xxxx-xx-xx 00:00:00 */
    convert_time_to_string( statis.cur_time - 24*60*60, yesterday_date, ZERO_HOUR_DATE );

    for (ct = 0; ct < mod->emp_record; ct++)
    {
        long long sdr_id = pe[ct].sdr_id;

        pe[ct].sdr_add_user = dbi_query_long(conn, "record_add_user", "select record_add_user \
                from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_del_user = dbi_query_long(conn, "record_del_user", \
                "select record_del_user from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_grow_user = dbi_query_long(conn, "record_grow_user", \
                "select record_add_user - record_del_user as record_grow_user from \"T_User_record\" \
                where record_eid = %lld and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_terminal_add_user = dbi_query_long(conn, "record_add_tm", \
                "select record_add_tm from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_terminal_add_user_test = dbi_query_long(conn, "record_add_test_tm", \
                "select record_add_test_tm from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_terminal_add_user_commercial = dbi_query_long(conn, "record_add_commercial_tm", \
                "select record_add_commercial_tm from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_gprs_add_user = dbi_query_long(conn, "record_add_gprs", \
                "select record_add_gprs from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_gprs_add_user_test = dbi_query_long(conn, "record_add_test_gprs", \
                "select record_add_test_gprs from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
        pe[ct].sdr_gprs_add_user_commercial = dbi_query_long(conn, "record_add_commercial_gprs", \
                "select record_add_commercial_gprs from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date );
    }

    //log_ucs_stats(pe, mod->emp_record);

    return;
}

static void calc_amp_ucs(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0, st = 0;
    long long rst;
    dbi_result result = 0;
    ST_UCS *pa = NULL;
    ST_UCS *pe = NULL;
    
    logRecord( LOG_INFO, "%s(%d): cal amp, interval:%d", __FUNCTION__, __LINE__, interval );

    pa = (ST_UCS *)mod->amp_array;
    pe = (ST_UCS *)mod->emp_array;

    /* acquire omp ucs stats */
    pa[0].sdr_id = 0;
    strncpy(pa[0].sdr_amp_id, "0", sizeof(pa[0].sdr_amp_id) - 1);
    convert_time_to_string(statis.cur_time, pa[0].sdr_record_time, 0);
    convert_time_to_string(statis.cur_time - 24*60*60, pa[0].sdr_time, 1);
    if (interval == 0) {
        pa[0].sdr_cyc_type = 0;
    } else if (interval == 7) {
        pa[0].sdr_cyc_type = 1;
    } else {
        pa[0].sdr_cyc_type = 2;
    }

    for (ct = 0; ct < mod->emp_record; ct++)
    {
        pa[0].sdr_add_user += pe[ct].sdr_add_user;
        pa[0].sdr_del_user += pe[ct].sdr_del_user;
        pa[0].sdr_grow_user += pe[ct].sdr_grow_user;
        pa[0].sdr_terminal_add_user += pe[ct].sdr_terminal_add_user;
        pa[0].sdr_terminal_add_user_test += pe[ct].sdr_terminal_add_user_test;
        pa[0].sdr_terminal_add_user_commercial += pe[ct].sdr_terminal_add_user_commercial;
        pa[0].sdr_gprs_add_user += pe[ct].sdr_gprs_add_user;
        pa[0].sdr_gprs_add_user_test += pe[ct].sdr_gprs_add_user_test;
        pa[0].sdr_gprs_add_user_commercial += pe[ct].sdr_gprs_add_user_commercial;
    }

    st = 1;
    /* acquire every enterprise id */
    result = dbi_conn_queryf(conn, "select ag_number from \"T_Agents\" order by ag_number");
    if (result) {
        while(dbi_result_next_row(result)) {
            //pa[st].sdr_id = atoll(dbi_result_get_string(result, "ag_number"));
            strncpy( pa[st].sdr_amp_id, dbi_result_get_string(result, "ag_number"), sizeof(pa[st].sdr_amp_id) - 1 );
            pa[st].sdr_amp_id[sizeof(pa[st].sdr_amp_id) - 1] = '\0';
            convert_time_to_string(statis.cur_time, pa[st].sdr_record_time, 0);
            convert_time_to_string(statis.cur_time - 24*60*60, pa[st].sdr_time, 1);
            if (interval == 0) {
                pa[st].sdr_cyc_type = 0;
            } else if (interval == 7) {
                pa[st].sdr_cyc_type = 1;
            } else {
                pa[st].sdr_cyc_type = 2;
            }

            st++;
        }
        dbi_result_free(result);
    }

    for (st = 1; st < mod->amp_record; st++)
    {
        /*
        result = dbi_conn_queryf(conn, "select e_id from \"T_Enterprise\" where \
                e_ag_path like '%s%lld%s' order by e_id", "%", pa[st].sdr_id, "%");
                */
                
        result = dbi_conn_queryf(conn, "select e_id from \"T_Enterprise\" where \
                e_ag_path like '%s%s%s' order by e_id", "%", pa[st].sdr_amp_id, "%");
        if (result) {
            while(dbi_result_next_row(result)) {
                rst = dbi_result_get_longlong(result, "e_id");
                for (ct = 0; ct < mod->emp_record; ct++) {
                    if (rst == pe[ct].sdr_id) {
                        pa[st].sdr_add_user += pe[ct].sdr_add_user;
                        pa[st].sdr_del_user += pe[ct].sdr_del_user;
                        pa[st].sdr_grow_user += pe[ct].sdr_grow_user;
                        pa[st].sdr_terminal_add_user += pe[ct].sdr_terminal_add_user;
                        pa[st].sdr_terminal_add_user_test += pe[ct].sdr_terminal_add_user_test;
                        pa[st].sdr_terminal_add_user_commercial += pe[ct].sdr_terminal_add_user_commercial;
                        pa[st].sdr_gprs_add_user += pe[ct].sdr_gprs_add_user;
                        pa[st].sdr_gprs_add_user_test += pe[ct].sdr_gprs_add_user_test;
                        pa[st].sdr_gprs_add_user_commercial += pe[ct].sdr_gprs_add_user_commercial;

                        break;
                    }
                }

                //st++;
                /*
                if ( dbi_result_next_row(result) ) {
                    st++;
                }
                */
            }
            dbi_result_free(result);
        }
    }

    //log_ucs_stats(pa, mod->amp_record);

    return;
}

static int set_ucs_record(struct module *mod)
{
	int	j, k;
	char	line[LEN_4096] = {0};
	char	tmp[LEN_2048] = {0};
    char sdr_id_field[LEN_64] = { '\0' };
    ST_UCS *pe = NULL;
    tDBConn *pconn = NULL;

    if ((pconn = attach_conn(GDSDB, gds_ip, gds_port)) == NULL)
    {
        logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
        return -1;
    }

    /* save collect data to output_db */
    if (mod->emp_record != 0 && mod->emp_array != NULL) {
        pe = mod->emp_array;
        for (j = 0; j < mod->emp_record; j++) {
            memset(line, '\0', LEN_4096);
            sprintf(line, "insert into \"%s\"(", mod->table[0].table);
            /*
            for (k = 0; k < mod->n_col; k++) {
                memset(tmp, '\0', LEN_2048);
                sprintf(tmp, "\"%s\",", mod->info[k].hdr);
                strcat(line, tmp);
            }
            */
            
            /* EMP: sdr_id, not include sdr_amp_id */
            snprintf( sdr_id_field, sizeof(sdr_id_field) - 1, "\"%s\",", mod->info[0].hdr );
            strcat( line, sdr_id_field );
            for ( k = 2; k < mod->n_col; k++ ) {
                memset( tmp, '\0', LEN_2048 );
                snprintf( tmp, sizeof(tmp) - 1 , "\"%s\",", mod->info[k].hdr );
                strncat( line, tmp, sizeof(line) - 1 );
            }
            
            line[strlen(line) - 1] = ')';
            strcat(line, "values(");
            memset(tmp, '\0', LEN_2048);
            sprintf(tmp, "'%lld','%s','%s','%lld','%lld','%lld','%lld','%lld','%lld','%lld',\
                    '%lld','%lld','%lld');",
                    pe[j].sdr_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_cyc_type,
                    pe[j].sdr_add_user, pe[j].sdr_del_user, pe[j].sdr_grow_user,
                    pe[j].sdr_terminal_add_user, pe[j].sdr_terminal_add_user_test,
                    pe[j].sdr_terminal_add_user_commercial, pe[j].sdr_gprs_add_user,
                    pe[j].sdr_gprs_add_user_test, pe[j].sdr_gprs_add_user_commercial);

            strcat(line, tmp);
            dbi_conn_queryf(pconn->conn, line);
            logRecord(LOG_DEBUG, "%s(%d):line->%s\n", __FUNCTION__, __LINE__, line);
        }
    }

    if (mod->amp_record != 0 && mod->amp_array != NULL) {
        pe = mod->amp_array;
        for (j = 0; j < mod->amp_record; j++) {
            memset(line, '\0', LEN_4096);
            sprintf(line, "insert into \"%s\"(", mod->table[1].table);
            /*
            for (k = 0; k < mod->n_col; k++) {
                memset(tmp, '\0', LEN_2048);
                sprintf(tmp, "\"%s\",", mod->info[k].hdr);
                strcat(line, tmp);
            }
            */
            
            /* EMP: sdr_amp_id, not include sdr_id */
            snprintf( sdr_id_field, sizeof(sdr_id_field) - 1, "\"%s\",", mod->info[0].hdr );
            strcat( line, sdr_id_field );
            for ( k = 2; k < mod->n_col; k++ ) {
                memset( tmp, '\0', LEN_2048 );
                snprintf( tmp, sizeof(tmp) - 1 , "\"%s\",", mod->info[k].hdr );
                strncat( line, tmp, sizeof(line) - 1 );
            }
            
            line[strlen(line) - 1] = ')';
            strcat(line, "values(");
            memset(tmp, '\0', LEN_2048);
            sprintf(tmp, "'%s','%s','%s','%lld','%lld','%lld','%lld','%lld','%lld','%lld',\
                    '%lld','%lld','%lld');",
                    pe[j].sdr_amp_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_cyc_type,
                    pe[j].sdr_add_user, pe[j].sdr_del_user, pe[j].sdr_grow_user,
                    pe[j].sdr_terminal_add_user, pe[j].sdr_terminal_add_user_test,
                    pe[j].sdr_terminal_add_user_commercial, pe[j].sdr_gprs_add_user,
                    pe[j].sdr_gprs_add_user_test, pe[j].sdr_gprs_add_user_commercial);

            strcat(line, tmp);
            dbi_conn_queryf(pconn->conn, line);
            logRecord(LOG_DEBUG, "%s(%d):line->%s\n", __FUNCTION__, __LINE__, line);
        }
    }

    if (mod->emp_array) {
        free(mod->emp_array);
        mod->emp_array = NULL;
    }

    if (mod->amp_array) {
        free(mod->amp_array);
        mod->amp_array = NULL;
    }
    
    if (mod->ser_array) {
        free(mod->ser_array);
        mod->ser_array = NULL;
    }

    detach_conn(pconn);
    return 0;
}

static void calc_emp_ucs_record(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0;
    char start_time[LEN_32];
    dbi_result result = 0;
    ST_UCS *pe = NULL;
    tDBConn *pconn = NULL;

    logRecord( LOG_INFO, "%s(%d): cal week or month, interval:%d", __FUNCTION__, __LINE__, interval );
    pe = (ST_UCS *)mod->emp_array;

    memset(start_time, '\0', LEN_32);
    convert_time_to_string(statis.cur_time - interval*24*60*60, start_time, 1);

    /* acquire every enterprise id */
    result = dbi_conn_queryf(conn, "select e_id from \"T_Enterprise\" order by e_id");
    if (result) {
        while(dbi_result_next_row(result)) {
            pe[ct].sdr_id = dbi_result_get_longlong(result, "e_id");
            convert_time_to_string(statis.cur_time, pe[ct].sdr_record_time, 0);
            convert_time_to_string(statis.cur_time - 24*60*60, pe[ct].sdr_time, 1);
            if (interval == 7) {
                pe[ct].sdr_cyc_type = 1;
            } else {
                pe[ct].sdr_cyc_type = 2;
            }
            ct++;
        }
        dbi_result_free(result);
    }

    if ((pconn = attach_conn(GDSDB, gds_ip, gds_port)) == NULL)
    {
        logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
        return;
    }

    for (ct = 0; ct < mod->emp_record; ct++)
    {
        long long sdr_id = pe[ct].sdr_id;

        pe[ct].sdr_add_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_add_user) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_del_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_del_user) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_grow_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_grow_user) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_terminal_add_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_terminal_add_user) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_terminal_add_user_test = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_terminal_add_user_test) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_terminal_add_user_commercial = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_terminal_add_user_commercial) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_gprs_add_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_gprs_add_user) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_gprs_add_user_test = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_gprs_add_user_test) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_gprs_add_user_commercial = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_gprs_add_user_commercial) as bigint) \
            from \"T_UserCycle_Statistics_EMP\" where sdr_cyc_type = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
    }

    detach_conn(pconn);
    //log_ucs_stats(pe, mod->emp_record);

    return;
}
/* The statistical results for cycle */
static void calc_ucs_stats(struct module *mod, int interval)
{

    tDBConn *pconn = NULL;

    if ((pconn = attach_conn(OMPDB, conf.server_addr, conf.server_port)) == NULL)
    {
        logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
        return ;
    }

    /* acquire enterprise count */
    mod->emp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Enterprise\";");
    if (mod->emp_record != 0) {
        mod->emp_array = calloc(mod->emp_record, STATS_UCS_SIZE);
        if (mod->emp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for emp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    sscanf(conf.output_db_addr, "%[^:]:%s", gds_ip, gds_port);
    logRecord(LOG_INFO, "%s(%d): gds ip:%s port:%s!", __FUNCTION__, __LINE__,
                        gds_ip, gds_port);

    /* acquire agents count */
    mod->amp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Agents\";") + 1;
    if (mod->amp_record != 0) {
        mod->amp_array = calloc(mod->amp_record, STATS_UCS_SIZE);
        if (mod->amp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for amp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    if (interval == 0) {
        calc_emp_ucs_stats(mod, pconn->conn);
    } else {
        calc_emp_ucs_record(mod, pconn->conn, interval);
    }
    calc_amp_ucs(mod, pconn->conn, interval);

    set_ucs_record(mod);

    detach_conn(pconn);
    return;
}

void mod_register(struct module *mod)
{
	register_mod_fileds(mod, 
                        "--ucs", 
                        ucs_usage, 
                        ucs_table, 
                        ucs_info, 
                        sizeof(ucs_table)/sizeof(struct mod_table), 
                        sizeof(ucs_info)/sizeof(struct mod_info), 
                        calc_ucs_stats);
}


/******************************************************************************

                        版权所有 (C), 2005-2015, ZED-3

 ******************************************************************************
  文 件 名   : mod_cds.c
  版 本 号   : 初稿
  作    者   : andy
  生成日期   : 2016年3月30日
  最近修改   :
  功能描述   :  T_CallData_Statistics_EMP
                T_CallData_Statistics_AMP
                T_CallData_Statistics_S
                企业用户，AMP用户，服务器用户通话数据统计表
  函数列表   :
              calc_amp_cds_stats
              calc_cds_record
              calc_cds_stats
              calc_emp_cds_stats
              calc_ser_cds_stats
              log_cds_stats
              mod_register
              set_cds_record
  修改历史   :
  1.日    期   : 2016年3月30日
    作    者   : guanfeng.wang
    修改内容   : 创建文件

******************************************************************************/


#include "gds.h"

/*
 * Structure for test infomation.
 */
typedef struct stats_cds {
    U_64 sdr_id;
    char sdr_amp_id[LEN_32];
    char sdr_record_time[LEN_32];
    char sdr_time[LEN_32];
    U_64 sdr_date_flag;
    U_64 sdr_ptt_htime;
    U_64 sdr_ptt_hcount;
    U_64 sdr_call_htime;
    U_64 sdr_call_hcount;
    U_64 sdr_video_htime;
    U_64 sdr_video_hcount;
    U_64 sdr_audio_htime;
    U_64 sdr_audio_hcount;
}ST_CDS;

static struct mod_table cds_table[] = {
    {0, "T_CallData_Statistics_EMP"},
    {1, "T_CallData_Statistics_AMP"},
    {2, "T_CallData_Statistics_S"}
};

static struct mod_info cds_info[] = {
    {"sdr_id", U64_BIT,  0,  STATS_NULL},
    {"sdr_amp_id", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_record_time", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_time", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_date_flag", U64_BIT,  0,  STATS_NULL},
    {"sdr_ptt_htime", U64_BIT,  0,  STATS_NULL},
    {"sdr_ptt_hcount", U64_BIT,  0,  STATS_NULL},
    {"sdr_call_htime", U64_BIT,  0,  STATS_NULL},
    {"sdr_call_hcount", U64_BIT,  0,  STATS_NULL},
    {"sdr_video_htime", U64_BIT,  0,  STATS_NULL},
    {"sdr_video_hcount", U64_BIT,  0,  STATS_NULL},
    {"sdr_audio_htime", U64_BIT,  0,  STATS_NULL},
    {"sdr_audio_hcount", U64_BIT,  0,  STATS_NULL},
};

#define STATS_CDS_SIZE (sizeof(struct stats_cds))

static char gds_ip[LEN_32] = {0};
static char gds_port[LEN_32] = {0};

static char *cds_usage = "    --cds               UserData Statistics";

static void log_cds_stats(ST_CDS *pe, long long mod_record)
{
    int ct;

    logRecord(LOG_INFO, "%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s\n",
            cds_info[0].hdr, cds_info[1].hdr, cds_info[2].hdr, cds_info[3].hdr, cds_info[4].hdr,
            cds_info[5].hdr, cds_info[6].hdr, cds_info[7].hdr, cds_info[8].hdr,
            cds_info[9].hdr, cds_info[10].hdr, cds_info[11].hdr);

    for (ct = 0 ; ct < mod_record; ct++) {
        logRecord(LOG_INFO, "%ld|%s|%s|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld\n",
                pe[ct].sdr_id, pe[ct].sdr_record_time, pe[ct].sdr_time, pe[ct].sdr_date_flag,
                pe[ct].sdr_ptt_htime, pe[ct].sdr_ptt_hcount,
                pe[ct].sdr_call_htime, pe[ct].sdr_call_hcount,
                pe[ct].sdr_video_htime, pe[ct].sdr_video_hcount,
                pe[ct].sdr_audio_htime, pe[ct].sdr_audio_hcount);
    }
}

static void calc_emp_cds_stats(struct module *mod, dbi_conn conn)
{
    int ct = 0;
    char dev_ip[LEN_32];
    char dev_port[LEN_32];
    dbi_result result = 0;
    ST_CDS *pe = NULL;
    tDBConn *pconn = NULL;

    pe = (ST_CDS *)mod->emp_array;

    /* acquire every enterprise id */
    result = dbi_conn_queryf(conn, "select e_id from \"T_Enterprise\" order by e_id");
    if (result) {
        while(dbi_result_next_row(result)) {
            pe[ct].sdr_id = dbi_result_get_longlong(result, "e_id");
            convert_time_to_string(statis.cur_time, pe[ct].sdr_record_time, 0);
            convert_time_to_string(statis.cur_time - 24*60*60, pe[ct].sdr_time, 1);
            pe[ct].sdr_date_flag = 0;
            ct++;
        }
        dbi_result_free(result);
    }

    for (ct = 0; ct < mod->emp_record; ct++)
    {
        long long sdr_id = pe[ct].sdr_id;

        result = dbi_conn_queryf(conn, "select d_ip2 from \"T_Device\" where d_id = \
                (select e_ss_id from \"T_Enterprise\" where e_id = %lld);", sdr_id);
        if (result) {
            while (dbi_result_next_row(result)) {
                memset(dev_ip, '\0', LEN_32);
                memset(dev_port, '\0', LEN_32);
                strcpy(dev_ip, dbi_result_get_string(result, "d_ip2"));
                strcpy(dev_port, "5432");
            }
            dbi_result_free(result);
        }

        if ((pconn = attach_conn(SSDB, dev_ip, dev_port)) == NULL)
        {
            logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
            continue;
        }

        pe[ct].sdr_ptt_htime = dbi_query_long(pconn->conn, "sum", "select sum(callsec) from \
                \"cdr_%lld\" where endtime < %lld and (call_type = 3 or call_type = 4);",
                sdr_id, statis.cur_time);
        pe[ct].sdr_ptt_hcount = dbi_query_long(pconn->conn, "count", "select count(*) from \
                \"cdr_%lld\" where endtime < %lld and (call_type = 3 or call_type = 4);",
                sdr_id, statis.cur_time);
        pe[ct].sdr_call_htime = 2 * dbi_query_long(pconn->conn, "sum", "select sum(callsec) from \
                \"cdr_%lld\" where endtime < %lld and (call_type = 1 or call_type = 2);",
                sdr_id, statis.cur_time);
        pe[ct].sdr_call_hcount = 2 * dbi_query_long(pconn->conn, "count", "select count(*) from \
                \"cdr_%lld\" where endtime < %lld and (call_type = 1 or call_type = 2);",
                sdr_id, statis.cur_time);
        pe[ct].sdr_video_htime = 2 * dbi_query_long(pconn->conn, "sum", "select sum(callsec) from \
                \"cdr_%lld\" where endtime < %lld and call_type = 2;",
                sdr_id, statis.cur_time);
        pe[ct].sdr_video_hcount = 2 * dbi_query_long(pconn->conn, "count", "select count(*) from \
                \"cdr_%lld\" where endtime < %lld and call_type = 2",
                sdr_id, statis.cur_time);
        pe[ct].sdr_audio_htime = 2 * dbi_query_long(pconn->conn, "sum", "select sum(callsec) from \
                \"cdr_%lld\" where endtime < %lld and call_type = 1;",
                sdr_id, statis.cur_time);
        pe[ct].sdr_audio_hcount = 2 * dbi_query_long(pconn->conn, "count", "select count(*) from \
                \"cdr_%lld\" where endtime < %lld and call_type = 1;",
                sdr_id, statis.cur_time);

        detach_conn(pconn);

    }

    //log_cds_stats(pe, mod->emp_record);

    return;
}

static void calc_amp_cds(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0, st = 0;
    dbi_result result = 0;
    ST_CDS *pa = NULL;
    ST_CDS *pe = NULL;
    long long rst = 0;
    
    logRecord( LOG_INFO, "%s(%d): cal amp, interval:%d", __FUNCTION__, __LINE__, interval );

    pa = (ST_CDS *)mod->amp_array;
    pe = (ST_CDS *)mod->emp_array;

    /* acquire omp uss stats */
    pa[0].sdr_id = 0;
    strncpy(pa[0].sdr_amp_id, "0", sizeof(pa[0].sdr_amp_id) - 1);
    convert_time_to_string(statis.cur_time, pa[ct].sdr_record_time, 0);
    convert_time_to_string(statis.cur_time - 24*60*60, pa[ct].sdr_time, 1);
    if (interval == 0) {
        pa[0].sdr_date_flag = 0;
    } else if (interval == 7) {
        pa[0].sdr_date_flag = 1;
    } else {
        pa[0].sdr_date_flag = 2;
    }
    for (ct = 0; ct < mod->emp_record; ct++)
    {
        pa[0].sdr_ptt_htime += pe[ct].sdr_ptt_htime;
        pa[0].sdr_ptt_hcount += pe[ct].sdr_ptt_hcount;
        pa[0].sdr_call_htime += pe[ct].sdr_call_htime;
        pa[0].sdr_call_hcount += pe[ct].sdr_call_hcount;
        pa[0].sdr_video_htime += pe[ct].sdr_video_htime;
        pa[0].sdr_video_hcount += pe[ct].sdr_video_hcount;
        pa[0].sdr_audio_htime += pe[ct].sdr_audio_htime;
        pa[0].sdr_audio_hcount += pe[ct].sdr_audio_hcount;
    }

    st = 1;
    /* acquire amp uss stats */
    result = dbi_conn_queryf(conn, "select ag_number from \"T_Agents\" order by ag_number");
    if (result) {
        while(dbi_result_next_row(result)) {
            //pa[st].sdr_id = atoll(dbi_result_get_string(result, "ag_number"));
            strncpy( pa[st].sdr_amp_id, dbi_result_get_string(result, "ag_number"), sizeof(pa[st].sdr_amp_id) - 1 );
            pa[st].sdr_amp_id[sizeof(pa[st].sdr_amp_id) - 1] = '\0';
            convert_time_to_string(statis.cur_time, pa[st].sdr_record_time, 0);
            convert_time_to_string(statis.cur_time - 24*60*60, pa[st].sdr_time, 1);
            if (interval == 0) {
                pa[st].sdr_date_flag = 0;
            } else if (interval == 7) {
                pa[st].sdr_date_flag = 1;
            } else {
                pa[st].sdr_date_flag = 2;
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
                        pa[st].sdr_ptt_htime += pe[ct].sdr_ptt_htime;
                        pa[st].sdr_ptt_hcount += pe[ct].sdr_ptt_hcount;
                        pa[st].sdr_call_htime += pe[ct].sdr_call_htime;
                        pa[st].sdr_call_hcount += pe[ct].sdr_call_hcount;
                        pa[st].sdr_video_htime += pe[ct].sdr_video_htime;
                        pa[st].sdr_video_hcount += pe[ct].sdr_video_hcount;
                        pa[st].sdr_audio_htime += pe[ct].sdr_audio_htime;
                        pa[st].sdr_audio_hcount += pe[ct].sdr_audio_hcount;

                        break;
                    }
                }
            }
            dbi_result_free(result);
        }
    }

    //log_cds_stats(pa, mod->amp_record);

    return;
}

static void calc_ser_cds(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0, st = 0;
    dbi_result result = 0;
    ST_CDS *ps = NULL;
    ST_CDS *pe = NULL;
    long long rst = 0;

    ps = (ST_CDS *)mod->ser_array;
    pe = (ST_CDS *)mod->emp_array;

    st = 0;
    /* acquire ser uss stats */
    result = dbi_conn_queryf(conn, "select d_id from \"T_Device\" where d_type = 'mds' order by d_id");
    if (result) {
        while(dbi_result_next_row(result)) {
            ps[st].sdr_id = dbi_result_get_longlong(result, "d_id");
            convert_time_to_string(statis.cur_time, ps[st].sdr_record_time, 0);
            convert_time_to_string(statis.cur_time - 24*60*60, ps[st].sdr_time, 1);
            if (interval == 0) {
                ps[st].sdr_date_flag = 0;
            } else if (interval == 7) {
                ps[st].sdr_date_flag = 1;
            } else {
                ps[st].sdr_date_flag = 2;
            }
            st++;
        }
        dbi_result_free(result);
    }

    for (st = 0; st < mod->ser_record; st++)
    {
        result = dbi_conn_queryf(conn, "select e_id from \"T_Enterprise\" where \
                e_mds_id = %lld order by e_id ", ps[st].sdr_id);
        if (result) {
            while(dbi_result_next_row(result)) {
                rst = dbi_result_get_longlong(result, "e_id");
                for (ct = 0; ct < mod->emp_record; ct++) {
                    if (rst == pe[ct].sdr_id) {
                        ps[st].sdr_ptt_htime += pe[ct].sdr_ptt_htime;
                        ps[st].sdr_ptt_hcount += pe[ct].sdr_ptt_hcount;
                        ps[st].sdr_call_htime += pe[ct].sdr_call_htime;
                        ps[st].sdr_call_hcount += pe[ct].sdr_call_hcount;
                        ps[st].sdr_video_htime += pe[ct].sdr_video_htime;
                        ps[st].sdr_video_hcount += pe[ct].sdr_video_hcount;
                        ps[st].sdr_audio_htime += pe[ct].sdr_audio_htime;
                        ps[st].sdr_audio_hcount += pe[ct].sdr_audio_hcount;
                    }
                }
            }
            dbi_result_free(result);
        }
    }

    //log_cds_stats(ps, mod->ser_record);

    return;
}

static int set_cds_record(struct module *mod)
{
	int	j, k;
	char	line[LEN_4096] = {0};
	char	tmp[LEN_2048] = {0};
    char sdr_id_field[LEN_64] = { '\0' };
    ST_CDS *pe = NULL;
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
                    '%lld','%lld');",
                    pe[j].sdr_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_date_flag,
                    pe[j].sdr_ptt_htime, pe[j].sdr_ptt_hcount,
                    pe[j].sdr_call_htime, pe[j].sdr_call_hcount,
                    pe[j].sdr_video_htime, pe[j].sdr_video_hcount,
                    pe[j].sdr_audio_htime, pe[j].sdr_audio_hcount);

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
                    '%lld','%lld');",
                    pe[j].sdr_amp_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_date_flag,
                    pe[j].sdr_ptt_htime, pe[j].sdr_ptt_hcount,
                    pe[j].sdr_call_htime, pe[j].sdr_call_hcount,
                    pe[j].sdr_video_htime, pe[j].sdr_video_hcount,
                    pe[j].sdr_audio_htime, pe[j].sdr_audio_hcount);

            strcat(line, tmp);
            dbi_conn_queryf(pconn->conn, line);
            logRecord(LOG_DEBUG, "%s(%d):line->%s\n", __FUNCTION__, __LINE__, line);
        }
    }

    if (mod->ser_record != 0 && mod->ser_array != NULL) {
        pe = mod->ser_array;
        for (j = 0; j < mod->ser_record; j++) {
            memset(line, '\0', LEN_4096);
            sprintf(line, "insert into \"%s\"(", mod->table[2].table);
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
            sprintf(tmp, "'%lld','%s','%s','%lld','%lld','%lld','%lld','%lld','%lld','%lld',\
                    '%lld','%lld');",
                    pe[j].sdr_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_date_flag,
                    pe[j].sdr_ptt_htime, pe[j].sdr_ptt_hcount,
                    pe[j].sdr_call_htime, pe[j].sdr_call_hcount,
                    pe[j].sdr_video_htime, pe[j].sdr_video_hcount,
                    pe[j].sdr_audio_htime, pe[j].sdr_audio_hcount);

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

static void calc_emp_cds_record(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0;
    dbi_result result = 0;
    char start_time[LEN_32];
    ST_CDS *pe = NULL;
    tDBConn *pconn = NULL;
    
    logRecord( LOG_INFO, "%s(%d): cal week or month, interval:%d", __FUNCTION__, __LINE__, interval );

    pe = (ST_CDS *)mod->emp_array;

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
                pe[ct].sdr_date_flag = 1;
            } else {
                pe[ct].sdr_date_flag = 2;
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

        pe[ct].sdr_ptt_htime = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_ptt_htime) as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_ptt_hcount = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_ptt_hcount) as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_call_htime = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_call_htime) as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_call_hcount = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_call_hcount) as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_video_htime = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_video_htime)  as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_video_hcount = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_video_hcount) as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_audio_htime = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_audio_htime) as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_audio_hcount = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_audio_hcount) as bigint) \
            from \"T_CallData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
    }

    detach_conn(pconn);
    //log_cds_stats(pe, mod->emp_record);

    return;
}

/* The statistical results for cycle */
static void calc_cds_stats(struct module *mod, int interval)
{

    tDBConn *pconn = NULL;

    if ((pconn = attach_conn(OMPDB, conf.server_addr, conf.server_port)) == NULL)
    {
        logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
        return ;
    }

    sscanf(conf.output_db_addr, "%[^:]:%s", gds_ip, gds_port);
    logRecord(LOG_INFO, "%s(%d): gds ip:%s port:%s!", __FUNCTION__, __LINE__,
                        gds_ip, gds_port);

    /* acquire enterprise count */
    mod->emp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Enterprise\";");
    if (mod->emp_record != 0) {
        mod->emp_array = calloc(mod->emp_record, STATS_CDS_SIZE);
        if (mod->emp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for emp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    /* acquire enterprise count */
    mod->amp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Agents\";") + 1;
    if (mod->amp_record != 0) {
        mod->amp_array = calloc(mod->amp_record, STATS_CDS_SIZE);
        if (mod->amp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for amp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    /* acquire enterprise count */
    mod->ser_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Device\" \
            where d_type = 'mds';");
    if (mod->ser_record != 0) {
        mod->ser_array = calloc(mod->ser_record, STATS_CDS_SIZE);
        if (mod->ser_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for amp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    if (interval == 0) {
        calc_emp_cds_stats(mod, pconn->conn);
    } else {
        calc_emp_cds_record(mod, pconn->conn, interval);
    }
    calc_amp_cds(mod, pconn->conn, interval);
    calc_ser_cds(mod, pconn->conn, interval);

    set_cds_record(mod);

    detach_conn(pconn);
    return;
}

void mod_register(struct module *mod)
{
	register_mod_fileds(mod, 
                        "--cds", 
                        cds_usage, 
                        cds_table, 
                        cds_info, 
                        sizeof(cds_table)/sizeof(struct mod_table), 
                        sizeof(cds_info)/sizeof(struct mod_info), 
                        calc_cds_stats);
}


/******************************************************************************

                        版权所有 (C), 2005-2015, ZED-3

 ******************************************************************************
  文 件 名   : mod_uss.c
  版 本 号   : 初稿
  作    者   : andy
  生成日期   : 2016年3月30日
  最近修改   :
  功能描述   :  T_UserState_Statistics_EMP
                T_UserState_Statistics_AMP
                企业用户，AMP用户状态统计表
  函数列表   :
              calc_amp_uss_stats
              calc_emp_uss_stats
              calc_uss_record
              calc_uss_stats
              log_uss_stats
              mod_register
              set_uss_record
  修改历史   :
  1.日    期   : 2016年3月30日
    作    者   : guanfeng.wang
    修改内容   : 创建文件

******************************************************************************/



#include "gds.h"

/*
 * Structure for test infomation.
 */
typedef struct stats_uss {
    U_64 sdr_id;
    char sdr_amp_id[LEN_32];
    char sdr_record_time[LEN_32];
    char sdr_time[LEN_32];
    U_64 sdr_date_flag;
    U_64 sdr_cumulative_users;
    U_64 sdr_loss_user;
    U_64 sdr_survival_user;
    F_32 sdr_survival_rate;
    U_64 sdr_online_user;
    U_64 sdr_offline_user;
    F_32 sdr_active_rate;
    U_64 sdr_online3_user;
    U_64 sdr_online7_user;
    U_64 sdr_online14_user;
    U_64 sdr_online30_user;
}ST_USS;

static struct mod_table uss_table[] = {
    {0, "T_UserState_Statistics_EMP"},
    {1, "T_UserState_Statistics_AMP"}
};

static struct mod_info uss_info[] = {
    {"sdr_id", U64_BIT,  0,  STATS_NULL},
    {"sdr_amp_id", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_record_time", U64_BIT,  0,  STATS_NULL},
    {"sdr_time", U64_BIT,  0,  STATS_NULL},
    {"sdr_date_flag", U64_BIT,  0,  STATS_NULL},
    {"sdr_cumulative_users", U64_BIT,  0,  STATS_NULL},
    {"sdr_loss_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_survival_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_survival_rate", U64_BIT,  0,  STATS_NULL},
    {"sdr_online_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_offline_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_active_rate", U64_BIT,  0,  STATS_NULL},
    {"sdr_online3_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_online7_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_online14_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_online30_user", U64_BIT,  0,  STATS_NULL},
};

#define STATS_USS_SIZE (sizeof(struct stats_uss))

static char gds_ip[LEN_32] = {0};
static char gds_port[LEN_32] = {0};

static char *uss_usage = "    --uss               UserState Statistics";

static void log_uss_stats(ST_USS *pe, long long mod_record)
{
    int ct;

    logRecord(LOG_INFO, "%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s\n",
            uss_info[0].hdr, uss_info[1].hdr, uss_info[2].hdr, uss_info[3].hdr, uss_info[4].hdr,
            uss_info[5].hdr, uss_info[6].hdr, uss_info[7].hdr, uss_info[8].hdr,
            uss_info[9].hdr, uss_info[10].hdr, uss_info[11].hdr, uss_info[12].hdr,
            uss_info[13].hdr, uss_info[14].hdr);

    for (ct = 0 ; ct < mod_record; ct++) {
        logRecord(LOG_INFO, "%ld|%s|%s|%ld|%ld|%ld|%ld|%2.2f|%ld|%ld|%2.2f|%ld|%ld|%ld|%ld\n",
                pe[ct].sdr_id, pe[ct].sdr_record_time, pe[ct].sdr_time, pe[ct].sdr_date_flag,
                pe[ct].sdr_cumulative_users, pe[ct].sdr_loss_user,
                pe[ct].sdr_survival_user, pe[ct].sdr_survival_rate,
                pe[ct].sdr_online_user, pe[ct].sdr_offline_user,
                pe[ct].sdr_active_rate, pe[ct].sdr_online3_user,
                pe[ct].sdr_online7_user, pe[ct].sdr_online14_user,
                pe[ct].sdr_online30_user);
    }
}

static void calc_emp_uss_stats(struct module *mod, dbi_conn conn)
{
    int ct = 0;
    char tmp[LEN_64];
    char last_date[LEN_64];
    char three_date[LEN_64];
    char seven_date[LEN_64];
    char fourteen_date[LEN_64];
    char thirty_date[LEN_64];
    char dev_ip[LEN_32];
    char dev_port[LEN_32];
    char corp_user[LEN_32];
    dbi_result result = 0;
    ST_USS *pe = NULL;
    long long rst = 0;
    tDBConn *pconn = NULL;
    
    char    fourteen_day_before_date[32] = { '\0' }; 
    char    yesterday_date[32] = { '\0' };

    pe = (ST_USS *)mod->emp_array;

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

    /* get date of before 14day, format: xxxx-xx-xx */
    convert_time_to_string( statis.cur_time - 14*24*60*60, fourteen_day_before_date, YYYY_MM_DD_DATE );

    /* get date of yesterday: format: xxxx-xx-xx 00:00:00 */
    convert_time_to_string( statis.cur_time - 24*60*60, yesterday_date, ZERO_HOUR_DATE );
    
    for (ct = 0; ct < mod->emp_record; ct++)
    {
        long long sdr_id = pe[ct].sdr_id;

        pe[ct].sdr_cumulative_users += dbi_query_long(conn, "count", "select count(*) from \"T_User\" \
                where u_e_id = %lld;", sdr_id);
        pe[ct].sdr_cumulative_users += dbi_query_long(conn, "record_del_user",
                "select record_del_user from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';",
                sdr_id, yesterday_date );

        pe[ct].sdr_loss_user += dbi_query_long(conn, "record_del_user",
                "select record_del_user from \"T_User_record\" where record_eid = %lld \
                and record_time = '%s';", \
                sdr_id, yesterday_date);

        /* acquire data from loginrecord_xxxxxx table */
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

        /*
        if ((pconn = attach_conn(SSDB, dev_ip, dev_port)) == NULL)
        {
            logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
            continue;
        }
        */

        if ((pconn = attach_conn(GDSDB, gds_ip, gds_port)) == NULL)
        {
            logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
            continue;
        }

        memset(tmp, '\0', LEN_64);
        convert_time_to_string(statis.cur_time - 14*24*60*60, tmp, 1);
        result = dbi_conn_queryf(conn, "select u_number from \"T_User\" where u_e_id = \
                %lld and u_create_time < '%s'", sdr_id, tmp);
        if (result) {
            /*
            while (dbi_result_next_row(result)) {
                memset(tmp, '\0', LEN_64);
                strcpy(tmp, dbi_result_get_string(result, "u_number"));
                rst = dbi_query_long(pconn->conn, "count", "select count(number) \
                        from \"loginrecord_%lld\" where number = '%s' and time between '%lld' and '%lld';",
                        sdr_id, tmp, (statis.cur_time-14*24*60*60), statis.cur_time);
                if (rst == 0)
                    pe[ct].sdr_loss_user++;
                rst = -1;
            }
            */
            while ( dbi_result_next_row(result) )
            {
                memset(tmp, '\0', LEN_64);
                strcpy(tmp, dbi_result_get_string(result, "u_number"));
                rst = dbi_query_long(pconn->conn, "sdr_active_flag", "select sdr_active_flag \
                    from \"T_UserActiveState_Statistics_EMP\" where sdr_id = '%lld' and sdr_num = '%s' \
                    and sdr_active_flag = 1 and sdr_time between '%s' and '%s';",  \
                    sdr_id, tmp, fourteen_day_before_date, pe[ct].sdr_time);

                if (rst == 0)
                {
                    pe[ct].sdr_loss_user++;
                }
                rst = -1;
                
            }
            dbi_result_free(result);
            
        }

        pe[ct].sdr_survival_user = pe[ct].sdr_cumulative_users - pe[ct].sdr_loss_user;
        if (pe[ct].sdr_cumulative_users != 0)
            pe[ct].sdr_survival_rate = (F_32)pe[ct].sdr_survival_user / pe[ct].sdr_cumulative_users;

        pe[ct].sdr_online_user = dbi_query_long(pconn->conn, "count", "select count(*) \
             from \"T_UserActiveState_Statistics_EMP\" where sdr_id = '%lld' \
             and sdr_active_flag = 1 and sdr_time = '%s';", \
             sdr_id, pe[ct].sdr_time);
        /*
        pe[ct].sdr_online_user = dbi_query_long(pconn->conn, "count", "select count(distinct number) \
            from \"loginrecord_%lld\" where time between '%lld' and '%lld';",
            sdr_id, (statis.cur_time-24*60*60), statis.cur_time);
        
        continue_online_user = 0;
        deadline_before_online_user = 0;
        deadline_before_offline_user = 0;
        deadline_before_online_user = dbi_query_long( pconn->conn, "count", "select count(number) \
            from \"loginrecord_%lld\" where time < '%lld' and type = '1';", \
            sdr_id, statis.cur_time-24*60*60 );
        deadline_before_offline_user = dbi_query_long( pconn->conn, "count", "select count(number) \
            from \"loginrecord_%lld\" where time < '%lld' and type = '2';", \
            sdr_id, statis.cur_time-24*60*60 );
        continue_online_user = deadline_before_online_user - deadline_before_offline_user;

        pe[ct].sdr_online_user += continue_online_user;
        */
            
        pe[ct].sdr_offline_user = pe[ct].sdr_cumulative_users - pe[ct].sdr_online_user;
        if ( pe[ct].sdr_offline_user < 0 )
        {
            pe[ct].sdr_offline_user = 0;
        }
        if (pe[ct].sdr_cumulative_users != 0)
            pe[ct].sdr_active_rate = (F_32)pe[ct].sdr_online_user / pe[ct].sdr_cumulative_users;

        /*
        detach_conn(pconn);

        if ((pconn = attach_conn(GDSDB, gds_ip, gds_port)) == NULL)
        {
            logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
            continue;
        }
        */
        memset( last_date, '\0', sizeof(last_date) );
        memset( three_date, '\0', sizeof(three_date) );
        memset( seven_date, '\0', sizeof(seven_date) );
        memset( fourteen_date, '\0', sizeof(fourteen_date) );
        memset( thirty_date, '\0', sizeof(thirty_date) );
        convert_time_to_string( statis.cur_time - 1*24*60*60, last_date, YYYY_MM_DD_DATE );
        convert_time_to_string( statis.cur_time - 3*24*60*60, three_date, YYYY_MM_DD_DATE );
        convert_time_to_string( statis.cur_time - 7*24*60*60, seven_date, YYYY_MM_DD_DATE );
        convert_time_to_string( statis.cur_time - 14*24*60*60, fourteen_date, YYYY_MM_DD_DATE );
        convert_time_to_string( statis.cur_time - 30*24*60*60, thirty_date, YYYY_MM_DD_DATE );

        result = dbi_conn_queryf(conn, "select u_number from \"T_User\" where u_e_id = %lld \
            order by u_number", sdr_id );

        if ( result )
        {
            while ( dbi_result_next_row(result) )
            {
                /* 3days online number */                
                memset( corp_user, '\0', sizeof(corp_user) );
                strncpy( corp_user, dbi_result_get_string(result, "u_number"), sizeof(corp_user)-1 );

                rst = dbi_query_long(pconn->conn, "count", "select count(*) \
                    from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld \
                    and sdr_active_flag = 1 and sdr_num = '%s' and sdr_time between '%s' and '%s';", \
                    sdr_id, corp_user, three_date, last_date );

                if ( rst == 3 )
                {
                    pe[ct].sdr_online3_user += 1;
                }

                /* 7days online number */
                rst = dbi_query_long(pconn->conn, "count", "select count(*) \
                    from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld \
                    and sdr_active_flag = 1 and sdr_num = '%s' and sdr_time between '%s' and '%s';", \
                    sdr_id, corp_user, seven_date, last_date );

                if ( rst == 7 )
                {
                    pe[ct].sdr_online7_user += 1;
                }
                
                /* 14days online number */
                rst = dbi_query_long(pconn->conn, "count", "select count(*) \
                    from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld \
                    and sdr_active_flag = 1 and sdr_num = '%s' and sdr_time between '%s' and '%s';", \
                    sdr_id, corp_user, fourteen_date, last_date );

                if ( rst == 14 )
                {
                    pe[ct].sdr_online14_user += 1;
                }

                
                /* 30days online number */
                rst = dbi_query_long(pconn->conn, "count", "select count(*) \
                    from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld \
                    and sdr_active_flag = 1 and sdr_num = '%s' and sdr_time between '%s' and '%s';", \
                    sdr_id, corp_user, thirty_date, last_date );

                if ( rst == 30 )
                {
                    pe[ct].sdr_online30_user += 1;
                }
            }

            dbi_result_free( result );
        }
        
        detach_conn(pconn);
        /*
        pe[ct].sdr_online3_user = dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                     from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and \
                        sdr_time between '%s' and '%s';", sdr_id, tmp, time);
        pe[ct].sdr_online3_user -= dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                     from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and sdr_active_flag = 0 \
                        and sdr_time between '%s' and '%s';", sdr_id, tmp, time);

        memset(tmp, '\0', LEN_64);
        convert_time_to_string(statis.cur_time-7*24*60*60, tmp, 1);

        count_record = dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and \
                sdr_time = '%s' and sdr_active_flag = 1;", sdr_id, tmp);
        
        if ( !count_record ) {
            pe[ct].sdr_online7_user = 0;
            pe[ct].sdr_online14_user = 0;
            pe[ct].sdr_online30_user = 0;
            
            detach_conn(pconn);
            continue;
        }


        pe[ct].sdr_online7_user = dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and \
                sdr_time between '%s' and '%s';", sdr_id, tmp, time);
        pe[ct].sdr_online7_user -= dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and sdr_active_flag = 0 \
                and sdr_time between '%s' and '%s';", sdr_id, tmp, time);

        
        memset(tmp, '\0', LEN_64);
        convert_time_to_string(statis.cur_time-14*24*60*60, tmp, 1);

        count_record = dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and \
                sdr_time = '%s'and sdr_active_flag = 1;", sdr_id, tmp);
        
        if ( !count_record ) {
            pe[ct].sdr_online14_user = 0;
            pe[ct].sdr_online30_user = 0;
            
            detach_conn(pconn);
            continue;
        }



        pe[ct].sdr_online14_user = dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and \
                sdr_time between '%s' and '%s';", sdr_id, tmp, time);
        pe[ct].sdr_online14_user -= dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and sdr_active_flag = 0 \
                and sdr_time between '%s' and '%s';", sdr_id, tmp, time);

        
        memset(tmp, '\0', LEN_64);
        convert_time_to_string(statis.cur_time-30*24*60*60, tmp, 1);
        
        count_record = dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and \
                sdr_time = '%s'and sdr_active_flag = 1;", sdr_id, tmp);
        
        if ( !count_record ) {
            pe[ct].sdr_online30_user = 0;
            
            detach_conn(pconn);
            continue;
        }

        pe[ct].sdr_online30_user = dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and \
                sdr_time between '%s' and '%s';", sdr_id, tmp, time);
        pe[ct].sdr_online30_user -= dbi_query_long(pconn->conn, "count", "select count(distinct sdr_num) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld and sdr_active_flag = 0 \
                and sdr_time between '%s' and '%s';", sdr_id, tmp, time);
        */
    }

    log_uss_stats(pe, mod->emp_record);

    return;
}

static void calc_amp_uss(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0, st = 0;
    dbi_result result = 0;
    ST_USS *pa = NULL;
    ST_USS *pe = NULL;
    long long rst = 0;
    
    logRecord( LOG_INFO, "%s(%d): cal amp, interval:%d", __FUNCTION__, __LINE__, interval );

    pa = (ST_USS *)mod->amp_array;
    pe = (ST_USS *)mod->emp_array;

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

    for (ct = 0; ct < mod->emp_record; ct++) {
        pa[0].sdr_cumulative_users += pe[ct].sdr_cumulative_users;
        pa[0].sdr_loss_user += pe[ct].sdr_loss_user;
        pa[0].sdr_survival_user += pe[ct].sdr_survival_user;
        pa[0].sdr_online_user += pe[ct].sdr_online_user;
        pa[0].sdr_offline_user += pe[ct].sdr_offline_user;
        pa[0].sdr_online3_user += pe[ct].sdr_online3_user;
        pa[0].sdr_online7_user += pe[ct].sdr_online7_user;
        pa[0].sdr_online14_user += pe[ct].sdr_online14_user;
        pa[0].sdr_online30_user += pe[ct].sdr_online30_user;
    }

    if (pa[0].sdr_cumulative_users != 0) {
        pa[0].sdr_survival_rate = (F_32)pa[0].sdr_survival_user / pa[0].sdr_cumulative_users;
        pa[0].sdr_active_rate = (F_32)pa[0].sdr_online_user / pa[0].sdr_cumulative_users;
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
                        pa[st].sdr_cumulative_users += pe[ct].sdr_cumulative_users;
                        pa[st].sdr_loss_user += pe[ct].sdr_loss_user;
                        pa[st].sdr_survival_user += pe[ct].sdr_survival_user;
                        pa[st].sdr_online_user += pe[ct].sdr_online_user;
                        pa[st].sdr_offline_user += pe[ct].sdr_offline_user;
                        pa[st].sdr_online3_user += pe[ct].sdr_online3_user;
                        pa[st].sdr_online7_user += pe[ct].sdr_online7_user;
                        pa[st].sdr_online14_user += pe[ct].sdr_online14_user;
                        pa[st].sdr_online30_user += pe[ct].sdr_online30_user;

                        break;
                    }
                }
                if (pa[st].sdr_cumulative_users != 0) {
                    pa[st].sdr_survival_rate = (F_32)pa[st].sdr_survival_user / pa[st].sdr_cumulative_users;
                    pa[st].sdr_active_rate = (F_32)pa[st].sdr_online_user / pa[st].sdr_cumulative_users;
                }
                //st++;
            }
            dbi_result_free(result);
        }
    }

    //log_uss_stats(pa, mod->amp_record);

    return;
}

static int set_uss_record(struct module *mod)
{
	int	j, k;
	char	line[LEN_4096] = {0};
	char	tmp[LEN_2048] = {0};
    char sdr_id_field[LEN_64] = { '\0' };
    ST_USS *pe = NULL;
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
            sprintf(tmp, "'%lld','%s','%s','%lld','%lld','%lld','%lld','%2.2f','%lld','%lld',\
                    '%2.2f','%lld','%lld', '%lld', '%lld');",
                    pe[j].sdr_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_date_flag,
                    pe[j].sdr_cumulative_users, pe[j].sdr_loss_user,
                    pe[j].sdr_survival_user, pe[j].sdr_survival_rate,
                    pe[j].sdr_online_user, pe[j].sdr_offline_user,
                    pe[j].sdr_active_rate, pe[j].sdr_online3_user,
                    pe[j].sdr_online7_user, pe[j].sdr_online14_user,
                    pe[j].sdr_online30_user);

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
            sprintf(tmp, "'%s','%s','%s','%lld','%lld','%lld','%lld','%2.2f','%lld','%lld',\
                    '%2.2f','%lld','%lld', '%lld', '%lld');",
                    pe[j].sdr_amp_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_date_flag,
                    pe[j].sdr_cumulative_users, pe[j].sdr_loss_user,
                    pe[j].sdr_survival_user, pe[j].sdr_survival_rate,
                    pe[j].sdr_online_user, pe[j].sdr_offline_user,
                    pe[j].sdr_active_rate, pe[j].sdr_online3_user,
                    pe[j].sdr_online7_user, pe[j].sdr_online14_user,
                    pe[j].sdr_online30_user);

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

static void calc_emp_uss_record(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0;
    char start_time[LEN_32];
    dbi_result result = 0;
    ST_USS *pe = NULL;
    tDBConn *pconn = NULL;
    
    logRecord( LOG_INFO, "%s(%d): cal week or month, interval:%d", __FUNCTION__, __LINE__, interval );

    pe = (ST_USS *)mod->emp_array;

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

        /*
        pe[ct].sdr_cumulative_users += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_cumulative_users) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_loss_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_loss_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_survival_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_survival_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);

        if (pe[ct].sdr_cumulative_users != 0)
            pe[ct].sdr_survival_rate = (F_32)pe[ct].sdr_survival_user / pe[ct].sdr_cumulative_users;

        pe[ct].sdr_online_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_online_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_offline_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_offline_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        if (pe[ct].sdr_cumulative_users != 0)
            pe[ct].sdr_active_rate = (F_32)pe[ct].sdr_online_user / pe[ct].sdr_cumulative_users;
        */
        pe[ct].sdr_cumulative_users += dbi_query_long(pconn->conn, "sdr_cumulative_users", "select sdr_cumulative_users \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_loss_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_loss_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_survival_user += dbi_query_long(pconn->conn, "sdr_survival_user", "select sdr_survival_user \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time ='%s';", sdr_id, pe[ct].sdr_time);

        if (pe[ct].sdr_cumulative_users != 0)
            pe[ct].sdr_survival_rate = (F_32)pe[ct].sdr_survival_user / pe[ct].sdr_cumulative_users;

        pe[ct].sdr_online_user += dbi_query_long(pconn->conn, "sdr_online_user", "select sdr_online_user \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_offline_user += dbi_query_long(pconn->conn, "sdr_offline_user", "select sdr_offline_user \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        if (pe[ct].sdr_cumulative_users != 0)
            pe[ct].sdr_active_rate = (F_32)pe[ct].sdr_online_user / pe[ct].sdr_cumulative_users;

        /*
        pe[ct].sdr_online3_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_online3_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_online7_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_online7_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_online14_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_online14_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_online30_user += dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_online30_user) as bigint) \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        */
        
        pe[ct].sdr_online3_user += dbi_query_long(pconn->conn, "sdr_online3_user", "select sdr_online3_user \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_online7_user += dbi_query_long(pconn->conn, "sdr_online7_user", "select sdr_online7_user \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_online14_user += dbi_query_long(pconn->conn, "sdr_online14_user", "select sdr_online14_user \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_online30_user += dbi_query_long(pconn->conn, "sdr_online30_user", "select sdr_online30_user \
            from \"T_UserState_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
    }

    detach_conn(pconn);
    //log_uss_stats(pe, mod->emp_record);

    return;
}

/* The statistical results for cycle */
static void calc_uss_stats(struct module *mod, int interval)
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
        mod->emp_array = calloc(mod->emp_record, STATS_USS_SIZE);
        if (mod->emp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for emp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    /* acquire agents count */
    mod->amp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Agents\";") + 1;
    if (mod->amp_record != 0) {
        mod->amp_array = calloc(mod->amp_record, STATS_USS_SIZE);
        if (mod->amp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for amp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    if (interval == 0) {
        calc_emp_uss_stats(mod, pconn->conn);
    } else {
        calc_emp_uss_record(mod, pconn->conn, interval);
    }
    calc_amp_uss(mod, pconn->conn, interval);

    set_uss_record(mod);

    detach_conn(pconn);
    return;

}

void mod_register(struct module *mod)
{
	register_mod_fileds(mod, 
                        "--uss", 
                        uss_usage, 
                        uss_table, 
                        uss_info, 
                        sizeof(uss_table)/sizeof(struct mod_table), 
                        sizeof(uss_info)/sizeof(struct mod_info), 
                        calc_uss_stats);
}


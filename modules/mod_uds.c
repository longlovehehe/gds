/******************************************************************************

                        版权所有 (C), 2005-2015, ZED-3

 ******************************************************************************
  文 件 名   : mod_uds.c
  版 本 号   : 初稿
  作    者   : andy
  生成日期   : 2016年3月30日
  最近修改   :
  功能描述   :  T_UserData_Statistics_EMP
                T_UserData_Statistics_AMP
                企业数据，AMP数据统计表
  函数列表   :
              calc_amp_uds_stats
              calc_emp_uds_stats
              calc_uds_record
              calc_uds_stats
              log_uds_stats
              mod_register
              set_uds_record
  修改历史   :
  1.日    期   : 2016年3月30日
    作    者   : guanfeng.wang
    修改内容   : 创建文件

******************************************************************************/




#include "gds.h"

/*
 * Structure for test infomation.
 */
typedef struct stats_uds {
    U_64 sdr_id;
    char sdr_amp_id[LEN_32];
    char sdr_record_time[LEN_32];
    char sdr_time[LEN_32];
    U_64 sdr_date_flag;
    U_64 sdr_creat_user;
    U_64 sdr_online_user;
    U_64 sdr_user;
    U_64 sdr_commercial_user;
    U_64 sdr_test_user;
    U_64 sdr_phone_user;
    U_64 sdr_console_user;
    U_64 sdr_gvs_user;
    U_64 sdr_enable_user;
    U_64 sdr_disable_user;
    U_64 sdr_terminal_user;
    U_64 sdr_terminal_user_test;
    U_64 sdr_terminal_user_commercial;
    char sdr_terminal_user_sort[LEN_1024];
    U_64 sdr_gprs_user;
    U_64 sdr_gprs_user_test;
    U_64 sdr_gprs_user_commercial;
}ST_UDS;

static struct mod_table uds_table[] = {
    {0, "T_UserData_Statistics_EMP"},
    {1, "T_UserData_Statistics_AMP"}
};

static struct mod_info uds_info[] = {
    {"sdr_id", U64_BIT,  0,  STATS_NULL},
    {"sdr_amp_id", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_record_time", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_time", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_date_flag", U64_BIT,  0,  STATS_NULL},
    {"sdr_creat_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_online_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_commercial_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_test_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_phone_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_console_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_gvs_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_enable_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_disable_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_terminal_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_terminal_user_test", U64_BIT,  0,  STATS_NULL},
    {"sdr_terminal_user_commercial", U64_BIT,  0,  STATS_NULL},
    {"sdr_terminal_user_sort", U64_BIT,  0,  STATS_NULL},
    {"sdr_gprs_user", U64_BIT,  0,  STATS_NULL},
    {"sdr_gprs_user_test", U64_BIT,  0,  STATS_NULL},
    {"sdr_gprs_user_commercial", U64_BIT,  0,  STATS_NULL}
};

#define STATS_UDS_SIZE (sizeof(struct stats_uds))

static char terminal_type[LEN_1024] = {0};
static char gds_ip[LEN_32] = {0};
static char gds_port[LEN_32] = {0};

static char *uds_usage = "    --uds               UserData Statistics";

static void log_uds_stats(ST_UDS *pe, long long mod_record)
{
    int ct;

    logRecord(LOG_INFO, "%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s\n",
            uds_info[0].hdr, uds_info[1].hdr, uds_info[2].hdr, uds_info[3].hdr, uds_info[4].hdr,
            uds_info[5].hdr, uds_info[6].hdr, uds_info[7].hdr, uds_info[8].hdr,
            uds_info[9].hdr, uds_info[10].hdr, uds_info[11].hdr, uds_info[12].hdr,
            uds_info[13].hdr, uds_info[14].hdr, uds_info[15].hdr, uds_info[16].hdr,
            uds_info[17].hdr, uds_info[18].hdr, uds_info[19].hdr, uds_info[20].hdr,
            uds_info[21].hdr);

    for (ct = 0 ; ct < mod_record; ct++) {
        logRecord(LOG_INFO, "%ld|%s|%s|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%ld|%s|%ld|%ld|%ld\n",
                pe[ct].sdr_id, pe[ct].sdr_record_time, pe[ct].sdr_time, pe[ct].sdr_date_flag,
                pe[ct].sdr_creat_user, pe[ct].sdr_online_user,
                pe[ct].sdr_user, pe[ct].sdr_commercial_user,
                pe[ct].sdr_test_user, pe[ct].sdr_phone_user,
                pe[ct].sdr_console_user, pe[ct].sdr_gvs_user,
                pe[ct].sdr_enable_user, pe[ct].sdr_disable_user,
                pe[ct].sdr_terminal_user, pe[ct].sdr_terminal_user_test,
                pe[ct].sdr_terminal_user_commercial, pe[ct].sdr_terminal_user_sort,
                pe[ct].sdr_gprs_user, pe[ct].sdr_gprs_user_test,
                pe[ct].sdr_gprs_user_commercial);

    }
}


/*****************************************************************************
 函 数 名  : terminal_value_get
 功能描述  : get fixed format string value, string format: 102w:2:3
 输入参数  : char *str :source string,       for example: 102w:2:3
             int *val1: save first number    for example: 2
             int *val2: save second number   for example: 3
 输出参数  : 无
 返 回 值  : static
 
 修改历史      :
  1.日    期   : 2016年5月21日
    修改内容   : 新生成函数

*****************************************************************************/
static int terminal_value_get(char *str, int *val1, int *val2)
{
    if ( !str )     return -1;

    char *p1 = NULL;
    char *p2 = NULL;
    char buf1[64] = { '\0' };
    char buf2[64] = { '\0' };

    if ( (p1 = strchr(str, ':')) )
    {
        if ( (p2 = strrchr(str, ':')) ) 
        {
            *p1 = '\0';
            *p2 = '\0';
            strncpy(buf1, p1 + 1, sizeof(buf1) - 1);
            strncpy(buf2, p2 + 1, sizeof(buf2) - 1);

            *val1 = atoi(buf1);
            *val2 = atoi(buf2);
        }
        else
        {
            *val1 = 0;
            *val2 = 0;

            return  -1;
        }
    }
    else
    {
        *val1 = 0; 
        *val2 = 0;

        return -1;
    }

    return 0;
}


/*****************************************************************************
 函 数 名  : distinct_terminal_type
 功能描述  : drop distinct terminal type, and Sum for the same terminal type
             for example: 102w:0:1,106w:2:3,102w:1:2,106w:2:3
             process result: 102w:1:3,106w:4:6

 输入参数  : const char *terminal_type: terminal type: format:102w:106w:506TF:S8
             char *src : will be process str: format: 102w:0:1,106w:2:3,102w:1:2,106s:2:3                
             char *final_terminal_type: save cal result of terminal type
 输出参数  : 无
 返 回 值  : static
 
 修改历史      :
  1.日    期   : 2016年5月21日
    修改内容   : 新生成函数

*****************************************************************************/
static int distinct_terminal_type(const char *terminal_type, char *src, char *final_terminal_type)
{
    if ( !terminal_type || !src || !final_terminal_type )   return -1;

    char *ptr, *stok, *p, *psrc, *pval, *ptmp;
    char *saveptr;
	char buff[LEN_1024] = {'\0'};
	char tmpsrc[LEN_1024] = {'\0'};
	char tmp[LEN_64] = {'\0'};
    int value1 = 0,  value2 = 0;
    int calval1 = 0, calval2 = 0;

	strncpy(buff, terminal_type, LEN_1024 - 1);
	strncpy(tmpsrc, src, LEN_1024 - 1);

	ptr = buff;
    psrc = tmpsrc;

    while ( (stok = strtok_r(ptr, ":", &saveptr)) )
    {
        calval1 = 0;
        calval2 = 0;
        while ( (p = strstr(psrc, stok)) )
        {

            value1 = 0;
            value2 = 0;
            if ( (pval = strchr(p, ',')) )
            {
                memset( tmp, '\0', sizeof(tmp) );
                strncpy( tmp, p, pval - p);
            }
            else
            {
                memset( tmp, '\0', sizeof(tmp) );
                strncpy( tmp, p, sizeof(tmp) - 1);
            }

            ptmp = strchr(p, ':');
            if ( strncmp(stok, p, ptmp - p) != 0 )
            {
                if ( NULL != pval )
                {
                    psrc = pval + 1;
                    continue;;
                }
                else
                {
                    break;
                }
            }

            terminal_value_get( tmp, &value1, &value2 );

            calval1 += value1;
            calval2 += value2;

            if ( NULL != pval )
            {
                psrc = pval + 1;
            }
            else
            {
                break;
            }
        }

        psrc = tmpsrc;

		strcat(final_terminal_type, stok);
		strcat(final_terminal_type, ":");
		memset(tmp, '\0', LEN_64);

		snprintf(tmp, sizeof(tmp)-1, "%d", calval1);
		strcat(final_terminal_type, tmp);
		strcat(final_terminal_type, ":");
		memset(tmp, '\0', LEN_64);

		snprintf(tmp, sizeof(tmp)-1, "%d", calval2);
		strcat(final_terminal_type, tmp);
		strcat(final_terminal_type, ",");

        ptr = NULL;
    }

    final_terminal_type[strlen(final_terminal_type) - 1] = '\0';

    return  0;
}



static void calc_emp_uds_stats(struct module *mod, dbi_conn conn)
{
    int ct = 0;
    char buff[LEN_1024];
    char tmp[LEN_64];
    char yesterday_date[LEN_64];
    char day_before_yesterday_date[LEN_64];
    //char dev_ip[LEN_32];
    //char dev_port[LEN_32];
    dbi_result result = 0;
    ST_UDS *pe = NULL;
    char *ptr, *saveptr, *stok;
    long long rst = 0;
    tDBConn *pconn = NULL;

    pe = (ST_UDS *)mod->emp_array;

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

    memset( yesterday_date, '\0', sizeof(yesterday_date) );
    memset( day_before_yesterday_date, '\0', sizeof(day_before_yesterday_date) );
    convert_time_to_string( statis.cur_time - 24*60*60, yesterday_date, ZERO_HOUR_DATE );
    convert_time_to_string( statis.cur_time - 2*24*60*60, day_before_yesterday_date, YYYY_MM_DD_DATE );
    
    for (ct = 0; ct < mod->emp_record; ct++)
    {
        long long sdr_id = pe[ct].sdr_id;

        pe[ct].sdr_user = dbi_query_long(conn, "count", "select count(*) from \"T_User\" \
                where u_e_id = %lld;", sdr_id);
        pe[ct].sdr_creat_user += pe[ct].sdr_user;
        pe[ct].sdr_creat_user += dbi_query_long(conn, "sum",
                "select cast(sum(record_total_del_users) as bigint) from \"T_User_record\" \
                where record_eid = %lld and record_time <= '%s';",
                sdr_id, yesterday_date );
        pe[ct].sdr_commercial_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '0' and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_test_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '1' and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_phone_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_sub_type = 1 and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_console_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_sub_type = 2 and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_gvs_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_sub_type = 3 and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_enable_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_active_state = '1' and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_disable_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_active_state = '0' and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_terminal_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where length(u_terminal_type) != 0 and u_e_id = %lld;",
                sdr_id);
        pe[ct].sdr_terminal_user_test = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '1' and length(u_terminal_type) != 0 \
                and u_e_id = %lld;", sdr_id);
        pe[ct].sdr_terminal_user_commercial = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '0' and length(u_terminal_type) != 0 \
                and u_e_id = %lld;", sdr_id);
        pe[ct].sdr_gprs_user = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where length(u_iccid) != 0 and u_iccid in \
                (select g_iccid from \"T_Gprs\") and u_e_id = %lld;", sdr_id);
        pe[ct].sdr_gprs_user_test = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '1' and length(u_iccid) != 0 \
                and u_iccid in (select g_iccid from \"T_Gprs\") and u_e_id = %lld;", sdr_id);
        pe[ct].sdr_gprs_user_commercial = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '0' and length(u_iccid) != 0 \
                and u_iccid in (select g_iccid from \"T_Gprs\") and u_e_id = %lld;", sdr_id);

        /* calc terminal user sort */
        memset(buff, '\0', LEN_1024);
        strncpy(buff, terminal_type, LEN_1024 - 1);
        ptr = buff;
        while((stok = strtok_r(ptr, ":", &saveptr)) != NULL)
        {
            strcat(pe[ct].sdr_terminal_user_sort, stok);
            strcat(pe[ct].sdr_terminal_user_sort, ":");
            memset(tmp, '\0', LEN_64);
            rst = dbi_query_long(conn, "count",
                    "select count(*) from \"T_User\" where u_attr_type = '0' and u_terminal_type = '%s' \
                    and u_e_id = %lld", stok, sdr_id);
            snprintf(tmp, LEN_64-1, "%lld", rst);
            strcat(pe[ct].sdr_terminal_user_sort, tmp);
            strcat(pe[ct].sdr_terminal_user_sort, ":");
            memset(tmp, '\0', LEN_64);
            rst = dbi_query_long(conn, "count",
                    "select count(*) from \"T_User\" where u_attr_type = '1' and u_terminal_type = '%s' \
                    and u_e_id = %lld", stok, sdr_id);
            snprintf(tmp, LEN_64-1, "%lld", rst);
            strcat(pe[ct].sdr_terminal_user_sort, tmp);
            strcat(pe[ct].sdr_terminal_user_sort, ",");

            ptr = NULL;
        }
        pe[ct].sdr_terminal_user_sort[strlen(pe[ct].sdr_terminal_user_sort) - 1] = '\0';

        /* calc sdr online user */
        if ((pconn = attach_conn(GDSDB, gds_ip, gds_port)) == NULL)
        {
            logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
            continue;
        }

        pe[ct].sdr_online_user = dbi_query_long(pconn->conn, "sdr_online_user", "select sdr_online_user \
                from \"T_UserData_Statistics_EMP\" where \"sdr_id\" = %lld and sdr_date_flag = 0 \
                and sdr_time = '%s';", sdr_id, day_before_yesterday_date );

        pe[ct].sdr_online_user += dbi_query_long(pconn->conn, "count", "select count(*) \
                from \"T_UserActiveState_Statistics_EMP\" where sdr_id = %lld \
                and sdr_active_flag = 1 and sdr_time = '%s';", \
                sdr_id, pe[ct].sdr_time );
        
        detach_conn(pconn);

        /*
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

        pe[ct].sdr_online_user += dbi_query_long(pconn->conn, "count", "select count(distinct number) \
                from \"loginrecord_%lld\" where time between '%lld' and '%lld';",
                sdr_id, (statis.cur_time-24*60*60), statis.cur_time);

        detach_conn(pconn);
        */
    }

    log_uds_stats(pe, mod->emp_record);

    return;
}

static void calc_amp_uds(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0, st = 0;
    char buff[LEN_1024];
    char tmp[LEN_64];
    dbi_result result = 0;
    ST_UDS *pa = NULL;
    ST_UDS *pe = NULL;
    char *ptr, *saveptr, *stok;
    long long rst = 0;
    char tmp_sdr_terminal_user_sort[LEN_1024] = { '\0' };

    logRecord( LOG_INFO, "%s:%d interval:%d", __FUNCTION__, __LINE__, interval );

    pa = (ST_UDS *)mod->amp_array;
    pe = (ST_UDS *)mod->emp_array;

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
        pa[0].sdr_user += pe[ct].sdr_user;
        pa[0].sdr_creat_user += pe[ct].sdr_creat_user;
        pa[0].sdr_commercial_user += pe[ct].sdr_commercial_user;
        pa[0].sdr_test_user += pe[ct].sdr_test_user;
        pa[0].sdr_phone_user += pe[ct].sdr_phone_user;
        pa[0].sdr_console_user += pe[ct].sdr_console_user;
        pa[0].sdr_gvs_user += pe[ct].sdr_gvs_user;
        pa[0].sdr_enable_user += pe[ct].sdr_enable_user;
        pa[0].sdr_disable_user += pe[ct].sdr_disable_user;
        pa[0].sdr_terminal_user += pe[ct].sdr_terminal_user;
        pa[0].sdr_terminal_user_test += pe[ct].sdr_terminal_user_test;
        pa[0].sdr_terminal_user_commercial += pe[ct].sdr_terminal_user_commercial;
        pa[0].sdr_gprs_user += pe[ct].sdr_gprs_user;
        pa[0].sdr_gprs_user_test += pe[ct].sdr_gprs_user_test;
        pa[0].sdr_gprs_user_commercial += pe[ct].sdr_gprs_user_commercial;
        pa[0].sdr_online_user += pe[ct].sdr_online_user;
    }

    /* calc terminal user sort */
    memset(buff, '\0', LEN_1024);
    strncpy(buff, terminal_type, LEN_1024 - 1);
    ptr = buff;
    while((stok = strtok_r(ptr, ":", &saveptr)) != NULL)
    {
        strcat(pa[0].sdr_terminal_user_sort, stok);
        strcat(pa[0].sdr_terminal_user_sort, ":");
        memset(tmp, '\0', LEN_64);
        rst = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '0' and u_terminal_type = '%s' \
                and u_e_id in (select e_id from \"T_Enterprise\");", stok);
        snprintf(tmp, LEN_64-1, "%lld", rst);
        strcat(pa[0].sdr_terminal_user_sort, tmp);
        strcat(pa[0].sdr_terminal_user_sort, ":");
        memset(tmp, '\0', LEN_64);
        rst = dbi_query_long(conn, "count",
                "select count(*) from \"T_User\" where u_attr_type = '1' and u_terminal_type = '%s' \
                and u_e_id in (select e_id from \"T_Enterprise\");", stok);
        snprintf(tmp, LEN_64-1, "%lld", rst);
        strcat(pa[0].sdr_terminal_user_sort, tmp);
        strcat(pa[0].sdr_terminal_user_sort, ",");

        ptr = NULL;
    }
    pa[0].sdr_terminal_user_sort[strlen(pa[0].sdr_terminal_user_sort) - 1] = '\0';

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

        result = dbi_conn_queryf(conn, "select e_id from \"T_Enterprise\" where \
                e_ag_path like '%s%s%s' order by e_id", "%", pa[st].sdr_amp_id, "%");
                
        memset( tmp_sdr_terminal_user_sort, '\0', sizeof(tmp_sdr_terminal_user_sort) - 1 );
        if (result)
        {
            while(dbi_result_next_row(result)) 
            {
                rst = dbi_result_get_longlong(result, "e_id");
                for (ct = 0; ct < mod->emp_record; ct++)
                {
                    if (rst == pe[ct].sdr_id)
                    {
                        pa[st].sdr_user += pe[ct].sdr_user;
                        pa[st].sdr_creat_user += pe[ct].sdr_creat_user;
                        pa[st].sdr_commercial_user += pe[ct].sdr_commercial_user;
                        pa[st].sdr_test_user += pe[ct].sdr_test_user;
                        pa[st].sdr_phone_user += pe[ct].sdr_phone_user;
                        pa[st].sdr_console_user += pe[ct].sdr_console_user;
                        pa[st].sdr_gvs_user += pe[ct].sdr_gvs_user;
                        pa[st].sdr_enable_user += pe[ct].sdr_enable_user;
                        pa[st].sdr_disable_user += pe[ct].sdr_disable_user;
                        pa[st].sdr_terminal_user += pe[ct].sdr_terminal_user;
                        pa[st].sdr_terminal_user_test += pe[ct].sdr_terminal_user_test;
                        pa[st].sdr_terminal_user_commercial += pe[ct].sdr_terminal_user_commercial;
                        pa[st].sdr_gprs_user += pe[ct].sdr_gprs_user;
                        pa[st].sdr_gprs_user_test += pe[ct].sdr_gprs_user_test;
                        pa[st].sdr_gprs_user_commercial += pe[ct].sdr_gprs_user_commercial;
                        pa[st].sdr_online_user += pe[ct].sdr_online_user;

                        break;
                    }
                }
                
                /* calc terminal user sort */
                memset(buff, '\0', LEN_1024);
                strncpy(buff, terminal_type, LEN_1024 - 1);
                ptr = buff;
                while((stok = strtok_r(ptr, ":", &saveptr)) != NULL)
                {
                    strcat(tmp_sdr_terminal_user_sort, stok);
                    strcat(tmp_sdr_terminal_user_sort, ":");
                    memset(tmp, '\0', LEN_64);
                    
                    rst = dbi_query_long(conn, "count",
                            "select count(*) from \"T_User\" where u_attr_type = '0' and u_terminal_type = '%s' \
                            and u_e_id = '%lld';",
                            stok, pe[ct].sdr_id );
                    snprintf(tmp, LEN_64-1, "%lld", rst);
                    
                    strcat(tmp_sdr_terminal_user_sort, tmp);
                    strcat(tmp_sdr_terminal_user_sort, ":");
                    memset(tmp, '\0', LEN_64);
                    
                    rst = dbi_query_long(conn, "count",
                            "select count(*) from \"T_User\" where u_attr_type = '1' and u_terminal_type = '%s' \
                            and u_e_id = '%lld';",
                            stok, pe[ct].sdr_id );
                    snprintf(tmp, LEN_64-1, "%lld", rst);
                    strcat(tmp_sdr_terminal_user_sort, tmp);
                    strcat(tmp_sdr_terminal_user_sort, ",");

                    ptr = NULL;
                }

                logRecord(LOG_INFO, "e_id:%d-ampID:%s--termsort:%s", rst, pa[st].sdr_amp_id, tmp_sdr_terminal_user_sort);
            }
            dbi_result_free(result);
        }

        /* drop distinct terminal type, and Sum for the same terminal type 
        for example: 102w:1:1,s8:0:2,102w:3:3,Z506:1:2
        process result: 102w:4:4,s8:0:2,Z506:1:2
        */
        distinct_terminal_type( terminal_type, tmp_sdr_terminal_user_sort, pa[st].sdr_terminal_user_sort );
        logRecord(LOG_INFO, "amp_terminal_sort:%s", pa[st].sdr_terminal_user_sort);
    }

    log_uds_stats(pa, mod->amp_record);

    return;
}

static int set_uds_record(struct module *mod)
{
	int	j, k;
	char	line[LEN_4096] = {0};
	char	tmp[LEN_2048] = {0};
    char sdr_id_field[LEN_64] = { '\0' };
    ST_UDS *pe = NULL;
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
                    '%lld','%lld','%lld', '%lld', '%lld', '%lld', '%lld', '%s', '%lld', \
                    '%lld', '%lld');",
                    pe[j].sdr_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_date_flag,
                    pe[j].sdr_creat_user, pe[j].sdr_online_user,
                    pe[j].sdr_user, pe[j].sdr_commercial_user,
                    pe[j].sdr_test_user, pe[j].sdr_phone_user,
                    pe[j].sdr_console_user, pe[j].sdr_gvs_user,
                    pe[j].sdr_enable_user, pe[j].sdr_disable_user,
                    pe[j].sdr_terminal_user, pe[j].sdr_terminal_user_test,
                    pe[j].sdr_terminal_user_commercial, pe[j].sdr_terminal_user_sort,
                    pe[j].sdr_gprs_user, pe[j].sdr_gprs_user_test,
                    pe[j].sdr_gprs_user_commercial);

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
                    '%lld','%lld','%lld', '%lld', '%lld', '%lld', '%lld', '%s', '%lld', \
                    '%lld', '%lld');",
                    pe[j].sdr_amp_id, pe[j].sdr_record_time, pe[j].sdr_time, pe[j].sdr_date_flag,
                    pe[j].sdr_creat_user, pe[j].sdr_online_user,
                    pe[j].sdr_user, pe[j].sdr_commercial_user,
                    pe[j].sdr_test_user, pe[j].sdr_phone_user,
                    pe[j].sdr_console_user, pe[j].sdr_gvs_user,
                    pe[j].sdr_enable_user, pe[j].sdr_disable_user,
                    pe[j].sdr_terminal_user, pe[j].sdr_terminal_user_test,
                    pe[j].sdr_terminal_user_commercial, pe[j].sdr_terminal_user_sort,
                    pe[j].sdr_gprs_user, pe[j].sdr_gprs_user_test,
                    pe[j].sdr_gprs_user_commercial);

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

static void calc_emp_uds_record(struct module *mod, dbi_conn conn, int interval)
{
    int ct = 0;
    //char buff[LEN_1024];
    //char tmp[LEN_64];
    char start_time[LEN_32];
    dbi_result result = 0;
    ST_UDS *pe = NULL;
    //char *ptr, *saveptr, *stok;
    //long long rst = 0;
    tDBConn *pconn = NULL;

    logRecord( LOG_INFO, "%s(%d): cal week or month, interval:%d", __FUNCTION__, __LINE__, interval );

    pe = (ST_UDS *)mod->emp_array;

    logRecord( LOG_INFO, "%s:%d interval:%d", __FUNCTION__, __LINE__, interval );

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
        pe[ct].sdr_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_creat_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_creat_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_commercial_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_commercial_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_test_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_test_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_phone_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_phone_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_console_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_console_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_gvs_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_gvs_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_enable_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_enable_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_disable_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_disable_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        */
        
        pe[ct].sdr_user = dbi_query_long(pconn->conn, "sdr_user", "select sdr_user \
            from \"T_UserData_Statistics_EMP\" where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s' ;", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_creat_user = dbi_query_long(pconn->conn, "sdr_creat_user", "select sdr_creat_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_commercial_user = dbi_query_long(pconn->conn, "sdr_commercial_user", "select sdr_commercial_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time ='%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_test_user = dbi_query_long(pconn->conn, "sdr_test_user", "select sdr_test_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_phone_user = dbi_query_long(pconn->conn, "sdr_phone_user", "select sdr_phone_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_console_user = dbi_query_long(pconn->conn, "sdr_console_user", "select sdr_console_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_gvs_user = dbi_query_long(pconn->conn, "sdr_gvs_user", "select sdr_gvs_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_enable_user = dbi_query_long(pconn->conn, "sdr_enable_user", "select sdr_enable_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_disable_user = dbi_query_long(pconn->conn, "sdr_disable_user", "select sdr_disable_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
            /*
        pe[ct].sdr_terminal_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_terminal_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_terminal_user_test = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_terminal_user_test) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
                and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_terminal_user_commercial = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_terminal_user_commercial) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
            */
            
        pe[ct].sdr_terminal_user = dbi_query_long(pconn->conn, "sdr_terminal_user", "select sdr_terminal_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_terminal_user_test = dbi_query_long(pconn->conn, "sdr_terminal_user_test", "select sdr_terminal_user_test \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
                and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_terminal_user_commercial = dbi_query_long(pconn->conn, "sdr_terminal_user_commercial", "select sdr_terminal_user_commercial \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
            
            /*
        pe[ct].sdr_gprs_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_gprs_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_gprs_user_test = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_gprs_user_test) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
        pe[ct].sdr_gprs_user_commercial = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_gprs_user_commercial) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
            */
            
        pe[ct].sdr_gprs_user = dbi_query_long(pconn->conn, "sdr_gprs_user", "select sdr_gprs_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_gprs_user_test = dbi_query_long(pconn->conn, "sdr_gprs_user_test", "select sdr_gprs_user_test \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        pe[ct].sdr_gprs_user_commercial = dbi_query_long(pconn->conn, "sdr_gprs_user_commercial", "select sdr_gprs_user_commercial \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time ='%s';", sdr_id, pe[ct].sdr_time);
            
        pe[ct].sdr_online_user = dbi_query_long(pconn->conn, "sdr_online_user", "select sdr_online_user \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
            /*      
        pe[ct].sdr_online_user = dbi_query_long(pconn->conn, "sum", "select cast(sum(sdr_online_user) as bigint) \
            from \"T_UserData_Statistics_EMP\"  where sdr_date_flag = 0 and sdr_id = %lld \
            and sdr_time between '%s' and '%s';", sdr_id, start_time, pe[ct].sdr_time);
            */

        /* calc terminal user sort */
        dbi_query_string(pconn->conn, pe[ct].sdr_terminal_user_sort, sizeof(pe[ct].sdr_terminal_user_sort), \
            "sdr_terminal_user_sort", "select sdr_terminal_user_sort from \"T_UserData_Statistics_EMP\" \
            where sdr_date_flag = 0 and sdr_id = %lld and sdr_time = '%s';", sdr_id, pe[ct].sdr_time);
        /*
        memset(buff, '\0', LEN_1024);
        strncpy(buff, terminal_type, LEN_1024 - 1);
        ptr = buff;
        while((stok = strtok_r(ptr, ":", &saveptr)) != NULL)
        {
            strcat(pe[ct].sdr_terminal_user_sort, stok);
            strcat(pe[ct].sdr_terminal_user_sort, ":");
            memset(tmp, '\0', LEN_64);
            rst = dbi_query_long(conn, "count",
                    "select count(*) from \"T_User\" where u_attr_type = '0' and u_terminal_type = '%s' \
                    and u_e_id = %lld", stok, sdr_id);
            snprintf(tmp, LEN_64-1, "%lld", rst);
            strcat(pe[ct].sdr_terminal_user_sort, tmp);
            strcat(pe[ct].sdr_terminal_user_sort, ":");
            memset(tmp, '\0', LEN_64);
            rst = dbi_query_long(conn, "count",
                    "select count(*) from \"T_User\" where u_attr_type = '1' and u_terminal_type = '%s' \
                    and u_e_id = %lld", stok, sdr_id);
            snprintf(tmp, LEN_64-1, "%lld", rst);
            strcat(pe[ct].sdr_terminal_user_sort, tmp);
            strcat(pe[ct].sdr_terminal_user_sort, ",");

            ptr = NULL;
        }
        pe[ct].sdr_terminal_user_sort[strlen(pe[ct].sdr_terminal_user_sort) - 1] = '\0';
        */
    }

    detach_conn(pconn);
    log_uds_stats(pe, mod->emp_record);

    return;
}

/* The statistical results for cycle */
static void calc_uds_stats(struct module *mod, int interval)
{
    dbi_result result = 0;
    tDBConn *pconn = NULL;

    logRecord( LOG_INFO, "%s:%d interval:%d", __FUNCTION__, __LINE__, interval );
    if ((pconn = attach_conn(OMPDB, conf.server_addr, conf.server_port)) == NULL)
    {
        logRecord(LOG_ERR, "%s(%d): failed to get db conn\n", __FUNCTION__, __LINE__);
        return ;
    }

    /* get all the terminal type */
    result = dbi_conn_queryf(pconn->conn, "select tt_type from \"T_TerminalType\";");
    if (result) {
        memset( terminal_type, '\0', sizeof(terminal_type) );
        while (dbi_result_next_row(result)) {
            strcat(terminal_type, dbi_result_get_string(result, "tt_type"));
            strcat(terminal_type, ":");
        }
        terminal_type[strlen(terminal_type) - 1] = '\0';
        dbi_result_free(result);
    }
    logRecord(LOG_INFO, "%s(%d): terminal_type:%s\n", __FUNCTION__, __LINE__, terminal_type);

    sscanf(conf.output_db_addr, "%[^:]:%s", gds_ip, gds_port);
    logRecord(LOG_INFO, "%s(%d): gds ip:%s port:%s!", __FUNCTION__, __LINE__,
                        gds_ip, gds_port);

    /* acquire enterprise count */
    mod->emp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Enterprise\";");
    if (mod->emp_record != 0) {
        mod->emp_array = calloc(mod->emp_record, STATS_UDS_SIZE);
        if (mod->emp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for emp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    /* acquire agents count */
    mod->amp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_Agents\";") + 1;
    if (mod->amp_record != 0) {
        mod->amp_array = calloc(mod->amp_record, STATS_UDS_SIZE);
        if (mod->amp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for amp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    if (interval == 0) {
        calc_emp_uds_stats(mod, pconn->conn);
    } else {
        calc_emp_uds_record(mod, pconn->conn, interval);
    }
    calc_amp_uds(mod, pconn->conn, interval);

    set_uds_record(mod);

    detach_conn(pconn);
    return;
}


void mod_register(struct module *mod)
{
	register_mod_fileds(mod, 
                        "--uds", 
                        uds_usage, 
                        uds_table, 
                        uds_info, 
                        sizeof(uds_table)/sizeof(struct mod_table), 
                        sizeof(uds_info)/sizeof(struct mod_info), 
                        calc_uds_stats);
}


/******************************************************************************

                        版权所有 (C), 2005-2015, ZED-3

 ******************************************************************************
  文 件 名   : mod_uas.c
  版 本 号   : 初稿
  作    者   : andy
  生成日期   : 2016年3月30日
  最近修改   :
  功能描述   :  T_UserActiveState_Statistics_EMP
                企业用户在线状态统计表
  函数列表   :
              calc_amp_uas_stats
              calc_emp_uas_stats
              calc_uas_record
              calc_uas_stats
              log_uas_stats
              mod_register
              set_uas_record
  修改历史   :
  1.日    期   : 2016年3月30日
    作    者   : guanfeng.wang
    修改内容   : 创建文件

******************************************************************************/





#include "gds.h"

#define USER_ONLINE             1
#define USER_OFFLINE            2

#define USER_STATUS_ACTIVITY    1
#define USER_STATUS_INACTIVITY  0
#define USER_NOT_EXIST          -1

/*
 * Structure for test infomation.
 */
typedef struct stats_uas {
    U_64 sdr_id;
    char sdr_time[LEN_32];
    U_64 sdr_num;
    U_64 sdr_online_times;
    U_64 sdr_offline_times;
    U_32 sdr_active_flag;
}ST_UAS;

static struct mod_table uas_table[] = {
    {0, "T_UserActiveState_Statistics_EMP"}
};

static struct mod_info uas_info[] = {
    {"sdr_id", U64_BIT,  0,  STATS_NULL},
    {"sdr_time", CHARS_BIT,  0,  STATS_NULL},
    {"sdr_num", U64_BIT,  0,  STATS_NULL},
    {"sdr_online_times", U64_BIT,  0,  STATS_NULL},
    {"sdr_offline_times", U64_BIT,  0,  STATS_NULL},
    {"sdr_active_flag", U64_BIT,  0,  STATS_NULL},
};


#define STATS_UAS_SIZE (sizeof(struct stats_uas))

static char gds_ip[LEN_32] = {0};
static char gds_port[LEN_32] = {0};

static char *uas_usage = "    --uas               UserActiveStats Statistics";

static void log_uas_stats(ST_UAS *pe, long long mod_record)
{
    int ct;

    logRecord(LOG_INFO, "%s|%s|%s|%s|%s|%s\n", uas_info[0].hdr, uas_info[1].hdr,
            uas_info[2].hdr, uas_info[3].hdr, uas_info[4].hdr, uas_info[5].hdr);

    for (ct = 0 ; ct < mod_record; ct++) {
        logRecord(LOG_INFO, "%ld|%s|%ld|%ld|%ld|%d\n", pe[ct].sdr_id, pe[ct].sdr_time,
                pe[ct].sdr_num, pe[ct].sdr_online_times, pe[ct].sdr_offline_times,
                pe[ct].sdr_active_flag);

    }
}


static void calc_emp_uas_stats(struct module *mod, dbi_conn conn)
{
    int ct = 0;
    char dev_ip[LEN_32];
    char dev_port[LEN_32];
    dbi_result result = 0;
    ST_UAS *pe = NULL;
    tDBConn *pconn = NULL;
    int     user_status = -1;

    pe = (ST_UAS *)mod->emp_array;

    /* acquire every enterprise id */
    result = dbi_conn_queryf(conn, "select u_number, u_e_id from \"T_User\" order by u_e_id");
    if (result) {
        while(dbi_result_next_row(result)) {
            pe[ct].sdr_num = atoll(dbi_result_get_string(result, "u_number"));
            pe[ct].sdr_id = dbi_result_get_longlong(result, "u_e_id");
            convert_time_to_string(statis.cur_time - 24*60*60, pe[ct].sdr_time, 1);
            ct++;
        }
        dbi_result_free(result);
    }

    logRecord(LOG_INFO, "%s(%d) uas start cal...", __FUNCTION__, __LINE__ );
    for (ct = 0; ct < mod->emp_record; ct++)
    {
        long long sdr_id = pe[ct].sdr_id;
        long long sdr_num = pe[ct].sdr_num;

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
            logRecord(LOG_ERR, "%s(%d): failed to get SSdb conn, ssip(%s)-ssport(%s).\n", \
                __FUNCTION__, __LINE__, dev_ip, dev_port );
            continue;
        }

        pe[ct].sdr_online_times = dbi_query_long(pconn->conn, "count", "select count(*) \
                from \"loginrecord_%lld\" where time between '%lld' and '%lld' \
                and type = 1 and number = '%lld';",
                sdr_id, (statis.cur_time-24*60*60), statis.cur_time, sdr_num);

        pe[ct].sdr_offline_times = dbi_query_long(pconn->conn, "count", "select count(*) \
                from \"loginrecord_%lld\" where time between '%lld' and '%lld' \
                and type = 2 and number = '%lld';",
                sdr_id, (statis.cur_time-24*60*60), statis.cur_time, sdr_num);

        /*
        if (pe[ct].sdr_online_times != 0 || pe[ct].sdr_offline_times != 0)
            pe[ct].sdr_active_flag = 1;
        */
        if ( (pe[ct].sdr_online_times > 0) || (pe[ct].sdr_offline_times > 0) )
        {
            pe[ct].sdr_active_flag = 1;
        }
        else
        {
            /* not find yesterday user status, 
            * need look up user last status in loginrecord_e_id, 
            */
            user_status = dbi_query_long( pconn->conn, "type", "select type \
                from \"loginrecord_%lld\" where number='%lld' order by time desc limit 1;", \
                sdr_id, sdr_num );
            if ( user_status == USER_ONLINE )
            {
                pe[ct].sdr_active_flag = USER_STATUS_ACTIVITY;
            }
            else if ( user_status == USER_OFFLINE )
            {
                pe[ct].sdr_active_flag = USER_STATUS_INACTIVITY;
            }
            else
            {
                pe[ct].sdr_active_flag = USER_STATUS_INACTIVITY;
            }
        }

        detach_conn(pconn);
    }
    logRecord(LOG_INFO, "%s(%d) uas end cal...", __FUNCTION__, __LINE__ );


    //log_uas_stats(pe, mod->emp_record);

    return;
}

static int set_uas_record(struct module *mod)
{
	int	j, k;
	char	line[LEN_4096] = {0};
	char	tmp[LEN_2048] = {0};
    ST_UAS *pe = NULL;
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
            for (k = 0; k < mod->n_col; k++) {
                memset(tmp, '\0', LEN_2048);
                sprintf(tmp, "\"%s\",", mod->info[k].hdr);
                strcat(line, tmp);
            }
            line[strlen(line) - 1] = ')';
            strcat(line, "values(");
            memset(tmp, '\0', LEN_2048);
            sprintf(tmp, "'%lld','%s', '%lld','%lld','%lld','%d');",
                    pe[j].sdr_id, pe[j].sdr_time, pe[j].sdr_num,
                    pe[j].sdr_online_times, pe[j].sdr_offline_times,
                    pe[j].sdr_active_flag);

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
/* The statistical results of the day */
static void calc_uas_stats(struct module *mod, int interval)
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

    /* acquire user count */
    mod->emp_record = dbi_query_long(pconn->conn, "count", "select count(*) from \"T_User\";");
    if (mod->emp_record != 0) {
        mod->emp_array = calloc(mod->emp_record, STATS_UAS_SIZE);
        if (mod->emp_array == NULL) {
            logRecord(LOG_ERR, "%s(%d): calloc for emp_array error!\n", __FUNCTION__, __LINE__);
            detach_conn(pconn);
            return;
        }
    }

    calc_emp_uas_stats(mod, pconn->conn);

    set_uas_record(mod);

    detach_conn(pconn);
    return;
}


void mod_register(struct module *mod)
{
	register_mod_fileds(mod,
                        "--uas",
                        uas_usage,
                        uas_table,
                        uas_info, 
                        sizeof(uas_table)/sizeof(struct mod_table), 
                        sizeof(uas_info)/sizeof(struct mod_info), 
                        calc_uas_stats);
}


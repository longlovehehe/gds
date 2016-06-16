#include "gds.h"

static pthread_mutex_t  logLock = PTHREAD_MUTEX_INITIALIZER;

static void timeGet(char *tbuf, int buflen)
{
    int     len = 0;
    char    timeTmp[80] = {0};
    struct timeval  tv;
    struct timezone tz;

    if (gettimeofday(&tv, &tz) == 0)
    {
        ctime_r(&(tv.tv_sec), timeTmp);               /* conver calendar time to local time */

        len = strlen(timeTmp) - 6;
        snprintf(timeTmp + len, sizeof(timeTmp), ".%06lu", tv.tv_usec);
        snprintf(tbuf, buflen, "[%s] ", timeTmp);
    }

    return ;
}


int logProcess(int level, const char *errinfo)
{
#ifdef DEBUG
    fprintf(stderr, "%s", errinfo);
    fflush(stderr);
#else
    int     fd = -1;
    int     ret = 0;
    char    filename[LEN_64] = {0};
    char    file_bak[LEN_64] = {0};

    struct stat sgbuf;
    pthread_mutex_lock(&logLock);

    strncpy(filename, LOG_FILE_DIR, sizeof(filename) - 1);
    strncat(filename, LOG_FILE, sizeof(filename) - strlen(LOG_FILE_DIR) - 1);
    filename[sizeof(filename) - 1] = '\0';
    snprintf(file_bak, sizeof(file_bak)-1, "%s%s", LOG_FILE_DIR, LOG_FILE_BAK);

    ret = access(filename, F_OK);
    if(ret == 0)
    {
        ret = stat(filename, &sgbuf);
        if(ret < 0)
        {
            pthread_mutex_unlock(&logLock);
            return -1;
        }
        if(sgbuf.st_size > LOG_FILE_MAX_SIZE)
        {
            remove(file_bak);
            rename(filename, file_bak);
        }
    }
    fd = open(filename, O_WRONLY | O_CREAT | O_APPEND, 644);
    if(fd < 0)
    {
        pthread_mutex_unlock(&logLock);
        return -1;
    }
    write(fd, errinfo, strlen(errinfo));
    close(fd);
    pthread_mutex_unlock(&logLock);
#endif
    return 0;
}


int logRecord(log_level_t level, const char *fmt, ...)
{
    int         ret = 0;
    char        realTime[LEN_128]  = {0};
    char        logInfo[LEN_1024] = {0};
    va_list     ap;

	if (level >= conf.debug_level) {
        va_start(ap, fmt);
        timeGet(realTime, sizeof(realTime));

        strncpy(logInfo, realTime, sizeof(logInfo) - 1);
        vsnprintf(logInfo + strlen(realTime), sizeof(logInfo) - strlen(realTime) - 1, fmt, ap);

        if (logInfo[strlen(logInfo) - 1] == '\n')
        {
            ret = logProcess(level, logInfo);
            if (ret < 0)
            {
                return -1;
            }
        }
        else
        {
            strncat(logInfo, "\n", 1);
            ret = logProcess(level, logInfo);
            if (ret < 0)
            {
                return -1;
            }
        }
        va_end(ap);
	}

	if (level == LOG_FATAL) {
		return -1;
    }

    return 0;
}

void log_mods()
{
    int i = 0;
    log_level_t level = LOG_DEBUG;

    logRecord(level, "%s(%d): -------------load mods --------------------\n", __FUNCTION__, __LINE__);
    logRecord(level, "%s(%d): total_mod_num:[%d]\n", __FUNCTION__, __LINE__, statis.total_mod_num);
    for (i = 0; i < statis.total_mod_num; i++) {
        struct module *mod = &mods[i];
        logRecord(level, "%s(%d): mod[%d]->name:[%s]\n", __FUNCTION__,
                __LINE__, i, mod->name);
    }

    logRecord(level, "%s(%d): -------------------------------------------\n", __FUNCTION__, __LINE__);
}

void log_config()
{
    log_level_t level = LOG_DEBUG;

    logRecord(level, "%s(%d): -------------parse config -----------------\n", __FUNCTION__, __LINE__);

    logRecord(level, "%s(%d): running_mode:[%d]\n", __FUNCTION__, __LINE__, conf.running_mode);
    logRecord(level, "%s(%d): config_file:[%s]\n", __FUNCTION__, __LINE__, conf.config_file);
    logRecord(level, "%s(%d): debug_level:[%ud]\n", __FUNCTION__, __LINE__, conf.debug_level);
    logRecord(level, "%s(%d): output_interface:[%s]\n", __FUNCTION__, __LINE__, conf.output_interface);
    logRecord(level, "%s(%d): output_stdio_mod:[%s]\n", __FUNCTION__, __LINE__, conf.output_stdio_mod);
    logRecord(level, "%s(%d): output_db_mod:[%s]\n", __FUNCTION__, __LINE__, conf.output_db_mod);
    logRecord(level, "%s(%d): output_db_addr:[%s]\n", __FUNCTION__, __LINE__, conf.output_db_addr);
    logRecord(level, "%s(%d): server_addr:[%s]\n", __FUNCTION__, __LINE__, conf.server_addr);
    logRecord(level, "%s(%d): server_port:[%s]\n", __FUNCTION__, __LINE__, conf.server_port);
    logRecord(level, "%s(%d): cycle_time:[%d]\n", __FUNCTION__, __LINE__, *conf.cycle_time);
    logRecord(level, "%s(%d): output_file_path:[%s]\n", __FUNCTION__, __LINE__, conf.output_file_path);

    logRecord(level, "%s(%d): -------------------------------------------\n", __FUNCTION__, __LINE__);
}


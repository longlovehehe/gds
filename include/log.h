#ifndef _LOG_H
#define _LOG_H

#define LOG_FILE_DIR        "/var/log/"
#define LOG_FILE            "gds.log"
#define LOG_FILE_BAK        "gds.log.bak"

#define LOG_FILE_MAX_SIZE   100000000            /* 100M */

typedef enum
{
	LOG_INFO,
	LOG_DEBUG,
	LOG_WARN,
	LOG_ERR,
	LOG_FATAL
} log_level_t;


int logRecord(log_level_t level, const char *fmt, ...);
void log_mods();
void log_config();

#endif

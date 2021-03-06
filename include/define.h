#ifndef _DEFINE_H
#define _DEFINE_H
/*
 * useful define
 */

#define U_BIT		3

#define	U_64		long long
#define	U_32		int
#define  F_32     float

#define LEN_32		32
#define LEN_64		64
#define LEN_128		128
#define LEN_256		256
#define LEN_512		512
#define LEN_1024	1024
#define LEN_2048	2048
#define LEN_4096	4096

#define MAX_COL_NUM	15
#define MAX_MOD_NUM	32

#define SECTION_SPLIT   "|"
#define STRING_SPLIT    ":"
#define ITEM_SPLIT	";"
#define ITEM_SPSTART	"="
#define DATA_SPLIT	","
#define HDR_SPLIT	"#"
#define PRINT_DATA_SPLIT "  "
#define PRINT_SEC_SPLIT	" "
#define W_SPACE		" \t\r\n"


#define DEFAULT_PRINT_NUM	20
#define DEFAULT_PRINT_INTERVAL	5

#define MOD_INFO_SIZE		sizeof(strcut mod_info)

#define DEFAULT_CONF_FILE_PATH		"/usr/local/gds/conf/gds.conf"
#define DEFAULT_OUTPUT_FILE_PATH	"/var/log/gds.data"
#define MIN_STRING "MIN:        "
#define MEAN_STRING "MEAN:       "
#define MAX_STRING "MAX:        "

#define TRUE 1
#define FALSE 0

#define VMSTAT "/proc/vmstat"
#define STAT "/proc/stat"
#define MEMINFO "/proc/meminfo"
#define LOADAVG "/proc/loadavg"
#define NET_DEV "/proc/net/dev"
#define NET_SNMP "/proc/net/snmp"
#define APACHERT "/tmp/apachert.mmap"
#define TCP "/proc/net/tcp"
#define NETSTAT "/proc/net/netstat"

enum {
	MERGE_NOT,
	MERGE_ITEM
};


enum {
	RUN_NULL,
	RUN_LIST,
	RUN_CRON,
	RUN_PRINT,
	RUN_PRINT_LIVE,
};


enum {
	DATA_NULL,
	DATA_SUMMARY,
	DATA_DETAIL,
	DATA_ALL
};


enum {
	TAIL_NULL,
	TAIL_MAX,
	TAIL_MEAN,
	TAIL_MIN
};


enum {
	OUTPUT_NULL,
	OUTPUT_PRINT,
	OUTPUT_NAGIOS
};


enum {
	CHARS_BIT,
	U64_BIT,
	DOUBLE_BIT
};


enum {
	MERGE_NULL,
	MERGE_SUM,
	MERGE_AVG
};


enum {
	STATS_NULL,
	STATS_SUB,
	STATS_SUB_INTER
};

#endif

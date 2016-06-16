#include "gds.h"


#define TIME_INTERVAL_HOUR      1
#define TIME_INTERVAL_SECOND    (TIME_INTERVAL_HOUR * 60*60)

struct statistic statis;
struct configure conf;
struct module mods[MAX_MOD_NUM];

static void set_core_dump()
{
    struct rlimit   core_dump;

    memset(&core_dump, 0, sizeof(core_dump));
    core_dump.rlim_cur = RLIM_INFINITY;
    core_dump.rlim_max = RLIM_INFINITY;

    if (setrlimit(RLIMIT_CORE, &core_dump)) {
        logRecord(LOG_FATAL, "%s(%d): Fail setting core dump limit to RLIM_INFINITY\n",
                __FUNCTION__, __LINE__);
    }
}

void usage()
{
    int i;
    struct module *mod;

    fprintf(stderr,
            "Usage: gds [options]\n"
            "Options:\n"
            "    --cron/-c      run in cron mode, output data to file\n"
            "    --interval/-i  specify intervals numbers, in minutes if with --live, it is in seconds\n"
            "    --list/-L      list enabled modules\n"
            "    --live/-l      running print live mode, which module will print\n"
            "    --time/-t      show the value for time (default: 1)\n"
            "    --help/-h      help\n");

    fprintf(stderr,
            "Modules Enabled:\n"
            );

    for (i = 0; i < statis.total_mod_num; i++) {
        mod = &mods[i];
        if(mod->usage) {
            fprintf(stderr, "%s", mod->usage);
            fprintf(stderr, "\n");
        }
    }

    exit(0);
}

struct option longopts[] = {
    { "cron", no_argument, NULL, 'c' },
    { "interval", required_argument, NULL, 'i' },
    { "list", no_argument, NULL, 'L' },
    { "live", no_argument, NULL, 'l' },
    { "time", no_argument, NULL, 't' },
    { "help", no_argument, NULL, 'h'},
    { 0, 0, 0, 0 },
};

static void main_init(int argc, char *argv[])
{
    int opt, oind = 0;

    while ((opt = getopt_long(argc, argv, ":ci:Ll:h", longopts, NULL)) != -1) {
        oind++;
        switch (opt) {
            case 'c':
                conf.running_mode = RUN_CRON;
                break;
            case 'i':
                conf.print_interval = atoi(optarg);
                oind++;
                break;
            case 'L':
                conf.running_mode = RUN_LIST;
                break;
            case 'l':
                conf.running_mode = RUN_PRINT;
                break;
            case 'h':
                usage();
            case ':':
                usage();
            case '?':
                if (argv[oind] && strstr(argv[oind], "--")) {
                    strcat(conf.output_print_mod, argv[oind]);
                    strcat(conf.output_print_mod, DATA_SPLIT);
                } else {
                    usage();
                }
        }
    }

    /* set default parameter */
    if (!conf.print_ndays)
        conf.print_ndays = 1;

    if (!conf.print_interval)
        conf.print_interval = DEFAULT_PRINT_INTERVAL;

    if (RUN_NULL == conf.running_mode)
        conf.running_mode = RUN_CRON;

    strcpy(conf.config_file, DEFAULT_CONF_FILE_PATH);
    if (access(conf.config_file, F_OK)) {
        logRecord(LOG_FATAL, "%s(%d):main_init: can't find gds.conf", __FUNCTION__, __LINE__);
    }

}

void shut_down()
{
    free_modules();

    memset(&statis, '\0', sizeof(struct statistic));
    memset(&conf, '\0', sizeof(struct configure));
    memset(&mods, '\0', sizeof(struct module) * MAX_MOD_NUM);

    dbi_shutdown();
    
    logRecord( LOG_INFO, "%s: GQT-GDS finish work", __FUNCTION__ );
    
    return ;
}

void running_list()
{
    int i;
    struct module *mod;

    printf("gds enable follow modules:\n");

    for (i = 0; i < statis.total_mod_num; i++) {
        mod = &mods[i];
        //printf("     %s\n", mod->name +4);
    }
}

void running_cron()
{
	/* output interface */
    struct module *mod = NULL;
    int i, days = 0;
    struct tm p_tm;
    memset( &p_tm, 0, sizeof(struct tm) );

    localtime_r(&statis.cur_time, &p_tm);
    if (p_tm.tm_mon == 0) {
        days = get_days_in_month(p_tm.tm_year + 1899, 12);
    } else {
        days = get_days_in_month(p_tm.tm_year + 1900, p_tm.tm_mon);
    }

    logRecord(LOG_DEBUG, "%s(%d):p_tm->tm_wday(week): %d---p_tm->tm_mday(month):%d", 
        __FUNCTION__, __LINE__, p_tm.tm_wday, p_tm.tm_mday);
    
    for (i = 0; i < statis.total_mod_num; i++) {
        mod = &mods[i];
        if (!mod->enable)
            continue;

        if (mod->data_collect) {
            mod->data_collect(mod, 0);

            if (p_tm.tm_wday == 1) {
                mod->data_collect(mod, 7);
            }

            if (p_tm.tm_mday == 1) {
                mod->data_collect(mod, days);
            }
            
        }
        
    }

    return ;
}

void DB_init(void)
{
    dbi_initialize(NULL);
    
    return ;
}


int main(int argc, char *argv[])
{
    logRecord( LOG_INFO, "%s: GQT-GDS start work", __FUNCTION__ );
    
    set_core_dump();

    parse_config_file(DEFAULT_CONF_FILE_PATH);

    load_modules();

    DB_init();

    statis.cur_time = time(NULL) - TIME_INTERVAL_SECOND;

    main_init(argc, argv);

	/*
	 * enter running
	 */
	switch (conf.running_mode) {
		case RUN_LIST:
			running_list();
			break;

		case RUN_CRON:
			running_cron();
			break;
		case RUN_PRINT:
			/* reload module by output_stdio_mod and output_print_mod*/
			reload_modules(conf.output_stdio_mod);
			reload_modules(conf.output_print_mod);
			/* disable module when n_col is zero */
			disable_col_zero();

			running_print();
			break;

		default:
			break;
	}

	shut_down();
	return 0;
}

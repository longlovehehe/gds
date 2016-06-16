#ifndef _GDS_H
#define _GDS_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <stdarg.h>
#include <time.h>
#include <dlfcn.h>
#include <errno.h>
#include <signal.h>
#include <getopt.h>
#include <ctype.h>
#include <fcntl.h>
#include <pthread.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <sys/stat.h>
#include <sys/time.h>
#include <sys/resource.h>

#include "framework.h"
#include "log.h"
#include "config.h"

#include "output_file.h"
#include "output_print.h"
#include "output_db.h"
#include "common.h"

struct statistic
{
    int total_mod_num;
    time_t cur_time;
};

extern struct configure conf;
extern struct module    mods[MAX_MOD_NUM];
extern struct statistic statis;

//extern tDBConnPool

#endif

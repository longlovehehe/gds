#ifndef _CONFIG_H_
#define _CONFIG_H_

#include "define.h"

/*
 * gds config file interface
 */

struct configure
{
	/* from arg */
	int	running_mode;	/* running mode */
	char	config_file[LEN_128];
	unsigned int	debug_level;

	char	output_interface[LEN_128];  /* which interface will enable*/

	/* output print */
	char	output_print_mod[LEN_512];  /* which mod will print throught argv */
	char	output_stdio_mod[LEN_512];  /* which mod will print throuhth conf file */
	int	print_interval;		 /* how many seconds will escape every print interval */
	int	print_ndays;		 /* how many line will print every time. default:10 */
	int	print_tail;
	int	print_file_number;	/* which gds.data file used*/

	/* output db */
	char	output_db_mod[LEN_512];  /* which mod will output */
	char	output_db_addr[LEN_512]; /* db addr */

	/* output nagios */
	char	server_addr[LEN_512];
	char    server_port[LEN_32];
	int	*cycle_time;

	char    check_name[MAX_MOD_NUM][LEN_32];
	float	wmin[MAX_MOD_NUM];
	float	wmax[MAX_MOD_NUM];
	float	cmin[MAX_MOD_NUM];
	float	cmax[MAX_MOD_NUM];
	int	mod_num;
	/* output file */
	char	output_file_path[LEN_128];
};


void parse_config_file(const char *file_name);
#endif

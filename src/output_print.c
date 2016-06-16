#include "gds.h"

/*
 * adjust print opt line
 */
void adjust_print_opt_line(char *n_opt_line, char *opt_line, int hdr_len)
{
}


/*
 * print header and update mod->n_item
 */
void print_header()
{
}


void printf_result(double result)
{
}


void print_array_stat(struct module *mod, double *st_array)
{
}


/* print current time */
void print_current_time()
{
	char cur_time[LEN_32] = {0};
	time_t timep;
	struct tm *t;

	time(&timep);
	t = localtime(&timep);
	strftime(cur_time, sizeof(cur_time), "%d/%m-%R", t);
	printf("%s%s", cur_time, PRINT_SEC_SPLIT);
}


void print_record()
{
}

/*
 * set and print record time
 */
long set_record_time(char *line)
{
	char *token, s_time[LEN_32] = {0};
	static long pre_time, c_time = 0;

	/* get record time */
	token = strstr(line, SECTION_SPLIT);
	memcpy(s_time, line, token - line);

	/* swap time */
	pre_time = c_time;
	c_time = atol(s_time);

	c_time = c_time - c_time%60;
	pre_time = pre_time - pre_time%60;
	/* if skip record when two lines haveing same minute */
	if (!(conf.print_interval = c_time - pre_time))
		return 0;
	else
		return c_time;
}

/*
 * check time if corret for pirnt from gds.data
 */
int check_time(char *line)
{
	char *token, s_time[LEN_32] = {0};
	long now_time = 0;

	/* get record time */
	token = strstr(line, SECTION_SPLIT);
	memcpy(s_time, line, token - line);
	now_time = atol(s_time);

	/* if time is divide by conf.print_nline_interval*/
	now_time = now_time - now_time % 60;
	if (!(now_time % ( 60 * 1)))
		return 0;
	else
		return 1;
}

void print_record_time(long c_time)
{
	char s_time[LEN_32] = {0};
	struct tm *t;

	t = localtime(&c_time);
	strftime(s_time, sizeof(s_time), "%d/%m-%R", t);
	printf("%s%s", s_time, PRINT_SEC_SPLIT);
}


void print_tail(int tail_type)
{
}


/*
 * print mode, print data from gds.data
 */
void running_print()
{
}

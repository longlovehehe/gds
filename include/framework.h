#ifndef _FRAMEWORK_H
#define _FRAMEWORK_H
/*
 * gds framwork
 */

#include "define.h"
struct mod_info {
	char	hdr[LEN_128];
	int	type_bit;	/* bit set indefi type */
	int	merge_mode;
	int	stats_opt;
};

struct mod_table {
    int item;
	char	table[LEN_64];
};

struct module
{
	char    name[LEN_32];
	char    opt_line[LEN_32];
	char    usage[LEN_256];

    struct  mod_table *table;
    struct  mod_info *info;
	void    *lib;
	int	enable;

	/* private data used by framework*/
	int	n_item;     //record type:emp、amp、ser
	int	n_col;      //record column
	U_64 emp_record; //the number of emp record
	U_64 amp_record; //the number of amp record
	U_64 ser_record; // the number of ser record

	void	*emp_array; //store the emp calculation results
	void	*amp_array; //store the amp calculation results
	void	*ser_array; //store the ser calculation results

	/* callback function of module */
	void (*data_collect) (struct module *, int interval);

	/* mod manage */
	void (*mod_register) (struct module *);
};


void register_mod_fileds(struct module *mod, char *opt, char *usage, struct mod_table *table,
        struct mod_info *info, int n_item, int n_col, void *data_collect);
void set_mod_record(struct module *mod, char *record);
void init_module_fields();
void reload_modules(char *s_mod);
void load_modules();
void free_modules();
void collect_record();
void read_line_to_module_record(char *line);
int  collect_record_stat();
void disable_col_zero();
#endif

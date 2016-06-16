#include "gds.h"

void register_mod_fileds(struct module *mod, char *opt, char *usage,
				struct mod_table *table, struct mod_info *info, int n_item,
                int n_col, void *data_collect)
{
    sprintf(mod->opt_line, "%s", opt);
    sprintf(mod->usage, "%s", usage);
    mod->table = table;
    mod->info = info;
    mod->n_item = n_item;
    mod->n_col = n_col;
    mod->data_collect = data_collect;
}

void set_mod_record(struct module *mod, char *record)
{
}

/*
 * load module from dir
 */
void load_modules()
{
    char    buf[LEN_128] = {0};
    char    mod_path[LEN_128] = {0};
    struct  module *mod = NULL;
    int (*mod_register)(struct module *);
    int i;

    /* get the full path of modules */
    sprintf(buf, "/usr/local/gds/modules");

    for (i = 0; i < statis.total_mod_num; i++) {
        mod = &mods[i];
        if (!mod->lib) {
            memset(mod_path, '\0', LEN_128);
            snprintf(mod_path, LEN_128, "%s/%s.so", buf, mod->name);
            logRecord(LOG_INFO, "%s(%d): load_modules: %s\n", __FUNCTION__, __LINE__, mod_path);
            if (!(mod->lib = dlopen(mod_path, RTLD_NOW|RTLD_GLOBAL))) {
                logRecord(LOG_ERR, "%s(%d): dlopen module %s err %s\n", __FUNCTION__, __LINE__,
                        mod->name, dlerror());
            } else {
                mod_register = dlsym(mod->lib, "mod_register");
                if (dlerror()) {
                    logRecord(LOG_ERR, "%s(%d): dlsym module %s err %s\n", __FUNCTION__, __LINE__,
                            mod->name, dlerror());
                } else {
                    mod_register(mod);
                    mod->enable = 1;
                    logRecord(LOG_INFO, "%s(%d): load new module '%s' to mods\n", __FUNCTION__,
                            __LINE__, mod_path);
                }
            }
        }
    }
}

/*
 * match return 1
 */
int is_include_string(char *mods, char *mod)
{

    char *token, n_str[LEN_512] = {0};

    memcpy(n_str, mods, strlen(mods));

    token = strtok(n_str, DATA_SPLIT);
    while (token) {
        if (!strcmp(token, mod)) {
            return 1;
        }
        token = strtok(NULL, DATA_SPLIT);
    }

    return 0;
}

/*
 * reload modules by mods, if not find in mods, then set module disable
 */
void reload_modules(char *s_mod)
{
    int i;
    struct module *mod;

    if (!s_mod || !strlen(s_mod))
        return;

    for (i = 0; i < statis.total_mod_num; i++) {
        mod = &mods[i];
        if (is_include_string(s_mod, mod->name) || is_include_string (s_mod, mod->opt_line))
            mod->enable = 1;
        else
            mod->enable = 0;
    }
}

/*
 * 1.alloc or realloc store array
 * 2.set mod->n_item
 */
void init_module_fields()
{
    struct module *mod = NULL;
    int i;

    for (i = 0; i < statis.total_mod_num; i++) {
        mod = &mods[i];
        if (!mod->enable)
            continue;

        /* get mod->n_item first, and mod->n_item will be reseted in reading next line */
        if (mod->n_item) {
            mod->emp_array = (double *)calloc(mod->emp_record * mod->n_col, sizeof(U_64));
            mod->amp_array = (double *)calloc(mod->amp_record * mod->n_col, sizeof(U_64));
            mod->ser_array = (double *)calloc(mod->ser_record * mod->n_col, sizeof(double));

        }
    }
}

/*
 * 1.realloc store array when mod->n_item is modify
 */
void realloc_module_array(struct module *mod, int n_n_item)
{
    if (n_n_item > mod->n_item) {
        if (mod->emp_array) {
            mod->emp_array = (double *)realloc(mod->emp_array, n_n_item * mod->n_col * sizeof (U_64));
            mod->amp_array = (double *)realloc(mod->amp_array, n_n_item * mod->n_col * sizeof (U_64));
            mod->ser_array = (double *)realloc(mod->ser_array, n_n_item * mod->n_col * sizeof (double));

        } else {
            mod->emp_array = (double *)calloc(mod->emp_record * mod->n_col, sizeof(U_64));
            mod->amp_array = (double *)calloc(mod->amp_record * mod->n_col, sizeof(U_64));
            mod->ser_array = (double *)calloc(mod->ser_record * mod->n_col, sizeof(double));

        }
    }
}

/*
 * set st result in ser_array
 */
void set_st_record(struct module *mod)
{

}


/*
 * computer mod->ser_array and swap cur_info to pre_info
 * return:  1 -> ok
 *	    0 -> some mod->n_item have modify will reprint header
 */
int collect_record_stat()
{
    return 0;
}


/*
 * free module info
 */
void free_modules()
{
	int	i;
	struct	module *mod;

	for (i = 0; i < statis.total_mod_num; i++) {
		mod = &mods[i];
		if (mod->lib)
			dlclose(mod->lib);

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
	}
}


/*
 * read line from file to mod->record
 */
void read_line_to_module_record(char *line)
{
}


/*
 * if col num is zero then disable module
 */
void disable_col_zero()
{
	struct module *mod = NULL;
	int  i;

	for (i = 0; i < statis.total_mod_num; i++) {
		mod = &mods[i];
		if (!mod->enable)
			continue;

		if (!mod->n_col)
			mod->enable = 0;
	}
}

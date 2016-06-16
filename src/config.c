#include "gds.h"

//add mod to gds
void parse_mod(char *mod_name)
{
    //check if the mod load already
    int i = 0;
    for (i = 0; i < statis.total_mod_num; i++) {
        struct module *mod = &mods[i];
        if (!strcmp(mod->name, mod_name))
            return;
    }

    struct module *mod = &mods[statis.total_mod_num++];
    char    *token = strtok(NULL, W_SPACE);
    if (token && (!strcasecmp(token, "on") || !strcasecmp(token, "enable"))) {
        strncpy(mod->name, mod_name, strlen(mod_name));
        return;
    } else {
        memset(mod, '\0', sizeof(struct module));
        statis.total_mod_num--;
    }
}


void parse_int(int *var)
{
    char *token = strtok(NULL, W_SPACE);

    if (token == NULL) {
        logRecord(LOG_FATAL, "%s(%d): Bungled line", __FUNCTION__, __LINE__);
        *var = 0;
    }
    *var = atoi(token);
}

void parse_string(char *var)
{
    char *token = strtok(NULL, W_SPACE);

    if (token) {
        strncpy(var, token, strlen(token));
    }
        
}

void parse_add_string(char *var)
{
    char *token = strtok(NULL, W_SPACE);
    if (var == NULL) {
        if (token)
            strncpy(var, token, strlen(token));
    } else {
        if (token) {
            strcat(token, ",");
            strncat(token, var, strlen(var));
        }
        if (token)
            strncpy(var, token, strlen(token));
    }
}

void set_debug_level()
{
    char *token = strtok(NULL, W_SPACE);

    if(token) {
        if (!strcmp(token,"INFO"))
            conf.debug_level = LOG_INFO;
        else if (!strcmp(token,"WARN"))
            conf.debug_level = LOG_WARN;
        else if (!strcmp(token,"DEBUG"))
            conf.debug_level = LOG_DEBUG;
        else if (!strcmp(token,"ERROR"))
            conf.debug_level = LOG_ERR;
        else if (!strcmp(token,"FATAL"))
            conf.debug_level = LOG_FATAL;
        else
            conf.debug_level = LOG_ERR;
    }
}

/* parse every config line */
static int parse_line(char *buff)
{
    char    *token;

    if ((token = strtok(buff, W_SPACE)) == NULL)
        (void) 0;       /*ignore empty lines */
    else if (strstr(token, "mod_"))
        parse_mod(token);
    else if (!strcmp(token, "output_interface"))
        parse_string(conf.output_interface);
    else if (!strcmp(token, "output_file_path"))
        parse_string(conf.output_file_path);
    else if (!strcmp(token, "output_db_addr"))
        parse_string(conf.output_db_addr);
    else if (!strcmp(token, "output_db_mod"))
        parse_add_string(conf.output_db_mod);
    else if (!strcmp(token, "output_stdio_mod"))
        parse_add_string(conf.output_stdio_mod);
    else if (!strcmp(token, "debug_level"))
        set_debug_level();
    else if (!strcmp(token, "server_addr"))
        parse_string(conf.server_addr);
    else if (!strcmp(token, "server_port"))
        parse_string(conf.server_port);
    else if (!strcmp(token, "cycle_time"))
        parse_int(conf.cycle_time);
    else
        return 0;

    return 1;
}

void parse_config_file(const char *file_name)
{
    FILE *fp;
    char *token;
    char config_input_line[LEN_1024] = {0};

    memset(&mods, '\0', sizeof(mods));
    memset(&conf, '\0', sizeof(conf));
    memset(&statis, '\0', sizeof(statis));

    conf.cycle_time = (int *)malloc(sizeof(int));

    if (!(fp = fopen(file_name, "r"))) {
        logRecord(LOG_FATAL, "%s(%d): Unable to open configuration file: %s\n",
                    __FUNCTION__, __LINE__, file_name);
    }

    while (fgets(config_input_line, LEN_1024, fp)) {
        if ((token = strchr(config_input_line, '\n')))
            *token = '\0';
        if ((token = strchr(config_input_line, '\r')))
            *token = '\0';
        if (config_input_line[0] == '#') {
            memset(config_input_line, '\0', LEN_1024);
            continue;
        }
        if (config_input_line[0] == '\0')
            continue;
        //FIXME can't supprot wrap line
        if (!parse_line(config_input_line)) {
            logRecord(LOG_FATAL, "%s(%d): parse_config_file: unknown keyword in '%s'\n",
                    config_input_line);
        }
        memset(config_input_line, '\0', LEN_1024);
    }

    fclose(fp);
    log_config();
    log_mods();
}

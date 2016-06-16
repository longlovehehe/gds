#include "gds.h"

void output_file()
{
	struct 	module *mod;
	FILE	*fp = NULL;
	int	i, ret = 0;
	char	line[LEN_4096] = {0};
	char	detail[LEN_1024] = {0};
	char	s_time[LEN_256] = {0};

	if (!(fp = fopen(conf.output_file_path, "a+"))) {
		if (!(fp = fopen(conf.output_file_path, "w")))
			logRecord(LOG_FATAL, "%s(%d): output_file: can't create data file = %s  err=%d",
                    __FUNCTION__, __LINE__, conf.output_file_path, errno);
	}

	sprintf(s_time, "%ld", statis.cur_time);
	strcat(line, s_time);

	for (i = 0; i < statis.total_mod_num; i++) {
		mod = &mods[i];
		if (mod->enable) {
			/* save collect data to output_file */
			sprintf(detail, "%s%s%s", SECTION_SPLIT, mod->opt_line, STRING_SPLIT);
			strcat(line, detail);
			ret = 1;
		}
	}
	strcat(line, "\n");

	if (ret) {
		fputs(line, fp);
		fclose(fp);
	}
	chmod(conf.output_file_path, 0666);
}


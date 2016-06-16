#include "gds.h"

int is_digit(char *str)
{
	/*dont handle minus value in gds.data */
	//if(*str == '-')
	//	str++;
	while (*str) {
		if (!isdigit(*str++))
			return 0;
	}
	return 1;
}


/*
 * convert record to array
 */
int convert_record_to_array(double *array, int l_array, char *record)
{
	char *token;
	char n_str[LEN_1024] = {0};
	int i = 0;

	if (!record || !strlen(record))
		return 0;
	memcpy(n_str, record, strlen(record));

	token = strtok(n_str, DATA_SPLIT);
	while (token) {
		if (!is_digit(token))
			return 0;
		*(array + i) = strtoull(token,NULL,10);
		token = strtok(NULL, DATA_SPLIT);
		i++;
	}

	if (i != l_array)
		return 0;
	return i;
}


int merge_one_string(double *array, int l_array, char *string, struct module *mod, int n_item)
{
	int i, len;
	double array_2[MAX_COL_NUM] = {0};
	struct mod_info *info = mod->info;

	if (!(len = convert_record_to_array(array_2, l_array, string)))
		return 0;

	for (i=0; i < len; i++) {
		switch (info[i].merge_mode) {
			case MERGE_SUM:
				array[i] += array_2[i];
				break;
			case MERGE_AVG:
				array[i] = (array[i] * (n_item - 1) + array_2[i])/n_item;
				break;
			default:
				;
		}
	}
	return 1;
}


int strtok_next_item(char item[], char *record, int *start)
{
	char *s_token, *e_token, *n_record;

	if (!record || !strlen(record) || strlen(record) <= *start)
		return 0;

	n_record = record + *start;
	e_token = strstr(n_record, ITEM_SPLIT);
	if (!e_token)
		return 0;
	s_token = strstr(n_record, ITEM_SPSTART);
	if (!s_token)
		return 0;

	memcpy(item, s_token + sizeof(ITEM_SPSTART) - 1, e_token - s_token - 1);
	*start = e_token - record + sizeof(ITEM_SPLIT);
	return 1;
}



int get_strtok_num(char *str, char *split)
{
	int num = 0;
	char *token, n_str[LEN_1024] = {0};

	if (!str || !strlen(str))
		return 0;

	memcpy(n_str, str, strlen(str));
	/* set print opt line */
	token = strtok(n_str, split);
	while (token) {
		num++;
		token = strtok(NULL, split);
	}

	return num;
}

void convert_time_to_string(time_t orig_time, char *time_str, int type)
{
    struct tm *p_tm = NULL;

    p_tm = localtime(&orig_time);
    switch(type) {
        case FULL_FORMAT_DATE:
            sprintf(time_str, "%02d-%02d-%02d %02d:%02d:%02d", (1900 + p_tm->tm_year), (1 + p_tm->tm_mon),
                    p_tm->tm_mday, p_tm->tm_hour, p_tm->tm_min, p_tm->tm_sec);
            break;
        case YYYY_MM_DD_DATE:
            sprintf(time_str, "%02d-%02d-%02d", (1900 + p_tm->tm_year), (1 + p_tm->tm_mon), p_tm->tm_mday);
            break;
        case ZERO_HOUR_DATE:
            sprintf( time_str, "%02d-%02d-%02d 00:00:00", (1900 + p_tm->tm_year), (1 + p_tm->tm_mon), p_tm->tm_mday );
            break;
        default:
            break;
    }
}


int get_days_in_month(int y,int m)
{
    int d;
    int day[]= {31,28,31,30,31,30,31,31,30,31,30,31};

    if (2 == m) {
        d=((((0 == y%4) && (0 != y%100)) || (0 == y%400)) ? 29 : 28);
    } else {
        d=day[m-1];
    }

    return d;
}

#ifndef _COMMON_H
#define _COMMON_H

#define FULL_FORMAT_DATE    0
#define YYYY_MM_DD_DATE     1
#define ZERO_HOUR_DATE      3

/*
 * convert data to array
 */
int convert_record_to_array(double *array, int l_array, char *record);
void get_mod_hdr(char hdr[], struct module *mod);
int strtok_next_item(char item[], char *record, int *start);
int merge_mult_item_to_array(double *array, struct module *mod);
int get_strtok_num(char *str, char *split);
void convert_time_to_string(time_t orig_time, char *time_str, int type);
int get_days_in_month(int y,int m);
#endif

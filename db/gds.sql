set client_encoding = 'UTF8';
-- ----------------------------
-- Table structure for T_CallCycle_Statistics_AMP
-- ----------------------------
CREATE TABLE "public"."T_CallCycle_Statistics_AMP" (
    "sdr_id" varchar(32) COLLATE "default" NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_cyc_type" int4 DEFAULT 0,
    "sdr_ptt_time" int8 DEFAULT 0,
    "sdr_ptt_count" int8 DEFAULT 0,
    "sdr_audio_time" int8 DEFAULT 0,
    "sdr_audio_caller_time" int8 DEFAULT 0,
    "sdr_audio_callee_time" int8 DEFAULT 0,
    "sdr_audio_count" int8 DEFAULT 0,
    "sdr_audio_caller_count" int8 DEFAULT 0,
    "sdr_audio_callee_count" int8 DEFAULT 0,
    "sdr_video_time" int8 DEFAULT 0,
    "sdr_video_caller_time" int8 DEFAULT 0,
    "sdr_video_callee_time" int8 DEFAULT 0,
    "sdr_video_count" int8 DEFAULT 0,
    "sdr_video_caller_count" int8 DEFAULT 0,
    "sdr_video_callee_count" int8 DEFAULT 0,
    CONSTRAINT "uk_ccs_amp" UNIQUE ("sdr_id", "sdr_time", "sdr_cyc_type")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_id" IS '代理商ID';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_time" IS '统计时间点，即统计数据截至日';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_cyc_type" IS '统计周期类型';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_ptt_time" IS '周期内对讲时长，话权方时长累计，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_ptt_count" IS '周期内对讲次数，每次话权改变算一次对讲';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_audio_time" IS '周期内音频单呼时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_audio_caller_time" IS '周期内音频单呼主叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_audio_callee_time" IS '周期内单呼被叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_audio_count" IS '周期内单呼次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_audio_caller_count" IS '周期内单呼主叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_audio_callee_count" IS '周期内单呼被叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_video_time" IS '周期内视频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_video_caller_time" IS '周期内视频主叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_video_callee_time" IS '周期内视频被叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_video_count" IS '周期内视频次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_video_caller_count" IS '周期内视频主叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_AMP"."sdr_video_callee_count" IS '周期内视频被叫次数';

-- ----------------------------
-- Table structure for T_CallCycle_Statistics_EMP
-- ----------------------------
CREATE TABLE "public"."T_CallCycle_Statistics_EMP" (
    "sdr_id" int8 NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_cyc_type" int4 DEFAULT 0,
    "sdr_ptt_time" int8 DEFAULT 0,
    "sdr_ptt_count" int8 DEFAULT 0,
    "sdr_audio_time" int8 DEFAULT 0,
    "sdr_audio_caller_time" int8 DEFAULT 0,
    "sdr_audio_callee_time" int8 DEFAULT 0,
    "sdr_audio_count" int8 DEFAULT 0,
    "sdr_audio_caller_count" int8 DEFAULT 0,
    "sdr_audio_callee_count" int8 DEFAULT 0,
    "sdr_video_time" int8 DEFAULT 0,
    "sdr_video_caller_time" int8 DEFAULT 0,
    "sdr_video_callee_time" int8 DEFAULT 0,
    "sdr_video_count" int8 DEFAULT 0,
    "sdr_video_caller_count" int8 DEFAULT 0,
    "sdr_video_callee_count" int8 DEFAULT 0,
    CONSTRAINT "uk_ccs_emp" UNIQUE ("sdr_id", "sdr_time", "sdr_cyc_type")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_id" IS '企业ID';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_time" IS '统计时间点，即统计数据截至日';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_cyc_type" IS '统计周期类型';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_ptt_time" IS '周期内对讲时长，话权方时长累计，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_ptt_count" IS '周期内对讲次数，每次话权改变算一次对讲';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_audio_time" IS '周期内音频单呼时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_audio_caller_time" IS '周期内音频单呼主叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_audio_callee_time" IS '周期内单呼被叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_audio_count" IS '周期内单呼次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_audio_caller_count" IS '周期内单呼主叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_audio_callee_count" IS '周期内单呼被叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_video_time" IS '周期内视频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_video_caller_time" IS '周期内视频主叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_video_callee_time" IS '周期内视频被叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_video_count" IS '周期内视频次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_video_caller_count" IS '周期内视频主叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_EMP"."sdr_video_callee_count" IS '周期内视频被叫次数';

-- ----------------------------
-- Table structure for T_CallCycle_Statistics_S
-- ----------------------------
CREATE TABLE "public"."T_CallCycle_Statistics_S" (
    "sdr_id" int4 NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_cyc_type" int4 DEFAULT 0,
    "sdr_ptt_time" int8 DEFAULT 0,
    "sdr_ptt_count" int8 DEFAULT 0,
    "sdr_audio_time" int8 DEFAULT 0,
    "sdr_audio_caller_time" int8 DEFAULT 0,
    "sdr_audio_callee_time" int8 DEFAULT 0,
    "sdr_audio_count" int8 DEFAULT 0,
    "sdr_audio_caller_count" int8 DEFAULT 0,
    "sdr_audio_callee_count" int8 DEFAULT 0,
    "sdr_video_time" int8 DEFAULT 0,
    "sdr_video_caller_time" int8 DEFAULT 0,
    "sdr_video_callee_time" int8 DEFAULT 0,
    "sdr_video_count" int8 DEFAULT 0,
    "sdr_video_caller_count" int8 DEFAULT 0,
    "sdr_video_callee_count" int8 DEFAULT 0,
    CONSTRAINT "uk_ccs_ser" UNIQUE ("sdr_id", "sdr_time", "sdr_cyc_type")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_id" IS '服务器ID';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_time" IS '统计时间点，即统计数据截至日';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_cyc_type" IS '统计周期类型';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_ptt_time" IS '周期内对讲时长，话权方时长累计，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_ptt_count" IS '周期内对讲次数，每次话权改变算一次对讲';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_audio_time" IS '周期内音频单呼时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_audio_caller_time" IS '周期内音频单呼主叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_audio_callee_time" IS '周期内单呼被叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_audio_count" IS '周期内单呼次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_audio_caller_count" IS '周期内单呼主叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_audio_callee_count" IS '周期内单呼被叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_video_time" IS '周期内视频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_video_caller_time" IS '周期内视频主叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_video_callee_time" IS '周期内视频被叫时长,单位分';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_video_count" IS '周期内视频次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_video_caller_count" IS '周期内视频主叫次数';
COMMENT ON COLUMN "public"."T_CallCycle_Statistics_S"."sdr_video_callee_count" IS '周期内视频被叫次数';

-- ----------------------------
-- Table structure for T_CallData_Statistics_AMP
-- ----------------------------
CREATE TABLE "public"."T_CallData_Statistics_AMP" (
    "sdr_id" varchar(32) COLLATE "default" NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_date_flag" int4 DEFAULT 0,
    "sdr_ptt_htime" int8 DEFAULT 0,
    "sdr_ptt_hcount" int8 DEFAULT 0,
    "sdr_call_htime" int8 DEFAULT 0,
    "sdr_call_hcount" int8 DEFAULT 0,
    "sdr_video_htime" int8 DEFAULT 0,
    "sdr_video_hcount" int8 DEFAULT 0,
    "sdr_audio_htime" int8 DEFAULT 0,
    "sdr_audio_hcount" int8 DEFAULT 0,
    CONSTRAINT "uk_cds_amp" UNIQUE ("sdr_id", "sdr_time", "sdr_date_flag")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_id" IS '代理商ID';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_date_flag" IS '时间标识';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_ptt_htime" IS '历史累计对讲时长，话权方时长累计，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_ptt_hcount" IS '历史累计对讲次数，每次话权改变算一次对讲';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_call_htime" IS '历史累计通话时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_call_hcount" IS '历史累计通话次数';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_video_htime" IS '历史累计视频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_video_hcount" IS '历史累计视频次数';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_audio_htime" IS '历史累计音频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_AMP"."sdr_audio_hcount" IS '历史累计音频次数';

-- ----------------------------
-- Table structure for T_CallData_Statistics_EMP
-- ----------------------------
CREATE TABLE "public"."T_CallData_Statistics_EMP" (
    "sdr_id" int8 NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_date_flag" int4 DEFAULT 0,
    "sdr_ptt_htime" int8 DEFAULT 0,
    "sdr_ptt_hcount" int8 DEFAULT 0,
    "sdr_call_htime" int8 DEFAULT 0,
    "sdr_call_hcount" int8 DEFAULT 0,
    "sdr_video_htime" int8 DEFAULT 0,
    "sdr_video_hcount" int8 DEFAULT 0,
    "sdr_audio_htime" int8 DEFAULT 0,
    "sdr_audio_hcount" int8 DEFAULT 0,
    CONSTRAINT "uk_cds_emp" UNIQUE ("sdr_id", "sdr_time", "sdr_date_flag")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_id" IS '企业ID';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_date_flag" IS '时间标识';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_ptt_htime" IS '历史累计对讲时长，话权方时长累计，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_ptt_hcount" IS '历史累计对讲次数，每次话权改变算一次对讲';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_call_htime" IS '历史累计通话时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_call_hcount" IS '历史累计通话次数';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_video_htime" IS '历史累计视频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_video_hcount" IS '历史累计视频次数';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_audio_htime" IS '历史累计音频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_EMP"."sdr_audio_hcount" IS '历史累计音频次数';

-- ----------------------------
-- Table structure for T_CallData_Statistics_S
-- ----------------------------
CREATE TABLE "public"."T_CallData_Statistics_S" (
    "sdr_id" int4 NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_date_flag" int4 DEFAULT 0,
    "sdr_ptt_htime" int8 DEFAULT 0,
    "sdr_ptt_hcount" int8 DEFAULT 0,
    "sdr_call_htime" int8 DEFAULT 0,
    "sdr_call_hcount" int8 DEFAULT 0,
    "sdr_video_htime" int8 DEFAULT 0,
    "sdr_video_hcount" int8 DEFAULT 0,
    "sdr_audio_htime" int8 DEFAULT 0,
    "sdr_audio_hcount" int8 DEFAULT 0,
    CONSTRAINT "uk_cds_ser" UNIQUE ("sdr_id", "sdr_time", "sdr_date_flag")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_id" IS '服务器ID';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_date_flag" IS '时间标识';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_ptt_htime" IS '历史累计对讲时长，话权方时长累计，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_ptt_hcount" IS '历史累计对讲次数，每次话权改变算一次对讲';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_call_htime" IS '历史累计通话时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_call_hcount" IS '历史累计通话次数';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_video_htime" IS '历史累计视频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_video_hcount" IS '历史累计视频次数';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_audio_htime" IS '历史累计音频时长，包括主叫时长+被叫时长，单位分';
COMMENT ON COLUMN "public"."T_CallData_Statistics_S"."sdr_audio_hcount" IS '历史累计音频次数';

-- ----------------------------
-- Table structure for T_UserActiveState_Statistics_EMP
-- ----------------------------
CREATE TABLE "public"."T_UserActiveState_Statistics_EMP" (
    "sdr_time" date NOT NULL,
    "sdr_id" int8 NOT NULL,
    "sdr_num" varchar(64) COLLATE "default" DEFAULT ''::character varying NOT NULL,
    "sdr_online_times" int8 DEFAULT 0,
    "sdr_offline_times" int8 DEFAULT 0,
    "sdr_active_flag" int4 DEFAULT 0,
    CONSTRAINT "uk_cas_emp" UNIQUE ("sdr_time", "sdr_num")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_UserActiveState_Statistics_EMP"."sdr_time" IS '统计时间点，即统计数据截至日';
COMMENT ON COLUMN "public"."T_UserActiveState_Statistics_EMP"."sdr_id" IS '企业ID';
COMMENT ON COLUMN "public"."T_UserActiveState_Statistics_EMP"."sdr_num" IS '企业用户ID';
COMMENT ON COLUMN "public"."T_UserActiveState_Statistics_EMP"."sdr_online_times" IS '用户上线次数';
COMMENT ON COLUMN "public"."T_UserActiveState_Statistics_EMP"."sdr_offline_times" IS '用户下线次数';
COMMENT ON COLUMN "public"."T_UserActiveState_Statistics_EMP"."sdr_active_flag" IS '用户活跃标识';

-- ----------------------------
-- Table structure for T_UserCycle_Statistics_AMP
-- ----------------------------
CREATE TABLE "public"."T_UserCycle_Statistics_AMP" (
    "sdr_id" varchar(32) COLLATE "default" NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_cyc_type" int4 DEFAULT 0,
    "sdr_add_user" int8 DEFAULT 0,
    "sdr_del_user" int8 DEFAULT 0,
    "sdr_grow_user" int8 DEFAULT 0,
    "sdr_terminal_add_user" int8 DEFAULT 0,
    "sdr_terminal_add_user_test" int8 DEFAULT 0,
    "sdr_terminal_add_user_commercial" int8 DEFAULT 0,
    "sdr_gprs_add_user" int8 DEFAULT 0,
    "sdr_gprs_add_user_test" int8 DEFAULT 0,
    "sdr_gprs_add_user_commercial" int8 DEFAULT 0,
    CONSTRAINT "uk_ucs_amp" UNIQUE ("sdr_id", "sdr_time", "sdr_cyc_type")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_id" IS '代理商ID';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_record_time" IS '记录写入时间，最小单位为秒';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_cyc_type" IS '统计周期类型';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_add_user" IS '新增用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_del_user" IS '删除用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_grow_user" IS '净增长用户数（可为负值）';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_terminal_add_user" IS '周期内增加终端用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_terminal_add_user_test" IS '周期内增加测试终端用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_terminal_add_user_commercial" IS '周期内增加商用终端用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_gprs_add_user" IS '周期内增加流量卡用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_gprs_add_user_test" IS '周期内增加测试流量卡用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_AMP"."sdr_gprs_add_user_commercial" IS '周期内增加商用流量卡用户数';

-- ----------------------------
-- Table structure for T_UserCycle_Statistics_EMP
-- ----------------------------
CREATE TABLE "public"."T_UserCycle_Statistics_EMP" (
    "sdr_id" int8 NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_cyc_type" int4 DEFAULT 0,
    "sdr_add_user" int8 DEFAULT 0,
    "sdr_del_user" int8 DEFAULT 0,
    "sdr_grow_user" int8 DEFAULT 0,
    "sdr_terminal_add_user" int8 DEFAULT 0,
    "sdr_terminal_add_user_test" int8 DEFAULT 0,
    "sdr_terminal_add_user_commercial" int8 DEFAULT 0,
    "sdr_gprs_add_user" int8 DEFAULT 0,
    "sdr_gprs_add_user_test" int8 DEFAULT 0,
    "sdr_gprs_add_user_commercial" int8 DEFAULT 0,
    CONSTRAINT "uk_ucs_emp" UNIQUE ("sdr_id", "sdr_time", "sdr_cyc_type")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_id" IS '企业ID';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_record_time" IS '记录写入时间，最小单位为秒';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_cyc_type" IS '统计周期类型';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_add_user" IS '新增用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_del_user" IS '删除用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_grow_user" IS '净增长用户数（可为负值）';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_terminal_add_user" IS '周期内增加终端用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_terminal_add_user_test" IS '周期内增加测试终端用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_terminal_add_user_commercial" IS '周期内增加商用终端用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_gprs_add_user" IS '周期内增加流量卡用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_gprs_add_user_test" IS '周期内增加测试流量卡用户数';
COMMENT ON COLUMN "public"."T_UserCycle_Statistics_EMP"."sdr_gprs_add_user_commercial" IS '周期内增加商用流量卡用户数';

-- ----------------------------
-- Table structure for T_UserData_Statistics_AMP
-- ----------------------------
CREATE TABLE "public"."T_UserData_Statistics_AMP" (
    "sdr_id" varchar(32) COLLATE "default" NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_date_flag" int4 DEFAULT 0,
    "sdr_creat_user" int8 DEFAULT 0,
    "sdr_online_user" int8 DEFAULT 0,
    "sdr_user" int8 DEFAULT 0,
    "sdr_commercial_user" int8 DEFAULT 0,
    "sdr_test_user" int8,
    "sdr_phone_user" int8 DEFAULT 0,
    "sdr_console_user" int8 DEFAULT 0,
    "sdr_gvs_user" int8 DEFAULT 0,
    "sdr_enable_user" int8 DEFAULT 0,
    "sdr_disable_user" int8 DEFAULT 0,
    "sdr_terminal_user" int8 DEFAULT 0,
    "sdr_terminal_user_test" int8 DEFAULT 0,
    "sdr_terminal_user_commercial" int8 DEFAULT 0,
    "sdr_terminal_user_sort" varchar COLLATE "default",
    "sdr_gprs_user" int8 DEFAULT 0,
    "sdr_gprs_user_test" int8 DEFAULT 0,
    "sdr_gprs_user_commercial" int8 DEFAULT 0,
    CONSTRAINT "uk_uds_amp" UNIQUE ("sdr_id", "sdr_time", "sdr_date_flag")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_id" IS '代理商ID';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_date_flag" IS '时间标识，包括周末，月末和普通日';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_creat_user" IS '累计用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_online_user" IS '累计在线用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_user" IS '现有用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_commercial_user" IS '商用用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_test_user" IS '测试用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_phone_user" IS '手机用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_console_user" IS '调度台用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_gvs_user" IS 'GVS用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_enable_user" IS '启用用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_disable_user" IS '停用用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_terminal_user" IS '现有终端用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_terminal_user_test" IS '测试终端用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_terminal_user_commercial" IS '商用终端用户';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_terminal_user_sort" IS '终端用户数，字符串格式';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_gprs_user" IS '现有流量卡用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_gprs_user_test" IS '测试流量卡用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_AMP"."sdr_gprs_user_commercial" IS '商用流量卡用户数';

-- ----------------------------
-- Table structure for T_UserData_Statistics_EMP
-- ----------------------------
CREATE TABLE "public"."T_UserData_Statistics_EMP" (
    "sdr_id" int8 NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_date_flag" int4 DEFAULT 0,
    "sdr_creat_user" int8 DEFAULT 0,
    "sdr_online_user" int8 DEFAULT 0,
    "sdr_user" int8 DEFAULT 0,
    "sdr_commercial_user" int8 DEFAULT 0,
    "sdr_test_user" int8,
    "sdr_phone_user" int8 DEFAULT 0,
    "sdr_console_user" int8 DEFAULT 0,
    "sdr_gvs_user" int8 DEFAULT 0,
    "sdr_enable_user" int8 DEFAULT 0,
    "sdr_disable_user" int8 DEFAULT 0,
    "sdr_terminal_user" int8 DEFAULT 0,
    "sdr_terminal_user_test" int8 DEFAULT 0,
    "sdr_terminal_user_commercial" int8 DEFAULT 0,
    "sdr_terminal_user_sort" varchar COLLATE "default",
    "sdr_gprs_user" int8 DEFAULT 0,
    "sdr_gprs_user_test" int8 DEFAULT 0,
    "sdr_gprs_user_commercial" int8 DEFAULT 0,
    CONSTRAINT "uk_uds_emp" UNIQUE ("sdr_id", "sdr_time", "sdr_date_flag")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_id" IS '企业ID';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_date_flag" IS '时间标识，包括周末，月末和普通日';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_creat_user" IS '累计用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_online_user" IS '累计在线用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_user" IS '现有用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_commercial_user" IS '商用用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_test_user" IS '测试用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_phone_user" IS '手机用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_console_user" IS '调度台用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_gvs_user" IS 'GVS用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_enable_user" IS '启用用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_disable_user" IS '停用用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_terminal_user" IS '现有终端用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_terminal_user_test" IS '测试终端用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_terminal_user_commercial" IS '商用终端用户';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_terminal_user_sort" IS '终端用户数，字符串格式';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_gprs_user" IS '现有流量卡用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_gprs_user_test" IS '测试流量卡用户数';
COMMENT ON COLUMN "public"."T_UserData_Statistics_EMP"."sdr_gprs_user_commercial" IS '商用流量卡用户数';

-- ----------------------------
-- Table structure for T_UserState_Statistics_AMP
-- ----------------------------
CREATE TABLE "public"."T_UserState_Statistics_AMP" (
    "sdr_id" varchar(32) COLLATE "default" NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_date_flag" int4 DEFAULT 0,
    "sdr_cumulative_users" int8 DEFAULT 0,
    "sdr_loss_user" int8 DEFAULT 0,
    "sdr_survival_user" int8 DEFAULT 0,
    "sdr_survival_rate" float4,
    "sdr_online_user" int8 DEFAULT 0,
    "sdr_offline_user" int8 DEFAULT 0,
    "sdr_active_rate" float4,
    "sdr_online3_user" int8 DEFAULT 0,
    "sdr_online7_user" int8 DEFAULT 0,
    "sdr_online14_user" int8 DEFAULT 0,
    "sdr_online30_user" int8 DEFAULT 0,
    CONSTRAINT "uk_uss_amp" UNIQUE ("sdr_id", "sdr_time", "sdr_date_flag")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_id" IS '代理商ID';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_date_flag" IS '时间标识';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_cumulative_users" IS '当天累计用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_loss_user" IS '遗失用户数（不包括14天内新增用户）';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_survival_user" IS '存活用户数（累计用户 – 遗失）';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_survival_rate" IS '存活率（存活/累计用户）*100%';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_online_user" IS '当天在线用户数（活跃用户）';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_offline_user" IS '当天离线用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_active_rate" IS '活跃度（活跃用户/累计用户）*100%';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_online3_user" IS '连续在线3天用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_online7_user" IS '连续在线7天用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_online14_user" IS '连续在线14天用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_AMP"."sdr_online30_user" IS '连续在线30天用户数';

-- ----------------------------
-- Table structure for T_UserState_Statistics_EMP
-- ----------------------------
CREATE TABLE "public"."T_UserState_Statistics_EMP" (
    "sdr_id" int8 NOT NULL,
    "sdr_record_time" timestamp(6) NOT NULL,
    "sdr_time" date NOT NULL,
    "sdr_date_flag" int4 DEFAULT 0,
    "sdr_cumulative_users" int8 DEFAULT 0,
    "sdr_loss_user" int8 DEFAULT 0,
    "sdr_survival_user" int8 DEFAULT 0,
    "sdr_survival_rate" float4,
    "sdr_online_user" int8 DEFAULT 0,
    "sdr_offline_user" int8 DEFAULT 0,
    "sdr_active_rate" float4,
    "sdr_online3_user" int8 DEFAULT 0,
    "sdr_online7_user" int8 DEFAULT 0,
    "sdr_online14_user" int8 DEFAULT 0,
    "sdr_online30_user" int8 DEFAULT 0,
    CONSTRAINT "uk_uss_emp" UNIQUE ("sdr_id", "sdr_time", "sdr_date_flag")
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_id" IS '企业ID';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_record_time" IS '记录写入时间，最小单位秒';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_time" IS '统计时间点';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_date_flag" IS '时间标识';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_cumulative_users" IS '当天累计用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_loss_user" IS '遗失用户数（不包括14天内新增用户）';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_survival_user" IS '存活用户数（累计用户 – 遗失）';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_survival_rate" IS '存活率（存活/累计用户）*100%';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_online_user" IS '当天在线用户数（活跃用户）';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_offline_user" IS '当天离线用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_active_rate" IS '活跃度（活跃用户/累计用户）*100%';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_online3_user" IS '连续在线3天用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_online7_user" IS '连续在线7天用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_online14_user" IS '连续在线14天用户数';
COMMENT ON COLUMN "public"."T_UserState_Statistics_EMP"."sdr_online30_user" IS '连续在线30天用户数';

CREATE TABLE "public"."T_Version" (
    "v_id" int4 NOT NULL,
    "v_version" varchar(32) NOT NULL,
    "v_time" timestamp(6),
    PRIMARY KEY ("v_id")
)
WITH (OIDS=FALSE)
;

-------------------------------
-- Primary Key structure for table T_Version
-- ----------------------------
ALTER TABLE "public"."T_Version";

insert into "T_Version" (v_id, v_version, v_time) values(0,'1.0',now());

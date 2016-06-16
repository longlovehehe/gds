#############################################
#
# Makefile for gds Program 
# 
# Author: wgfxcu 
#   Date: 2016/03/09
# 
# Make Target:
# ------------
# The Makefile provides the fllowing targets to make:
# $make 			compile and link 
# $make ctags		create ctags for VI editor 
# $make clean 		clean objects and executable file 
# $make rpm 		
#


# The directories in which source files reside.
SRC_DIR = ./src
MOD_DIR = ./modules

MOD_SRC = $(wildcard $(MOD_DIR)/*.c)
MOD_LIB = $(patsubst %.c, %.so, $(MOD_SRC))

GDS_SRC = $(SRC_DIR)/gds.c			\
		  $(SRC_DIR)/config.c		\
		  $(SRC_DIR)/log.c 			\
		  $(SRC_DIR)/common.c		\
		  $(SRC_DIR)/framework.c	\
		  $(SRC_DIR)/output_file.c	\
		  $(SRC_DIR)/output_db.c	\
		  $(SRC_DIR)/output_print.c	

GDS_OBJS = $(SRC_DIR)/gds.o			\
		   $(SRC_DIR)/config.o		\
		   $(SRC_DIR)/log.o			\
		   $(SRC_DIR)/common.o		\
		   $(SRC_DIR)/framework.o	\
		   $(SRC_DIR)/output_file.o	\
		   $(SRC_DIR)/output_db.o	\
		   $(SRC_DIR)/output_print.o	

# The executable file name.
PROGRAM	= $(SRC_DIR)/gds 

# RPM package directory
RPM = ./rpm

# The directories in which header file reside.
INC_DIR = ./include 

# The C program compiler 
CC = gcc
LD = ld

CTAGS = ctags
CTAGSFLAGS = -R

# The pre-processor and compiler options.
CFLAGS 	= -Wall -g -O -lpthread -ldl -ldbi -I$(INC_DIR)
LDFLAGS = -rdynamic 
SOFLAGS = -I$(INC_DIR) -Wall -fPIC --shared -g -ldbi

# The command used to delete file.
RM = rm -f

.PHONY: all ctags clean  rpm

all:$(PROGRAM) $(MOD_LIB)

# Rules for creating dependency file.
# --------------------------------------

$(PROGRAM):$(GDS_OBJS)
	$(CC) $(CFLAGS) $(LDFLAGS) $(GDS_OBJS) -o $@ 

$(MOD_LIB):%.so:%.c                                                                                       
	$(CC) $(SOFLAGS) $^ -o  $@


# Rules for clean genetating the tags.
# --------------------------------------
ctags:$(INC_DIR) $(SRC_DIR) $(MOD_DIR)
	$(CTAGS) $(CTAGSFLAGS) $(INC_DIR) $(SRC_DIR) $(MOD_DIR)


# Rules for clean executable and objects file.
# --------------------------------------
clean:
	$(RM) $(PROGRAM) $(GDS_OBJS) 
	$(RM) $(MOD_LIB) $(MOD_OBJS)
	$(RM) $(RPM)/gds-*.rpm


# Rules for creating rpm 
# --------------------------------------
#Judgment is 64 bit system or 32 bit system
SYSTERM = $(shell uname -r)

ifeq ($(findstring x86_64,$(SYSTERM)),$(nullstring)) 
	PLATFORM = i386
else
	PLATFORM = x86_64
endif

rpm:
	rpm/gds-build.sh
	rpmbuild -bb rpm/gds.spec
	cp /usr/src/redhat/RPMS/${PLATFORM}/gds-*.${PLATFORM}.rpm rpm
	rm /usr/src/redhat/RPMS/${PLATFORM}/gds-*.${PLATFORM}.rpm
	



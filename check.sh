# made by Vinit Agarwal, Tanya Agarwal and Rashi gupta
#!/bin/bash

#arg 1  --->   path of user dir ( /icpc/checking )
#arg 2  --->   uid (user id of the team )
#arg 3  --->   qcode (question code, each ques has a question code
#arg 4  --->   secret path ( dir where the solution and input data sets are stored )
#arg 5  --->   compiler  ( be sure to have compiler name in "(quotes) neccasry if giving compiler options like -lm
#arg 6  --->   extention of program file eg .c, .cpp, .java

#echo "hello world";
#exit;
USR_PATH=$1;
CUID=$2;
QCODE=$3;
SECRET_PATH=$4;
CC=$5;
EXT=$6; 

TIMEOUT=2;

#export PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games";
export PATH="/usr/kerberos/bin:/usr/local/bin:/bin:/usr/bin:/usr/libexec/gcc:/www/iupc:";


##testing for compiler error
#compiling....
echo "hiiiii";

case "$CC" in
javac)
	 `mv ${USR_PATH}/${CUID}/${QCODE}.java ${USR_PATH}/${CUID}/${QCODE}_${CUID}.java  2>> ./err` 
	cd ${USR_PATH}/${CUID} ; $CC ${QCODE}_${CUID}.${EXT} 2>> /www/iupc/err
	cd - > /dev/null
	;; 
	
gcc*)
	`$CC -o ${USR_PATH}/${CUID}/${QCODE}_${CUID} ${USR_PATH}/${CUID}/${QCODE}.${EXT} 2>> ./err`
    echo "hii"
     ;;
	
g++)
	`$CC -o ${USR_PATH}/${CUID}/${QCODE}_${CUID} ${USR_PATH}/${CUID}/${QCODE}.${EXT} 2>> ./err` ;;
python)
	#python does not require compilation
	;;
perl)
	#perl does not require compilation
	;;
php)	
	#compilation not required for php
	;;
* )
	echo "Invalid Language";
	echo $CC
	exit;;
esac


#problem with compilation
if [ "$?" -ne "0" ]  #problem with compilation
then
echo "Compilation Error";
exit;
fi


#################################################  DONE WITH COMPILATION ###########################################


#to execute

case "$CC" in
javac)
	cd ${USR_PATH}/${CUID} ; timeout $TIMEOUT "java ${QCODE}_${CUID} < ${SECRET_PATH}${QCODE}.in > ${USR_PATH}/${CUID}/${QCODE}.out"; cd - > /dev/null;;
	
gcc*)
	timeout $TIMEOUT "${USR_PATH}/${CUID}/${QCODE}_${CUID} < ${SECRET_PATH}${QCODE}.in > ${USR_PATH}/${CUID}/${QCODE}.out";;
	
g++)
	timeout $TIMEOUT "${USR_PATH}/${CUID}/${QCODE}_${CUID} < ${SECRET_PATH}${QCODE}.in > ${USR_PATH}/${CUID}/${QCODE}.out";;

python)
	timeout $TIMEOUT "python ${USR_PATH}/${CUID}/${QCODE}.${EXT} < ${SECRET_PATH}${QCODE}.in > ${USR_PATH}/${CUID}/${QCODE}.out";;

perl)
	timeout $TIMEOUT "perl ${USR_PATH}/${CUID}/${QCODE}.${EXT} < ${SECRET_PATH}${QCODE}.in > ${USR_PATH}/${CUID}/${QCODE}.out";;

php)
	timeout $TIMEOUT "php ${USR_PATH}/${CUID}/${QCODE}.${EXT} < ${SECRET_PATH}${QCODE}.in > ${USR_PATH}/${CUID}/${QCODE}.out";;

* )
	echo "Invalid Language : Cannot Execute";
	exit;;
esac


#the exit status is 22 for "Time Limit Execeeded
ERR="$?"
#echo "ghghg" $ERR 
if `test $ERR -gt 0`
then
	if [ $ERR -eq "22" ]
	then
	    echo "Time Limit Exceeded";
	    #delete the dump
	    rm "${USR_PATH}/${CUID}/${QCODE}.out"
	else
	    echo "RUN TIME ERROR";
	fi
	exit;
fi


################################# END OF CODE EXECUTION #################################


#do a diff...then done
ERR=`diff --ignore-all-space --ignore-blank-lines ${SECRET_PATH}${QCODE}.sol ${USR_PATH}${CUID}/${QCODE}.out > /dev/null; echo $?`
#echo "DIFF $ERR "
if [ "$ERR" -eq "0" ]
then
echo "Accepted"
touch ${USR_PATH}/${CUID}/${QCODE}.done
else
echo "Wrong Answer"
fi

################################# END OF CHECKING ########################################



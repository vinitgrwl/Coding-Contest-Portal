//<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
//	timeout.cpp
//	
//	This program aims at executing a timeout for execution of another
//	program. Another program and timeout has to be set as command 
//	line argument.
//

#include <stdio.h> 
#include <stdlib.h>
#include <string.h>
#include <unistd.h>

#include <pthread.h>
#include <signal.h>

#include <sys/types.h>
#include <sys/wait.h>

char *toExec = NULL;


void killSystem( void )
{
    //get the first word from toExec[]
    char  theCommd[100];
    int i;
    for( i=0 ; toExec[i] != '\0' ; i++ )
    {
	theCommd[i] = toExec[i];
	if( toExec[i] == ' ' )
	    break;
    }
    theCommd[i] = '\0';

    char toKillC[100];
    sprintf( toKillC, "killall %s", theCommd );
    //puts( toKillC );
    system( toKillC );
}


int main(int argc, char ** argv)
{
    if( argc != 3 )
    {
	fprintf( stderr, "INVALID USAGE\n\n%s <timeout> \"<program name>\" \n", argv[0] );
	return 7;
    }

    toExec = argv[2];
    int toWait=0;
    sscanf( argv[1], "%d", &toWait );

    pid_t child = fork();
    if( child >= 0 ) //fork succeeded
    {
	if( child == 0 ) // child process
	{
	    //execute the user program...as this process`
	    system( toExec );
	    
	    //execution done before 2 sec,
	    //   so, kill parent and then do a suicide (kill self)
	    //             this process will receive a kill signal in 2 sec from the parent
	    //printf( "quiting.......child\n" );
	    return 0;
	}
	else //parent process
	{
	    //sleep for 2 sec and then murder the child..
	    sleep( (unsigned int) toWait );
	    //while( 1 ) printf( "..........parent\n" );

	    //murder child..
	    int Kstatus = kill( child, 9 );
	    //if kill failed means the the process does not exist, and the program executed in less than 2 sec

	    int cStatus;
	    wait( &cStatus );
	    //printf( "Kstatus = %d ==== cStatus = %d\n", Kstatus, cStatus );
	    if( cStatus == 0 )
	    {
		//printf( "the child was not killed\n" );
		exit( 0 ); 
	    }
	    else
	    {
		//printf( "the child was killd\n" );
		killSystem();
		exit( 22 ); //time limit exceeded
	    }
	}
    }
    else
    {
	perror( "Fork failed\n" );
    }


    exit( 22 );
}

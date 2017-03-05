/**
 * generate.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Generates pseudorandom numbers in [0,LIMIT), one per line.
 *
 * Usage: generate n [s]
 *
 * where n is number of pseudorandom numbers to print
 * and s is an optional seed
 */
 
#define _XOPEN_SOURCE

#include <cs50.h>
#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include "helpers.h"

// constant
#define LIMIT 65536
const int MAX = 65536;

int main(int argc, string argv[])
{
    // Forces the user to give either two or three arguments when calling Generate
    if (argc != 2 && argc != 3)
    {
        printf("Usage: generate n [s]\n");
        return 1;
    }
int NumList[MAX];
    // Because argv[1] is a string, this converts it to an int
    int n = atoi(argv[1]);

    // This controls the seeding of the randomizing, if a seed value is provided
    if (argc == 3)
    {
        srand48((long int) atoi(argv[2]));
    }
    else
    {
        srand48((long int) time(NULL));
    }

    // For each number desired (given in argv[1] returns a number between 1 and 0 and multiplies it by the Limit (specified above) This gives random numbers essentially
    for (int i = 0; i < n; i++)
    {
       NumList[i] = drand48() * LIMIT;
    }
sort(NumList, n);
for (int q=0; q<n; q++) {printf("%d\n",NumList[q]);}
    // success
    return 0;
}
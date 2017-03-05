/**
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       
#include <cs50.h>

#include "helpers.h"

bool splitter(int value, int values[], int n, int starter, int ender)

{int midpoint;
midpoint = (starter+ender)/2;
    if(ender<starter) {return false;}
    if(values[midpoint]>value) {return splitter(value, values, n, starter, midpoint-1);}
    else if (values[midpoint]<value) {return splitter(value, values, n, midpoint+1, ender);}
    else if (values[midpoint] == value) {return true;}
  return false;
}

/**
 * Returns true if value is in array of n values, else false.
 */
bool search(int value, int values[], int n)
{if (value<0) {return false;}
    return splitter(value, values, n, 0, n);
return false;
}
    
   /* Here is the regular version of search for(int i = 0; i<n; i++)
    {if (values[i] == value)
    {return true;}}*/
    
    
    


/**
 * Sorts array of n values.
 */
void sort(int values[], int n)
{//Selection Sort
    int i = 0;
    int counter = 0;
    int holder = 0;
    while (i<n)
    {counter = i;
    for (int p = i; p< n; p++)
    {
    if (values[p]<values[counter]) {counter = p;}}
        holder = values[counter];
        values[counter] = values[i];
        values[i] = holder;
    i++;}
    return;
}
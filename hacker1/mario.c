/* This program makes 2 mario style pyramids out of #'s in the mario block style with a chasm of two spaces between them.*/

#include <stdio.h>
#include <cs50.h>

int main(void)
{   printf("Height: ");
    int height = GetInt();
    if (height>23) 
    {printf("Please enter an integer less than 24: ");
        height = GetInt();}
        else if (height<0)
        {printf("Please enter a positive integer for height: ");
        height = GetInt();}
    int level = 1;
    while (height>=level)
    {for (int block = 1; height>=block; block++)
    {if (block > -1*(level-height) )
    {printf("#");} 
    else
    {printf(" ");}
    }
    printf("  ");
    for (int block2 = 1; height>=block2; block2++)
    {if (block2 <= level) {printf("#");}} 
    printf("\n");
    level++;}
}
    
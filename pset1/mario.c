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
    {for (int block = 1; height + 1>=block; block++)
    {if (block > -1*(level-height) )
    {printf("#");} 
    else
    {printf(" ");}
    }
    printf("\n");
    level++;}
}
    
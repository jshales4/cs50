# include <stdio.h>
# include <cs50.h>
#include <math.h>

int main(void)
{printf("Hello! Enter the amount of change required: ");
float change_f = GetFloat();
if (change_f<0) {printf("Please do not enter a negative number :\n"); change_f = GetFloat();}
int change_i = round(change_f * 100);
int quarters = 0;
int dimes = 0;
int nickels = 0;
int pennies = 0;

while (change_i>0)
{if (change_i>=25)
{change_i = change_i-25; quarters ++;} 
else if (change_i >=10) {change_i = change_i - 10; dimes ++;}
else if (change_i>=5) {change_i = change_i - 5; nickels++;}
else if (change_i>=1) {change_i = change_i - 1; pennies++;}
}

printf("%d\n", quarters + dimes + nickels + pennies);

}
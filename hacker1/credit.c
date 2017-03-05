#include <stdio.h>
#include <cs50.h>
#include <string.h>
int main(void)
{printf("Please enter a credit card number: ");
    long long int card = GetLongLong();
    int result[20];
    int index = 0;
    int digit;
    while (card>0)
    {digit = card % 10;
    result[index] = digit;
    card = card/10;
    index++; }
    
    
    int p = 0;
    while (p<index)
    {if (p % 2 != 0)
    { result[p] = result[p] *2; if (result[p] > 9) {result[p] = result[p] - 10 + 1;}
    } p++;}
    int r = 0;
    int valid = 0;
    while (r<index)
    {valid = valid + result[r];
    r++;}
    
    if (valid % 10 != 0)
    {printf("INVALID\n");}
    {if (digit == 3) {printf("AMEX\n");}
    {if (digit == 4) {printf("VISA\n");}
    {if (digit == 5) {printf("MASTERCARD\n");}
    }}}
    };
    
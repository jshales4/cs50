#include <cs50.h>
#include <stdio.h>
#include <string.h>
#include <ctype.h>

int main(void)
{string name = GetString();
char initials[100];
int p = 0;
printf("%c",toupper(name[0]));
for (int i=0; i< strlen(name); i++)
{if (name[i]==' ' && name[i+1]!='\0') {initials[p]=name[i+1]; p++;};}
for (int n=0; n<p; n++){printf("%c",toupper(initials[n]));};
printf("\n");}
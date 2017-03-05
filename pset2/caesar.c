#include <cs50.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>


int main(int argc, string argv[]){
    if(argc<2){printf("Enter an argument for Caesar!\n"); return 1;} else {int k = atoi(argv[1]) % 26;
    int x;
    string phrase = GetString();
    for (int i = 0; i<strlen(phrase); i++)
    {int p = (int)phrase[i]; 
    if ((p<91 && p>64)) {x = 90;} else {if((p>96 && p<123)) {x = 122;} else {x = 1000; p=p-k;}}
        if ((p + k)>x) {printf("%c",p + k - 26);} else {printf("%c",p + k);}}
printf("\n");
return 0;
}}

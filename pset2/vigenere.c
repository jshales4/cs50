#include <cs50.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>


int main(int argc, string argv[]){
    if(argc<2){printf("Enter an argument for the Vigenere cipher!\n"); return 1;}
    int x;
    for (int q = 0; q<strlen(argv[1]); q++)
    {if ((argv[1][q]<91 && argv[1][q]>64)) {argv[1][q] = argv[1][q] + 32;} 
    else if ((argv[1][q]<97 || argv[1][q]>122)) {printf("Enter a valid string argument!"); return 1;}}
    string phrase = GetString();
    int k = 0;
    for (int i = 0; i<strlen(phrase); i++)
    {int p = (int)phrase[i]; int r = argv[1][k]-97;
    if ((p<91 && p>64)) {x = 90; k = (k+1) % strlen(argv[1]);} 
    else {if((p>96 && p<123)) {x = 122; k = (k+1) % strlen(argv[1]);} else {x = 1000; p=p-r;}}
        if ((p + r)>x) {printf("%c",p + r - 26);} else {printf("%c",p + r);}}
printf("\n");
return 0;
}
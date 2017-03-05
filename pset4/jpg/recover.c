/**
 * recover.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Recovers JPEGs from a forensic image.
 */
 
 #include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include <stdbool.h>
typedef uint8_t BYTE;

/* Pseudo-code:
Find beginning of first picture. Write data to picture file in 512 byte chunks 
until a new JPG beginning signature is found. Save file, change outputting to new
file, and repeat until the end of the memory card is reached.
*/
int main(void)
{
   FILE* card = fopen("card.raw", "r");
   FILE* image;
   int counter = 0;
   bool BuildingFile=false;
   BYTE bloc[512];
   while(fread(&bloc, 512, 1, card)>0)
        {if(bloc[0] == 0xff && bloc[1] == 0xd8 && bloc[2] == 0xff && (bloc[3] >= 0xe0 && bloc[3] <= 0xef))
   {if(BuildingFile==true) {fclose(image);}
   else {BuildingFile=true;}
       char filename[8];
       sprintf(filename, "%03d.jpg", counter++); 
            image = fopen(filename, "w");}
            if(true==1){fwrite(&bloc, 512, 1, image);}
   }
                    
fclose(card);
return 0;
}


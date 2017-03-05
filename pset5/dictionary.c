/**
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 */

#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

#include "dictionary.h"

  typedef struct node 
    {
        char word[LENGTH+2];
        struct node* next;
    }
    node; 
# define SIZE 3000
 node* hashtable[SIZE] = {NULL};
/**
 * Returns true if word is in dictionary else false.
 */
 /* This has function is known as djb2, taken from http://www.cse.yorku.ca/~oz/hash.html*/
 /*unsigned long hash1(char* str) {
  unsigned long hash = 5381;
  int c;
  while ((c = *str++) != 0)
    hash = ((hash << 5) + hash) + c;  hash * 33 + c 
  return hash;
}
 */
 int size_of_dictionary = 0;
 /* D. J.Bernstein hash function */
size_t hash1(const char* cp)
{
    size_t hash = 5381;
    while (*cp)
        hash = 33 * hash ^ (unsigned char) *cp++;
    return hash % SIZE;
} 
 
bool check(const char* word)
{   int length = strlen(word);
    char temporary_word[LENGTH+1];
    for (int i = 0; i< length; i++)
    {if(isalpha(word[i])) {temporary_word[i] = tolower(word[i]);}
        else {temporary_word[i] = word[i];}
    }
    temporary_word[length] = '\0';
    unsigned long hash_picker = hash1(temporary_word);
    if (hashtable[hash_picker]==NULL)
    {return false;}
    node * cursor = hashtable[hash_picker];
    while (cursor != NULL)
    {if (strcmp(temporary_word, cursor->word) == 0) {
        return true;}
        else {cursor = cursor->next;}
        }
        return false;
    
}


/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */

 
bool load(const char* dictionary)

{
   
    FILE* dictio = fopen(dictionary,"r");
    if (dictio ==NULL)
    {return false;}
    char word[LENGTH+1];
  while (!feof(dictio)){
   node* new_node = malloc(sizeof(node));
   size_of_dictionary++;
    fscanf(dictio, "%s\n", word);
    strcpy(new_node->word,word);
    int key = hash1(word); 
    if (hashtable[key]==NULL)
    {hashtable[key]=new_node;
        new_node->next = NULL;
    }
    else
    {new_node->next=hashtable[key];
    hashtable[key]=new_node;
    }
    
}
    fclose(dictio);
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */

 
unsigned int size(void)
{
    if (size_of_dictionary>0)
    {return size_of_dictionary;}
return 0;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{for(int q = 0; q<SIZE; q++)
{if(hashtable[q]!=NULL)
    {node* cursor = hashtable[q]->next;
    while(cursor!= NULL)
    {node* temp = cursor;
    cursor = cursor->next;
    free(temp);}}}
    return true;
}

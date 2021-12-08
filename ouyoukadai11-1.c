#include <stdio.h>

void keisan(int a,int b,int *c,int *d);

void main(void)
{
	int a,b,c,d;
	
	printf("a = ");
	scanf("%d",&a);
	printf("b = ");
	scanf("%d",&b);
	
	keisan(a,b,&c,&d);
	printf("\na - b = %d\n",c);
	printf("\na Å~ b = %d\n",d);
}

void keisan(int a,int b,int *c,int *d)
{
	*c = a - b;
	
	*d = a * b;
}
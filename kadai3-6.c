#include <stdio.h>

void main(void)
{
	double i,j,height[5],weight[5],bmi[5],n;
	
	for(i = 0;i < 5;i++){
		printf("%if‚Ìg’· = ",i);
		scanf("%if",&height[i]);
		printf("%if‚Ì‘Ìd = ",i);
		scanf("%if",&weight[i]);
	}
	
	for(i = 0;i < 5;i++){
		bmi[i] = weight[i] / (height[i] * height[i]);
	}
	
	for(i = 0;i < 5;i++){
		for(j = i;j < 5;j++){
			if(bmi[i] > bmi[j]){
				 n = bmi[i];
				bmi[i] = bmi[j];
				bmi[j] = n;
			}
		}
	}
	for(i = 0;i < 5;i++){
		printf("%f \n",bmi[i]);
	}
}
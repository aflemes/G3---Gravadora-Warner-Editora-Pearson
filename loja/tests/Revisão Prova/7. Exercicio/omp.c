

int main(){
	int n,p, tid, i;
	float fat;

	printf("informe o n e o p");
	scanf("%d %d",&n,&p);

	nodo = 0;
	#pragma omp parallel
	{
		omp_set_num_thread(n);
		tid = omp_get_thread_num();

		for(i=3,nodo < p,i+=2){
			fat = fatorial(i);			

		}

				
	
	}	
	
	
}

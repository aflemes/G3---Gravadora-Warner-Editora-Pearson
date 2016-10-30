#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <stdlib.h>
#include <string.h>

#define N 10000
/*---------------------------------------------------------------------------------------------------*/
int main(int argc, char **argv){

	struct sockaddr_in endereco_servidor;
	long int coefBin, fatn, fatp, fatnp;
	int n, p,valor;
	int soquete;
	
	if ( argc != 3 ){
		printf("%s <ip> <porta>\n", argv[0]);
		exit(0);
	}
	
	printf("Entre com n e p\n");
	scanf("%d %d", &n, &p);

	soquete = socket(AF_INET, SOCK_STREAM, 0);


	bzero((char *)&endereco_servidor,sizeof(endereco_servidor));       
	endereco_servidor.sin_family = AF_INET;
	endereco_servidor.sin_addr.s_addr = inet_addr(argv[1]);
	endereco_servidor.sin_port = htons(atoi(argv[2]));

	connect(soquete,(struct sockaddr *)&endereco_servidor, sizeof(endereco_servidor));	
	
	fatnp = n - p;

	// fatorial de fatn
	send(soquete, &n, sizeof(n), 0);
	recv(soquete, &fatn, sizeof(fatn), 0);	
	
	// fatorial de fatp
	send(soquete, &p, sizeof(p), 0);
	recv(soquete, &fatp, sizeof(fatp), 0);

	// fatorial de fatnp
	send(soquete, &fatnp, sizeof(fatnp), 0);
	recv(soquete, &fatnp, sizeof(fatnp), 0);

	coefBin = fatn/(fatp)* fatnp;

	printf("Coeficiente binomila %ld\n", coefBin);	

	close(soquete);

}
/*---------------------------------------------------------------------------------------------------*/


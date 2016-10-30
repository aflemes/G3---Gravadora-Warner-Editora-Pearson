#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <stdlib.h>
#include <string.h>

#define N 1000

/*---------------------------------------------------------------------------------------------------*/
long int fatorial(int k){
	long int f;
	int i;
	for (i=1; i<=k; i++)
		f*= i;
	return f;
}
int main(int argc, char **argv){

	struct sockaddr_in endereco_cliente, endereco_servidor;
	int soquete;
	int tamanho;
	int valor;

	if ( argc != 2){
		printf("%s <porta>\n", argv[0]);
		exit(0);
	}
	
	soquete = socket(AF_INET, SOCK_DGRAM, 0);

	bzero((char *)&endereco_servidor,sizeof(endereco_servidor));       
	endereco_servidor.sin_family = AF_INET;
	endereco_servidor.sin_addr.s_addr = INADDR_ANY;
	endereco_servidor.sin_port = htons(atoi(argv[1]));

	bind(soquete, (struct sockaddr *) &endereco_servidor, sizeof(endereco_servidor));

	tamanho = sizeof(endereco_cliente);
	
	recvfrom(soquete, &valor, sizeof(int), 0, (struct sockaddr *)&endereco_cliente, &tamanho);
	
	valor =	fatorial(valor);

	sendto(soquete, (char*) valor, sizeof(valor) + 1, 0, (struct sockaddr *)&endereco_cliente, sizeof(endereco_cliente));

	close(soquete);
}

/*---------------------------------------------------------------------------------------------------*/

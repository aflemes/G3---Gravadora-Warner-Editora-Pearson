#include <stdio.h>
#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <stdlib.h>
#include <string.h>

/*---------------------------------------------------------------------------------------------------*/
#define CONEXOES 10
#define N 50
/*---------------------------------------------------------------------------------------------------*/

long int fatorial(int n){
	long int f;
	int i;

	for (i=1; i<=n; i++)
		f*= i;
	return f;
}

//SOCKET é formado pelo IP e pela PORTA
int main(int argc, char **argv){

	struct sockaddr_in endereco_servidor;
	int soquete_servidor, soquete_cliente;
	int tamanho;
	int valor,i;
    int pid;

	if ( argc != 2){
		printf("%s <porta>\n", argv[0]);
		exit(0);
	}

	soquete_servidor = socket(AF_INET, SOCK_STREAM, 0);

	bzero((char *)&endereco_servidor,sizeof(endereco_servidor));       
	endereco_servidor.sin_family = AF_INET;
	endereco_servidor.sin_addr.s_addr = INADDR_ANY;
	endereco_servidor.sin_port = htons(atoi(argv[1]));

	bind(soquete_servidor,(struct sockaddr *) &endereco_servidor, sizeof(endereco_servidor));

	listen(soquete_servidor, CONEXOES);

	// a porta 80 é apenas a porta de entrada, depois o servidor aloca uma nova porta exclusiva ao cliente
	soquete_cliente = accept(soquete_servidor, NULL, NULL);

	for(i=0;i < 3; i++){
		recv(soquete_cliente,&valor,sizeof(valor) + 1,0);
	
		valor = fatorial(valor);

		send(soquete_cliente, &valor, sizeof(valor) + 1, 0);	
	}
        
   	close(soquete_cliente);
	close(soquete_servidor);

}

/*---------------------------------------------------------------------------------------------------*/

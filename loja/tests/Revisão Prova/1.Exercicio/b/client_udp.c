#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <stdlib.h>
#include <string.h>

#define N 1000

/*TESTAR COM IP 127.0.0.1 PORTA 13, RETORNA A HORA*/

/*---------------------------------------------------------------------------------------------------*/
int main(int argc, char **argv){

	struct sockaddr_in endereco_servidor;
	struct sockaddr_in endereco_msg;
	int soquete, tamanho;
    long int coefBin, fatn, fatp, fatnp;
    int n, p;

	if ( argc != 3 ){
		printf("%s <ip> <porta>\n", argv[0]);
		exit(0);
	}

	printf("Entre com n e p\n");
    scanf("%d %d", &n, &p);

	soquete = socket(AF_INET, SOCK_DGRAM, 0);

    fatnp = n - p;

	bzero((char *)&endereco_servidor,sizeof(endereco_servidor));       
	endereco_servidor.sin_family = AF_INET;
	endereco_servidor.sin_addr.s_addr = inet_addr(argv[1]);
	endereco_servidor.sin_port = htons(atoi(argv[2]));

    //fatorial de n
	sendto(soquete, (char*) n, sizeof(n) + 1, 0, (struct sockaddr *) &endereco_servidor, sizeof(endereco_servidor));
	recvfrom(soquete, &fatn, sizeof(fatn), 0, NULL, NULL);
    
    //fatorial de p
	sendto(soquete, (char*) p, sizeof(p) + 1, 0, (struct sockaddr *) &endereco_servidor, sizeof(endereco_servidor));
	recvfrom(soquete, &fatp, sizeof(fatp), 0, NULL, NULL);

    //fatorial de n
	sendto(soquete, (char*) fatnp, sizeof(fatnp) + 1, 0, (struct sockaddr *) &endereco_servidor, sizeof(endereco_servidor));
	recvfrom(soquete, &fatnp, sizeof(fatnp), 0, NULL, NULL);

    coefBin = fatn/(fatp)*fatnp);
    printf("Coeficiente binomila %ld\n", coefBin);

	close(soquete);

}
/*---------------------------------------------------------------------------------------------------*/




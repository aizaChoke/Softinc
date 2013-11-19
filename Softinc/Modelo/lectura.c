#include<stdio.h>
int main() {
    int p,q,r;
    while (scanf("%d %d",&p,&q) != EOF) 
    {
        if (q>p) r=q-p;
        else r=p-q;
        printf("%d\n",r);
    }
}

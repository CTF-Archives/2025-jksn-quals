#include <bits/stdc++.h>
using namespace std;

int main () {

    int cnt = 0;
    for(int i = 0; i < 10; i++) {
        int cnt = i;
        cnt = cnt - 1;
    }
    for(int i = 0; i < 20; i++) {
        cnt = cnt + 1;
    }

    cout << cnt;

    return 0;
}
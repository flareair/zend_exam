<?php

$socket = stream_socket_server("tcp://0.0.0.0:1037");

echo "Server started!\n";
while ($conn = stream_socket_accept($socket, -1)) {
  echo "Request!\n";
  fwrite($conn, "Hello World\n");
  fclose($conn);
}

fclose($socket);
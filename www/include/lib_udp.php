<?php

	########################################################################

	function udp_send($address, $msg, $more=array()){

		list($host, $port) = explode(":", $address);
		$len = strlen($msg);

		$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

		if (! $sock){
			$err = socket_strerror(socket_last_error());
			return not_okay("failed to create socket: {$err}");
		}

		if (isset($more['broadcast'])){
			socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1); 
		}

		$ok = socket_sendto($sock, $msg, $len, 0, $host, $port);
		socket_close($sock);

		if (! $ok){
			$err = socket_strerror(socket_last_error());
			return not_okay("failed to send message: {$err}");
		}

		return okay();
	}

	########################################################################

?>

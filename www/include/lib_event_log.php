<?php

	# EXPERIMENTAL (20120426/straup)

	########################################################################

	function event_log_record($event){

		if (! $GLOBALS['cfg']['enable_feature_event_log']){
			return not_okay("event logging is not enabled");
		}

		$collector = $GLOBALS['cfg']['event_log_collector'];

		if (! $collector){
			error_log("[EVENT] " . json_encode($event));
			return okay();
		}

		try {
			loadlib($collector);
		}

		catch (){
			return not_okay("failed to load event log collector '{$collector}'");
		}	

		$func_name = "{$collector}_record";
		return call_user_func_array($func_name, array($event));
	}

	########################################################################

?>

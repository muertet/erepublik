<?php
/**
* Simple XHProf debugging class
*/
class XHProf
{
	/**
	* Starts XHProf
	* 
	* @return boolean
	*/
	public static function start()
	{
		if (extension_loaded('xhprof')) {
		    include_once '../../xhprof-master/xhprof_lib/utils/xhprof_lib.php';
		    include_once '../../xhprof-master/xhprof_lib/utils/xhprof_runs.php';
		    xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
			
			return true;
		}else{
			return false;
		}
	}
	
	/**
	* Stops XHProf
	* 
	* @return string
	*/
	public static function stop()
	{
		if (extension_loaded('xhprof')) {
		    $profiler_namespace = 'eRepublikClone';  // namespace for your application
		    $xhprof_data = xhprof_disable();
		    $xhprof_runs = new XHProfRuns_Default();
		    $run_id = $xhprof_runs->save_run($xhprof_data, $profiler_namespace);
		    $profiler_url = sprintf('http://localhost/xhprof-master/xhprof_html/index.php?run=%s&source=%s', $run_id, $profiler_namespace);
		    return '<a href="'. $profiler_url .'" target="_blank">Profiler output</a>';
		}
	}
}
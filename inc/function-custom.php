<?php
function log_dump($data)
{
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);

	$formatted = '<pre>' . substr($highlighted, 27, -8) . '</pre>';

	$custom_css = 'pre {position: static;
		background: #ffffff80;
		// max-height: 50vh;
		width: 100vw;
	}
	pre::-webkit-scrollbar{
	width: 1rem;}';

	$formatted_css = '<style>' . $custom_css . '</style>';
	echo ($formatted_css . $formatted);
}

function empty_content($str)
{
	return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}

?>
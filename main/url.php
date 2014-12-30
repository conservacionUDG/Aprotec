<?php
	switch ($objects["principal"]->url_p(URL_short())) {
		default:{$objects['principal']->page('404.html');}break;
		case '/':{$objects['principal']->index();}break;
		case '/quinesomos/':{$objects['principal']->page('quienessomos.html');}break;
	}
?>
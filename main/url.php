<?php
	switch ($objects["principal"]->url_p(URL_short())) {
		default:{$objects['principal']->page('404.html','Error 404');}break;
		case '/':{$objects['principal']->index();}break;
		case '/quinesomos/':{$objects['principal']->page('quienessomos.html','Quines Somos');}break;
		case '/calendario/':{$objects['principal']->page('calendario.html','Calendario');}break;
		case '/faq':{$objects['principal']->page('faq.html','Preguntas Frecuntes');}break;
	}
?>
<?php
	switch ($objects["principal"]->url_p(URL_short())) {
		default:{$objects['principal']->page('404.html','Error 404');}break;
		case '/':{$objects['principal']->index();}break;
		case '/quinesomos/':{$objects['principal']->page('quienessomos.html','Quines Somos');}break;
		case '/calendario/':{$objects['principal']->page('calendario.html','Calendario');}break;
		case '/faq':{$objects['principal']->page('faq.html','Preguntas Frecuntes');}break;
		case '/em-confian/':{$objects['principal']->page('empresas-confian.html','Empresas que confian');}break;
		case '/contactanos/':{$objects['principal']->contactanos();}break;
		case '/miperfil/':{$objects['principal']->miperfil();}break;
		case '/eventos/':{$objects['principal']->eventos();}break;
		case '/jobs/':{$objects['principal']->jobs();}break;
		case '/reg-oferta/':{$objects['principal']->reg_oferta();}break;
		case '/log-in/':{$objects['principal']->log_in();}break;
		case '/register/':{$objects['principal']->registrar();}break;
	}
?>
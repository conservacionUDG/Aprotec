<?php
	switch ($objects["principal"]->url_p(URL_short())) {
		/**
		*Url del sistema.
		*Paguinas principales y cosas que los usuarios pueden ver
		*e interactuar con ellas.
		**/
		default:{$objects['principal']->page('404.html','Error 404');}break;
		case '/':{$objects['principal']->index();}break;
		case 'quinesomos':{$objects['principal']->page('quienessomos.html','Quines Somos');}break;
		case 'calendario':{$objects['principal']->page('calendario.html','Calendario');}break;
		case 'faq':{$objects['principal']->page('faq.html','Preguntas Frecuntes');}break;
		case 'em-confian':{$objects['principal']->empresas_conf();}break;
		case 'contactanos':{$objects['principal']->contactanos();}break;
		case 'miperfil':{$objects['principal']->miperfil();}break;
		case 'eventos':{$objects['principal']->eventos();}break;
		case 'jobs':{$objects['principal']->jobs();}break;
		case 'reg-oferta':{$objects['principal']->reg_oferta();}break;
		case 'log-in':{$objects['principal']->log_in();}break;
		case 'register':{$objects['principal']->registrar();}break;
		case 'news':{$objects['principal']->news();}break;
		case 'destroy':{$objects['principal']->destroy();}break;
		case 'recursos':{$objects['principal']->recursos();}break;
		/**
		*Url del CMD.
		*Paguinas que solo los administradores del contenido van a poder ver
		*y son por las cuales se podra editar el contenido del sistema para
		*poder actualizarlo como sea devido.
		**/
		case 'CMD':{$objects['cmd']->index();}break;
		/**
		*Url de las clases.
		*App sacada de learningWor
		**/
	}
?>
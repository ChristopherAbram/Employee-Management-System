<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Definitions for classes package.
 *
 * @package    core\classes
 * @author     Christopher Abram
 * @version    1.0
 * @date	09.09.2016
 */
 
define('DATETIME', 'Y-m-d H:i:s');
define('DATE', 'Y-m-d');

define('GUEST', 'guest');
define('PLAIN', 'plain');
define('PUBLICIST', 'publicist');
define('ADMINISTRATOR', 'administrator');

define('REGEX_STANDARD', '[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s]');
define('REGEX_STANDARD_PUNCTUATION', '[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s\,\.\?\!]');
define('REGEX_NUMERIC', '[0-9]');
define('REGEX_ALPHANUMERIC', '[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s]');
define('REGEX_ALPHANUMERIC_PUNCTUATION', '[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s\,\.\?\!]');

// Special character set:
define('REGEX_EMAIL', '(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))');
define('REGEX_PATH', '(https|http|ftp)\:\/\/|([a-z0-9A-Z]+\.[a-z0-9A-Z]+\.[a-zA-Z]{2,4})|([a-z0-9A-Z]+\.[a-zA-Z]{2,4})|\?([a-zA-Z0-9]+[\&\=\#a-z]+)');
define('REGEX_PHONE', '((?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\s\/]?)?((?:\(?\d{1,}\)?[\-\.\s\/]?){0,})(?:[\-\.\s\/]?(?:#|ext\.?|extension|x)?[\-\.\s\/]?(\d+))?)');
define('REGEX_FLOAT', '[0-9A-Za-z\_\,\.\-\:\+\=]');
define('REGEX_INT', '-?([0-9])|([1-9][0-9]*)');
define('REGEX_INT_UNSIGNED', '([0-9])|([1-9][0-9]*)');
define('REGEX_TITLE', '[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s\_\,\.\-\<\>\(\)\[\]\!\?\@\#\$\%\^\&\*\:\;\/\{\}\+\=\~]');
define('REGEX_NAMEPATH', '([0-9]*[A-Za-z\_\,\.\-]+[0-9]*)');

$MIME = array(
    // images :
    'image/png'						=> '.png',
    'image/jpeg'                                        => '.jpeg',
    'image/gif'						=> '.gif',
    'image/bmp'						=> '.bmp',
    //'image/x-icon'                                        => '.ico',
    //'image/x-rgb'                                         => '.rgb',
    //'image/vnd.dwg'					=> '.dwg',
    //'image/vnd.dxf'					=> '.dxf',
    //'image/jp2'						=> '.jp2',

    'image/x-ms-bmp'                                        => '.bmp',
    'image/x-targa'                                     => '.tga',	
    'image/vnd.adobe.photoshop'                         => '.ai',
    'image/xbm' 					=> '.xbm',
    'image/pxm' 					=> '.pxm',

    'image/vnd.svf'					=> '.svf',
    'image/tiff'					=> '.tiff',
    // audio :
    'audio/3gpp,video/3gpp'			=> '.3gpp',
    'audio/ac3'						=> '.ac3',
    'audio/basic'					=> '.au',
    'audio/mpeg,video/mpeg'			=> '.mp2',
    'audio/mpeg'					=> '.mp3',
    'audio/mp4,video/mp4'			=> '.mp4',
    'audio/x-wav'					=> '.wav',

    'audio/midi' 					=> '.mid',
    'audio/ogg' 					=> '.ogg',
    'audio/x-m4a' 					=> '.m4a',
    'audio/wav' 					=> '.wav',
    'audio/x-ms-wma' 				=> '.wma',
    // videos :
    'video/mpeg'					=> '.mpeg',
    'video/quicktime'				=> '.mov',
    'video/x-msvideo'				=> '.avi',
    'video/x-sgi-movie'				=> '.movie',
    'video/x-matroska'				=> '.mkv',
    'video/x-ms-wmv'				=> '.wmv',
    'video/x-flv'					=> '.flv',

    'video/x-dv'					=> '.dv',
    'video/mp4'						=> '.mp4',
    'video/webm' 					=> '.webm',
    'video/ogg' 					=> '.ogv',
    // text :
    'text/css'						=> '.css',
    'text/csv'						=> '.csv',
    'text/html'						=> '.html',
    'text/javascript,application/javascript' => '.js',
    'text/plain'					=> '.txt',
    'text/xml,application/xml'		=> '.xml',

    'text/x-php' 					=> '.php',
    'text/javascript' 				=> '.js',
    'text/rtf' 						=> '.rtf',
    'text/rtfd' 					=> '.rtfd',
    'text/x-python' 				=> '.py',
    'text/x-java-source'			=> '.java',
    'text/x-ruby' 					=> '.rb',
    'text/x-shellscript' 			=> '.sh',
    'text/x-perl' 					=> '.pl',
    'text/xml' 						=> '.xml',
    'text/x-sql' 					=> '.sql',
    'text/x-csrc' 					=> '.c',
    'text/x-chdr' 					=> '.h',
    'text/x-c++src' 				=> '.cpp',
    'text/x-c++hdr' 				=> '.hh',
    'text/x-comma-separated-values' => '.csv',

    // application :
    'application/octet-stream'		=> '.exe',
    'allpication/vnd.ms-asf' 		=> '.asf',
    'application/msword'			=> '.doc',
    'application/xml-dtd'			=> '.dtd',
    'application/json'				=> '.json',
    'application/pdf'				=> '.pdf',
    'image/vnd.adobe.photoshop'		=> '.psd',
    'application/postscript'		=> '.ai',
    'application/vnd.ms-powerpoint' => '.ppt',
    'application/rtf,text/rtf'		=> '.rtf',
    'application/xhtml+xml'			=> '.xhtml',
    'application/vnd.ms-excel'		=> '.xls',
    'aplication/zip'				=> '.zip',
    'application/x-zip-compressed'	=> '.zip',
    'application/x-rar-compressed'	=> '.rar',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx',
    'application/tar'				=> '.tar', 
    'application/x-tar'				=> '.tar', 
    'applicaton/x-gtar'				=> '.tar', 
    'multipart/x-tar'				=> '.tar', 
    'application/x-compress'		=> '.tar', 
    'application/x-compressed'		=> '.tar',
    'application/gzip'				=> '.gz', 
    'application/x-gzip'			=> '.gz', 
    'application/x-gunzip'			=> '.gz', 
    'application/gzipped'			=> '.gz', 
    'application/gzip-compressed'	=> '.gz', 
    'application/x-compressed'		=> '.gz', 
    'application/x-compress'		=> '.gz', 
    'gzip/document'					=> '.gz',

    'application/x-bzip2' 			=> '.bz',
    'application/x-rar' 			=> '.rar',
    'application/x-7z-compressed' 	=> '.7z',

    'application/x-executable' 		=> '.exe',
    'application/vnd.ms-word' 		=> '.doc',
    'application/vnd.ms-excel' 		=> '.xls',
    'application/xml' 				=> '.xml',
    'application/vnd.oasis.opendocument.text' => '.odt',
    'application/x-shockwave-flash' => '.swf',
    'application/x-bittorrent' 		=> 'torrent',
    'application/x-jar' 			=> 'jar',
	
);

$IMG_TYPES = array( 
    'image/png',
    'image/jpeg',
    'image/gif',
    'image/bmp',
    //'image/x-icon',
    //'image/x-rgb',
    //'image/vnd.dwg',
    //'image/vnd.dxf',
    //'image/jp2',
    'image/vnd.svf',
    'image/tiff',
    'image/x-ms-bmp',
    'image/x-targa',	
    'image/vnd.adobe.photoshop',
    'image/xbm',
    'image/pxm',
);

$AUDIO_TYPES = array( 
    'audio/3gpp,video/3gpp',
    'audio/ac3',
    'audio/basic',
    'audio/mpeg,video/mpeg',
    'audio/mpeg',
    'audio/mp4,video/mp4',
    'audio/x-wav',
    'audio/midi',
    'audio/ogg',
    'audio/x-m4a',
    'audio/wav',
    'audio/x-ms-wma',
);

$VIDEO_TYPES = array( 
    'video/mpeg',
    'video/quicktime',
    'video/x-msvideo',
    'video/x-ms-wmv',
    'video/x-sgi-movie',
    'video/x-matroska',
    'video/x-dv',
    'video/mp4',
    'video/webm',
    'video/ogg',
);

$TEXT_TYPES = array( 
    'text/css',
    'text/csv',
    'text/html',
    'text/javascript,application/javascript',
    'text/plain',
    'text/xml,application/xml',
    'text/x-php',
    'text/javascript',
    'text/rtf',
    'text/rtfd',
    'text/x-python',
    'text/x-java-source',
    'text/x-ruby',
    'text/x-shellscript',
    'text/x-perl',
    'text/xml',
    'text/x-sql',
    'text/x-csrc',
    'text/x-chdr',
    'text/x-c++src',
    'text/x-c++hdr',
    'text/x-comma-separated-values',
);

$APP_TYPES = array( 
    'application/octet-stream',
    'allpication/vnd.ms-asf',
    'application/msword',
    'application/xml-dtd',
    'application/json',
    'application/pdf',
    'image/vnd.adobe.photoshop',
    'application/postscript',
    'application/vnd.ms-powerpoint',
    'application/rtf,text/rtf',
    'application/xhtml+xml',
    'application/vnd.ms-excel',
    'aplication/zip',
    'application/x-zip-compressed',
    'application/x-rar-compressed',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/tar', 
    'application/x-tar', 
    'applicaton/x-gtar', 
    'multipart/x-tar', 
    'application/x-compress', 
    'application/x-compressed', 
    'application/gzip', 
    'application/x-gzip', 
    'application/x-gunzip', 
    'application/gzipped', 
    'application/gzip-compressed', 
    'application/x-compressed', 
    'application/x-compress', 
    'gzip/document',
    'application/x-bzip2',
    'application/x-rar',
    'application/x-7z-compressed',
    'application/x-executable',
    'application/vnd.ms-word',
    'application/vnd.ms-excel',
    'application/xml',
    'application/vnd.oasis.opendocument.text',
    'application/x-shockwave-flash',
    'application/x-bittorrent',
    'application/x-jar', 
);

$ICO = array( // images icons :
    '.png'						=> 'miniature',
    '.jpeg'						=> 'miniature',
    '.jpg'						=> 'miniature',
    '.gif'						=> 'miniature',
    '.bmp'						=> 'miniature',
    //'.ico'						=> 'miniature',
    //'.rgb'						=> 'miniature',
    //'.dwg'						=> 'miniature',
    //'.dxf'						=> 'miniature',
    //'.jp2'						=> 'miniature',
    '.svf'						=> 'miniature',
    '.tiff'						=> 'miniature',
    // audio icons :
    '.3gpp'						=> 34,
    '.ac3'						=> 33,
    '.au'						=> 32,
    '.mp2'						=> 30,
    '.mp3'						=> 21,
    '.mp4'						=> 22,
    '.wav'						=> 37,
    // video icons :
    '.mpeg'						=> 17,
    '.mov'						=> 35,
    '.avi'						=> 16,
    '.movie'						=> 35,
    '.mkv'						=> 36,
    '.wmv'						=> 18,
    '.flv'						=> 38,
    // text icons :
    '.css'						=> 9,
    '.csv'						=> 27,
    '.html'						=> 4,
    '.htm'						=> 4,
    '.php'						=> 8,
    '.js'						=> 7,
    '.txt'						=> 3,
    '.xml'						=> 6,
    // app icons :
    '.exe'						=> 39,
    '.asf'						=> 40,
    '.doc'						=> 11,
    '.rtf'						=> 41,
    '.dtd'						=> 42,
    '.json'						=> 31,
    '.pdf'						=> 2,
    '.psd'						=> 10,
    '.ai'						=> 43,
    '.ps'						=> 44,
    '.ppt'						=> 12,
    '.pptx'						=> 12,
    '.rtf'						=> 41,
    '.xhtml'						=> 4,
    '.xls'						=> 25,
    '.xlsx'						=> 25,
    '.zip'						=> 13,
    '.rar'						=> 15,
    '.tar'						=> 45,
    '.gz'						=> 46,
    '.gzip'						=> 46,
    '.docx'						=> 11,
);
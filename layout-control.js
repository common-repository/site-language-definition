if( !document.querySelector('meta[content="notranslate"]') ){
	jQuery('head').append('<meta name="google" content="notranslate">');
	console.log("done");
}
else {
	console.log(document.querySelector('meta[content="notranslate"]'));
}
if( !document.querySelector('meta[http-equiv="Content-Language"]') ){
	jQuery('head').append('<meta http-equiv="Content-Language" content="' + Lang.lang + '">');
}
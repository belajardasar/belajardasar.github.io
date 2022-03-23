<?php 

/* ==> IMAKE CONFIGURATION CENTER <== */


/*	SCRAPER CONFIG
| -------------------------------------------------------------------
| OVERCLOCK_LEVEL 	= Integer ( 1 - 20 )
| BADWORD_FILTER 	= Boolean TRUE / FALSE
| IMAGE_SOURCE		= String ( bing / google )
| LANG_CODE			= String ( gudang/lang_CODE.txt )
| IS_UTF8			= String TRUE / FALSE
| CSE_FILTER		= String ( site:pinterest.com/pin/ )
| SCRAPING_MODE		= String ( RANDOM, IMAGE_ONLY, or IMAGE_ARTICLE )
| MAX_IMAGE_RESULT	= Integer ( 1 - 35 )
| MAX_ARTICLE_LEVEL	= Integer ( 20 - 30 )
| GOOGLE_SUGGEST 	= Boolean TRUE / FALSE
| PROXY_MODE 		= Boolean TRUE / FALSE
| CEK_PROXY 		= Boolean TRUE / FALSE
| SCRAPER_PHASE 	= Integer ( 1500 - 10000 ) keywords
| SCRAPER_VERSION 	= Integer
| -------------------------------------------------------------------
*/

define("OVERCLOCK_LEVEL",	20); //✔

define("BADWORD_FILTER",	TRUE); //✔

define("IMAGE_SOURCE",		"bing"); //✔

define('LANG_CODE',			'en-US');//✔

define('IS_UTF8',			FALSE);//✔

define("CSE_FILTER",		""); //✔

define("SCRAPING_MODE",		"RANDOM"); //✔

define("MAX_IMAGE_RESULT",	20); //✔

define("MAX_ARTICLE_LEVEL",	25); //✔

//define("GOOGLE_SUGGEST",	FALSE);

define("PROXY_MODE",		FALSE); //✔

define("CEK_PROXY",			TRUE); //✔

define("SCRAPER_PHASE",		5000); //✔

define("SCRAPER_VERSION",	97); //✔


/*	EXPORT CONFIG
| -------------------------------------------------------------------
| THEME_NAME 		= String ( hybrid, native1)
| SITE_NAME 		= String
| SITE_DESCRIPTION 	= String
| SITE_AUTHOR 		= String
| ADS_LINK 			= String
| IS_UADS			= Boolean TRUE / FALSE (U-Ads Client)
| -------------------------------------------------------------------
*/

define("THEME_NAME",		"native1");

define("SITE_NAME",			"{niche} Tips and References");

define("SITE_DESCRIPTION",	"Best {niche} Tips and References website . Search anything about {niche} Ideas in this website.");

define("SITE_AUTHOR",		"James");


define("ARTICLE_PER_XML",	500);
define("BACK_DATE",			"-8 month");
define("SHEDULE_DATE",		"+2 month");
define("WP_CATEGORY",		"wallpaper");

define("MINIFY_HTML",		FALSE);

define("IMAGE_DOWNLOAD",	FALSE);

define("ADS_LINK",			"#EDIT-WITH-YOUR-ADS");

define("IS_UADS",			FALSE);

define("CDN_IMAGE",			TRUE);

/*	NATIVE CONFIG
| -------------------------------------------------------------------
| DEFAULT_NICHE		= String
| POST_EXTENSION	= String ( .html / .xhtml / etc)
| -------------------------------------------------------------------
*/

define("DEFAULT_NICHE",	"sport");

define("POST_EXTENSION", ".html");

//EXPORT CONFIG

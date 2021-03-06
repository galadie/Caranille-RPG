<?php

    $php_recommended_settings = array(array ('Safe Mode','safe_mode','OFF'),
					array ('Display Errors','display_errors','ON'),
					array ('File Uploads','file_uploads','ON'),
					array ('Magic Quotes GPC','magic_quotes_gpc','OFF'),
					array ('Magic Quotes Runtime','magic_quotes_runtime','OFF'),
					array ('Register Globals','register_globals','OFF'),
					array ('Output Buffering','output_buffering','OFF'),
					array ('Session auto start','session.auto_start','OFF'),
					);
/**
    References :
    1. http://en.wikipedia.org/wiki/ISO_3166-1#Officially_assigned_code_elements
*/
    $country_codes = array(
 
'AF' => "AFGHANISTAN" , 
'AL' => "ALBANIA" , 
'DZ' => "ALGERIA" , 
'AS' => "AMERICAN SAMOA" , 
'AD' => "ANDORRA" , 
'AO' => "ANGOLA" , 
'AI' => "ANGUILLA" , 
'AQ' => "ANTARCTICA" , 
'AG' => "ANTIGUA AND BARBUDA" , 
'AR' => "ARGENTINA" , 
'AM' => "ARMENIA" , 
'AW' => "ARUBA" , 
'AU' => "AUSTRALIA" , 
'AT' => "AUSTRIA" , 
'AZ' => "AZERBAIJAN" , 
'BS' => "BAHAMAS" , 
'BH' => "BAHRAIN" , 
'BD' => "BANGLADESH" , 
'BB' => "BARBADOS" , 
'BY' => "BELARUS" , 
'BE' => "BELGIUM" , 
'BZ' => "BELIZE" , 
'BJ' => "BENIN" , 
'BM' => "BERMUDA" , 
'BT' => "BHUTAN" , 
'BO' => "BOLIVIA" , 
'BA' => "BOSNIA AND HERZEGOVINA" , 
'BW' => "BOTSWANA" , 
'BV' => "BOUVET ISLAND" , 
'BR' => "BRAZIL" , 
'IO' => "BRITISH INDIAN OCEAN TERRITORY" , 
'BN' => "BRUNEI DARUSSALAM" , 
'BG' => "BULGARIA" , 
'BF' => "BURKINA FASO" , 
'BI' => "BURUNDI" , 
'KH' => "CAMBODIA" , 
'CM' => "CAMEROON" , 
'CA' => "CANADA" , 
'CV' => "CAPE VERDE" , 
'KY' => "CAYMAN ISLANDS" , 
'CF' => "CENTRAL AFRICAN REPUBLIC" , 
'TD' => "CHAD" , 
'CL' => "CHILE" , 
'CN' => "CHINA" , 
'CX' => "CHRISTMAS ISLAND" , 
'CC' => "COCOS (KEELING) ISLANDS" , 
'CO' => "COLOMBIA" , 
'KM' => "COMOROS" , 
'CG' => "CONGO" , 
'CD' => "CONGO, THE DEMOCRATIC REPUBLIC OF THE" , 
'CK' => "COOK ISLANDS" , 
'CR' => "COSTA RICA" , 
'CI' => "COTE D'IVOIRE" , 
'HR' => "CROATIA" , 
'CU' => "CUBA" , 
'CY' => "CYPRUS" , 
'CZ' => "CZECH REPUBLIC" , 
'DK' => "DENMARK" , 
'DJ' => "DJIBOUTI" , 
'DM' => "DOMINICA" , 
'DO' => "DOMINICAN REPUBLIC" , 
'EC' => "ECUADOR" , 
'EG' => "EGYPT" , 
'SV' => "EL SALVADOR" , 
'GQ' => "EQUATORIAL GUINEA" , 
'ER' => "ERITREA" , 
'EE' => "ESTONIA" , 
'ET' => "ETHIOPIA" , 
'FK' => "FALKLAND ISLANDS (MALVINAS)" , 
'FO' => "FAROE ISLANDS" , 
'FJ' => "FIJI" , 
'FI' => "FINLAND" , 
'FR' => "FRANCE" , 
'GF' => "FRENCH GUIANA" , 
'PF' => "FRENCH POLYNESIA" , 
'TF' => "FRENCH SOUTHERN TERRITORIES" , 
'GA' => "GABON" , 
'GM' => "GAMBIA" , 
'GE' => "GEORGIA" , 
'DE' => "GERMANY" , 
'GH' => "GHANA" , 
'GI' => "GIBRALTAR" , 
'GR' => "GREECE" , 
'GL' => "GREENLAND" , 
'GD' => "GRENADA" , 
'GP' => "GUADELOUPE" , 
'GU' => "GUAM" , 
'GT' => "GUATEMALA" , 
'GN' => "GUINEA" , 
'GW' => "GUINEA-BISSAU" , 
'GY' => "GUYANA" , 
'HT' => "HAITI" , 
'HM' => "HEARD ISLAND AND MCDONALD ISLANDS" , 
'VA' => "HOLY SEE (VATICAN CITY STATE)" , 
'HN' => "HONDURAS" , 
'HK' => "HONG KONG" , 
'HU' => "HUNGARY" , 
'IS' => "ICELAND" , 
'IN' => "INDIA" , 
'ID' => "INDONESIA" , 
'IR' => "IRAN, ISLAMIC REPUBLIC OF" , 
'IQ' => "IRAQ" , 
'IE' => "IRELAND" , 
'IL' => "ISRAEL" , 
'IT' => "ITALY" , 
'JM' => "JAMAICA" , 
'JP' => "JAPAN" , 
'JO' => "JORDAN" , 
'KZ' => "KAZAKHSTAN" , 
'KE' => "KENYA" , 
'KI' => "KIRIBATI" , 
'KP' => "KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF" , 
'KR' => "KOREA, REPUBLIC OF" , 
'KW' => "KUWAIT" , 
'KG' => "KYRGYZSTAN" , 
'LA' => "LAO PEOPLE'S DEMOCRATIC REPUBLIC" , 
'LV' => "LATVIA" , 
'LB' => "LEBANON" , 
'LS' => "LESOTHO" , 
'LR' => "LIBERIA" , 
'LY' => "LIBYAN ARAB JAMAHIRIYA" , 
'LI' => "LIECHTENSTEIN" , 
'LT' => "LITHUANIA" , 
'LU' => "LUXEMBOURG" , 
'MO' => "MACAO" , 
'MK' => "MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF" , 
'MG' => "MADAGASCAR" , 
'MW' => "MALAWI" , 
'MY' => "MALAYSIA" , 
'MV' => "MALDIVES" , 
'ML' => "MALI" , 
'MT' => "MALTA" , 
'MH' => "MARSHALL ISLANDS" , 
'MQ' => "MARTINIQUE" , 
'MR' => "MAURITANIA" , 
'MU' => "MAURITIUS" , 
'YT' => "MAYOTTE" , 
'MX' => "MEXICO" , 
'FM' => "MICRONESIA, FEDERATED STATES OF" , 
'MD' => "MOLDOVA, REPUBLIC OF" , 
'MC' => "MONACO" , 
'MN' => "MONGOLIA" , 
'MS' => "MONTSERRAT" , 
'MA' => "MOROCCO" , 
'MZ' => "MOZAMBIQUE" , 
'MM' => "MYANMAR" , 
'NA' => "NAMIBIA" , 
'NR' => "NAURU" , 
'NP' => "NEPAL" , 
'NL' => "NETHERLANDS" , 
'AN' => "NETHERLANDS ANTILLES" , 
'NC' => "NEW CALEDONIA" , 
'NZ' => "NEW ZEALAND" , 
'NI' => "NICARAGUA" , 
'NE' => "NIGER" , 
'NG' => "NIGERIA" , 
'NU' => "NIUE" , 
'NF' => "NORFOLK ISLAND" , 
'MP' => "NORTHERN MARIANA ISLANDS" , 
'NO' => "NORWAY" , 
'OM' => "OMAN" , 
'PK' => "PAKISTAN" , 
'PW' => "PALAU" , 
'PS' => "PALESTINIAN TERRITORY, OCCUPIED" , 
'PA' => "PANAMA" , 
'PG' => "PAPUA NEW GUINEA" , 
'PY' => "PARAGUAY" , 
'PE' => "PERU" , 
'PH' => "PHILIPPINES" , 
'PN' => "PITCAIRN" , 
'PL' => "POLAND" , 
'PT' => "PORTUGAL" , 
'PR' => "PUERTO RICO" , 
'QA' => "QATAR" , 
'RE' => "REUNION" , 
'RO' => "ROMANIA" , 
'RU' => "RUSSIAN FEDERATION" , 
'RW' => "RWANDA" , 
'SH' => "SAINT HELENA" , 
'KN' => "SAINT KITTS AND NEVIS" , 
'LC' => "SAINT LUCIA" , 
'PM' => "SAINT PIERRE AND MIQUELON" , 
'VC' => "SAINT VINCENT AND THE GRENADINES" , 
'WS' => "SAMOA" , 
'SM' => "SAN MARINO" , 
'ST' => "SAO TOME AND PRINCIPE" , 
'SA' => "SAUDI ARABIA" , 
'SN' => "SENEGAL" , 
'CS' => "SERBIA AND MONTENEGRO" , 
'SC' => "SEYCHELLES" , 
'SL' => "SIERRA LEONE" , 
'SG' => "SINGAPORE" , 
'SK' => "SLOVAKIA" , 
'SI' => "SLOVENIA" , 
'SB' => "SOLOMON ISLANDS" , 
'SO' => "SOMALIA" , 
'ZA' => "SOUTH AFRICA" , 
'GS' => "SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS" , 
'ES' => "SPAIN" , 
'LK' => "SRI LANKA" , 
'SD' => "SUDAN" , 
'SR' => "SURINAME" , 
'SJ' => "SVALBARD AND JAN MAYEN" , 
'SZ' => "SWAZILAND" , 
'SE' => "SWEDEN" , 
'CH' => "SWITZERLAND" , 
'SY' => "SYRIAN ARAB REPUBLIC" , 
'TW' => "TAIWAN, PROVINCE OF CHINA" , 
'TJ' => "TAJIKISTAN" , 
'TZ' => "TANZANIA, UNITED REPUBLIC OF" , 
'TH' => "THAILAND" , 
'TL' => "TIMOR-LESTE" , 
'TG' => "TOGO" , 
'TK' => "TOKELAU" , 
'TO' => "TONGA" , 
'TT' => "TRINIDAD AND TOBAGO" , 
'TN' => "TUNISIA" , 
'TR' => "TURKEY" , 
'TM' => "TURKMENISTAN" , 
'TC' => "TURKS AND CAICOS ISLANDS" , 
'TV' => "TUVALU" , 
'UG' => "UGANDA" , 
'UA' => "UKRAINE" , 
'AE' => "UNITED ARAB EMIRATES" , 
'GB' => "UNITED KINGDOM" , 
'US' => "UNITED STATES" , 
'UM' => "UNITED STATES MINOR OUTLYING ISLANDS" , 
'UY' => "URUGUAY" , 
'UZ' => "UZBEKISTAN" , 
'VU' => "VANUATU" , 
'VE' => "VENEZUELA" , 
'VN' => "VIET NAM" , 
'VG' => "VIRGIN ISLANDS, BRITISH" , 
'VI' => "VIRGIN ISLANDS, U.S." , 
'WF' => "WALLIS AND FUTUNA" , 
'EH' => "WESTERN SAHARA" , 
'YE' => "YEMEN" , 
'ZM' => "ZAMBIA" , 
'ZW' => "ZIMBABWE" , 
);

/**
    ISO 639-1 Language Codes
    Useful in Locale analysis
     
    References :
    1. http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
    2. http://blog.xoundboy.com/?p=235
*/
 
$language_codes = array(
        'en' => 'English' , 
        'aa' => 'Afar' , 
        'ab' => 'Abkhazian' , 
        'af' => 'Afrikaans' , 
        'am' => 'Amharic' , 
        'ar' => 'Arabic' , 
        'as' => 'Assamese' , 
        'ay' => 'Aymara' , 
        'az' => 'Azerbaijani' , 
        'ba' => 'Bashkir' , 
        'be' => 'Byelorussian' , 
        'bg' => 'Bulgarian' , 
        'bh' => 'Bihari' , 
        'bi' => 'Bislama' , 
        'bn' => 'Bengali/Bangla' , 
        'bo' => 'Tibetan' , 
        'br' => 'Breton' , 
        'ca' => 'Catalan' , 
        'co' => 'Corsican' , 
        'cs' => 'Czech' , 
        'cy' => 'Welsh' , 
        'da' => 'Danish' , 
        'de' => 'German' , 
        'dz' => 'Bhutani' , 
        'el' => 'Greek' , 
        'eo' => 'Esperanto' , 
        'es' => 'Spanish' , 
        'et' => 'Estonian' , 
        'eu' => 'Basque' , 
        'fa' => 'Persian' , 
        'fi' => 'Finnish' , 
        'fj' => 'Fiji' , 
        'fo' => 'Faeroese' , 
        'fr' => 'French' , 
        'fy' => 'Frisian' , 
        'ga' => 'Irish' , 
        'gd' => 'Scots/Gaelic' , 
        'gl' => 'Galician' , 
        'gn' => 'Guarani' , 
        'gu' => 'Gujarati' , 
        'ha' => 'Hausa' , 
        'hi' => 'Hindi' , 
        'hr' => 'Croatian' , 
        'hu' => 'Hungarian' , 
        'hy' => 'Armenian' , 
        'ia' => 'Interlingua' , 
        'ie' => 'Interlingue' , 
        'ik' => 'Inupiak' , 
        'in' => 'Indonesian' , 
        'is' => 'Icelandic' , 
        'it' => 'Italian' , 
        'iw' => 'Hebrew' , 
        'ja' => 'Japanese' , 
        'ji' => 'Yiddish' , 
        'jw' => 'Javanese' , 
        'ka' => 'Georgian' , 
        'kk' => 'Kazakh' , 
        'kl' => 'Greenlandic' , 
        'km' => 'Cambodian' , 
        'kn' => 'Kannada' , 
        'ko' => 'Korean' , 
        'ks' => 'Kashmiri' , 
        'ku' => 'Kurdish' , 
        'ky' => 'Kirghiz' , 
        'la' => 'Latin' , 
        'ln' => 'Lingala' , 
        'lo' => 'Laothian' , 
        'lt' => 'Lithuanian' , 
        'lv' => 'Latvian/Lettish' , 
        'mg' => 'Malagasy' , 
        'mi' => 'Maori' , 
        'mk' => 'Macedonian' , 
        'ml' => 'Malayalam' , 
        'mn' => 'Mongolian' , 
        'mo' => 'Moldavian' , 
        'mr' => 'Marathi' , 
        'ms' => 'Malay' , 
        'mt' => 'Maltese' , 
        'my' => 'Burmese' , 
        'na' => 'Nauru' , 
        'ne' => 'Nepali' , 
        'nl' => 'Dutch' , 
        'no' => 'Norwegian' , 
        'oc' => 'Occitan' , 
        'om' => '(Afan)/Oromoor/Oriya' , 
        'pa' => 'Punjabi' , 
        'pl' => 'Polish' , 
        'ps' => 'Pashto/Pushto' , 
        'pt' => 'Portuguese' , 
        'qu' => 'Quechua' , 
        'rm' => 'Rhaeto-Romance' , 
        'rn' => 'Kirundi' , 
        'ro' => 'Romanian' , 
        'ru' => 'Russian' , 
        'rw' => 'Kinyarwanda' , 
        'sa' => 'Sanskrit' , 
        'sd' => 'Sindhi' , 
        'sg' => 'Sangro' , 
        'sh' => 'Serbo-Croatian' , 
        'si' => 'Singhalese' , 
        'sk' => 'Slovak' , 
        'sl' => 'Slovenian' , 
        'sm' => 'Samoan' , 
        'sn' => 'Shona' , 
        'so' => 'Somali' , 
        'sq' => 'Albanian' , 
        'sr' => 'Serbian' , 
        'ss' => 'Siswati' , 
        'st' => 'Sesotho' , 
        'su' => 'Sundanese' , 
        'sv' => 'Swedish' , 
        'sw' => 'Swahili' , 
        'ta' => 'Tamil' , 
        'te' => 'Tegulu' , 
        'tg' => 'Tajik' , 
        'th' => 'Thai' , 
        'ti' => 'Tigrinya' , 
        'tk' => 'Turkmen' , 
        'tl' => 'Tagalog' , 
        'tn' => 'Setswana' , 
        'to' => 'Tonga' , 
        'tr' => 'Turkish' , 
        'ts' => 'Tsonga' , 
        'tt' => 'Tatar' , 
        'tw' => 'Twi' , 
        'uk' => 'Ukrainian' , 
        'ur' => 'Urdu' , 
        'uz' => 'Uzbek' , 
        'vi' => 'Vietnamese' , 
        'vo' => 'Volapuk' , 
        'wo' => 'Wolof' , 
        'xh' => 'Xhosa' , 
        'yo' => 'Yoruba' , 
        'zh' => 'Chinese' , 
        'zu' => 'Zulu' , 
        );

    $_roles_classes = array('Tank','Heal','Damage');

	$_medical_functions = array("Health","Poison","Booster");
	
	$array_inventory_2_type = array("Magic","Item","Invocation","Parchment","Craft","Ress");
	
	$array_accessory_type = array( "Armor","Gloves","Boots","Helmet","Pants");
	$array_weapon_type = array("sword","dagues","hammer","espadon","arc","lance","baton","sceptre","disque");		
    $array_armor_type = array("tissus","legere","moyenne","lourde","massive");
    
	$array_character_barre = array("HP","MP");//,"XP"
	$array_character_stats = array("Strength","Magic","Agility","Defense");
	
	$array_building_type = array("temple","zigourat","armurie","forge","bazar","Atelier","Raffinerie");
    $array_shops_type = array("accessory","magic","weapon","items","temple");

	$array_landing_type = array('forest','grass','hills','montain','plain','rock','sand','swamp','water');

	$array_battle_type = array("Arena","Dungeon","Chapter","Mission"); // Battle ??
	
	
	$array_access_type = array("Admin","Modo","Member","Visit");
	$array_status_type = array("Authorized","Banned");
	$array_forum_type = array("Categorie",'forum','Topic');
	$array_topic_type = array("Annonce","Sujet");
	$array_guild_functions = array('message','rank', 'privilege', 'recrutement','evenement');

	$array_work_class = array
	(
		"recolte" => array
		(
			"prospection", //=> array("roche"),
			"minage", //=> array("m�taux"),
			"coupe", //=> array("bois"),
			"culture", //=> array("plante"),
			"chasse", //=> array("peaux"),
		),
		"transformation" => array
		(
			"taille", //=> array("pierre"),
			"orfevrerie", //=> array("lingot"),
			"scierie", //=> array("planche")
			"distillerie", //=> array("essence")
			"tannerie", //=> array("cuir")
			
		),
		"assemblage" => array
		(
			"bijouterie", //=> array(),
			"forge", //=> array()
			"papeterie", //=> array()
			"herborisme",
			"couture",
		)		
	);
	//$array_work_recolte_type = array("prospection","minage","coupe",
	
	$array_craft_type = array(
		'dague' => array("lame courte"), 
		'epee' => array("lame longue", "lame lourde")
	);

	$array_character_type = array_merge( $array_character_barre,  $array_character_stats);

	$array_magic_type = $_medical_functions + array("Attack");
	$array_items_type = $_medical_functions + array("Magic");
	$array_items_shop_type = $array_items_type + array("Parchment");
	
	$array_inventory_type = $array_accessory_type + $array_weapon_type + $array_inventory_2_type ; 
	$array_items_craft_type = $array_accessory_type + $array_weapon_type + $array_items_type ;	
	$array_items_db_type = $array_accessory_type + $array_weapon_type + $array_items_shop_type;

?>
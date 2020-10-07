<?php
/*
 * Copyright 2014 Osclass
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Escape all the values of an array.
 *
 * @param array $array Array used to apply addslashes.
 * @return array $array after apply addslashes.
 */
function add_slashes_extended( $array ) {
    if(get_magic_quotes_gpc()) {
        return $array;
    }
    
    foreach ( (array) $array as $k => $v ) {
        if( is_array($v) ) {
            $array[$k] = add_slashes_extended($v);
        } else {
            $array[$k] = addslashes($v);
        }
    }

    return $array;
}

function osc_sanitizeString($string) {
    $string = strip_tags($string);
    $string = preg_replace('/%([a-fA-F0-9][a-fA-F0-9])/', '--$1--', $string);
    $string = str_replace('%', '', $string);
    $string = preg_replace('/--([a-fA-F0-9][a-fA-F0-9])--/', '%$1', $string);

    $string = remove_accents($string);

    //$string = strtolower($string);
    // @TODO  retrieve $arr_stop_words from Locale user custom list. as editable in /oc-admin/index.php?page=languages
    //        and do a 
    //        str_replace($arr_stop_words, '', $string);
    $string = preg_replace('/&.+?;/', '', $string);
    $string = str_replace(array('.','\'','--'), '-', $string);
    $string = preg_replace('/\s+/', '-', $string);
    $string = preg_replace('|[\p{Ps}\p{Pe}\p{Pi}\p{Pf}\p{Po}\p{S}\p{Z}\p{C}\p{No}]+|u', '', $string);

    if( is_utf8($string) ) {
        $string = urlencode($string);
        // mdash & ndash
        $string = str_replace(array('%e2%80%93', '%e2%80%94'), '-', strtolower($string));
    }

    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');

    return $string;
}

function remove_accents($string) {
	if ( !preg_match('/[\x80-\xff]/', $string) )
		return $string;

	if (is_utf8($string)) {
		$chars = array(
		// Decompositions for Latin-1 Supplement
		chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
		chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
		chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
		chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
		chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
		chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
		chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
		chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
		chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
		chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
		chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
		chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
		chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
		chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
		chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
		chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
		chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
		chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
		chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
		chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
		chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
		chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
		chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
		chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
		chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
		chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
		chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
		chr(195).chr(191) => 'y',
		// Decompositions for Latin Extended-A
		chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
		chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
		chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
		chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
		chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
		chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
		chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
		chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
		chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
		chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
		chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
		chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
		chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
		chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
		chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
		chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
		chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
		chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
		chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
		chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
		chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
		chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
		chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
		chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
		chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
		chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
		chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
		chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
		chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
		chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
		chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
		chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
		chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
		chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
		chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
		chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
		chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
		chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
		chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
		chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
		chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
		chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
		chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
		chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
		chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
		chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
		chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
		chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
		chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
		chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
		chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
		chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
		chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
		chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
		chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
		chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
		chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
		chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
		chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
		chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
		chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
		chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
		chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
		chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
		// Euro Sign
		chr(226).chr(130).chr(172) => 'E',
//Transliteration for Cyrillic
chr(192),chr(208).chr(144) => 'a', // А
chr(224),chr(208).chr(176) => 'a', // а
chr(193),chr(208).chr(145) => 'b', // Б
chr(225),chr(208).chr(177) => 'b', // б
chr(194),chr(208).chr(146) => 'v', // В
chr(226),chr(208).chr(178) => 'v', // в
chr(195),chr(208).chr(147) => 'g', // Г
chr(227),chr(208).chr(179) => 'g', // г
chr(196),chr(208).chr(148) => 'd', // Д
chr(228),chr(208).chr(180) => 'd', // д
chr(197),chr(208).chr(149) => 'e', // Е
chr(229),chr(208).chr(181) => 'e', // е
chr(168),chr(208).chr(129) => 'yo', // Ё
chr(184),chr(209).chr(145) => 'yo', // ё
chr(198),chr(208).chr(150) => 'zh', // Ж
chr(230),chr(208).chr(182) => 'zh', // ж
chr(199),chr(208).chr(151) => 'z', // З
chr(231),chr(208).chr(183) => 'z', // з
chr(200),chr(208).chr(152) => 'i', // И
chr(232),chr(208).chr(184) => 'i', // и
chr(201),chr(208).chr(153) => 'j', // Й
chr(233),chr(208).chr(185) => 'j', // й
chr(202),chr(208).chr(154) => 'k', // К
chr(234),chr(208).chr(186) => 'k', // к
chr(203),chr(208).chr(155) => 'l', // Л
chr(235),chr(208).chr(187) => 'l', // л
chr(204),chr(208).chr(156) => 'm', // М
chr(236),chr(208).chr(188) => 'm', // м
chr(205),chr(208).chr(157) => 'n', // Н
chr(237),chr(208).chr(189) => 'n', // н
chr(206),chr(208).chr(158) => 'o', // О
chr(238),chr(208).chr(190) => 'o', // о
chr(207),chr(208).chr(159) => 'p', // П
chr(239),chr(208).chr(191) => 'p', //п
chr(208),chr(208).chr(160) => 'r', // Р
chr(240),chr(209).chr(128) => 'r', // р
chr(209),chr(208).chr(161) => 's', // С
chr(241),chr(209).chr(129) => 's', // с
chr(210),chr(208).chr(162) => 't', // Т
chr(242),chr(209).chr(130) => 't', // т
chr(211),chr(208).chr(163) => 'y', // У
chr(243),chr(209).chr(131) => 'y', // у
chr(212),chr(208).chr(164) => 'f', // Ф
chr(244),chr(209).chr(132) => 'f', // ф
chr(213),chr(208).chr(165) => 'x', // Х
chr(245),chr(209).chr(133) => 'x', // х
chr(214),chr(208).chr(166) => 'c', // Ц
chr(246),chr(209).chr(134) => 'c', //ц
chr(215),chr(208).chr(167) => 'ch', // Ч
chr(247),chr(209).chr(135) => 'ch', // ч
chr(216),chr(208).chr(168) => 'sh', // Ш
chr(248),chr(209).chr(136) => 'sh', // ш
chr(217),chr(208).chr(169) => 'sch', // Щ
chr(249),chr(209).chr(137) => 'sch', // щ
chr(218),chr(208).chr(170) => '', // Ъ
chr(250),chr(209).chr(138) => '', // ъ
chr(219),chr(208).chr(171) => 'y', // Ы
chr(251),chr(209).chr(139) => 'y', // ы
chr(220),chr(208).chr(172) => '', // Ь
chr(252),chr(209).chr(140) => '', // ь
chr(221),chr(208).chr(173) => 'e', // Э
chr(253),chr(209).chr(141) => 'e', // э
chr(222),chr(208).chr(174) => 'yu', // Ю
chr(254),chr(209).chr(142) => 'yu', // ю
chr(223),chr(208).chr(175) => 'ya', // Я
chr(255),chr(209).chr(143) => 'ya', // я
/* Цифры */
chr(48) => '0', // 0
chr(48).chr(48) => '00', // 00
chr(48).chr(49) => '01', // 01
chr(48).chr(50) => '02', // 02
chr(48).chr(51) => '03', // 03
chr(48).chr(52) => '04', // 04
chr(48).chr(53) => '05', // 05
chr(48).chr(54) => '06', // 06
chr(48).chr(55) => '07', // 07
chr(48).chr(56) => '08', // 08
chr(48).chr(57) => '09', // 09
chr(49) => '1', // 1
chr(49).chr(48) => '10', // 10
chr(49).chr(49) => '11', // 11
chr(49).chr(50) => '12', // 12
chr(49).chr(51) => '13', // 13
chr(49).chr(52) => '14', // 14
chr(49).chr(53) => '15', // 15
chr(49).chr(54) => '16', // 16
chr(49).chr(55) => '17', // 17
chr(49).chr(56) => '18', // 18
chr(49).chr(57) => '19', // 19
chr(50) => '2', // 2
chr(50).chr(48) => '20', // 20
chr(50).chr(49) => '21', // 21
chr(50).chr(50) => '22', // 22
chr(50).chr(51) => '23', // 23
chr(50).chr(52) => '24', // 24
chr(50).chr(53) => '25', // 25
chr(50).chr(54) => '26', // 26
chr(50).chr(55) => '27', // 27
chr(50).chr(56) => '28', // 28
chr(50).chr(57) => '29', // 29
chr(51) => '3', // 3
chr(51).chr(48) => '30', // 30
chr(51).chr(49) => '31', // 31
chr(51).chr(50) => '32', // 32
chr(51).chr(51) => '33', // 33
chr(51).chr(52) => '34', // 34
chr(51).chr(53) => '35', // 35
chr(51).chr(54) => '36', // 36
chr(51).chr(55) => '37', // 37
chr(51).chr(56) => '38', // 38
chr(51).chr(57) => '39', // 39
chr(52) => '4', // 4
chr(52).chr(48) => '40', // 40
chr(52).chr(49) => '41', // 41
chr(52).chr(50) => '42', // 42
chr(52).chr(51) => '43', // 43
chr(52).chr(52) => '44', // 44
chr(52).chr(53) => '45', // 45
chr(52).chr(54) => '46', // 46
chr(52).chr(55) => '47', // 47
chr(52).chr(56) => '48', // 48
chr(52).chr(57) => '49', // 49
chr(53) => '5', // 5
chr(53).chr(48) => '50', // 50
chr(53).chr(49) => '51', // 51
chr(53).chr(50) => '52', // 52
chr(53).chr(51) => '53', // 53
chr(53).chr(52) => '54', // 54
chr(53).chr(53) => '55', // 55
chr(53).chr(54) => '56', // 56
chr(53).chr(55) => '57', // 57
chr(53).chr(56) => '58', // 58
chr(53).chr(57) => '59', // 59
chr(54) => '6', // 6
chr(54).chr(48) => '60', // 60
chr(54).chr(49) => '61', // 61
chr(54).chr(50) => '62', // 62
chr(54).chr(51) => '63', // 63
chr(54).chr(52) => '64', // 64
chr(54).chr(53) => '65', // 65
chr(54).chr(54) => '66', // 66
chr(54).chr(55) => '67', // 67
chr(54).chr(56) => '68', // 68
chr(54).chr(57) => '69', // 69
chr(55) => '7', // 7
chr(55).chr(48) => '70', // 70
chr(55).chr(49) => '71', // 71
chr(55).chr(50) => '72', // 72
chr(55).chr(51) => '73', // 73
chr(55).chr(52) => '74', // 74
chr(55).chr(53) => '75', // 75
chr(55).chr(54) => '76', // 76
chr(55).chr(55) => '77', // 77
chr(55).chr(56) => '78', // 78
chr(55).chr(57) => '79', // 79
chr(56) => '8', // 8
chr(56).chr(48) => '80', // 80
chr(56).chr(49) => '81', // 81
chr(56).chr(50) => '82', // 82
chr(56).chr(51) => '83', // 83
chr(56).chr(52) => '84', // 84
chr(56).chr(53) => '85', // 85
chr(56).chr(54) => '86', // 86
chr(56).chr(55) => '87', // 87
chr(56).chr(56) => '88', // 88
chr(56).chr(57) => '89', // 89
chr(57) => '9', // 9
chr(57).chr(48) => '90', // 90
chr(57).chr(49) => '91', // 91
chr(57).chr(50) => '92', // 92
chr(57).chr(51) => '93', // 93
chr(57).chr(52) => '94', // 94
chr(57).chr(53) => '95', // 95
chr(57).chr(54) => '96', // 96
chr(57).chr(55) => '97', // 97
chr(57).chr(56) => '98', // 98
chr(57).chr(57) => '99', // 99
		// GBP (Pound) Sign
		chr(194).chr(163) => '');

		$string = strtr($string, $chars);
	} else {
		// Assume ISO-8859-1 if not UTF-8
		$chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
			.chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
			.chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
			.chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
			.chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
			.chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
			.chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
			.chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
			.chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
			.chr(252).chr(253).chr(255);

		$chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

		$string = strtr($string, $chars['in'], $chars['out']);
		$double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
		$double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
		$string = str_replace($double_chars['in'], $double_chars['out'], $string);
	}

	$string = strtolower(htmlentities($string));
	$string = preg_replace('#&([a-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '$1', $string);
	$string = preg_replace('#&([a-z]{2})(?:lig);#', '$1', $string);
	$string = preg_replace('#&[^;]+;#', '', $string);

	return $string;
}

function is_utf8($string) {
    return preg_match('%^(?:
          [\x09\x0A\x0D\x20-\x7E]            # ASCII
        | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
        |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
        | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
        |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
        |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
        | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
        |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
    )*$%xs', $string);

}

?>

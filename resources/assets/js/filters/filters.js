export function classPortrait (ranking) {
    var gender = ranking.gender == 1 ? 'male' : 'female';
    var c = ranking.class == 'crusader' ? 'x1_' + ranking.class : ranking.class;
    c = c.replace('-', '');
    
    return 'http://media.blizzard.com/d3/icons/portraits/21/' + c + '_' + gender + '.png';
}

export function battleTag (battle_tag) {
    return battle_tag.split('#').shift();
}

export function classText (c) {
    return 'text--' + c.split(' ').join('_');
}

export function number (n) {
	if (isNaN(n) || n == null) {
		return 0;
	}

    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

export function classCrest (c) {
	return '/img/' + c + '/crest.png';
}

export function classBanner (c) {
    return '/img/' + c + '/banner.jpg';
}

export function region (r) {
	switch (r) {
		case 'US':
			return 'Americas';
		break;	
		case 'EU':
			return 'Europe';
		break;
		case 'TW':
			return 'Taiwan';
		break;
		case 'KR':
			return 'Korea';
		break;
		default:
			return '';
	}
}
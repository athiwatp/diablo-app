var classPortrait = function (ranking) {
    if (typeof ranking == 'string') {
        var split = ranking.split('_');
        var gender = split[1];
        var c = split[0];
    } else {
        var gender = ranking.gender == 1 ? 'male' : 'female';
        var c = ranking.class;
    }

    c = c == 'crusader' ? 'x1_' + c : c;
    c = c.replace('-', '');
    
    return 'http://media.blizzard.com/d3/icons/portraits/21/' + c + '_' + gender + '.png';
}

var battleTag = function (battle_tag) {
    return battle_tag.split('#').shift();
}

var classText = function (c) {
    return 'text--' + c.split(' ').join('_');
}

var number = function (n) {
	if (isNaN(n) || n == null) {
		return 0;
	}

    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

var classCrest = function (c) {
    if (c == '') {
        return '';
    }

	return '/img/' + c + '/crest.png';
}

var classPreview = function (c) {
    if (c == '') {
        return '';
    }

    return '/img/' + c + '/preview.jpg';
}

var teamCrest = function (c) {
    if (c == '') {
        return '';
    }

	return '/img/team/' + c + '.jpg';
}

var classBanner = function (c) {
    return '/img/' + c + '/banner.jpg';
}

var region = function (r) {
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

var leaderboardClassLink = function (c) {
    return '/leaderboards/season/' + CURRENT_SEASON + '/class/' + c.replace('-', '');
}

var time = function (ms) {
    var min = (ms/1000/60) << 0;
    var sec = parseInt((ms/1000) % 60).toString();
    sec = sec.length == 1 ? sec + '0' : sec;

    return min + ':' + sec;
}

export default {
	'battleTag': battleTag,
	'classBanner': classBanner,
	'classCrest': classCrest,
	'classPortrait': classPortrait,
	'classPreview': classPreview,
	'classText': classText,
	'number': number,
	'leaderboardClassLink': leaderboardClassLink,
	'region': region,
	'teamCrest': teamCrest,
	'time': time
}
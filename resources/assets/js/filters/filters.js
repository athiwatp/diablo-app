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

    if (c === 'missing') {
        return '/img/missing-class.png';
    }
    
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

    if (c == 'missing') {
        return '/img/missing-class.png';
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

var time = function (duration) {
    var milliseconds = parseInt((duration%1000)/100)
        , seconds = parseInt((duration/1000)%60)
        , minutes = parseInt((duration/(1000*60))%60);

    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    return minutes + ':' + seconds;
}

var missingHeroes = function (rankings, players) {
    var missing = players - rankings.length;

    for (var i = 0; i < missing; i++) {
        rankings.push({
            gender: 1,
            class: 'missing'
        });
    }

    return rankings;
}

export default {
	'battleTag': battleTag,
	'classBanner': classBanner,
	'classCrest': classCrest,
	'classPortrait': classPortrait,
	'classPreview': classPreview,
	'classText': classText,
	'number': number,
	'region': region,
	'teamCrest': teamCrest,
	'time': time,
    'missingHeroes': missingHeroes
}
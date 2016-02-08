export function classPortrait (ranking) {
    var gender = ranking.gender == 'm' ? 'male' : 'female';
    var c = ranking.class == 'crusader' ? 'x1_' + ranking.class : ranking.class;
    c = c.replace(' ', '');
    return 'http://media.blizzard.com/d3/icons/portraits/21/' + c + '_' + gender + '.png';
}

export function battleTag (battle_tag) {
    return battle_tag.split('#').shift();
}

export function classText (c) {
    return 'text--' + c.split(' ').join('_');
}
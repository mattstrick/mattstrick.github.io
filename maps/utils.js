function getPrettyPrice(price) {
    switch (price) {
        case 0:
            return 'None Given';
            break;
        case 1:
            return 'Less than $30/month';
            break;
        case 2:
            return 'Less than $60/month';
            break;
        case 3:
            return 'Less than $90/month';
            break;
        case 4:
            return 'Less than $120/month';
            break;
        case 5:
            return 'More than $120/month';
            break;
        default:
            return 'None Given';
            break;
    }
}

function getCoords(gym) {
    return {lat: parseFloat(gym.lat),lng: parseFloat(gym.lng)};
}
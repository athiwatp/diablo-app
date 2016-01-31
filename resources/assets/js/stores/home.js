import http from '../services/http';

export default {
    state: {},

    get (cb) {
        http.get('/api/home', data => {
            this.state = data;

            if (cb) {
                cb();
            }
        });
    }
}
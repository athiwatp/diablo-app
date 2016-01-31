import http from '../services/http';

export default {
    state: {},

    byId (id, cb) {
        http.get('/api/heroes/' + id, data => {
            this.state = data;

            if (cb) {
                cb();
            }
        });
    },

    update (id, cb) {
        http.patch('/api/heroes/' + id, data => {
            this.state = data;

            if (cb) {
                cb();
            }
        });
    }
}
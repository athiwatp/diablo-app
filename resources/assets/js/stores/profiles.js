import http from '../services/http';

export default {
    state: {},

    byId (id, cb) {
        http.get('/api/profiles/' + id, data => {
            this.state = data;

            if (cb) {
                cb();
            }
        });
    },

    update (id, cb) {
        http.patch('/api/profiles/' + id, () => {
            if (cb) {
                cb();
            }
        });
    }
}
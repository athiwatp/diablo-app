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
            if (data.status == 'queued') {
                // Queued, do something
                console.log('Hero update queued');
            } else {
                this.state = data;
            }

            if (cb) {
                cb();
            }
        });
    }
}
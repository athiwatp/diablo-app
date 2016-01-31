export default {
    get (url, data = {}, cb) {
        return Vue.http.get(url, data, cb);
    },

    patch (url, data = {}, cb) {
        return Vue.http.patch(url, data, cb);
    }
};
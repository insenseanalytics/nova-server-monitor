export default {
    getCheckStatusList() {
        return window.axios
            .get('/nova-vendor/insenseanalytics/nova-server-monitor/index')
            .then(response => response.data);
    },
};

Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'nova-server-monitor',
            path: '/nova-server-monitor',
            component: require('./components/CheckStatusList'),
        },
    ])
});

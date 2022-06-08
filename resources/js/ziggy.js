const Ziggy = {
    url: "http://127.0.0.1:8000",
    port: null,
    defaults: {},
    routes: {
        "ignition.healthCheck": {
            uri: "_ignition/health-check",
            methods: ["GET", "HEAD"],
        },
        "ignition.executeSolution": {
            uri: "_ignition/execute-solution",
            methods: ["POST"],
        },
        "ignition.updateConfig": {
            uri: "_ignition/update-config",
            methods: ["POST"],
        },
        home: { uri: "/", methods: ["GET", "HEAD"] },
        contact: { uri: "contact", methods: ["GET", "HEAD"] },
    },
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };

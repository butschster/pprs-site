var Ziggy = {
    namedRoutes: {
        "debugbar.openhandler": {"uri": "_debugbar\/open", "methods": ["GET", "HEAD"], "domain": null},
        "debugbar.clockwork": {"uri": "_debugbar\/clockwork\/{id}", "methods": ["GET", "HEAD"], "domain": null},
        "debugbar.telescope": {"uri": "_debugbar\/telescope\/{id}", "methods": ["GET", "HEAD"], "domain": null},
        "debugbar.assets.css": {"uri": "_debugbar\/assets\/stylesheets", "methods": ["GET", "HEAD"], "domain": null},
        "debugbar.assets.js": {"uri": "_debugbar\/assets\/javascript", "methods": ["GET", "HEAD"], "domain": null},
        "debugbar.cache.delete": {"uri": "_debugbar\/cache\/{key}\/{tags?}", "methods": ["DELETE"], "domain": null},
        "api.quote.show": {"uri": "api\/quote\/{quote}", "methods": ["GET", "HEAD"], "domain": null},
        "home": {"uri": "\/", "methods": ["GET", "HEAD"], "domain": null},
        "news.show": {"uri": "news\/{news}", "methods": ["GET", "HEAD"], "domain": null},
        "news.index": {"uri": "news", "methods": ["GET", "HEAD"], "domain": null},
        "page.show": {"uri": "{page}", "methods": ["GET", "HEAD"], "domain": null}
    },
    baseUrl: 'http://home.butschserver.ru/',
    baseProtocol: 'http',
    baseDomain: 'home.butschserver.ru',
    basePort: false,
    defaultParameters: []
};

if (typeof window.Ziggy !== 'undefined') {
    for (var name in window.Ziggy.namedRoutes) {
        Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
    }
}

export {
    Ziggy
}

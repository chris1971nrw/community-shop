// PWA Service Worker für Community Shop

const CACHE_NAME = 'community-shop-v1';
const CACHE_VERSION = '1.0.0';
const urlsToCache = [
    '/',
    '/index.html',
    '/assets/css/style.css',
    '/assets/js/app.js',
    '/assets/icons/icon-192x192.png',
    '/assets/icons/icon-512x512.png'
];

// Install Event
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('Service Worker: Caching assets');
                return cache.addAll(urlsToCache);
            })
            .then(() => {
                console.log('Service Worker: Installation completed');
                self.skipWaiting();
            })
    );
});

// Activate Event
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.map((key) => {
                    if (key !== CACHE_NAME) {
                        console.log('Service Worker: Deleting old cache:', key);
                        return caches.delete(key);
                    }
                })
            );
        }).then(() => {
            console.log('Service Worker: Activation completed');
            self.clients.claim();
        })
    );
});

// Fetch Event - Network First, then Cache
self.addEventListener('fetch', (event) => {
    event.respondWith(
        fetch(event.request)
            .then((response) => {
                const responseClone = response.clone();
                caches.open(CACHE_NAME).then((cache) => {
                    cache.put(event.request, responseClone);
                });
                return response;
            })
            .catch((error) => {
                console.log('Service Worker: Offline fallback', error);
                return caches.match(event.request)
                    .then((cachedResponse) => {
                        if (cachedResponse) {
                            return cachedResponse;
                        }
                        return caches.match('/offline.html');
                    });
            })
    );
});

// Push Message Handler
self.addEventListener('push', (event) => {
    if (event.data) {
        const data = event.data.json();
        const options = {
            body: data.body,
            icon: '/assets/icons/icon-192x192.png',
            badge: '/assets/icons/icon-72x72.png',
            tag: data.tag,
            data: data.url,
            image: data.image,
            actions: [
                {
                    action: 'open',
                    title: 'Öffnen',
                    icon: '/assets/icons/icon-192x192.png'
                }
            ]
        };
        
        event.waitUntil(
            self.registration.showNotification(data.title, options)
        );
    }
});

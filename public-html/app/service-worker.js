const cacheName = 'to-do-list-cache-v3';

// Rutas relativas a donde está el SW
const base = self.location.pathname.replace('/service-worker.js', '');

const archivos = [
  `${base}/`,
  `${base}/index.php`,
  `${base}/styles.css`,
  `${base}/script.js`,
  `${base}/manifest.json`,
  `${base}/img/hadestdl.png`,
  `${base}/img/hadestdl512.png`
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(cacheName).then((cache) => {
      return cache.addAll(archivos);
    })
  );
  self.skipWaiting(); // Activa el SW inmediatamente
});

self.addEventListener('activate', (event) => {
  // Elimina caches viejos
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(
        keys.filter((key) => key !== cacheName).map((key) => caches.delete(key))
      )
    )
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => response || fetch(event.request))
  );
});
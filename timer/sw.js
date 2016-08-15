self.addEventListener('install', function(e) {
  e.waitUntil(
  	caches.open('v2').then(function(cache) {
  		return cache.addAll([
		'/timer/',
		'/timer/index.html',
		'/timer/app.js'
		]);
  	})
  );
});

self.addEventListener('fetch', function(event) {
	console.log(event.request.url);
	event.respondWith(
		caches.match(event.request).then(function(response) {
			return response || fetch(event.request);
		})
	);
});
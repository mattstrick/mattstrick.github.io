let map;
      let markers = [];
      let gyms = [
        {name: "Planet Fitness", coords: { lat: 41.948164, lng: -87.6481925 }, address: "3636 N Broadway, Chicago, IL 60613", phone: "(773) 281-6700"},
        {name: "Quads Gym", coords: {lat: 41.95000599999999, lng: -87.6485787}, address: "3727 North Broadway, Chicago, IL 60613", phone: "(773) 404-7867"},
        {name: "Transform At Amy Bourque Yoga", coords: {lat: 42.10468210000001, lng: -72.63114759999999}, address: "470 Westfield St, West Springfield, MA 01089"},
        {name: "Hampshire Athletic Club", coords: {lat: 42.3655789, lng: -72.485379}, address: "90 Gatehouse Rd, Amherst, MA 01002"},
        {name: "Amherst Fitness", coords: {lat: 42.3725172, lng: -72.50225069999999}, address: "375 College St, Amherst, MA 01002", phone: "(413) 230-3824"},
        {name: "Ravenswood Fitness Center", coords: {lat: 41.9615851, lng: -87.6784122}, address: "1958 W Montrose Ave, Chicago, IL 60613", phone: "(773) 784-0732"},
        {name: "CrossTown Fitness - Lakeview", coords: {lat: 41.9476093, lng: -87.6497698}, address: "3600 N Halsted St, Chicago, IL 60613", phone: "(312) 550-9923"},
        {name: "Orangetheory Fitness", coords: {lat: 41.9504097, lng: -87.65006249999999}, address: "3738 N Halsted St #2, Chicago, IL 60613", phone: "(224) 252-0242"},
        {name: "9Round Fitness", coords: {lat: 41.953224, lng: -87.64938599999999}, address: "3911 N Broadway, Chicago, IL 60613", phone: "(773) 657-5051"},
        {name: "Lakeview Athletic Club", coords: {lat: 41.9404779, lng: -87.6448161}, address: "3212 N. Broadway Avenue, Chicago, IL 60657", phone: "(773) 529-2024"},
        {name: "Lincoln Park Athletic Club", coords: {lat: 41.932469, lng: -87.65467660000002}, address: "1019 W Diversey Pkwy, Chicago, IL 60614", phone: "(773) 529-2022"},
        {name: "Lincoln Park Fitness Center", coords: {lat: 41.9258117, lng: -87.6410069}, address: "444 W Fullerton Pkwy #1, Chicago, IL 60614", phone: "(773) 281-8715"},
        {name: "Lakeshore Sport & Fitness", coords: {lat: 41.9257582, lng: -87.6616561}, address: "1320 W Fullerton Ave, Chicago, IL 60614", phone: "(773) 348-6377"},
        {name: "LA Fitness", coords: {lat: 41.93338, lng: -87.645539}, address: "2828 N Clark St, Chicago, IL 60657", phone: "(773) 929-6900"},
        {name: "FFC Lakeview", coords: {lat: 41.940843, lng: -87.6494994}, address: "3228 N Halsted St, Chicago, IL 60657", phone: "(773) 755-3232"},
        {name: "Number One Gym", coords: {lat: 41.9409078, lng: -87.6544529}, address: "3232 N Sheffield Ave, Chicago, IL 60657", phone: "(773) 871-1496"},
        {name: "FITNESS 19", coords: {lat: 41.9340227, lng: -87.6447091}, address: "2834 N Broadway, Chicago, IL 60657", phone: "(773) 868-1919"},
        {name: "Anytime Fitness", coords: {lat: 41.9982848, lng: -87.6649422}, address: "1346 W Devon Ave, Chicago, IL 60660", phone: "(872) 888-8525"},
        {name: "Chicago Fitness Center", coords: {lat: 41.938663, lng: -87.6670561}, address: "3131 N Lincoln Ave, Chicago, IL 60657", phone: "(773) 549-8181"},
        {name: "Southport Fitness", coords: {lat: 41.9439701, lng: -87.66366690000001}, address: "3413 N Southport Ave 2nd Floor, Chicago, IL 60657", phone: "(773) 244-2000"},
        {name: "Planet Fitness", coords: {lat: 41.8911546, lng: -87.6210377}, address: "240 E Illinois St, Chicago, IL 60611", phone: "(312) 464-1010"},
        {name: "Cheetah Gym Andersonville", coords: {lat: 41.9775546, lng: -87.668517}, address: "5248 N Clark St, Chicago, IL 60640", phone: "(773) 728-7777"},
        {name: "XSport Fitness", coords: {lat: 41.9373125, lng: -87.6449622}, address: "3030 N Broadway, Chicago, IL 60657", phone: "(773) 634-7333"},
        {name: "Equinox Lincoln Park", coords: {lat: 41.9141384, lng: -87.6337968}, address: "1750 N Clark St, Chicago, IL 60614", phone: "(312) 254-4000"},
        {name: "Equinox The Loop", coords: {lat: 41.8808633, lng: -87.634293}, address: "200 W Monroe St, Chicago, IL 60606", phone: "(312) 252-3100"},
      ];
      
      function initMap() {
        
        const myLatLng = { lat: 41.8781, lng: -87.6298 };
        const myAddress = "3727 North Broadway 60613";
        map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: myLatLng,
        });
        const geocoder = new google.maps.Geocoder();
        gyms.forEach(
            (gym) => addMarker(gym)
        )

        // geocodeAddress(geocoder, map);
        document.getElementById("submit").addEventListener("click", () => {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
          let address = document.getElementById('address').value;
        geocoder.geocode({ address: address }, (results, status) => {
          if (status === "OK") {
            resultsMap.setCenter(results[0].geometry.location);
            // Log out the lat long coordinate
            console.log({"lat": results[0].geometry.location.lat(), "lng": results[0].geometry.location.lng()});
            // new google.maps.Marker({
            //   map: resultsMap,
            //   position: results[0].geometry.location,
            // });
          } else {
            alert(
              "Geocode was not successful for the following reason: " + status
            );
          }
        });
      }

      // Adds a marker to the map and push to the array.
      function addMarker(gym) {

        const gymPhoneNumber = gym.phone ? "<p>" + gym.phone + "</p>" : '';
        const contentString =
          '<div id="content">' +
          '<div id="bodyContent">' +
          "<h3>" + 
          gym.name +
          "</h3>" +
          "<p>" +
          gym.address +
          "</p>" +
          gymPhoneNumber +
          "</div>" +
          "</div>";

        const infowindow = new google.maps.InfoWindow({
          content: contentString,
        });
        const marker = new google.maps.Marker({
          position: gym.coords,
          map: map,
        });

        marker.addListener("click", () => {
          infowindow.open(map, marker);
        });

        markers.push(marker);
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
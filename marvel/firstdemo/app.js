/* global $,console,document,Handlebars */

//default not avail image
var IMAGE_NOT_AVAIL = "http://i.annihil.us/u/prod/marvel/i/mg/b/40/image_not_available";

//my key
let PUBLIC_KEY = "35b4bcaa4d204fe16b1f9e255b85e622";
let PRIVATE_KEY = "8715d5398deeb053beda5d8f7bb20da86076ae59"
let ts = new Date().getTime();

console.log(ts);
console.log(PUBLIC_KEY);
let hash = CryptoJS.MD5(ts + PRIVATE_KEY + PUBLIC_KEY);

console.log(hash);

console.log("JavaScript is working!");

 async function init() {
   const domElement = document.getElementById("marvel");
 
   const character = await getApiData();
   
   for (let i = 0; i < character.data.results.length; i++) {
    const ul = document.createElement("ul");
    if (character.data.results[i].description && character.data.results[i].thumbnail.path != IMAGE_NOT_AVAIL ) {
      ul.innerHTML = `<li> Name: ${character.data.results[i].name} 
      <br><br> Description: ${character.data.results[i].description}
      <br><br>
      <img src="${character.data.results[i].thumbnail.path+".jpg"}" alt="imageHere" width="250" height="250">;
      </li>`
      //  document.getElementById('img').src = character.data.results[i].thumbnail.path+".jpg"
        domElement.append(ul);
      console.log(character.data.results);  
      console.log(document.getElementById('img').src = character.data.results[i].thumbnail.path+".jpg");
      // console.log(character.data.results[i].thumbnail.path);
    }
   
  //  domElement.append(ul);
  //  console.log(character.data.results);  
  //  console.log(character.data.results[i].thumbnail.path);
 
   }
}

 /**
  * Async function to get the data from the SWAPI api
  * @returns - returns a promise
  */
 async function getApiData() {
   try {
	 let response = await fetch(`https://gateway.marvel.com:443/v1/public/characters?&ts=${ts}&apikey=${PUBLIC_KEY}&hash=${hash}&limit=100&offset=100`);
	 console.log(response);
	 let character = await response.json();
	 return character;
   } 
   catch (err) {
	 console.error("Error: ", err);
   }
 }
 init();
 

		
// $(document).ready(function() {
	
// 	var $results = $("#results");
// 	var $status = $("#status");
	
// 	var templateSource = $("#reportTemplate").html();
// 	var template = Handlebars.compile(templateSource);
// 	var start = 2013;
// 	var end = 2010;
	
// 	var promises = [];
	
// 	$status.html("<i>Getting comic book data - this will be slow - stand by...</i>");
	
// 	for(var x=start; x>=end; x--) {
// 		promises.push(getComicData(x));
// 	}
	
// 	$.when.apply($,promises).done(function() {

// 		var args = Array.prototype.slice.call(arguments, 0);

// 		$status.html("");
		
// 		for(var x=0; x<args.length; x++) {
// 			var year = start-x;
// 			console.log("displaying year", year);
		

// 			var stats = {};
// 			stats.year = year;
// 			stats.priceTotal = 0;
// 			stats.priceCount = 0;
// 			stats.minPrice = 999999999;
// 			stats.maxPrice = -999999999;
// 			stats.pageTotal = 0;
// 			stats.pageCount = 0;
// 			stats.pics = [];
			
// 			var res = args[x][0];
			
// 			if(res.code === 200) {
// 				for(let i=0;i<res.data.results.length;i++) {
// 					let comic = res.data.results[i];
// 					// console.log(id);	
// 					// // just get the first item
// 					// if(comic.prices.length && comic.prices[0].price !== 0) {
// 					// 	stats.priceTotal += comic.prices[0].price;
// 					// 	if(comic.prices[0].price > stats.maxPrice) stats.maxPrice = comic.prices[0].price;
// 					// 	if(comic.prices[0].price < stats.minPrice) stats.minPrice = comic.prices[0].price;
// 					// 	stats.priceCount++;
// 					// 	console.log("working");
// 					// }
// 					if(comic.pageCount > 0) {
// 						stats.pageTotal+=comic.pageCount;
// 						stats.pageCount++;
// 						console.log("help");
// 					}
				// 	if(comic.thumbnail && comic.thumbnail.path != IMAGE_NOT_AVAIL) {stats.pics.push(comic.thumbnail.path + "." + comic.thumbnail.extension);
					
				// }
// 				stats.avgPrice = (stats.priceTotal/stats.priceCount).toFixed(2);
// 				stats.avgPageCount = (stats.pageTotal/stats.pageCount).toFixed(2);
				
// 				//pick 5 thumbnails at random
// 				stats.thumbs = [];
// 				while(stats.pics.length > 0 && stats.thumbs.length < 5) {
// 					var chosen = getRandomInt(0, stats.pics.length);
// 					stats.thumbs.push(stats.pics[chosen]);
// 					stats.pics.splice(chosen, 1);
// 				}
				
// 				console.dir(stats);
// 				var html = template(stats);
// 				$results.append(html);
// 			}
// 		}
// 	});
	
// });

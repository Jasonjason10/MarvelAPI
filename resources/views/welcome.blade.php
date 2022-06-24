<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->

		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h1>Marvel API jason.</h1>
		<div id="marvel"></div>
		<img id="img" src="" alt="imageHere" width="250" height="250">
	<div id="results"></div>
	<div id="status"></div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>


	<script>

// import './bootstrap';
/* global $,console,document,Handlebars */

//default not avail image
var IMAGE_NOT_AVAIL = "http://i.annihil.us/u/prod/marvel/i/mg/b/40/image_not_available";

//my key
let PUBLIC_KEY = "35b4bcaa4d204fe16b1f9e255b85e622";
let PRIVATE_KEY = "8715d5398deeb053beda5d8f7bb20da86076ae59"
let ts = new Date().getTime();

// console.log(ts);
// console.log(PUBLIC_KEY);
let hash = CryptoJS.MD5(ts + PRIVATE_KEY + PUBLIC_KEY);

// console.log(hash);

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
      <img src="${character.data.results[i].thumbnail.path+".jpg"}" alt="imageHere" width="250" height="250">
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
	 let response = await fetch(`https://gateway.marvel.com:443/v1/public/characters?&ts=${ts}&apikey=${PUBLIC_KEY}&hash=${hash}&limit=100&offset=600`);
	 console.log(response);
	 let character = await response.json();
	 return character;
   }
   catch (err) {
	 console.error("Error: ", err);
   }
 }
 init();


	</script>
	<script src="/js/app.js"></script>


	</body>
</html>



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
		<p>Welcome to my api</p>
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
let IMAGE_NOT_AVAIL = "http://i.annihil.us/u/prod/marvel/i/mg/b/40/image_not_available";

//my key
const PUBLIC_KEY = "35b4bcaa4d204fe16b1f9e255b85e622";
const PRIVATE_KEY = "8715d5398deeb053beda5d8f7bb20da86076ae59"
let ts = new Date().getTime();

let hash = CryptoJS.MD5(ts + PRIVATE_KEY + PUBLIC_KEY);



console.log("JavaScript is working!");

 async function init() {
   const domElement = document.getElementById("marvel");

   const information = await getApiData();

   for (let i = 0; i < information.data.results.length; i++) {
    const ul = document.createElement("ul");
    if (information.data.results[i].description && information.data.results[i].thumbnail.path != IMAGE_NOT_AVAIL ) {
      ul.innerHTML = `<li> Name: ${information.data.results[i].name}
      <br><br> Description: ${information.data.results[i].description}
      <br><br>
      <img src="${information.data.results[i].thumbnail.path+".jpg"}" alt="imageHere" width="250" height="250">
      </li>`
        domElement.append(ul);
      console.log(information.data.results);
      console.log(document.getElementById('img').src = information.data.results[i].thumbnail.path+".jpg");
    }
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
	 let information = await response.json();
	 return information;
   }
   catch (err) {
	 console.error("Error: ", err);
   }
 }
 init();


	</script>
	<script type="module" src="/js/app.js"></script>


	</body>
</html>



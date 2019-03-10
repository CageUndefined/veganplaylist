var elixir = require("laravel-elixir");

elixir(function(mix) {
	mix.sass("./resources/sass/app.scss", "public/css");
});
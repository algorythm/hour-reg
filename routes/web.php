<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('register', function() {
//  $cn_login_url = "https://auth.dtu.dk/dtu/login";
//  $cn_validate_url = "https://auth.dtu.dk/dtu/validate";
//  $redirect_url = "https://time.wiberg.tech/register/validate";
//  return redirect($cn_login_url . '?service=' . $redirect_url);
//});

Route::get('register/validate', function() {
  $cn_login_url = "https://auth.dtu.dk/dtu/login";
  $cn_validate_url = "https://auth.dtu.dk/dtu/validate";
  $redirect_url = "https://time.wiberg.tech/register/validate";

  $client = new GuzzleHttp\Client();
  $res = $client->request('GET', $cn_validate_url.'?service='.$redirect_url.'&ticket='.$_GET['ticket']);

  //echo $cn_validate_url.'?service='.$redirect_url.'&ticket='.$_GET['ticket'];

  if (substr($res->getBody(), 0, 3) === "no") {
    echo "Could not authenticate with Camput Net.";
  } elseif (substr($res->getBody(), 0, 3) === "yes") { // Authenticated with CN
    $studyno=substr($res->getBody(), 4, 11);
    return view('auth.register', ['studyno' => $studyno]);
  }

  echo "error??";
  //return view('auth.register');
});

Route::get('login/validate', function() {
  $cn_login_url = "https://auth.dtu.dk/dtu/login";
  $cn_validate_url = "https://auth.dtu.dk/dtu/validate";
  $redirect_url = "https://time.wiberg.tech/login/validate";

  $client = new GuzzleHttp\Client();
  $res = $client->request('GET', $cn_validate_url.'?service='.$redirect_url.'&ticket='.$_GET['ticket']);

  //echo $cn_validate_url.'?service='.$redirect_url.'&ticket='.$_GET['ticket'];

  if (substr($res->getBody(), 0, 3) === "no") {
    echo "Could not authenticate with Camput Net.";
  } elseif (substr($res->getBody(), 0, 3) === "yes") { // Authenticated with CN
    $studyno=substr($res->getBody(), 4, 11);

    $user = App\User::where('studyno','=',$studyno)->first();
    if ($user === null) {
      return redirect("/register");
    } else {
      Auth::login(App\User::where('studyno','=',$studyno)->first(), true);
    }


    return redirect('/home');
  }
});

Route::group(['middleware' => 'auth'], function() {
  Route::get('categories', 'CategoryController@showCategories')->name('categories');
  Route::post('categories/create', 'CategoryController@createCategory');

  Route::get('hour/start/category/{category_id}', 'HourController@StartHourNow');
  Route::get('hour/stop/current', 'HourController@StopHourNow');
  Route::get('hour/delete/{hour_id}', 'HourController@DeleteHour');
  Route::get('hour/edit/{hour_id}', 'HourController@EditHourView');
  Route::post('hour/edit/{hour_id}', 'HourController@EditHour');
  Route::get('stats/all', function() {
    return view('stats.all');
  });
  Route::get('stats/user/{id}', function($id) {
    return view('stats.user', ['user' => App\User::find($id)]);
  });
});




Route::get('test', function() {
  $client = new GuzzleHttp\Client();
  echo "Hello";
});

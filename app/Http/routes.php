<?php

use App\Article;                // Model
use Illuminate\Http\Request;    // Validator

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix'=> 'articles'], function (){  // Делаем группировку

    Route::get('/', function () {
        $articles = Article::orderBy('created_at', 'acs')->get();       // Подготовка билдера
        return view('articles.index', ['articles'=>$articles]);   // передаём $articles in index
    })->name('articles.all');

    Route::post('/', function (Request $request){
        $validator = Validator::make($request->all(), ['name' => 'required|max:70', 'description'=> 'required|min:10']); // Получение всех входных данных
        if($validator->fails()){
            return redirect(route('articles.all'))->withInput()->withErrors($validator);
//            withInput() предназначен для сохранения ввода во время перенаправления.
//            withErrors() добавит флеш данные под ключ errors/$errors.
        }
        $article = new Article();
        $article->name = $request->name;
        $article->description = $request->description;
        $article->save();   // отправка запроса на сервер
        return redirect(route('articles.all')); // возвращает на главную страницу
    })->name('articles.add');

    Route::delete('/{article}', function (Article $article){
        Article::find($article);  // Находит и возвращает результат поиска
        $article->delete();       // Отправка mySQL запроса на удаление строки с таблицы, где дословно ID->delete();
        return redirect(route('articles.all'));
    })->name('articles.delete');

##########################
    Route::get('/{article}', function (Article $article){
        Article::find($article);    // находим ID в BD
        $article->getAttributes();  // Получаем все значения строки из таблицы
        return view('articles.article', ['article' => $article]);   // делаем отображение страницы article, и передаём туда переменную $article
    })->name('articles.item');

});



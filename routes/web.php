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


Auth::routes();

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    //ARTICLE CONTROLLER ROUTES
    Route::get('/article/{id}', 'ArticleController@articleShow');
    Route::post('/add_article', 'ArticleController@addArticle');
    Route::post('/delete_article', 'ArticleController@deleteArticle');
    Route::post('/delete_article_redirect', 'ArticleController@deleteArticleRedirect');
    Route::get('/edit_article/{id}', 'ArticleController@editArticleView');
    Route::post('/edit_article', "ArticleController@editArticle");

    //CATEGORY CONTROLLER ROUTES
    Route::post('/add_category', 'CategoryController@addCategory');
    Route::post('/delete_category', 'CategoryController@deleteCategory');
    Route::get('/category/{id}', 'CategoryController@findCategory');
    Route::get('/edit_category/{id}', 'CategoryController@editCategoryView');
    Route::post('/edit_category/{id}', 'CategoryController@editCategory');

    //FEEDBACK CONTROLLER ROUTES
    Route::post('/add_feedback', 'FeedbackController@addFeedback');
    Route::post('/delete_feedback', 'FeedbackController@deleteFeedback');
    Route::get('/edit_feedback/{id}', 'FeedbackController@editFeedbackView');
    Route::post('/edit_feedback/{id}', 'FeedbackController@editFeedback');

    //CATEGORY FEEDBACK ROUTES
    Route::post('/add_feedback_category', 'CategoryFeedbackController@addFeedback');
    Route::post('/delete_feedback_category', 'CategoryFeedbackController@deleteFeedback');
    Route::get('/edit_feedback_category/{id}', 'CategoryFeedbackController@editFeedbackView');
    Route::post('/edit_feedback_category/{id}', 'CategoryFeedbackController@editFeedback');

    Route::get('/categories', 'HomeController@categories');
});

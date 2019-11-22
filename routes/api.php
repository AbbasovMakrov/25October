<?php
use \Illuminate\Support\Facades\Route;
Route::prefix("auth")->group(function()
{
    Route::post("login","LoginController");
    Route::post("register","RegisterController");
});

Route::prefix("message")->middleware("auth:api")->group(function()
{
    Route::get("index/{receiverId}",action_path_builder("Message","index"));
    Route::post("store/{receiverId}",action_path_builder("Message","store"));
    Route::post("update/{receiverId}",action_path_builder("Message","update"));
    Route::patch("see/{receiverId}",action_path_builder("Message","see"));
    Route::delete("destroy/{messageId}",action_path_builder("Message","destroy"));
    Route::delete("destroy-all-messages",action_path_builder("Message","destroyAllMessages"));
});
Route::get("users/index","GetUsers")->middleware("auth:api");
Route::post("account/update","AccountController")->middleware("auth:api");
Route::get("credits",function()
{
   return api_response([
       "by" => [
           "API" => "Abbas H Laravel",
           "Android_Application" => "Hadi D Android",
           "IOS_Application" => null,
           "Event" => "25 October",
       ]
   ]);
});
Route::namespace("Dashboard")->prefix("dashboard")->group(function()
{
    Route::post("login",'LoginController');
    Route::prefix("message")->middleware(['auth','role:admin'])->group(function()
    {
        Route::get("index",action_path_builder("Message","index"));
        Route::patch("mark-as-important/{messageId}",action_path_builder("Message","markAsImportant"));
        Route::delete("destroy/{messageId}",action_path_builder("Message","destroy"));
    });

});

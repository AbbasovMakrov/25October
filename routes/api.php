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
    Route::put("see/{messageId}",action_path_builder("Message","see"));
    Route::delete("destroy/{messageId}",action_path_builder("Message","destroy"));
    Route::delete("destroy-all-messages",action_path_builder("Message","destroyAllMessages"));
});
Route::get("users/index","GetUsers")->middleware("auth:api");
Route::post("account/update","AccountController")->middleware("auth:api");
Route::get("credits",function()
{
   return api_response([
       "by" => [
           "API" => "Abbas Laravel",
           "Android_Application" => "Hadi Android",
           "IOS_Application" => "??",
           "Server_Installation" => "??",
           "Event" => "25 October"
       ]
   ]);
});

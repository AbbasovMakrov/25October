<?php
if (!function_exists("api_response"))
{
    /**
     * @param null $data
     * @param null $errors
     * @return \Illuminate\Http\JsonResponse
     */
    function api_response($data = null , $errors = null)
    {
        return response()->json([
            "data" => $data,
            "errors" => $errors
        ]);
    }
}
if (!function_exists("action_path_builder"))
{
    /**
     * @param string $Controller
     * @param string $Action
     * @return string
     */
    function action_path_builder(string $Controller ,string $Action = "index")
    {
        return "{$Controller}Controller@{$Action}";
    }
}
if (!function_exists("file_type"))
{
    function file_type(string $fileName)
    {
        $imageExtensions = ["jpg","jpeg","png"];
        $audioExtensions = ['ogg','m4a','mp3'];
        $fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
        if (in_array($fileExtension,$imageExtensions))
            return "image";
        else if (in_array($fileExtension,$audioExtensions))
            return "audio";
        return "video" ;
    }
}

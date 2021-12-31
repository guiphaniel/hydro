<?php


function startScript(String $path){
    if(str_contains($path,".py"))
        return exec($path . " " . __DIR__);
    else
        return exec($path.".py ".__DIR__);
}

function connectResultsDB(): ?PDO
{
    try{
        return new PDO('sqlite:'.__DIR__.'database.db');
    }catch(PDOException $e){
        return null;
    }
}

startScript("resetMovieDB.py");


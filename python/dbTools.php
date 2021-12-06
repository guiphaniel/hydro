<?php

function startScript(String $path){
    if(str_contains($path,".py"))
        return shell_exec($path . " " . __DIR__);
    else
        return shell_exec($path.".py");
}

function connectResultsDB(): ?PDO
{
    try{
        return new PDO('sqlite:'.__DIR__.'database.db');
    }catch(PDOException $e){
        return null;
    }
}

startScript("main.py");


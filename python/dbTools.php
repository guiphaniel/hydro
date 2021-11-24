<?php

function startScript(String $path){
    if(str_contains($path,".py"))
        return shell_exec($path);
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

var_dump(startScript(__DIR__."/main.py"));


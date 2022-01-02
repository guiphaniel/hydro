<?php

function startUsersRecommendations(){
    $cmd = "getUsersRecommendations.py " .__DIR__;
    if (str_starts_with(php_uname(), "Windows")){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}

function startResetMovieDB(){
    $cmd = "resetMovieDB.py " .__DIR__;
    if (str_starts_with(php_uname(), "Windows")){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}

function startComputeAverageRatings(){
    $cmd = "computeAverageRatings.py " .__DIR__;
    if (str_starts_with(php_uname(), "Windows")){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}

function startResetDBRatings(){
    $cmd = "resetRatingsDB.py " .__DIR__;
    if (str_starts_with(php_uname(), "Windows")){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}

function connectResultsDB(): ?PDO
{
    try{
        return new PDO('sqlite:'.__DIR__.'database.db');
    }catch(PDOException $e){
        return null;
    }
}

startResetDBRatings();
startResetMovieDB();
startUsersRecommendations();
startComputeAverageRatings();

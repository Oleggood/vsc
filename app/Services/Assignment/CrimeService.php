<?php

namespace App\Services\Assignment;

class CrimeService
{
    function prepareCrimes($array, $number) {
        array_unshift($array, $number);
        $resultArray = array_unique($array);
        return $resultArray;
    }

    function attachCrimes($crimesArr, $assignment) {
        // Переменная для отслеживания первого элемента
        $firstElement = true;
        // Проходим по $crimesArr и прикрепляем к каждой записи в таблице 'assignment_crime', устанавливаем 'main' в 'true' только для первого элемента
        foreach ($crimesArr as $crimeId) {
            $main = $firstElement ? true : false;
            $assignment->crimes()->attach($crimeId, ['main' => $main]);
            $firstElement = false; // После первого элемента устанавливаем $firstElement в false для остальных 'main' => false
        }
    }

}

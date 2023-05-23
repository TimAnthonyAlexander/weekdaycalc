<?php

while (true) {
    // Ask for stdin input for a date in dd.mm.yyyy format
    $date = readline("Enter a date in dd.mm.yyyy format: ");

    // Check if the input is valid
    if (!preg_match("/^([0-9]{2})\.([0-9]{2})\.([0-9]{4})$/", $date, $matches)) {
        // If the input is invalid, print an error message
        echo "Invalid input!\n";
    }

    $day = $matches[1];
    $month = $matches[2];
    $year = $matches[3];

    $century = substr($year, 0, 2);

    $yearOfCentury = substr($year, 2, 2);

    $monthToMonthCode = [
        0, 3, 3, 6, 1, 4, 6, 2, 5, 0, 3, 5
    ];

    $isLeapYear = $year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0);

    if ($month == 1 || $month == 2) {
        $isLeap = $isLeapYear ? 1 : 0;
    } else {
        $isLeap = 0;
    }

    $monthCode = $monthToMonthCode[$month - 1];

    $centuryCode = match ($century) {
        "17" => 4,
        "18" => 2,
        "19" => 0,
        "20" => 6,
        "21" => 4,
        "22" => 2,
        default => 0
    };

    $yearCode = ($yearOfCentury + floor($yearOfCentury / 4)) % 7;

    $dayOfWeek = ($day + $monthCode + $centuryCode + $yearCode - $isLeap) % 7;

    $dayOfWeekToDay = [
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    ];

    echo "Formula: ($day + $monthCode + $centuryCode + $yearCode - $isLeap) % 7 = $dayOfWeek\n";
    echo "The day of the week is " . $dayOfWeekToDay[$dayOfWeek] . "\n";
}

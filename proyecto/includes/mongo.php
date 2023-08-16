<?php
function generateTimeSlots($horaInicio, $horaFin) {
    $startTime = strtotime("7:00");
    $endTime = strtotime("21:00");
    $startSlot = strtotime($horaInicio);
    $endSlot = strtotime($horaFin);

    $timeSlots = [];
    while ($startTime < $startSlot) {
        $timeSlots[] = date("H:i", $startTime);
        $startTime += 60 * 60; 
    }
  
  
    while ($endSlot < $endTime) {
        $endSlot += 60 * 60; 
        $timeSlots[] = date("H:i", $endSlot);
    }

    return $timeSlots;
}

function generateAvailableTimeSlots($horaInicio, $horaFin) {
    $startSlot = strtotime($horaInicio);
    $endSlot = strtotime($horaFin);

    $timeSlots = [];
    $currentSlot = $startSlot;
    while ($currentSlot <= $endSlot) {
        $timeSlots[] = date("H:i", $currentSlot);
        $currentSlot += 60 * 60;
    }

    return $timeSlots;
}

?>
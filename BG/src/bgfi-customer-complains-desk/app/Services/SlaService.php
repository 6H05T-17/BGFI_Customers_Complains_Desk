<?php

namespace App\Services;

class SlaService
{
    /**
     * Calcule la date limite en fonction d'une chaîne de délai (ex: "24 heures", "3 jours")
     */
    public function calculateDeadline(string $delay)
    {
        $delay = strtolower(trim($delay));
        
        // Gestion des heures (ex: "24 heures", "48 heures")
        if (preg_match('/(\d+)\s*(heure|heures|h)/', $delay, $matches)) {
            return now()->addHours((int) $matches[1]);
        }
        
        // Gestion des jours (ex: "3 jours", "5 jours")
        if (preg_match('/(\d+)\s*(jour|jours|j)/', $delay, $matches)) {
            return now()->addDays((int) $matches[1]);
        }

        // Gestion des semaines (au cas où)
        if (preg_match('/(\d+)\s*(semaine|semaines|s)/', $delay, $matches)) {
            return now()->addWeeks((int) $matches[1]);
        }

        // Fallback de sécurité : 1 jour par défaut si le format est inconnu
        return now()->addDay();
    }
}
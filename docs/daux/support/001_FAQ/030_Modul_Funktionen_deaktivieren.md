---
title: Fehlermeldungen anzeigen
---

Dem Modul können unterschiedlich viele (Fehler)-Meldungen entlockt werden.
Dazu gibt es im Admin des Moduls zwei Schalter:
[ Admin ] -> [ D3 Module ] -> [ {$menutitle} ] -> [Konfiguration] -> [Tab Konfiguration]:

* Logging: 
    - Logging komplett ausschalten
    - Nur Fehler mit schreiben
    - Auch Fehler + Statusmeldungen (Alles protokollieren)

* Debug-Modus
Ist "Alles protokollieren" und der Debug-Modus aktiv, dann werden zusätzlich verschiedene Datenbankabfragen protokolliert und in der Tabelle d3log abgelegt.

Bei vielen Bestellungen und einem hohen Ausführungsinterval des CronJobs sollte die Größe der Tabelle d3log periodisch überprüft werden und ältere
Einträge gelöscht werden.


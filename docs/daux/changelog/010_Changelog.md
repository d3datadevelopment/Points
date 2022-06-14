---
title: Changelog
---

## Version 5.0.3.1 - 2021-08-03
### Fixed

- Die E-Mais wurden nicht generiert. Bugfix für Verwendung in der 6.2 & 6.3

---

title: Changelog
---

## Version 5.0.3.0 - 2021-07-16
### Fixed
- Support für OXID 6.2 & 6.3

---

## Version 5.0.2.3 - 2020-07-24
### Fixed
- unvollständige Updateprozedur auf Version 6 des Shops

---

## Version 5.0.2.2 - 2020-07-24
### Fixed
- Controller wurden verschlüsselt ausgeliefert
- Fehler bei der Ermittlung der Sprache für die Erinnerungs-E-Mails

---

## Version 5.0.2.1
- Templates für das Theme Wave angepasst, Version 1.0.1

---

## Version 5.0.2.0
- Punkte für Bewertungen konnten nicht vergeben werden
- kleine Refactoring  Arbeiten
- Ausgabe des CronJobs kann als E-Mail versendet werden

---

## Version 5.0.1.0
- Kleine Layoutänderung im Kundenkonto(nur Flow Theme). Die Angaben zu den Gutscheinen werden jetzt übersichtlicher dargestellt
- Die .sh-Datei für den CronJob kann nun im Admin des Moduls erstellt werden.

---

## Version 5.0.0.2
- Kleine Nachbesserung der Dokumentation

---

## Version 5.0.0.1
- Umstellung der Dokumentation von PDF auf eine HTML-bsierende Dokumentation. Die Dokumentation 
liegt dem Modul jetzt im Ordner docs/Documentation/ bei.

---

## Version 5.0.0.0
- Angepasst für Shopversion 6.x, Installation via Composer 

---

## Version 4.1.1.1
- Bug beim Einlösen der Bonuspunkte - fehlerhaft benannte Methode wurde korrigiert
- Bug in der Verwendung der Templates für das Kundenkonto - die Azure Templates wurden nicht verwendet
- kleine Layoutanpassung bei der Ausgabe der Gutscheine - der Kommentar wurde verschoben angezeigt

---

## Version 4.1.1.0
- Ausgaben der Kontoübersicht in Templates ausgelagert
- Bug bei Versand der Reminderemails, Mails wurde häufiger versendet
- Prüfung und Abbruch wenn automatisch kein Gutschein erstellt wurde

---

## Version 4.1.0.1
- Umstieg auf den neuen Theme-Mapper des Modul-Connectors, so kann auch das Modul auch mit dem Roxive-Theme eingesetzt werden
- kleine Bugs bei bei den übersetzungen, in den Templates und CSS-Formatierungen
- fehlerhafte Datenbankabfragen wenn zwischen der Bestellung und Vergabe der Punkte einige Tage liegen
- einige zusätzliche Templateblöcke

---

## Version 4.1.0.0
- Test/Anpassung auf die 4.10.x/5.3.x
- Kundenkonto auf Flow-Theme angepasst
- neuer Menüpunkt Logmeldungen im Modul
- Bugfix: Logout im Admin, im Zusammenhang mit dem aktuellen Modul-Connector und dem neuen Admin-Theme

---

## Version 4.0.2.3
- Bug: fehlerhaftes Include eines Templates im Kundenkonto
- Test auf 4.9 / 5.2

---

## Version 4.0.2.2
- Bug: Gutschein wird mit 0 Euro berechnet
- Bug: Optionen für die Zusendung der E-Mails werden nicht mehr richtig gespeichert
- Bug: Installationsssistenten wird mehrfach gestartet

---

## Version 4.0.2.1
- Anpassung Precheck

---

## Version 4.0.2.0
- Bug bei der Prüfung auf verbotene Kundengruppe
- Bug bei änderung der E-Mailadressen der Kunden
- Erhalt der E-Mails kann jetzt auch im Admin am Kunde geändert werden
- Anzeige der Bezahlarten in den Einstellungen des Modul geändert
- kleine Templatefehler im Admin behoben
- Test auf 4.8

---
## Version 4.0.1.0
- Bugfix: individuelle Gutscheinlänge wurde nicht beachtet
- auch für Shopversionen ab 4.8 einsetzbar
- Systemcheck integriert (d3precheck.php)

---

## Version 4.0.0.0
- Anpassung auf Oxid 4.7 / 5.0
- Integration in die D³-Lizenzverwaltung
- halbautomatische Installation

---

## Version 3.0.0.2
- stornierte Bestellungen bei der Vergabe von Punkte ignorieren
- manuell vergebene Punkte in Reminder-Mails beachten

---

## Version 3.0.1
- Problem wenn die Berechnung der Punkte einen Wert unter 1 ergibt
- Test auf vorhandene Gutscheinnummern
- Feld OXVOUCHERID aus Install.sql entfernt
- Bug bei verbotenen Benutzergruppe
- Bug bei der Vergabe von Bonuspunkten für Bewertungen an Artikeln
- Änderungen für Shopversion ab 4.6.0 integriert

---

## Version 3.0
- Anpassung für OXID 4.5.x
- Konfiguration im Admin
- zusätzliche Kriterien
- Bonuspunkte löschen/stornieren
- Erinnerungsemail
- erweitertes Logging

---

## Version 2.2
- Punktevergabe für Kundenbewertungen eingebaut
- Erweiterung der d3points-Tabelle um oxtype- und oxtext-Datenfeld
- manuelle Punkte können nun über ein Langtextfeld im Admin kommentiert werden
- logging auf mod_cfg umgestellt
- securitykey für cronjob eingebaut

---

## Version 2.1
- Berechnungsfehler im cronjob bereinigt
- CMS-Bausteine für Automail (Gutscheine) eingefügt

---

## Version 2.0
- Umstellung des Moduls auf PE4

---

## Version 1.0
- Startversion für OXID PE3

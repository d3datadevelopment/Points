Version 5.0.0.2
- Test auf OXID 6.0.3 / 6.1.0

Version 5.0.0.1
- Dateien verschoben
- neue Dokumentation

Version 5.0.0.0
- Angepasst f�r Shopversion 6.x, Installation via Composer 


Version 4.1.1.1
- Bug beim Einl�sen der Bonuspunkte - fehlerhaft benannte Methode wurde korrigiert
- Bug in der Verwendung der Templates f�r das Kundenkonto - die Azure Templates wurden nicht verwendet
- kleine Layoutanpassung bei der Ausgabe der Gutscheine - der Kommentar wurde verschoben angezeigt


Version 4.1.1.0
- Ausgaben der Konto�bersicht in Templates ausgelagert
- Bug bei Versand der Reminderemails, Mails wurde h�ufiger versendet
- Pr�fung und Abbruch wenn automatisch kein Gutschein erstellt wurde


Version 4.1.0.1
- Umstieg auf den neuen Theme-Mapper des Modul-Connectors, so kann auch das Modul auch mit dem Roxive-Theme eingesetzt werden
- kleine Bugs bei bei den �bersetzungen, in den Templates und CSS-Formatierungen
- fehlerhafte Datenbankabfragen wenn zwischen der Bestellung und Vergabe der Punkte einige Tage liegen
- einige zus�tzliche Templatebl�cke


Version 4.1.0.0
- Test/Anpassung auf die 4.10.x/5.3.x
- Kundenkonto auf Flow-Theme angepasst
- neuer Men�punkt Logmeldungen im Modul
- Bugfix: Logout im Admin, im Zusammenhang mit dem aktuellen Modul-Connector und dem neuen Admin-Theme


Version 4.0.2.3
- Bug: fehlerhaftes Include eines Templates im Kundenkonto
- Test auf 4.9 / 5.2


Version 4.0.2.2
- Bug: Gutschein wird mit 0 Euro berechnet
- Bug: Optionen f�r die Zusendung der E-Mails werden nicht mehr richtig gespeichert
- Bug: Installationsssistenten wird mehrfach gestartet


Version 4.0.2.1
- Anpassung Precheck


Version 4.0.2.0
- Bug bei der Pr�fung auf verbotene Kundengruppe
- Bug bei �nderung der E-Mailadressen der Kunden
- Erhalt der E-Mails kann jetzt auch im Admin am Kunde ge�ndert werden
- Anzeige der Bezahlarten in den Einstellungen des Modul ge�ndert
- kleine Templatefehler im Admin behoben
- Test auf 4.8


Version 4.0.1.0
- Bugfix: individuelle Gutscheinl�nge wurde nicht beachtet
- auch f�r Shopversionen ab 4.8 einsetzbar
- Systemcheck integriert (d3precheck.php)

Version 4.0.0.0
 -Anpassung auf Oxid 4.7 / 5.0
 -Integration in die D�-Lizenzverwaltung
 -halbautomatische Installation


Version 3.0.0.2
 - stornierte Bestellungen bei der Vergabe von Punkte ignorieren
 - manuell vergebene Punkte in Reminder-Mails beachten


Version 3.0.1
 -Problem wenn die Berechnung der Punkte einen Wert unter 1 ergibt
 -Test auf vorhandene Gutscheinnummern
 -Feld OXVOUCHERID aus Install.sql entfernt
 -Bug bei verbotenen Benutzergruppe
 -Bug bei der Vergabe von Bonuspunkten f�r Bewertungen an Artikeln
- �nderungen f�r Shopversion ab 4.6.0 integriert


Version 3.0
- Anpassung f�r OXID 4.5.x
- Konfiguration im Admin
- zus�tzliche Kriterien
- Bonuspunkte l�schen/stornieren
- Erinnerungsemail
- erweitertes Logging


Version 2.2
- Punktevergabe f�r Kundenbewertungen eingebaut
- Erweiterung der d3points-Tabelle um oxtype- und oxtext-Datenfeld
- manuelle Punkte k�nnen nun �ber ein Langtextfeld im Admin kommentiert werden
- logging auf mod_cfg umgestellt
- securitykey f�r cronjob eingebaut


Version 2.1
- Berechnungsfehler im cronjob bereinigt
- CMS-Bausteine f�r Automail (Gutscheine) eingef�gt

Version 2.0
- Umstellung des Moduls auf PE4


Version 1.0
- Startversion f�r OXID PE3

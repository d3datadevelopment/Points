---
title: Cronjob anpassen / automatische Vergabe der Bonuspunkte
---

Legen Sie den Cronjob für die automatische Bearbeitung der eingerichteten Aufträge an.
Den Link für den Cronjob finden Sie im Adminbereich des Moduls. Dort können Sie sich auch entsprechende sh-Dateien für Ihren Provider erstellen lassen. 
Passen Sie diese entsprechend Ihren Daten an. 


> [!!] Sie sollten unbedingt den Aufruf von .sh-Dateien via Browser verhindern, so dass kein Unbefugter die Datei von außen aufrufen kann. Dazu können Sie z.B. die .htaccess-Datei des Shops um folgende Zeilen erweitern:

```htaccess
    <Files *.sh>
    Require all denied
    </Files>
```

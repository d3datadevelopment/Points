---
title: Datenbank bereinigen
---
  
Das Modul legt Informationen in der Datenbank ab. Sofern diese Daten nicht mehr benötigt werden, können diese gelöscht werden. 

> [!] Legen Sie sich vorab bitte unbedingt eine Sicherung an, um die Daten im Zweifelsfall wiederherstellen zu können.
    
Für das Modul **{$modulename}** sind dies die folgende Tabellen und Felder:
* die komplette Tabelle `d3points`
    
und diese Felder in bestehenden Tabellen: **)
* in `oxorder`:  das Feld `D3ISSETPOINTS`
* in `oxuser`:  die Felder `D3POINTSMAILOPTION` und `D3POINTSSENDREMINDER`

sowie diese Einträge bestehenden Tabellen:

* in Tabelle `d3_cfg_mod`:  
  * den Eintrag `oxmodid = "{$modcfgident}"` ***)

**) Diese Felder sind für alle (Sub)Shops notwendig. Ist die Entfernung in nur einen von mehreren Mandaten gewünscht, so dürfen diese Felder nicht entfernt werden. 
***) Diesen Eintrag gibt es ggf. für jeden Subshop. Entfernen Sie diesen nur für die Mandanten, in denen das Modul **nicht** mehr installiert ist. 

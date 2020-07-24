<?php
/**
 * HTML Tags for markup (same as in online manual):
 * <span class="navipath_or_inputname">...</span> for names of input fields, selectlists and Buttons, e.g. <span class="navipath_or_inputname">Active</span>
 * <span class="userinput_or_code">...</span> for input in input fields (also options in selectlists) and code
 * <span class="filename_filepath_or_italic">...</span> for filenames, filepaths and other italic stuff
 * <span class="warning_or_important_hint">...</span> for warning and important things
 * <ul> and <li> for lists
 */
$sLangName = "Deutsch";
$aLang = array(
    'charset' => 'UTF-8',
    'D3_CFG_d3points_DEBUG_MODUS_HELP' => '<b>Debug-Modus:</b><br>Ist diese Checkbox aktiviert, werden weitere zus&auml;tzliche Informationen ausgegeben bzw. in der Log-Tabelle gespeichert.<br>Im Normalbetrieb ist diese Einstellung nicht notwendig.<br>
                            <br>Dieser Modus dient zur Untersuchung von eventuell auftretenden Fehlern und sollte nur kurzzeitig aktiviert sein.<br>
                            <br>
                            <b>Bei aktivierter Option werden sehr viele zus&auml;tzliche Informationen in der Datenbank gespeichert.</b>',
    'D3_CFG_d3points_LOGGING_HELP' => '<b>Logging:</b><br>Mit dieser Auswahl k&ouml;nnen Sie die Priorit&auml;t des Logging einstellen. Meldungen oder Fehler haben eine vordefinierte Priorit&auml;t. Anhand der Priorit&auml;t wird entschieden, welche Eintr&auml;ge in die Datenbank geschrieben werden.<br>
                            <ul>
                                <li><b>kein Protokoll</b>: in der Datenbank wird kein Logeintrag geschrieben. Ist diese Einstellung gesetzt wird das Modul weder eine normale Meldung schreiben noch eine schwere Fehlermeldung.</li>
                                <li><b>Alles protokollieren</b>: s&auml;mtliche Meldungen egal ob schwerer Fehler oder nur Statusmeldungen werden in der Datenbank abgespeichert. Diese Option sollte zur Fehleranalyse bzw. eine kurze Zeit nach Installation des Moduls aktiviert werden.<br><b>Achtung: es werden sehr viele Daten in der Datenbank gespeichert!</b></li>
                                <li><b>Fehler mitschreiben</b>: nur Meldungen mit dem Status eines Fehlers werden gespeichert.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_CRONJOB_GENERALL_HELP' => '<b>Modul aktiv:</b><br>De/Aktiviert das Modul Bonuspunkte.<br>Wenn das Modul deaktiviert ist, wird der Cronjob nicht ausgef&uuml;hrt und im Kundenbereich wird die &Uuml;bersicht zu den Bonuspunkten ausgeblendet.',
    'D3_CFG_d3points_TEST_MODUS_HELP' => 'Ist diese Checkbox aktiviert, werden die E-Mails nicht an Kunden, sondern an eine vorher festgelegte E-Mailadresse (siehe unten "Konfiguration E-Mails") versendet.<br>
                            <ul>
                                <li>Diese Option kann verwendet werden um die Einstellung und Funktionsweise des Moduls zu testen.</li>
                                <li>Der Testmodus beinhaltet alle Aufgaben des Moduls. Ausnahme bildet der Versand der E-Mails.</li>
                                <li>In den Kundenkonten (Frontend sowie Backend) bleiben die &Uuml;bersichten der Bonuspunkte und deren Optionen sichtbar.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_CRONJOBS_ACTIVE_HELP' => '<b>Cronjob:</b><br>De/Aktiviert den Cronjob.<br>Eine separate &Auml;nderung in den Cronjob-Einstellung bei Ihrem Provider ist nicht n&ouml;tig.<br>Diese Option ist Vorraussetzung f&uuml;r die enthaltenen Funktionen (Punktevergabe, Automatische Gutscheinvergabe, E-Mail mit Bonuspunkte, Erinnerungs-E-Mails).',
    'D3_CFG_MOD_d3points_ACCESSKEY_HELP' => '<b>Zugriffsschutz f&uuml;r den CronJob:</b><br>Vergeben Sie hier ein mehrstelliges Passwort (ca. 6-8 Zeichen), um unberechtigte Aufrufe des CronJobs zu unterbinden.',
    'D3_CFG_MOD_d3points_CRONJOB_NEWPOINTS_HELP' => '<b>Punktevergabe:</b><br>De/Aktivieren Sie die automatische Vergabe von Punkten. Damit werden die Punkte dem Kunden per Cronjob zugewiesen (Die Einstellungskritereien finden Sie unter "Berechnung der Bonuspunkte".).',
    'D3_CFG_MOD_d3points_CRONJOBS_LINK_HELP' => '<b>Link:</b><br>Der Link erm&ouml;glicht die manuelle Ausf&uuml;hrung des Cronjobs. Kopieren Sie dazu den Link und f&uuml;hren diesen in der Adresszeile Ihres Browsers aus.<br>Dieser Link kann ebenfalls f&uuml;r den regul&auml;ren Server-Cronjob genutzt werden.',
    'D3_CFG_MOD_d3points_VOUCHER_HELP' => '<b>Generierung Gutscheine:</b><br>
                            Stellen Sie die Berechnungen und andere Einstellungen f&uuml;r die Gutscheine der Gutscheinserie d3points ein.<br>
                            Wenn die Gutscheinserie "d3points" nicht vorhanden ist, wird die Serie vom Modul automatisch mit Standardeinstellungen neu erstellt.<br> Wird die Gutscheinserie vom Modul neu erstellt schreibt das Modul einen Eintrag in die Tabelle d3log, mit dem Betreff "Create new Voucherserie".',
    'D3_CFG_MOD_d3points_VOUCHER_4_MAX_POINTS_HELP' => '<b>Automatische Gutscheinvergabe:</b><br>De/Aktivieren Sie die Erstellung der Gutscheine der Gutscheinserie d3points.<br>
                            <ul>
                                <li>Die Einstellungen finden Sie hier im Bereich "Generierung Gutscheine".</li>
                                <li>Per E-Mail wird der Kunde &uuml;ber den Gutschein informiert.</li>
                                <li>Die Vergabe der Punkte und die Generierung der E-Mail wird im CronJob durchgef&uuml;hrt.</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SEND_FIRST_MAIL_HELP' => '<b>E-Mail mit Bonuspunkte:</b><br>De/Aktiviert die Kundenbenachrichtigung f&uuml;r den Erhalt von Bonuspunkten (bspw. durch Bestellungen oder Artikelbewertungen).<br>
                            <ul>
                                <li>Die Generierung der E-Mail wird im CronJob durchgef&uuml;hrt.</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SEND_REMINDER_MAIL_HELP' => '<b>Erinnerungs-E-Mails:</b><br>De/Aktiviert den Versand von Erinnerungs-E-Mails an den Kunden.<br>
                            <ul>
                                <li>Die Generierung der E-Mail wird im CronJob durchgef&uuml;hrt.</li>
                                <li>Sie k&ouml;nnen die Zeitabst&auml;nde in dem Bereich "Konfiguration E-Mails" einstellen.</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_CALCULATION_HELP' => '<b>Berechnung der Bonuspunkte:</b><br>Die Grundlage f&uuml;r die Berechnung der Bonuspunkte bildet der Gesamtwert der Bestellung ohne die Versandkosten.<br>
                            <ul>
                                <li>Der Gesamtwert ergibt sich aus folgenden beiden Feldern: <span class="filename_filepath_or_italic">oxtotalordersum - oxdelcost</span>.</li>
                                <li>Rabatte und Gutscheine werden bereits durch den Shop './*im Feld <span class="filename_filepath_or_italic">oxtotalordersum</span> */'ber&uuml;cksichtig.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_SCALE_HELP' => '<b>Punktesysteme - Staffelsystem (scalar) :</b><br>Mit dieser Option werden die Punkte nach einem Staffelsystem (skalar) vergeben.<br>
                            <ul>
                                <li>Es k&ouml;nnen beliebig viele Preisstaffeln (Anzahl => von__@@bis) definiert werden.</li>
                                <li>Befindet sich der Gesamtwert der Bestellung (ohne Versandkosten, inkl. Rabatten und Gutscheinen) innerhalb einer Staffelung, wird die zugewiesene Anzahl an Bonuspunkten vergeben.</li>
                                <li>Wenn sich der Gesamtwert der Bestellung unter- oder oberhalb der Staffelung befindet, werden keine Punkte berechnet.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_LINEAR_HELP' => '<b>Punktesysteme - lineare Punktevergabe (linear):</b><br>Mit dieser Option werden die Punkte nach einer festen Formel (linear) vergeben.<br>
                            Die Berechnung erfolgt &uuml;ber die Formel:<br> Multiplikator * Gesamtwert (ohne Versandkosten, inkl. Rabatten und Gutscheinen)',
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_SCALAR_SET_HELP' => '<b>Punkteverteilung f&uuml;r das Staffelsystem:</b><br>Beispiel:<br>5 =&gt; 0__@@49.99<br>10 =&gt; 50__@@99.99<br>20 =&gt; 100__@@149.99<br>30 =&gt; 150__@@999999 <br><br>Sollte keine Staffel vorgegeben sein, kann die hier gezeigte Standardstaffel genutzt werden.',
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_LINEAR_SET_HELP' => '<b>Punkte f&uuml;r die lineare Punktevergabe:</b><br>Mit diesem Divisor werden die Punkte berechnet.<br>
                            Voraussetzung ist die aktive lineare Punktevergabe.<br>
                            G&uuml;ltige Wertebereiche:<br>
                            <ul>
                                <li>ganze Zahlen: 1 2 3 ... 9</li>
                                <li>Dezimalbr&uuml;che: 0,5 1,25 ... 0.5 1.25 ... </li>
                            </ul><br>
                            Die berechneten Bonuspunkte werden immer auf ganze Zahlen abgerundet. <br>
                            Berechnungsformel/Beispiel:<ul><li> Warenwert / Divisor = Punkte</li><li>100 / 10 = 10 Punkte</li></ul>',
    /*    'D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_HELP' => 'Es k&ouml;nnen unterschiedliche Punkte f&uuml;r Stern- und Textbewertungen vergeben werden.
                                Somit wird der Kunde animiert, einen Text zu schreiben, statt nur Sterne zu vergeben.<br>
                                z.B. kann f&uuml;r eine Sternbewertung 2, und einen Text 4 Punkte vergeben werden<br>
                                Bewertet der Kunde nur per Sterne, erh&auml;lt er demzufolge 2 Punkte.
                                Tr&auml;gt er zus&auml;tzlich einen Bewertungstext ein, bekommt er bereits 6 Punkte.',//*/
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_RATING_SET_HELP' => '<b>Punkte f&uuml;r Sternbewertung:</b><br>Der Kunde kann Bonuspunkte f&uuml;r vergebene Sternbewertungen bei Artikeln erhalten.<br>
                            <ul>
                                <li>Die Punkte werden pro Bewertung vergeben (nicht nach der Anzahl der Sterne).</li>
                                <li>G&uuml;ltig sind nur ganze Zahlen (1 2 3 ... 9).</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                            </ul>'/*
                            <br>
                            Sie k&ouml;nnen auch f&uuml;r eingetragene Produktbewertungen Punkte vergeben.<br>
                            Diese Option wird aktiviert, wenn in mindestens eine der beiden folgenden Variablen ein Wert &gt; 0 eingestellt wird<br>
                            Es k&ouml;nnen unterschiedliche Punkte f&uuml;r Stern- und Textbewertungen vergeben werden.
                            Somit wird der Kunde animiert, einen Text zu schreiben, statt nur Sterne zu vergeben.
                            z.B. kann f&uuml;r eine Sternbewertung 2, und einen Text 4 Punkte vergeben werden.<br>
                            Bewertet der Kunde nur per Sterne, erh&auml;lt er demzufolge 2 Punkte.
                            Tr&auml;gt er zus&auml;tzlich einen Bewertungstext ein, bekommt er bereits 6 Punkte.*/,
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_TEXT_SET_HELP' => '<b>Punkte f&uuml;r Textbewertung:</b><br>Der Kunde kann Bonuspunkte f&uuml;r vergebene Textbewertungen bei Artikeln erhalten. <br>'.
//Mit einer h&ouml;heren Punktezahl als bei der Sternbewertung, animieren Sie den Kunden eine Textbewertung abzugeben.<br> Beachten Sie, das die Punkte f&uuml;r Stern und Text addiert werden. Z.B. kann f&uuml;r eine Sternbewertung 2 und einen Text 4 Punkte vergeben werden. Bewertet der Kunde nur per Sterne, erh&auml;lt er demzufolge 2 Punkte. Tr&auml;gt er zus&auml;tzlich einen Bewertungstext ein, bekommt er bereits 6 Punkte.
        '<ul>
                                <li>G&uuml;ltig sind nur ganze Zahlen (1 2 3 ... 9).</li>
                                <li>Der Kunde erh&auml;lt dazu eine Best&auml;tigungs-E-Mail</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_HELP'                        => 'Sie können auch für eingetragene Produktbewertungen Punkte vergeben	
<br>Diese Option wird aktiv, wenn in mindestens eine der beiden folgenden Variablen ein Wert > 0 eingestellt wird.
<br>Es können unterschiedliche Punkte für Stern- und Textbewertungen vergeben werden. Somit wird der Kunde animiert, einen Text zu schreiben, statt nur Sterne zu vergeben.
<br>Z.B. kann für eine Sternbewertung 2, und einen Test 4 Punkte vergeben werd.<br>Bewertet der Kunde nur per Sterne, erhält er demzufolge 2 Punkte. Trägt er zusä;tzlich einen Bewertungstext ein, bekommt er bereits 6 Punkte.',

    'D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_TEXT_MULTIPLE_REVIEWS_HELP' => '<b>Mehrfach-Textbewertungen f&uuml;r Artikel:</b><br>Der Shop erlaubt es den Kunden, beliebig oft einen Artikel mit einem Text zu bewerten.<br>Mit dieser Option k&ouml;nnen Sie die mehrfache Vergabe von Bonuspunkten f&uuml;r Textbewertungen an einem Artikel regeln.<br>Aktivieren Sie die Checkbox damit Ihre Kunden mehrere Textbewertungen verg&uuml;tet bekommen sollen.',
    'D3_CFG_MOD_d3points_POINTS_SYSTEM_EE_MALL_ACCOUNT_HELP' => '<b>Shop&uuml;bergreifendes Punktekonto (nur EE) :</b><br>Diese Option gilt nur f&uuml;r den Einsatz in einer oxid eShop Enterprise-Version.
                            <ul>
                                <li>De/aktivieren Sie die Shop&uuml;bergreifende Verwaltung der Bonuspunkte. Im Kundenkonto werden mit der Aktivierung die Punkte aus den (Sub-)Shops zusammen aufgelistet.</li>
                                <li>Die Gutscheine werden aus der Gesamtsumme der Bonuspunkte pro Konto erstellt.</li>
                                <li>Voraussetzung ist die aktive Shopeinstellung "Benutzer k&ouml;nnen sich in allen Shops einloggen" ([Stammdaten]->[Grundeinstellungen]->Auswahl Supershop->[Mall]).</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECT_ORDERS_HELP' => '<b>Auswahlkriterien f&uuml;r die Punktevergabe an Bestellungen:</b><br>
                            Diese Einstellungen beeinflussen die Vorauswahl der Bestellungen.<br>
                            Erfüllt eine Bestellung alle Bedingungen, dann werden dem Kunden für diese Bestellung Punkte gut geschrieben. Die Konfiguration dazu finden Sie in dem Bereich "Berechnung der Bonuspunkte".',
    'D3_CFG_MOD_d3points_SELECTION_DATE_LIMIT_HELP' => '<b>Zeitlimit f&uuml;r zur&uuml;ckliegende Bestellungen:</b><br>
                            Bestellungen mit einem Bestelldatum &auml;lter als n Monate werden f&uuml;r die Punktevergabe ausgeschlossen.<br>
                            Bei Shops mit sehr vielen Altbestellungen (bspw. seit 2007) kann es bei der Ausf&uuml;hrung des Cronjobs zu einem Abbruch kommen.
                			<ul>
                                <li>Die Eingabe erfolgt in Monaten (G&uuml;ltig sind nur ganze Zahlen 1 2 3 4 ... 9).</li>
                                <li>Es wird das Bestelldatum (Feld <span class="filename_filepath_or_italic">oxorderdate</span>) selektiert.</li>
                                <li>Bei Angaben kleiner gleich 0 werden alle Bestellungen ohne ein Zeitlimit gepr&uuml;ft.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_DATE_RANGE_HELP' => '<b>Zeitspanne zwischen Bestellzeit und Punktevergabe:</b><br>
                            Die Vergabe der Punkte wird mit einem Versatz von n Tage/n durchgef&uuml;hrt.
							<ul>
                                <li>Eingabe erfolgt in Tagen (G&uuml;ltig sind nur ganze Zahlen 1 2 3 4 ... 9).</li>
                                <li>Es wird das Bestelldatum (Feld <span class="filename_filepath_or_italic">oxorderdate</span>) gepr&uuml;ft.</li>
                                <li>Bei Angaben kleiner 0 wird keine Bestellung ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_PRICE_LIMIT_HELP' => '<b>Minimalwert f&uuml;r den Warenbruttowert:</b><br>
                            Bestellungen, welche den Minimalwert nicht erf&uuml;llen werden ausgeschlossen.
                            <ul>
                                <li>Der Minimalwert wird mit den Warenwert (<span class="filename_filepath_or_italic">oxtotalordersum - oxdelcost</span>) verglichen.</li>
                                <li>Der Vergleich wird in der Basisw&auml;hrung durchgef&uuml;hrt.</li>
                                <li>Bei Angaben kleiner 0 wird keine Bestellung ausgeschlossen.</li>
                                <li>Sollten Sie das Staffelpunktesystem verwenden, beachten Sie bitte die Angaben unter [Berechnung der Bonuspunkte]->Punkteverteilung f&uuml;r das Staffelsystem].</li>
                                <li>M&ouml;gliche Formate (mit Pipezeichen | getrennt): 19,99 | 19.99 | 20</li>
                            </ul>',
    'D3_CFG_MOD_d3points_DO_POINTS_FOR_USER_WITHOUT_ACCOUNT_HELP' => '<b>Kunden ohne Kundenkonto erhalten Bonuspunkte:</b><br>
                            Vergeben Sie an Kunden ohne Kundenkonto (Einkauf ohne Registrierung) Bonuspunkte.<br>
                            Bitte beachten Sie:<br>
                            <ul>
                                <li>Bei aktiver Checkbox wird die Bestellung des unregistrierten Kunden, wie eine Bestellung eines registrierten Kunden behandelt.</li>
                                <li>Tipp: Der Kunde kann sich erst in das Konto einloggen, wenn ein Passwort an den Kunden vergeben wurde.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_GROUPS_4_POINTS_HELP' => '<b>Kundengruppen freigeben:</b><br>
                            Schr&auml;nken Sie die Auswahl der Bestellungen auf bestimmte Kundengruppen ein.
                            <ul>
                                <li>Die Kunden m&uuml;ssen in einer der gew&auml;hlten Gruppen zugeordnet sein (die Gruppen werden mit "ODER" gepr&uuml;ft).</li>
                                <li>Die Auswahl der Kundengruppen ist optional.</li>
                                <li>Ist keine Gruppe ausgew&auml;hlt wird dieses Kriterium &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_GROUPS_4_NO_POINTS_HELP' => '<b>Kundengruppen ausschlie&szlig;en:</b><br>
                            Schlie&szlig;en Sie einzelne Kundengruppen aus.
                            <ul>
                                <li>Die Kunden m&uuml;ssen in einer der gew&auml;hlten Gruppen zugeordnet sein (die Gruppen werden mit "ODER" gepr&uuml;ft).</li>
                                <li>Die Auswahl der Kundengruppen ist optional.</li>
                                <li>Ist keine Gruppe ausgew&auml;hlt wird dieses Kriterium &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_PAYMENT_DATE_PAYED_POINTS_HELP' => '<b>Bezahldatum bei folgenden Bezahlarten pr&uuml;fen:</b><br>
                            W&auml;hlen Sie die Bezahlarten, welche auf das "bezahlt am"-Datum gepr&uuml;ft werden sollen.<br>
                            <ul>
                                <li>Die Pr&uuml;fung erfolgt auf das Feld <span class="filename_filepath_or_italic">oxpaid</span>.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden tempor&auml;r ausgeschlossen und mit dem n&auml;chsten Cronjob-Aufruf erneut gepr&uuml;ft.</li>
                                <li>Beispiel: Wenn per Vorrauskasse bezahlt wird, wollen Sie erst nach Erhalt des Betrages Bonuspunkte vergeben.</li>
                                <li>Mit dieser Pr&uuml;fung k&ouml;nnen Sie unberechtige Punktevergabe, durch unbezahlte Mehrfachbestellungen vorbeugen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_PAYMENT_4_NO_POINTS_HELP' => '<b>Keine Punkte bei folgenden Zahlarten:</b><br>
                            W&auml;hlen Sie die Bezahlarten aus, welche f&uuml;r die Berechnungen ausgeschlossen werden sollen.<br>
                            Bestellungen, welche dieses Kriterium erf&uuml;llen werden dauerhaft ausgeschlossen.',
    'D3_CFG_MOD_d3points_SELECTION_DELIVERYDATE_4_NO_POINTS_HELP' => '<b>Versanddatum bei folgenden Bezahlarten pr&uuml;fen:</b><br>
                            W&auml;hlen Sie die Bezahlarten, welche auf das "versandt am"-Datum gepr&uuml;ft werden sollen.<br>
                            <ul>
                                <li>Die Pr&uuml;fung erfolgt auf das Feld <span class="filename_filepath_or_italic">oxsenddate</span>.</li>
                                <li>Beispiel: Wenn per Kreditkarte bezahlt wird, wollen Sie erst nach Versand des Produktes / der Bestellung die Bonuspunkte vergeben.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden tempor&auml;r ausgeschlossen und mit dem n&auml;chsten Cronjob-Aufruf erneut gepr&uuml;ft.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_OXFOLDER_4_POINTS_HELP' => '<b>Ordner freigeben:</b><br>
                            W&auml;hlen Sie die Ordner f&uuml;r die Bestellungen freigeben werden.<br>
                            <ul>
                                <li>Die Bestellungen m&uuml;ssen in einer der gew&auml;hlten Ordner zugeordnet sein (die Ordner werden mit "ODER" gepr&uuml;ft).</li>
                                <li>Die Auswahl der Bestellordner ist optional.</li>
                                <li>Ist kein Bestellordner ausgew&auml;hlt wird dieses Kriterium &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',

    'D3_CFG_MOD_d3points_SELECTION_OXFOLDER_4_NO_POINTS_HELP' => '<b>Ordner ausschlie&szlig;en</b><br>
                            W&auml;hlen Sie die Ordner f&uuml;r die Bestellungen ausgeschlossen werden.<br>
                            <ul>
                                <li>Die Bestellungen m&uuml;ssen in einer der gew&auml;hlten Ordner zugeordnet sein (die Ordner werden mit "ODER" gepr&uuml;ft).</li>
                                <li>Die Auswahl der Bestellordner ist optional.</li>
                                <li>Ist kein Bestellordner ausgew&auml;hlt wird dieses Kriterium &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',


    'D3_CFG_MOD_d3points_OPT_SETTINGS_HELP' => '<b>Optionale Auswahlkriterien:</b><br>
                            Hier k&ouml;nnen Sie weitere Felder und zus&auml;tzliche Pr&uuml;fungen angeben.<br>
                            Diese werden bspw. von diversen Modulen (Bezahlmodulen, Schnittstellen zu Verkaufsportalen, ...) bef&uuml;llt.<br>
                            Weitere Information bekommen Sie bei dem jeweiligen Modulhersteller der Schnittstellen/Module.<br>
                            Sie k&ouml;nnen m&ouml;gliche Werte aus der Datenbank, in der entsprechenden Tabelle auslesen.',
    'D3_CFG_MOD_d3points_SELECTION_OXIP_INCL_HELP' => '<b>Notwendige Werte im Feld oxip:</b><br>
                            In der Tabelle <span class="filename_filepath_or_italic">oxorder</span> im Feld <span class="filename_filepath_or_italic">oxip</span> speichern einige Module eine Art Kennung von Portalen (bspw. amazon, ebay, ...) ab.<br>
                            Hier k&ouml;nnen Sie die Kennungen eintragen, welche zwingend erforderlich sind.
                            <ul>
                                <li>Das Datenfeld darf nur exakt diese Zeichenkette enthalten.</li>
                                <li>Gro&szlig;- Kleinschreibung wird ignoriert.</li>
                                <li>Bei mehreren Kennungen muss jeder Wert auf einer separaten Zeile stehen.</li>
                                <li>Bleibt das Feld leer, wird diese Pr&uuml;fung &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_OXIP_EXCL_HELP' => '<b>Verbotene Werte im Feld oxip:</b><br>
                            In der Tabelle <span class="filename_filepath_or_italic">oxorder</span> im Feld <span class="filename_filepath_or_italic">oxip</span> speichern einige Module eine Art Kennung von Portalen (bspw. amazon, ebay, ...) ab.<br>
                            Hier k&ouml;nnen Sie die Kennungen eintragen, welche ausgeschlossen werden sollen.
                            <ul>
                                <li>Das Datenfeld darf nur exakt diese Zeichenkette enthalten</li>
                                <li>Gro&szlig;- Kleinschreibung wird ignoriert</li>
                                <li>Bei mehreren Kennungen muss jeder Wert auf einer separaten Zeile stehen.</li>
                                <li>Bleibt das Feld leer, wird diese Pr&uuml;fung &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_OXTRANSSTATUS_INCL_HELP' => '<b>Notwendige Werte im Feld oxtransstatus:</b><br>
                            In der Tabelle <span class="filename_filepath_or_italic">oxorder</span> im Feld <span class="filename_filepath_or_italic">oxtransstatus</span> speichern einige Module die Status von Transaktionen (bspw. ERROR, OK, ...) ab.<br>
                            Hier k&ouml;nnen Sie die Transaktionstatus eintragen, welche zwingend erforderlich sind.
                            <ul>
                                <li>Das Datenfeld darf nur exakt diese Zeichenkette enthalten.</li>
                                <li>Gro&szlig;- Kleinschreibung wird ignoriert.</li>
                                <li>Bei mehreren Kennungen muss jeder Wert auf einer separaten Zeile stehen.</li>
                                <li>Bleibt das Feld leer, wird diese Pr&uuml;fung &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_OXTRANSSTATUS_EXCL_HELP' => '<b>Verbotene Werte im Feld oxtransstatus:</b><br>
                            In der Tabelle <span class="filename_filepath_or_italic">oxorder</span> im Feld <span class="filename_filepath_or_italic">oxtransstatus</span> speichern einige Module die Status von Transaktionen (bspw. ERROR, OK, ...) ab.<br>
                            Hier k&ouml;nnen Sie die Transaktionstatus eintragen, welche ausgeschlossen werden sollen.
                            <ul>
                                <li>Das Datenfeld darf nur exakt diese Zeichenkette enthalten.</li>
                                <li>Gro&szlig;- Kleinschreibung wird ignoriert.</li>
                                <li>Bei mehreren Kennungen muss jeder Wert auf einer separaten Zeile stehen.</li>
                                <li>Bleibt das Feld leer, wird diese Pr&uuml;fung &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_OXBILLEMAIL_INCL_HELP' => '<b>Erlaubte E-Mailadresse/n:</b><br>
                            Schr&auml;nken Sie die Auswahl der Bestellungen auf bestimmte E-Mailadressen oder Teile von E-Mailadressen ein.
                            <ul>
                                <li>Begrenzung auf komplette oder Teile von E-Mailadressen.</li>
                                <li>Beispiele (mit Pipezeichen | getrennt):<br> user@domain.de | domain.de | domain | user@ </li>
                                <li>Gro&szlig;- Kleinschreibung wird ignoriert.</li>
                                <li>Bei mehreren Kennungen muss jeder Wert auf einer separaten Zeile stehen.</li>
                                <li>Bleibt das Feld leer, wird diese Pr&uuml;fung &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium nicht erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_SELECTION_OXBILLEMAIL_EXCL_HELP' => '<b>Verbotene E-Mailadresse/n:</b><br>
                            W&auml;hlen Sie E-Mailadressen oder Teile von E-Mailadressen aus, welche f&uuml;r die Berechnungen ausgeschlossen werden sollen.<br>
                            <ul>
                                <li>Begrenzung auf komplette oder Teile von E-Mailadressen.</li>
                                <li>Beispiele (mit Pipezeichen | getrennt):<br> user@domain.de | domain.de | domain | user@ </li>
                                <li>Gro&szlig;- Kleinschreibung wird ignoriert.</li>
                                <li>Bei mehreren Kennungen muss jeder Wert auf einer separaten Zeile stehen.</li>
                                <li>Bleibt das Feld leer, wird diese Pr&uuml;fung &uuml;bersprungen.</li>
                                <li>Bestellungen, welche dieses Kriterium erf&uuml;llen werden dauerhaft ausgeschlossen.</li>
                            </ul>',
    //Konfiguration ->Generierung Gutscheine
    'D3_CFG_MOD_d3points_VOUCHER_RATE_4_VOUCHER_HELP' => '<b>Bonuspunkte-Umrechnungskurs:</b><br>
                            Hier wird der Umrechnungkurs von den Punkten zu der Shop-Basisw&auml;hrung eingestellt.<br>
                        	<ul>
                                <li>
                                    Die W&auml;hrung ist nicht auf die Shop-Basisw&auml;hrung festgelegt.<br>
                                    Der Wert des Gutscheines wird in der vom Kunden gew&auml;hlten W&auml;hrung angezeigt.
                                </li>
                                <li>
                                    <b>Beispiel 1:</b><br>
                                    Ist "0.01" hinterlegt, bekommt der Kunde einen Gutschein in H&ouml;he von 1 Cent je 1 Bonuspunkt.<br>
                                    Punktekonto betr&auml;gt 250 Punkte. Umrechnung: 250 * 0.01 = 2.50<br>Der Kunde erh&auml;lt somit einen Gutschein &uuml;ber 2,50 Shop-Basisw&auml;hrung.
                                </li>
                                <li>
                                    <b>Beispiel 2:</b><br>
                                    Ist "0.05" hinterlegt, bekommt der Kunde einen Gutschein in H&ouml;he von 5 Cent je 1 Bonuspunkt.<br>
                                    Punktekonto betr&auml;gt 250 Punkte. Umrechnung: 250 * 0.05 = 12.50<br>Der Kunde erh&auml;lt somit einen Gutschein &uuml;ber 12,50 Shop-Basisw&auml;hrung.
                                </li>
                                <li>M&ouml;gliche Angaben (mit Pipezeichen | getrennt):<br> 1 | 1,5 | 1.5 | 0.05 | 0,05</li>
                            </ul>',
    'D3_CFG_MOD_d3points_POINTS_VOUCHER_OUT_PAYMENT_HELP' => '<b>Minimallimit f&uuml;r die Punkteumwandlung:</b><br>
                            Stellen Sie die Mindestpunktezahl ein, ab der ein Kunde manuell aus seinen Bonuspunkten einen Gutschein erstellen kann.<br>
                            <ul>
                                <li>Beispiel: Bei einem Wert von 100, darf der Kunde erst ab einem Kontostand von 100 Punkten einen Gutschein erstellen.</li>
                                <li>G&uuml;ltig sind nur ganze Zahlen (100 200 300 ... 900).</li>
                                <li>0 - kein Limit gesetzt.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_POINTS_VOUCHER_AUTOMATIC_PAYOUT_HELP' => '<b>Automatische Gutscheinerstellung:</b><br>
                            Geben Sie die H&ouml;he an, ab wann die Bonuspunkte automatisch in einen Gutschein umgewandelt werden sollen.
                            <ul>
                                <li>G&uuml;ltig sind nur ganze Zahlen (100 200 300 ... 900).</li>
                                <li>Das Kundenkonto wird bei der Generierung um die Punktezahl (siehe Bonuspunkte-Umrechnungskurs) reduziert.</li>
                                <li>Der Kunde erh&auml;lt automatisch eine E-Mail mit dem Gutscheincode.</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_POINTS_VOUCHER_NUMBER_OF_CHARAKTER_HELP' => '<b>Anzahl der Stellen des Gutscheincodes:</b><br>
                            Anzahl der Stellen, die ein Gutscheincode bei der Erstellung bekommen soll. Die Generierung erfolgt per Zufall mit n Stellen.',
    //Konfiguration -->Email

    'D3_CFG_MOD_d3points_EMAILS_HELP' => '<b>Konfiguration E-Mails:</b><br>Hier k&ouml;nnen Sie noch weitere Einstellungen zum Thema E-Mails setzen.',
    'D3_CFG_MOD_d3points_EMAILS_TEST_HELP' => '<b>Test-E-Mailadresse angeben:</b><br>Wenn der Test-Modus aktiv ist, werden alle Bonuspunkte E-Mails an die eingetragene E-Mailadresse versendet.',
    'D3_CFG_MOD_d3points_EMAILS_BCC_HELP' => '<b>Blindkopie-E-Mailadresse angeben:</b><br>Alle ausgehenden E-Mails werden zus&auml;tzlich als BCC (Blindkopie) an die eingetragene E-Mailadresse versendet.',
    'D3_CFG_MOD_d3points_SEND_FIRST_EMAIL_HELP' => '<b>Zeitversatz zwischen Vergabe der Punkte und Benachrichtgung per E-Mail:</b><br>
                            Der Kunde erh&auml;lt die Informations-E-Mail zur Punktevergabe erst nach n Tagen.
                            <ul>
                                <li>G&uuml;ltig sind nur ganze Zahlen (1 2 3 ... 9).</li>
                                <li>Bei Angaben kleiner 0 wird die Informations-E-Mail bei der Punktevergabe versendet.</li>
                            </ul>',
    //'D3_CFG_MOD_d3points_REMINDER'  				=> 'Einstellung Erinnerungsemails',
    'D3_CFG_MOD_d3points_REMINDER_DAYS_WAIT_4_FIRST_MAIL_HELP' => '<b>:</b><br>Punktestand ab dem der Kunde erinnert werden soll.
                            <ul>
                            <li>Angabe erfolgt in Tagen.</li>
                            <li>Der Wert gibt die Anzahl der Tage an, die zwischen der ersten Informationsmail (das er Punkte erhalten hat) und einer weiteren Erinnerungs-E-mail liegen sollen</li>
                            <li>Bleibt das Feld leer bzw. wird auf "0" gesetzt werden keine Erinnerungs-E-Mails versendet.</li>
                            <li>Der Kunde kann den Empfang dieser E-Mail abw&auml;hlen. Die notwendige Einstellm&ouml;glichkeit befindet sich im Kundenkonto.</li></ul>',
    'D3_CFG_MOD_d3points_REMINDER_DAYS_WAIT_4_NEXT_MAILS_HELP' => '<b>Intervall der Erinnerungs-E-Mail:</b><br>
                            Der Kunde erh&auml;lt nach n Tagen die Einnerungs-E-Mail.<br>
                            <ul>
                                <li>In der Erinnerungs-E-Mail wird der Kunde an sein Punktekonto erinnert.</li>
                                <li>Der Intervall wird nach jeder Punktevergabe neu gestartet.</li>
                                <li>G&uuml;ltig sind nur ganze Zahlen (1 2 3 ... 9).</li>
                                <li>Bei Angaben kleiner 0 wird die Informations-E-Mail bei der Punktevergabe versendet.</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                            </ul>',
    'D3_CFG_MOD_d3points_REMINDER_AMOUNT_POINTS_HELP' => '<b>Mindestpunktestand Erinnerungs-E-Mail:</b><br>
                            Der Kunde wird erst ab einem Kontostand n erinnert.
                            <ul>
                                <li>Abfrage pr&uuml;ft auf: Einstellung >= Punktestand Kundenkonto </li>
                                <li>Der Kunde erh&auml;lt dazu eine E-Mail mit der Summe seiner Punkte.</li>
                                <li>Der Kunde kann den Empfang dieser separaten E-Mail, in seinem Kundenkonto de/aktivieren.</li>
                                <li>G&uuml;ltig sind nur ganze Zahlen (100 200 300 ... 900).</li>
                            </ul>',

    //Testmodus
    'D3_CFG_MOD_d3points_TESTMODUS_FOR_REVIEWS_HELP' => '',
    'D3_CFG_MOD_d3points_TESTMODUS_DISPLAY_ACCOUNT_HELP' => '',
    'D3_CFG_MOD_d3points_TESTMODUS_FOR_GROUPS_HELP' => '',

    'D3_CFG_MOD_d3points_TESTMODUS_CREATE_VOUCHERS_HELP' => '',

    //Spielwiese
    //Wartung
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_HELP' => '<b>Alle Bestellungen zur&uuml;cksetzen:</b><br>
                            Mit dieser Wartungsoption k&ouml;nnen Sie den Status f&uuml;r ALLE Bestellungen innerhalb eines Shops setzen.<br>
                            Damit k&ouml;nnen alle Bestellungen f&uuml;r eine erneute Punktevergabe freigeschalten/gesperrt werden.<br>
                            Achtung! Bereits vergebenene Punkte werden nicht gel&ouml;scht!<br><br>
                            Tipp: Nach der Installation bzw. Liveschaltung des Moduls k&ouml;nnen Sie alle Bestellungen als bearbeitet markieren. Damit wird das Bonuspunkteprogramm erst mit neuen Bestellungen gestartet. ',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TXT_HELP' => '<b>:</b><br>Alle Bestellungen auf bearbeitet setzten. Mit einem Haken werden alle Bestellungen auf "bearbeitet" gesetzt. Ohne Haken wird der Status "unbearbeitet" gesetzt und die Bestellungen werden vom Cronjob bearbeitet.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDER_TXT_HELP' => '<b>Bonuspunkte einer einzelnen Bestellung l&ouml;schen:</b><br>F&uuml;r eine einzelne Bestellung k&ouml;nnen die vergebenen Punkte gel&ouml;scht oder storniert werden.<br>Der Kunde wird &uuml;ber diesen Vorgang per E-Mail benachrichtigt.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_UNSET_HELP' => '<b>als unbearteitet markieren:</b><br>An alle Bestellungen im Shop werden nach Ausf&uuml;hrung dieser Aktion neue Bonuspunkte vergeben.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_SET_HELP' => '<b>als bearbeitet markieren:</b><br>An alle bisher im Shop get&auml;tigten Bestellungen k&ouml;nnen keine Bonuspunkte mehr vergeben werden.<br>Bonuspunkte werden an zuk&uuml;nftigen Bestellungen berechnet.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_HELP' => '<b>Vorgang wirklich ausf&uuml;hren?:</b><br>Aus Sicherheitsgr&uuml;nden muss dieses Feld best&auml;tigt werden.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDER_CONFIRM_HELP' => '<b>Vorgang wirklich ausf&uuml;hren?:</b><br>Aus Sicherheitsgr&uuml;nden muss dieses Feld best&auml;tigt werden.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP_DELETE_HELP' => '<b>l&ouml;schen:</b><br>Bereits vergebene Punkte und Gutscheine dieser Bestellung werden gel&ouml;scht.<br>Die Bestellung ist damit f&uuml;r eine erneute <b>Punktevergabe freigeschalten</b>.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP_STORNO_HELP' => '<b>stornieren:</b><br>Dem Bonuspunktekonto werden die Punkte aus der Bestellung negativ berechnet.<br>Im Falle eines negativen Punktestand wird versucht vorhandene Bonuspunkte-Gutscheine aufzul&ouml;sen. Kann kein Gutschein aufgel&ouml;st werden, bleibt ein negativer Punktestand.<br><b>Dieser Vorgang ist im Kundenkonto nachvollziehbar</b> und kann dem Kunden &uuml;ber das Feld "Bemerkung" erl&auml;utert werden.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_COMMET_HELP' => '<b>Bemerkung:</b><br>Hier kann ein Kommentar f&uuml;r den Kunden hinterlassen werden. Diese Meldung ist im Kundenkonto sichtbar und wird in der E-Mail angezeigt.',
    'D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_SEND_MAIL_HELP' => '<b>E-Mail versenden:</b><br>Der Kunde wird dar&uuml;ber per E-Mail unterrichtet.',
    //Bestellungen ->Stamm
    //Benutzer D3 Bonuspunkte
    'D3_USER_POINTS_SETPOINTS_HELP' => '<b>Punkte:</b><br>
                            Geben Sie an ob Sie negative/positive Punkte vergeben woll.
                            <ul>
                                <li>Der Kunde erh&auml;lt keine E-Mail Benachrichtigung.</li>
                                <li>Die Vergabe der Punkte kann der Kunde in seinem Kundenkonto einsehen.</li>
                                <li>G&uuml;ltig sind nur ganze Zahlen (-100 100 -200 200 ... 900).</li>
                            </ul>
        ',
    'D3_USER_POINTS_SETPOINTS_SEND_EMAIL_HELP'  =>'',

    'D3_CFG_MOD_d3points_FNC_CRONJOB_PRINT_STATUS_HELP'                    => 'Die Ausführung der CronJobs beeinhaltet die Ausgabe umfangreicher Informationen zur Abarbeitung und zu den Kundendaten.
<br>Für Tests, der Inbetriebnahme oder dem regulären Betrieb können diese Informationen wichtig sein um die Funktion nachzuvollziehen.
 <br> Ist diese Option nicht gesetzt, dann werden auch keine Daten ausgegeben.',

    'D3_CFG_MOD_d3points_FNC_CRONJOB_SEND_STATUS_TO_HELP'       => 'Mit dieser Option werden die Ausgaben zusätzlich an die hier hinterlegte Emailadresse gesendet.<br>Ist das Feld leer, so erfolgt keine Ausgabe per Mail.<br><br>
Diese Einstellung ist unabhängig von der Option: 
'
);
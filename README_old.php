<?php die('Direct access not permitted');?>

###########################################################
#######                                             #######
#######          README zur AluMPI-Homepage         #######
#######                                             #######
#######                 Version 0.3                 #######
#######                 21.03.2016                  #######
#######                                             #######
###########################################################


=======================
         INHALT 
=======================

0. TO DO
	0.1 Wichtig
	0.2 Optional
	
1. Allgemeines

2. Struktur der Homepage
	2.1 Ordnerstruktur
	2.2 Aufbau einer Seite

3. Übliche Arbeitsschritte
	3.1 Den Inhalt einer Unterseite ändern
	3.2 Eine neue Unterseite anlegen
	3.3 Eine Unterseite löschen
	3.4 Eine Unterseite intern schalten
	3.5 ?
	
4. Hinweise zu Implementierungsdetails
	4.1 Form Validation
	4.2 Email-Versand
	4.3 ?

=======================




################################################
	0. TO DO
################################################


	0.1 Wichtig
------------------------------------------------


- Seite auf HTTPS umstellen
- Admin-Funktionalitäten implementieren
- Was ist die Usergruppe in der DB?



	0.2 Optional
------------------------------------------------

- Absolventenbilder klein/gross: 07, 08, 09, 14_1, 14_2
- Registrierung von Fördermitgliedern
- Mitgliedsbestätigung generieren
- Foto-Upload in Absolventenfeier-Anmeldeformular?
- Arbeitgeber angeben
- -> Absolventennetzwerk





################################################
	1. Allgemeines
################################################

Die Homepage ist in PHP geschrieben und läuft unabhängig von jeglichen externen Frameworks. Sie ist separat lauffähig, d.h. wenn der 
entsprechende Ordnerstruktur auf einen anderen PHP-fähigen Webserver kopiert wird, kann die Homepage dort direkt verwendet werden.

Aktuell läuft die Homepage über den AluMPI-Server, der im Fachschaftszimmer steht.
Name: btfmx5
IP-Adresse: 132.180.136.54
Sub-Netzwerk: fs.uni-bayreuth.de
MAC-Adresse: 00 04 48 b2 49 0c
Netzantrag Nr. 140894

Auf diesem Server ist Debian installiert, als Webserver wird Apache verwendet. Die Homepage liegt im öffentlichen Verzeichnis des 
Webservers unter /var/www/html/ .
Sendmail ist zum Versand der E-Mails installiert, MySQL ist als Datenbank-Server installiert, wird aber nur zu Testzwecken genutzt.
Die eigentliche verwendete Datenbank liegt NICHT auf dem eigenen Webserver, sondern ist auch weiterhin unter Verwaltung des IT-Servicezentrums 
der Uni Bayreuth, s.d. die Verantwortung für Datensicherung, Backups etc. nicht bei uns liegt.
Die Datenbank ist unter mysql.rz.uni-bayreuth.de erreichbar, Account-Name ist "alumpi", das Passwort ist dem Vorstand bekannt.








################################################
	2. Struktur der Homepage
################################################

	2.1 Ordnerstruktur
------------------------------------------------


Direkt im Hauptordner der Homepage liegen lediglich zwei Dateien, diese README, sowie eine index.php, die auf die Startseite weiterleitet.
In diesem Hauptordner liegen zwei Arten von Ordnern: Seiten-Ordner und strukturelle Ordner.
Seiten-Ordner enthalten jeweils eine Unterseite der Homepage. Der Name des Seiten-Ordnerns wird bei der Darstellung der entsprechenden Unterseite
in der URL im Browser angezeigt und ist somit bewusst zu wählen. Näheres zum Inhalt dieser Ordner unter Punkt 2.2
Strukturelle Order beginnen jeweils mit einem Unterstrich und enthalten diversen Inhalt:
- _css enthält sämtliche verwendete CSS-Dateien
- _images_content enthält sämtliche Bilder, die im Inhaltsbereich des Homepage Verwendung finden
- _images_layout enthält alle Bilder, die im Seitenlayout selbst verwendet werden
- _includes_functionality enthält diverse PHP-Dateien, die Funktionalitäten bereitstellen, die auf mehr als einer Unterseite verwendet werden.
- _includes_layout enthält alle PHP-Dateien, die zum Zusammenbau der Seite benötigt werden

Neben den Dateien und Ordnern im Hauptordner der Homepage wird zum Aufbau der Datenbankverbindung eine Datei "db_config.php" benötigt, die außerhalb
des zugänglichen Webserver-Verzeichnisses liegt, um die dort enthaltenen Daten wie das DB-Passwort zu schützen.
Diese muss vom Hauptordner aus unter dem Pfad HOME_DIRECTORY . "config_files/db_config.php" zu finden sein, also in einem separaten Ordner "config-files" liegen.




	2.2 Aufbau einer Seite
------------------------------------------------


Jeder Seiten-Ordner enthält mindestens zwei PHP-Dateien: index.php und content.php
Die Datei index.php ist dabei die Datei, die dem Nutzer im Browser angezeigt wird. Der PHP-Code in dieser Datei baut also die gesamte ausgelieferte Seite
zusammen. Dazu werden in dieser Datei diverse Bestandteile der Seite aus "_includes_layout" (wie z.B. der Header, der Footer und das Navigationsmenü) geladen,
außerdem wird der Seiteninhalt aus der content.php eingefügt.
Die Datei content.php enthält den eigentlichen Seiteninhalt der entsprechenden Unterseite. Sie bindet dabei ggf. Inhalt aus weiteren PHP-Dateien ein, dies 
kann statisch oder an bestimmte Bedingungen geknüpft geschehen.

Eine gesamte, zusammengebaute Unterseite hat damit folgende Struktur:

------------
<!DOCTYPE html>
<html>
	[htmlheader.php]
	<body>
		[header.php]
		<section id="main">
			[navigation.php]
			[content.php] (seitenspezifisch)
		</section>
		[footer.php]
	</body>
</html>
------------




################################################
	3. Übliche Arbeitsschritte
################################################

	3.1 Den Inhalt einer Unterseite ändern
------------------------------------------------



	3.2 Eine neue Unterseite anlegen
------------------------------------------------




	3.3 Eine Unterseite löschen
------------------------------------------------





	3.4 Eine Unterseite intern schalten
------------------------------------------------




################################################
	4. Hinweise zu Implementierungsdetails
################################################



	4.1 Form Validation
------------------------------------------------

Regexes zur Überprüfung der Eingabefelder, wichtig die Modifier i für case-insensitive und u für UTF-8, um Umlaute etc. korrekt zu verarbeiten.


	4.2 E-Mail-Versand
------------------------------------------------

Um keinen eigenen Mailserver installieren zu müssen, wurde initial versucht den Mailversand mittels SSMTP zu erledigen. Hierbei wird die E-Mail
mittels SMTP über einen anderen, eigentlichen Mailserver verschickt. Dafür wurden zwei Alternativen getestet
1. Uni-Webmail:	Nutzung der normalen Adresse alumpi@uni-bayreuth.de, Problem: Uni-Webmail zu langsam und unzuverlässig. Wenn die Bestätigungsmail
				erste eine halbe Stunde nach Abschicken der Anmeldung kommt ist das kacke
2. Gmail:		Account alumpi.ubt@gmail.com erstellt, versand der Mails darüber funktioniert instantan und gut, ABER: Keine eigene Angabe einer
				Absenderadresse über "From:" möglich, Google überschreibt dies mit dem Accountnamen. Doof, da "no-reply@alumpi.de" als Absender
				verwendet werden (für den User sichtbar sein) soll, keine Gmail-Adresse.
				
-> Jetzt doch Verwendung eines eigenen Mini-Mailservers
Verwendung von "sendmail"
Keine manuelle Konfiguration erforderlich, lediglich Installation und auto-Konfiguration von sendmail, 
eintragen von "sendmail_path = /usr/sbin/sendmail -t -i" in der "php.ini"

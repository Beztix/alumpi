<?php die('Direct access not permitted');?>

###########################################################
#######                                             #######
#######          README zur AluMPI-Homepage         #######
#######                                             #######
#######                 Version 0.2                 #######
#######                 21.01.2016                  #######
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
	3.1 Seiteninhalt verändern
	3.2 Eine neue Seite anlegen
	3.3 Eine Seite löschen
	3.4 Eine Seite in den Mitgliederbereich aufnehmen
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


- Bei Veröffentlichung die DB anpassen!
- Was ist die Usergruppe in der DB?



	0.2 Optional
------------------------------------------------

- Registrierung von Fördermitgliedern
- Mitgliedsbestätigung generieren
- Foto-Upload in Absolventenfeier-Anmeldeformular?
- Arbeitgeber angeben
- Absolventennetzwerk





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

	0.1 Ordnerstruktur
------------------------------------------------




	0.2 Aufbau einer Seite
------------------------------------------------





################################################
	3. Übliche Arbeitsschritte
################################################






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

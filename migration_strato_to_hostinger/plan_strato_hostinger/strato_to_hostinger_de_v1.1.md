# Migrationsplan: Strato → Hostinger 

### Autor: Dr. Henry Macartney
### Datum: 01.05.2026

## Änderungshistorie

| Version | Datum | Wesentliche Änderungen |
|---------|---|---|
| 1.0     | 1. Mai 2026 | Erstfassung. Drei Arbeitsbereiche identifiziert: Übertragung der Domain-Registrierung, WordPress- und Datenbankmigration, E-Mail-Migration. E-Mail-Ansatz: Live-IMAP-zu-IMAP-Synchronisation (z. B. `imapsync`) mit gleichzeitig aktiven Anbietern. WordPress-Migration als langfristiges Ziel betrachtet, mit vollständigem Primärdomain-Wechsel und Datenbank-Suchen-und-Ersetzen. |
| 1.1     | 1. Mai 2026 | **E-Mail-Migration-Ansatz geändert** auf Backup-und-Wiederherstellung: die Kretzschmars erstellen vor der Umstellung eine lokale Thunderbird-/MailStore-Kopie aller E-Mails und stellen diese anschließend per Drag-and-Drop in die neuen Hostinger-Postfächer wieder her. Risikoärmer, gibt den Praxisinhabern ein dauerhaftes lokales Archiv, DSGVO-Verschlüsselungshinweise ergänzt. <br><br> **Site-Neuaufbau als paralleler Arbeitsbereich aufgenommen**: die migrierten WP-Sites werden nun ausschließlich als Übergangslösung behandelt — beide Sites werden bei Hostinger von Grund auf neu in modernem Design aufgebaut. Deutschlandspezifische Compliance-Hinweise hinzugefügt (DSGVO, lokal gehostete Schriften gemäß LG München, BFSG-Barrierefreiheit) sowie eine Entscheidungstabelle für die Übergangsphase zwischen Domain-Übertragung und Start der neuen Site. <br><br> **Reihenfolge der Schritte erweitert** von 5 auf 8 Schritte, um den parallelen Neuaufbau abzubilden. <br><br> **Risikoregister erweitert** um Einträge zu Backup-Vollständigkeit, Festplattenverschlüsselung, vergessenen Kalender-/Kontakt-Exporten und DSGVO-Verstößen beim Start der neuen Site. <br><br> **Neue Referenztabelle** zum Vergleich von Thunderbird, MailStore Home und imapsync. |

---

## Betroffene Domains

| Domain | Praxisinhaber | Status |
|---|---|---|
| `birgit-kretzschmar.de` | Birgit Kretzschmar (Tanz- und Lehrtherapeutin) | WordPress + Datenbank zu Hostinger migriert, Staging unter `mediumspringgreen-ant-406352.hostingersite.com` (vorerst als Übergangslösung live) |
| `kretzschmar-wiesbaden.de` | Dr. Alexander Kretzschmar (Psychologischer Psychotherapeut) | WordPress + Datenbank zu Hostinger migriert, Staging unter `sienna-kudu-455515.hostingersite.com` (vorerst als Übergangslösung live) |

Beide Staging-Sites wurden überprüft und sind funktionsfähig (Inhalte, Navigation und Bilder vollständig vorhanden).

## Kontext & Rahmenbedingungen

- Beide sind **professionelle psychotherapeutische Praxen** — patientennah, DSGVO-relevant, Ausfallzeiten sollten minimiert werden
- Strato-Kündigung wurde vor ca. 1 Monat eingereicht; **die AuthInfo-Codes für beide Domains nähern sich dem 30-Tage-Ablauf** (.de-Domains)
- Beide Auth-Codes liegen uns bereits vor
- Die migrierten WordPress-Sites dienen ausschließlich als **Übergangslösung** — beide Sites werden bei Hostinger **von Grund auf neu** in modernem Design aufgebaut
- Bis der Neuaufbau bereit ist, bleiben die migrierten Sites live, damit Patienten jederzeit funktionierende Kontaktinformationen erreichen

## Arbeitsbereiche

Drei Arbeitsbereiche im Umfang:

1. ⏳ **Übertragung der Domain-Registrierung** (.de) — ausstehend, zeitkritisch
2. ⏳ **E-Mail-Migration** über Backup-und-Wiederherstellung — ausstehend, kritisch für die Praxen
3. ⏳ **Neuaufbau der Sites** bei Hostinger im modernen Design — separates Projekt, läuft parallel

Die migrierten WordPress-Sites sind eine **Übergangsmaßnahme**, um die Praxen während des Übergangs erreichbar zu halten — kein langfristiges Ziel.

---

## 1. Übertragung der Domain-Registrierung (DRINGEND — Auth-Code-Frist läuft)

Vorgehen bei **Hostinger**:

1. Hostinger-Seite "Domain übertragen" öffnen
2. `birgit-kretzschmar.de` eingeben → bezahlen → AuthInfo-Code einfügen
3. Bei der Frage zu Nameservern **"Hostinger-Nameserver verwenden"** auswählen
4. Vorgang für `kretzschmar-wiesbaden.de` wiederholen
5. Die Bestätigungs-E-Mail von Hostinger anklicken

Bei .de-Domains ist die Übertragung in der Regel innerhalb von 1–4 Tagen abgeschlossen.

**Falls ein Auth-Code abläuft, bevor wir handeln:** einen neuen im Strato-Kundenservicebereich anfordern (Login-Bereich → Domainverwaltung → Link "Authcode anfordern" neben der gekündigten Domain). .de-Auth-Codes sind 30 Tage gültig und müssen danach erneut angefordert werden.

**Harte Frist:** das Strato-Kündigungsdatum selbst. Danach wird die Domain freigegeben und ist gefährdet. Das genaue "Vertragsende"-Datum aus der Strato-Kündigungsbestätigungs-E-Mail muss heute überprüft werden.

---

## 2. E-Mail-Migration über Backup-und-Wiederherstellung

Dieser Ansatz gibt den Kretzschmars jederzeit volle lokale Kontrolle über ihre E-Mails — risikoärmer als eine Live-IMAP-zu-IMAP-Synchronisation, und die lokale Kopie ist ein dauerhaftes Archiv in ihrem Besitz.

### Schritt A — Bestandsaufnahme bei Strato

Im Strato-E-Mail-Verwaltungsbereich pro Domain auflisten:
- Alle Postfächer (z. B. `kontakt@…`, `praxis@…`, `info@…`)
- Alle Weiterleitungen und Aliase
- Speicherkontingente und ungefähres E-Mail-Volumen pro Postfach
- Eventuell vorhandene CalDAV/CardDAV-Kalender/-Kontakte, die separat exportiert werden müssen

### Schritt B — Lokales Backup VOR der Umstellung (während Strato noch aktiv ist)

Die Kretzschmars führen dies an jedem Praxisrechner durch:

1. **Thunderbird** installieren (kostenlos, Windows/Mac/Linux)
2. Jedes Strato-Postfach per **IMAP** hinzufügen (nicht POP3 — entscheidend)
3. Für jeden Ordner (Posteingang, **Gesendet**, Entwürfe, eigene Ordner): Rechtsklick → Eigenschaften → Häkchen bei **"Diesen Ordner für die Offline-Nutzung synchronisieren"** setzen
4. Thunderbird alles herunterladen lassen — bei Jahren von Praxispost kann das Stunden dauern, möglicherweise über Nacht
5. Den Thunderbird-**Profilordner** auf der Festplatte lokalisieren und auf eine **verschlüsselte externe Festplatte** kopieren (BitLocker / FileVault / VeraCrypt) — enthält Patientenkorrespondenz und ist DSGVO-relevant

**Alternatives Werkzeug:** **MailStore Home** (kostenlos, Windows) — speziell für IMAP-Archivierung entwickelt, geführter Ablauf als Thunderbird. Wird häufig von kleinen deutschen Praxen für Anbieterwechsel verwendet. Empfehlenswert, wenn Thunderbird zu fummelig wirkt.

**Nicht vergessen:**
- Ordner "Gesendet" (wird leicht übersehen)
- Kalender (als `.ics` exportieren) und Kontakte (als `.vcf` exportieren), falls per CalDAV/CardDAV bei Strato genutzt
- Vor Schritt C die Vollständigkeit des Backups überprüfen

### Schritt C — E-Mail-Lösung bei Hostinger festlegen

Optionen:
- Hostingers im Hosting enthaltene E-Mail-Konten (begrenzt; prüfen, was im erworbenen Tarif enthalten ist)
- Hostinger Email (kostenpflichtig, separat vom Webhosting — empfohlen für die professionelle Nutzung)
- Google Workspace (extern, robusteste Lösung, erfordert MX-Eintrag auf Google statt auf Hostinger)

### Schritt D — Postfächer bei Hostinger neu anlegen

Im hPanel → E-Mails → jedes Postfach mit der **gleichen Adresse** wie bei Strato anlegen. Starke neue Passwörter vergeben. Sicher dokumentieren (vorzugsweise im Passwortmanager).

### Schritt E — E-Mails aus dem lokalen Backup in die Hostinger-Postfächer wiederherstellen

In Thunderbird:

1. Das **neue Hostinger-Postfach** als zweites IMAP-Konto hinzufügen
2. Mit beiden sichtbaren Konten (Strato alt und Hostinger neu) **Ordner oder ausgewählte E-Mails** vom alten Konto in die entsprechenden Ordner des Hostinger-Kontos **per Drag-and-Drop ziehen**
3. Thunderbird lädt sie über IMAP zu Hostinger hoch — Ordnerstruktur, Datumsangaben, Lese-/Ungelesen-Status und Anhänge bleiben erhalten
4. Falls das Strato-Postfach zu diesem Zeitpunkt bereits weg ist, stattdessen aus den **Lokalen Ordnern** (der Offline-Kopie) ziehen

Für MailStore-Home-Nutzer: die Funktion "In IMAP-Postfach exportieren" nutzen, ausgerichtet auf das neue Hostinger-Konto.

### Schritt F — MX-Einträge umstellen

Nachdem die Postfächer bei Hostinger bestehen und die Inhalte wiederhergestellt wurden, die MX-Einträge ändern (im Hostinger-DNS, sobald dieser für die .de-Domains zuständig ist), sodass sie auf Hostingers Mailserver zeigen. 24–72 Stunden Propagationszeit einplanen; einzelne E-Mails können in diesem Fenster noch bei Strato eingehen — das Strato-Postfach bis zum Ende des Fensters aktiv lassen.

### Schritt G — E-Mail-Programme aktualisieren

Birgit und Alexander müssen Outlook / Apple Mail / Smartphone-IMAP- und SMTP-Einstellungen auf Hostingers Server umstellen. An einem ruhigen Tag einplanen. Beide mit den neuen Servernamen, Ports und Passwörtern versorgen.

---

## 3. Neuaufbau der Sites bei Hostinger (Parallelprojekt)

Die migrierten WordPress-Sites sind eine Überbrückung. Das eigentliche Ziel sind **zwei neue Sites mit modernem Design**, frisch bei Hostinger aufgebaut.

### Vorgehen

- Die neuen Sites in einer **Staging-Umgebung** aufbauen (z. B. Subdomain `dev.kretzschmar-wiesbaden.de` oder Hostingers integrierte Staging-Werkzeuge), damit die alten Sites während der Entwicklung für Patienten erreichbar bleiben
- Wenn eine neue Site fertig und freigegeben ist, wird sie als primäre Site für die echte Domain eingewechselt
- Die migrierten alten Sites können dann archiviert oder gelöscht werden

Aus diesem Grund ist die Datenbank-Operation "Suchen-und-Ersetzen" auf den migrierten WP-Sites **nicht** zwingend nötig — sie sind nicht das langfristige Ziel.

### Empfehlungen für die neuen Sites (deutsche psychotherapeutische Praxen)

**DSGVO-Konformität — nicht verhandelbar:**
- Ordnungsgemäße Datenschutzerklärung und Impressum
- Cookie-Einwilligungsbanner nur, wenn Tracking/Cookies tatsächlich verwendet werden
- **Keine Google Fonts vom Google-CDN laden** — Schriften lokal hosten (LG-München-Urteil, 2022)
- **Kein Google Analytics ohne ausdrückliche Einwilligung**; datenschutzfreundliche Alternativen erwägen (selbst gehostetes Matomo, Plausible)
- TLS/SSL sitewide erzwungen (Hostinger erledigt das automatisch via Let's Encrypt)

**Inhalte und Formulare:**
- Viele deutsche Praxen verzichten ganz auf Kontaktformulare und veröffentlichen Telefonnummer + Info-E-Mail — einfacher und reduziert Datenminimierungsbedenken
- Falls ein Kontaktformular verwendet wird: minimale Felder, verschlüsselte Übertragung, klarer Einwilligungstext, dokumentierte Aufbewahrungsrichtlinie
- **Keine Patientenstimmen / Testimonials** — fachlich und rechtlich für Therapeuten in Deutschland heikel

**Barrierefreiheit:**
- BFSG (Barrierefreiheitsstärkungsgesetz) seit Juni 2025 in Kraft — psychotherapeutische Sites sind noch nicht direkt vorgeschrieben, aber WCAG 2.1 AA zu folgen ist gute Praxis und schützt vor künftigen Geltungserweiterungen

**Technische Grundlage:**
- WordPress bei Hostinger mit einem sauberen modernen Theme (Astra, Kadence, Blocksy — alle gute Optionen)
- Hostingers KI-Website-Builder ist eine Option für einfachere Sites, bietet aber weniger Flexibilität als WordPress
- Automatische Backups bei Hostinger ab Tag eins aktivieren

---

## Was geschieht mit den migrierten WP-Sites in der Zwischenzeit?

Drei Optionen für die Zeit zwischen Abschluss der Domain-Übertragung und Start der neuen Site:

| Option | Beschreibung | Empfehlung |
|---|---|---|
| **Migrierte WP-Sites live halten** | Die Primärdomain jeder Hostinger-Site von `*.hostingersite.com` auf die echte `.de` umstellen, sodass Besucher den vorhandenen (alten Design-) Inhalt sehen | ✅ **Empfohlen** — Patienten erreichen jederzeit funktionierende Kontaktinformationen |
| **Platzhalter "Site in Bearbeitung"** | Einfache Halteseite mit Telefonnummer, Adresse und E-Mail der Praxis | Akzeptabel, aber sichtbar unfertig; Patienten in Notlagen sollten das nicht sehen |
| **Weiterleitung auf eine temporäre Kontaktseite** | Einzelne statische Seite nur mit Kontaktinformationen | Schlechteste Option für aktive medizinische Praxen |

Für **aktive psychotherapeutische Praxen** ist Option 1 die richtige Wahl. Das alte Design ist nicht hübsch, aber eine funktionierende Seite ist weit besser als ein Platzhalter, wenn jemand dringend einen Termin benötigt.

Wenn Option 1 gewählt wird, ist nach DNS-Auflösung der .de-Domain auf Hostinger dieser kleine Schritt nötig:
- Im hPanel pro Site: Primärdomain von `*.hostingersite.com` auf die echte `.de`-Domain ändern
- Suchen-und-Ersetzen in der WP-Datenbank ausführen, um interne URLs zu aktualisieren (Hostinger hat ein integriertes Tool, oder Plugin Better Search Replace verwenden)
- Bestätigen, dass das SSL-Zertifikat für die .de-Domain automatisch ausgestellt wird

---

## Empfohlene Reihenfolge der Schritte

1. **Heute:** Beide Domain-Übertragungen bei Hostinger mit den Auth-Codes anstoßen. Damit beginnt die Frist und Schutz vor Auth-Code-Ablauf ist gegeben.
2. **Heute / morgen:** Strato-Postfächer inventarisieren; die Kretzschmars beginnen mit dem lokalen Thunderbird-/MailStore-Backup aller E-Mails.
3. **Innerhalb von 1–3 Tagen:** Vollständigkeit der Backups überprüfen; entsprechende Postfächer bei Hostinger anlegen.
4. **Sobald die Domain-Übertragung abgeschlossen ist** (1–4 Tage bei .de):
  - Primärdomain der migrierten WP-Sites auf die echte `.de` umstellen (Übergangslösung)
  - Suchen-und-Ersetzen in den WP-Datenbanken ausführen
  - MX-Einträge auf Hostinger-Mailserver aktualisieren
  - SSL-Ausstellung verifizieren
5. **E-Mail wiederherstellen** aus dem lokalen Backup in die Hostinger-Postfächer per Thunderbird-Drag-and-Drop oder MailStore-Export.
6. **Nach der Umstellung:**
  - E-Mail-Programm-Einstellungen von Birgit und Alexander aktualisieren (IMAP/SMTP)
  - Alle Kontaktformulare sowie ein- und ausgehende E-Mails testen
  - **Strato mindestens 7 Tage aktiv lassen** als Sicherheitsnetz für verspätete E-Mails
7. **Parallel (separates Projekt):** Mit Design und Aufbau der neuen modernen WordPress-Sites in Hostinger-Staging-Umgebungen beginnen.
8. **Wenn die neuen Sites fertig sind:** Jede Domain auf den neuen Aufbau umstellen; die migrierten alten WP-Installationen archivieren oder löschen.

---

## Risikoregister

| Risiko | Maßnahme |
|---|---|
| Auth-Code läuft vor Anstoß der Übertragung ab | Übertragungen sofort starten; bei Bedarf bei Strato neu anfordern |
| Strato-Kündigungsdatum verstreicht vor Anstoß der Übertragung | Genaues "Vertragsende"-Datum heute prüfen; Übertragung muss vorher gestartet sein |
| Lokales E-Mail-Backup unvollständig (z. B. Ordner "Gesendet" vergessen) | Alle Ordner vor Strato-Abschaltung offline synchronisiert prüfen; Ordnerzahlen vor Umstellung gegenprüfen |
| Backup-Festplatte verloren oder unverschlüsselt (DSGVO-Risiko) | BitLocker / FileVault / VeraCrypt verwenden; die Festplatte wie Patientendaten behandeln |
| Kalender/Kontakte beim Backup vergessen | CalDAV/CardDAV explizit als .ics/.vcf exportieren, falls bei Strato genutzt |
| E-Mails gehen während der Umstellung verloren | Lokales Backup als Sicherheitsnetz; Strato 7+ Tage nach Umstellung weiterlaufen lassen |
| Übergangs-WP-Site bricht nach Primärdomain-Wechsel | Gründliches Suchen und Ersetzen; Admin und Frontend vor der Bekanntmachung testen |
| SSL wird für .de-Domain nicht ausgestellt | Hostinger stellt Let's Encrypt automatisch aus; bei Verzögerung manuell aus dem hPanel anstoßen |
| Patienten erreichen die Praxis während der Umstellung nicht | Migrierte WP-Sites als Übergangslösung live halten; erst auf neues Design umstellen, wenn vollständig bereit |
| Neue Site geht mit DSGVO-Verstößen live | Pre-Launch-Checkliste: lokal gehostete Schriften, kein Google Analytics ohne Einwilligung, Datenschutzerklärung + Impressum vorhanden |

---

## Referenz: Strato Auth-Code-Anforderung (falls Neuausstellung nötig)

1. Im Strato-Login-Bereich mit Kundennummer oder Domainname anmelden
2. Schaltfläche "Einstellungen" → Vertragsservice → Domainverwaltung → Domain(s)-Übersicht
3. Neben der gekündigten Domain auf **Auth-Code anfordern** / **Authcode anfordern** klicken
4. Der Code wird an die hinterlegte E-Mail-Adresse des Domaininhabers verschickt (Zustellung innerhalb von ca. 24 Stunden)
5. .de-Codes sind ab Ausstellung 30 Tage gültig

## Referenz: E-Mail-Backup-Werkzeuge

| Werkzeug | Plattform | Kosten | Geeignet für |
|---|---|---|---|
| **Thunderbird** | Windows / Mac / Linux | Kostenlos | Drag-and-Drop-Backup und -Wiederherstellung über IMAP; flexibel, aber manuell |
| **MailStore Home** | Windows | Kostenlos (Privatnutzung) | Geführte IMAP-Archivierung mit durchsuchbarem Archiv; einfachere Bedienung |
| **imapsync** | Linux / Mac (Kommandozeile) | Kostenlos (einige bezahlte Binärpakete) | Server-zu-Server-Synchronisation ohne lokale Zwischenstation; technisch versierte Nutzer |